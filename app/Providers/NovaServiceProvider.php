<?php

namespace App\Providers;

use App\Nova\Admin;
use App\Nova\Category;
use App\Nova\FAQ;
use App\Nova\Language;
use App\Nova\Order;
use App\Nova\Product;
use App\Nova\SubCategory;
use App\Nova\User;
use App\Nova\Vendor;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\Group;
use DigitalCreative\CollapsibleResourceManager\Resources\NovaResource;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use function Symfony\Component\Translation\t;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
//            new Help(),
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
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
                            Order::class
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
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Management',
                        'expanded' => true,
                        'resources' => [
                            Admin::class,
                            User::class,
                            Vendor::class,
                            Group::make([
                                'label' => 'Settings',
                                'expanded' => false,
                                'resources' => [
                                    Language::class,
                                    NovaResource::make(FAQ::class)->label('FAQs'),
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
            ])
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 99999;
        });
    }
}
