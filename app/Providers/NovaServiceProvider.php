<?php

namespace App\Providers;

use Anaseqal\NovaImport\NovaImport;
use App\Nova\Admin;
use App\Nova\Attribute;
use App\Nova\Category;
use App\Nova\City;
use App\Nova\Contact;
use App\Nova\Country;
use App\Nova\Coupon;
use App\Nova\Currency;
use App\Nova\FAQ;
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
use App\Nova\Metrics\SubCategoryCount;
use App\Nova\Metrics\SubscribersCount;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersStatus;
use App\Nova\Metrics\UsersType;
use App\Nova\Order;
use App\Nova\Page;
use App\Nova\PaymentGateway;
use App\Nova\Product;
use App\Nova\Quote;
use App\Nova\Slider;
use App\Nova\SubCategory;
use App\Nova\Subscriber;
use App\Nova\Tag;
use App\Nova\Team;
use App\Nova\Unit;
use App\Nova\User;
use App\Nova\Vendor;
use App\Observers\CategoryObserver;
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
use KABBOUCHI\LogsTool\LogsTool;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Richardkeep\NovaTimenow\NovaTimenow;
use Spatie\BackupTool\BackupTool;
use Vyuldashev\NovaPermission\NovaPermissionTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
//        Nova::serving(function () {
//            \App\Models\Category::observe(CategoryObserver::class);
//        });
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
            new SubCategoryCount,
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
                            SubCategory::class,
                            Product::class,
                            Tag::class,
                            Attribute::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Vendors',
                        'expanded' => false,
                        'resources' => [
                            Vendor::class,
                            Membership::class
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
                            Admin::class,
                            Team::class,
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
                    ])
                ]
            ]),
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
        ];
    }

    public function register()
    {

    }
}
