<?php

namespace App\Nova;

use App\Nova\Filters\Order\OrderDate;
use App\Nova\Filters\Order\OrderStatus;
use App\Nova\Filters\Order\PaymentMethod;
use App\Nova\Filters\Order\PaymentStatus;
use App\Nova\Metrics\OrdersPerDay;
use App\Nova\Metrics\OrdersStatus;
use App\Nova\Metrics\Revenue;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Order extends Resource
{
    public static $model = \App\Models\Order::class;

    public static $title = 'order_id';

    public static $tableStyle = 'tight';

    public static $polling = true;
    public static $pollingInterval = 30;
    public static $showPollingToggle = true;

    public static $search = [
        'id', 'order_id', 'name', 'email'
    ];

    public static function relatableQuery(NovaRequest $request, $query) {
        return $query->where('type', 'individual');
    }

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('order_id')->readonly()->default('ORD-'.strtoupper(uniqid())),
            DateTime::make('Date', 'created_at')->format('LLLL')->hideWhenCreating()->hideWhenUpdating()->sortable(),
            BelongsTo::make('User')->withoutTrashed()->hideFromIndex(),
            Text::make('Name')->sortable()->rules(REQUIRED_STRING_VALIDATION),
            Text::make('Email')->hideFromIndex()->rules(REQUIRED_EMAIL_VALIDATION),
            Text::make('Phone')->sortable()->rules(REQUIRED_STRING_VALIDATION),
            Text::make('Phone2')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
            Text::make('Address')->hideFromIndex()->rules(REQUIRED_STRING_VALIDATION),
            Text::make('Building Number')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
            Text::make('Street')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
            Text::make('District')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
            Text::make('City')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),

            (Panel::make('Payment Information', [
                Select::make('Payment Method')->options([
                    'cash' => 'Cash',
                    'credit card' => 'Credit Card',
                    'paypal' => 'PayPal'
                ])->default('cash')->displayUsingLabels()
                    ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:cash,credit card,paypal'])),

                NovaDependencyContainer::make([
                    Text::make('Reference Number')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
                    Text::make('Card Number')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
                    Text::make('Card Type')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
                    Text::make('Card Name')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
                    Text::make('Card Expire Date', 'card_exp_date')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
                    DateTime::make('Transaction Date')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
                ])->dependsOnNot('payment_method', 'cash'),
            ])),

            Select::make('Payment Status')->options([
                'pending' => 'Pending',
                'refunded' => 'Refunded',
                'completed' => 'Completed'
            ])->default('pending')->hideFromIndex()->hideFromDetail()
                ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:pending,refunded,completed'])),
            Indicator::make('Payment Status')->colors([
                'pending' => 'yellow',
                'refunded' => 'red',
                'completed' => 'green'
            ])->labels([
                'pending' => 'Pending',
                'refunded' => 'Refunded',
                'completed' => 'Completed'
            ]),

            Select::make('Order Status', 'status')->options([
                'pending' => 'Pending',
                'shipping' => 'Shipping',
                'completed' => 'Completed',
                'refused' => 'Refused'
            ])->default('pending')->hideFromIndex()->hideFromDetail()
                ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:pending,shipping,completed,refused'])),
            Indicator::make('Order Status', 'status')->colors([
                'pending' => 'yellow',
                'shipping' => 'orange',
                'completed' => 'green',
                'refused' => 'red',
            ])->labels([
                'pending' => 'Pending',
                'shipping' => 'Shipping',
                'completed' => 'Completed',
                'refused' => 'Refused'
            ]),

            Textarea::make('Notes')->rules(NULLABLE_TEXT_VALIDATION),
            Textarea::make('Refused Notes')->rules(NULLABLE_TEXT_VALIDATION),

            Currency::make('Total Price')->rules(REQUIRED_NUMERIC_VALIDATION),

            HasMany::make('Order Items', 'items'),

        ];
    }

    public function cards(Request $request)
    {
        return [
            new Revenue,
            new OrdersPerDay,
            new OrdersStatus
        ];
    }

    public function filters(Request $request)
    {
        return [
            new OrderDate,
            new PaymentStatus,
            new OrderStatus,
            new PaymentMethod
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
}
