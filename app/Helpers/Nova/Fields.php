<?php

namespace App\Helpers\Nova;

use Drobee\NovaSluggable\Slug;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;

class Fields {

    /**
     * @param string $model
     * @param string $tableName
     * @return Panel
     */
    public static function SEO(string $model, string $tableName): Panel
    {
        return (new Panel('SEO', [
            Slug::make('Slug')
                ->slugLanguage('en')
                ->slugUnique()
                ->slugModel($model)
                ->event('blur')
                ->hideFromIndex()
                ->rules(REQUIRED_STRING_VALIDATION)
                ->creationRules("unique:$tableName,slug")
                ->updateRules("unique:$tableName,slug,{{resourceId}}"),

            Text::make('Meta Title', 'meta_title')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION)
                ->translatable(),

            Text::make('Meta Keywords', 'meta_keywords')
                ->hideFromIndex()
                ->rules(NULLABLE_TEXT_VALIDATION)
                ->translatable(),

            Textarea::make('Meta Description', 'meta_desc')
                ->hideFromIndex()
                ->rules(NULLABLE_TEXT_VALIDATION)
                ->alwaysShow()
                ->translatable(),

            Code::make('Schema')
                ->hideFromIndex()
                ->rules(NULLABLE_TEXT_VALIDATION),
        ]));
    }

}
