<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Password;
use InvalidArgumentException;

class GenerateProductsAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if (Hash::check('12345678', $fields['password'])) {
            foreach ($models as $model) {
                $template = $model->template;
                $string = '';
                $total = 1;

                foreach ($template as $locale) {
                    foreach ($locale as $item) {
                        $values[] = explode('-', $item['value']);
                    }
                    foreach ($values as $value) {
                        $count = count($value);
                        if($count > 1) {
                            $total *= $count;
                        }
                    }
                    dd($total);
                }

            }
        } else {
            throw new InvalidArgumentException('The given password is invalid.');
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Password::make('Password')->rules(REQUIRED_PASSWORD_NOT_CONFIRMED_VALIDATION),
        ];
    }
}
