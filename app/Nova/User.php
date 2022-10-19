<?php

namespace App\Nova;

use App\Helpers\Nova\Fields;
use App\Nova\Filters\UserStatus;
use App\Nova\Filters\UserType;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersStatus;
use App\Nova\Metrics\UsersType;
use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    use HasDependencies;

    public static $model = \App\Models\User::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'email', 'phone', 'phone2', 'address', 'address2'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION)->hideFromIndex(),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

            Text::make('Email')
                ->sortable()
                ->rules(REQUIRED_EMAIL_VALIDATION)
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Fields::image(false, USER_PROFILE, 'Profile', true),

            Fields::image(false, USER_COVER, 'Cover', true),

            Text::make('Phone')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Phone2')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Address')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Address2')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Toggle::make('Active')
                ->falseColor('#bacad6')
                ->editableIndex(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Select::make('Type')->options([
                'individual' => 'Individual',
                'company' => 'Company'
            ])->default('individual')->displayUsingLabels()
                ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:individual,company'])),

            NovaDependencyContainer::make([
                Fields::file(true, COMPANY_PATH, 'Licenses', false),
            ])->dependsOn('type', 'company'),

            HasMany::make('Orders'),

        ];
    }

    public function cards(Request $request)
    {
        return [
            new UsersType,
            new UsersPerDay,
            new UsersStatus
        ];
    }

    public function filters(Request $request)
    {
        return [
            new UserType,
            new UserStatus,
        ];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }

    public static function canSort(NovaRequest $request, $resource) {
        return false;
    }
}
