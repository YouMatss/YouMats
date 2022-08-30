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

                dd($this->printf($this->reformat($template)));

            }
            dd('break');
        } else {
            throw new InvalidArgumentException('The given password is invalid.');
        }
    }

    private function reformat($template) {
        $formattedTemplate = [];
        $values = [];
        $templateLength = count($template['ar']);
        $maxLength = 1;

        foreach ($template['ar'] as $item) {
            $tempValue = explode('-', $item['value']);
            if($maxLength < count($tempValue)) {
                $maxLength = count($tempValue);
            }
            $values[] = $tempValue;
        }

        foreach ($values as $key => $value) {
            if(count($value) < $maxLength) {
                $formattedTemplate[$key] = $value;
                for ($i = count($value); $i < $maxLength; $i++) {
                    $formattedTemplate[$key][$i] = '';
                }
            } else {
                $formattedTemplate[$key] = $value;
            }
        }

        return [
            'template' => $formattedTemplate,
            'templateLength' => $templateLength,
            'maxLength' => $maxLength
        ];
    }

    private function printf($arr) {
        $output = [];

        for ($i = 0; $i < $arr['maxLength']; $i++) {
            if($arr['template'][0][$i] != '')
                $this->printUntil($arr, 0, $i, $output);
        }
    }

    private function printUntil($arr, $m, $n, $output) {
        $string = '';
        $result = [];
        $output[$m] = $arr['template'][$m][$n];

        if($m == $arr['templateLength'] - 1) {
            for ($i = 0; $i < $arr['templateLength']; $i++) {
                $string .= $output[$i] . ' ';
            }
            $result[] = $string;

            dd($result);

            return $result;
        }

        for($j = 0; $j < $arr['maxLength']; $j++) {
            $s = $m+1;
            if ($arr['template'][$s][$j] != '')
                $this->printUntil($arr, $s, $j, $output);
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
