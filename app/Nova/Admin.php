<?php

namespace App\Nova;

use Laravel\Nova\Actions\ActionResource;
use Vyuldashev\NovaPermission\PermissionBooleanGroup;
use Vyuldashev\NovaPermission\Role;
use Vyuldashev\NovaPermission\Permission;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Vyuldashev\NovaPermission\RoleBooleanGroup;

class Admin extends Resource {
    public static $model = \App\Models\Admin::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'email',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Name')
                ->sortable()
                ->hideFromIndex()
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

            Text::make('Email')
                ->sortable()
                ->rules(REQUIRED_EMAIL_VALIDATION)
                ->creationRules('unique:admins,email')
                ->updateRules('unique:admins,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            MorphToMany::make('Roles', 'roles', Role::class),
            MorphToMany::make('Permissions', 'permissions', Permission::class),

            RoleBooleanGroup::make('Roles'),
            PermissionBooleanGroup::make('Permissions'),

        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
