<?php

namespace App\Providers;

use Anaseqal\NovaImport\NovaImport;
use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\Vendor as VendorModel;
use App\Nova\Admin;
use App\Nova\Car;
use App\Nova\CarType;
use App\Nova\Category;
use App\Nova\City;
use App\Nova\Contact;
use App\Nova\Country;
use App\Nova\Coupon;
use App\Nova\Currency;
use App\Nova\Driver;
use App\Nova\FAQ;
use App\Nova\GenerateProduct;
use App\Nova\Inquire;
use App\Nova\Language;
use App\Nova\Membership;
use App\Nova\Metrics\CategoryCount;
use App\Nova\Metrics\ContactCount;
use App\Nova\Metrics\OrdersPerDay;
use App\Nova\Metrics\OrdersStatus;
use App\Nova\Metrics\ProductCount;
use App\Nova\Metrics\Quote\QuotePerDay;
use App\Nova\Metrics\Quote\QuotesStatus;
use App\Nova\Metrics\Revenue;
use App\Nova\Metrics\SubscribersCount;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersStatus;
use App\Nova\Metrics\UsersType;
use App\Nova\Order;
use App\Nova\Page;
use App\Nova\Partner;
use App\Nova\PaymentGateway;
use App\Nova\Product;
use App\Nova\Quote;
use App\Nova\Slider;
use App\Nova\StaticImage;
use App\Nova\Subscribe;
use App\Nova\Subscriber;
use App\Nova\Tag;
use App\Nova\Team;
use App\Nova\Trip;
use App\Nova\Unit;
use App\Nova\User;
use App\Nova\Vendor;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\VendorObserver;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use Bernhardh\NovaTranslationEditor\NovaTranslationEditor;
use ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\Group;
use DigitalCreative\CollapsibleResourceManager\Resources\InternalLink;
use DigitalCreative\CollapsibleResourceManager\Resources\NovaResource;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Infinety\Filemanager\FilemanagerTool;
use KABBOUCHI\LogsTool\LogsTool;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Panel;
use Mirovit\NovaNotifications\NovaNotifications;
use OptimistDigital\NovaSettings\NovaSettings;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;
use Richardkeep\NovaTimenow\NovaTimenow;
use Spatie\BackupTool\BackupTool;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use Waynestate\Nova\CKEditor;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
        try {
            CategoryModel::fixTree();
            NovaSettings::addSettingsFields([
                new Panel('General', $this->generalData()),
                new Panel('General SEO', $this->generalSeo()),
                new Panel('Social Media Links', $this->socialFields()),
            ], [], 'General');
            NovaSettings::addSettingsFields([
                new Panel('Vendor Terms', $this->vendorTerms())
            ], [], 'Vendor Terms');
            NovaSettings::addSettingsFields([
                new Panel('Redirect 301', $this->redirect301())
            ], [], 'Redirect 301');
            Nova::serving(function () {
                CategoryModel::observe(CategoryObserver::class);
                ProductModel::observe(ProductObserver::class);
                VendorModel::observe(VendorObserver::class);
            });
        } catch (\Exception $e) {}
    }

    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    protected function cards()
    {
        return [
            (new NovaTimenow)->timezones([
                'Asia/Riyadh',
                'Africa/Cairo',
                'Asia/Dubai',
                'America/New_York',
                'Australia/Sydney',
                'Europe/Paris',
                'Europe/London',
            ])->defaultTimezone('Asia/Riyadh'),
            new UsersType,
            new UsersPerDay,
            new UsersStatus,
            new Revenue,
            new OrdersPerDay,
            new OrdersStatus,
            new QuotePerDay,
            new QuotesStatus,
            new CategoryCount,
            new ProductCount,
            new SubscribersCount,
            new ContactCount
        ];
    }

    protected function dashboards()
    {
        return [];
    }

    public function tools()
    {
        return [
            NovaBreadcrumbs::make(),
            (NovaPermissionTool::make()
                ->rolePolicy(RolePolicy::class)
                ->permissionPolicy(PermissionPolicy::class)
            )->canSee(function ($request) {
                return $request->user()->isSuperAdmin();
            }),
            new CollapsibleResourceManager([
                'disable_default_resource_manager' => true,
                'remember_menu_state' => true,

                'navigation' => [
                    TopLevelResource::make([
                        'label' => 'Orders',
                        'expanded' => true,
                        'icon' => '',
                        'resources' => [
                            Order::class,
                            Quote::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Products',
                        'expanded' => true,
                        'icon' => '',
                        'resources' => [
                            Category::class,
                            Product::class,
                            Tag::class,
                            InternalLink::make([
                                'label' => 'Create Main Category',
                                'target' => '_self',
                                'badge' => null,
                                'icon' => null,
                                'path' => '/resources/main-categories/new'
                            ]),
                            InternalLink::make([
                                'label' => 'Create Sub Category',
                                'target' => '_self',
                                'badge' => null,
                                'icon' => null,
                                'path' => '/resources/sub-categories/new'
                            ]),
                            NovaResource::make(GenerateProduct::class)->canSee(function ($request) {
                                return $request->user()->isSuperAdmin();
                            }),
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Vendors',
                        'expanded' => false,
                        'resources' => [
                            Vendor::class,
                            Subscribe::class,
                            Membership::class
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Tracker',
                        'expanded' => false,
                        'resources' => [
                            Trip::class,
                            Driver::class,
                            Car::class,
                            CarType::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Users',
                        'expanded' => false,
                        'resources' => [
                            User::class,
                            Subscriber::class,
                            Contact::class,
                            NovaResource::make(Inquire::class)->label('Inquire (Fast Quote)'),
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Management',
                        'expanded' => true,
                        'resources' => [
                            InternalLink::make([
                                'label' => 'File Manager (Extra)',
                                'target' => '_self',
                                'path' => '/nova-filemanager?path=extra'
                            ]),
                            Admin::class,
                            StaticImage::class,
                            Team::class,
                            Partner::class,
                            Slider::class,
                            Group::make([
                                'label' => 'Settings',
                                'expanded' => false,
                                'resources' => [
                                    Language::class,
                                    Currency::class,
                                    PaymentGateway::class,
                                    Coupon::class,
                                    Page::class,
                                    NovaResource::make(FAQ::class)->label('FAQs'),
                                    Unit::class,
                                    NovaResource::make(ActionResource::class)->label('Activity Logs')
                                    ->canSee(function ($request) {
                                        return $request->user()->isSuperAdmin();
                                    }),
                                ]
                            ]),
                            Group::make([
                                'label' => 'Countries',
                                'expanded' => false,
                                'resources' => [
                                    Country::class,
                                    City::class
                                ]
                            ]),
                            Group::make([
                                'label' => 'Permissions',
                                'expanded' => false,
                                'resources' => [
                                    NovaPermissionTool::make()->roleResource,
                                    NovaPermissionTool::make()->permissionResource
                                ]
                            ]),
                        ]
                    ]),
                ]
            ]),
            NovaSettings::make()->canSee(function ($request) {
                return $request->user()->isSuperAdmin();
            }),
            new FilemanagerTool(),
            NovaTranslationEditor::make(),
            (new BackupTool())
                ->canSee(function ($request) {
                    return $request->user()->isSuperAdmin();
                }),
            (new LogsTool())
                ->canSee(function ($request) {
                    return $request->user()->isSuperAdmin();
                })
                ->canDownload(function ($request) {
                    return $request->user()->isSuperAdmin();
                })
                ->canDelete(function ($request) {
                    return $request->user()->isSuperAdmin();
                }),
            new NovaImport,
            NovaNotifications::make(),
        ];
    }

    public function register()
    {

    }

    /**
     * @return array
     */
    private function socialFields(): array
    {
        return [
            Text::make('Facebook')->rules(NULLABLE_URL_VALIDATION),
            Text::make('Twitter')->rules(NULLABLE_URL_VALIDATION),
        ];
    }

    private function generalData(): array
    {
        return [
            Text::make('Site Name', 'site_name')
                ->rules(REQUIRED_STRING_VALIDATION)->translatable(),
            Text::make('Main Phone', 'phone')
                ->rules(REQUIRED_STRING_VALIDATION),
            Text::make('Widget Phone', 'widget_phone')
                ->rules(REQUIRED_STRING_VALIDATION),
            Text::make('Widget Whatsapp', 'widget_whatsapp')
                ->rules(REQUIRED_STRING_VALIDATION),
        ];
    }

    /**
     * @return array
     */
    private function generalSeo(): array
    {
        return [
            Text::make('Home Meta Title', 'home_meta_title')
                ->rules(NULLABLE_STRING_VALIDATION)->translatable(),

            Text::make('Home Meta Keywords', 'home_meta_keywords')
                ->rules(NULLABLE_TEXT_VALIDATION)->translatable(),

            Textarea::make('Home Meta Description', 'home_meta_desc')
                ->rules(NULLABLE_TEXT_VALIDATION)->translatable(),

            Code::make('Home Schema', 'home_schema')
                ->rules(NULLABLE_TEXT_VALIDATION),

            Text::make('Categories Additional Word', 'categories_additional_word')
                ->rules(NULLABLE_STRING_VALIDATION)->translatable(),

            Text::make('Products Additional Word', 'products_additional_word')
                ->rules(NULLABLE_STRING_VALIDATION)->translatable(),

        ];
    }

    /**
     * @return array
     */
    private function vendorTerms(): array
    {
        return [
            Text::make('Title', 'vendor_terms_title')
                ->rules(REQUIRED_STRING_VALIDATION)->translatable(),
            CKEditor::make('Text', 'vendor_terms_text')
                ->rules(REQUIRED_TEXT_VALIDATION)->translatable(),
            Text::make('Button', 'vendor_terms_button')
                ->rules(REQUIRED_STRING_VALIDATION)->translatable(),
        ];
    }

    /**
     * @return array
     */
    private function redirect301(): array
    {
        return [
            SimpleRepeatable::make('Redirect', 'redirect', [
                Text::make('From')->rules(REQUIRED_STRING_VALIDATION),
                Text::make('To')->rules(REQUIRED_STRING_VALIDATION)
            ])->canAddRows(true)->canDeleteRows(true),
        ];
    }
}
