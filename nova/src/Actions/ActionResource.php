<?php

namespace Laravel\Nova\Actions;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\MorphToActionTarget;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class ActionResource extends Resource {

    public static $model = ActionEvent::class;
    public static $globallySearchable = false;

    public static $tableStyle = 'tight';

    public static $polling = true;
    public static $pollingInterval = 30;
    public static $showPollingToggle = true;

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return true;
    }

    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id'),
            Text::make(__('Action Name'), 'name', function ($value) {
                return __($value);
            }),

            Text::make(__('Action Initiated By'), function () {
                return $this->user->name ?? $this->user->email ?? __('Nova User');
            }),

            MorphToActionTarget::make(__('Action Target'), 'target'),

            Status::make(__('Action Status'), 'status', function ($value) {
                return __(ucfirst($value));
            })->loadingWhen([__('Waiting'), __('Running')])->failedWhen([__('Failed')]),

            $this->when(isset($this->original), function () {
                return KeyValue::make(__('Original'), 'original');
            }),

            $this->when(isset($this->changes), function () {
                return KeyValue::make(__('Changes'), 'changes');
            }),

            Textarea::make(__('Exception'), 'exception'),

            DateTime::make(__('Action Happened At'), 'created_at')->exceptOnForms(),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->with('user');
    }

    public static function availableForNavigation(Request $request)
    {
        return true;
    }

    public static function searchable()
    {
        return true;
    }

    public static function label()
    {
        return __('Actions');
    }

    public static function singularLabel()
    {
        return __('Action');
    }

    public static function uriKey()
    {
        return 'action-events';
    }
}
