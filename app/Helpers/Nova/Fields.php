<?php

namespace App\Helpers\Nova;

use DmitryBubyakin\NovaMedialibraryField\Fields\GeneratedConversions;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Drobee\NovaSluggable\Slug;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;

class Fields {
    /**
     * @param string $model
     * @param string $tableName
     * @param bool $requiredSlug
     * @param bool $is_canonical
     * @param bool $translatable_schema
     * @return Panel
     */
    public static function SEO(string $model, string $tableName, bool $requiredSlug = true, bool $is_canonical = false, bool $translatable_schema = false): Panel
    {
        if($requiredSlug)
            $slugValidation = REQUIRED_STRING_VALIDATION;
        else
            $slugValidation = NULLABLE_STRING_VALIDATION;

        $attributes = [
            Slug::make('Slug')
                ->slugLanguage('en')
                ->slugUnique()
                ->slugModel($model)
                ->event('blur')
                ->hideFromIndex()
                ->rules($slugValidation)
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
        ];

        $schema = Code::make('Schema')
            ->hideFromIndex()
            ->rules(NULLABLE_TEXT_VALIDATION);

        if($translatable_schema) {
            $schema = Code::make('Schema')
                ->hideFromIndex()
                ->rules(NULLABLE_TEXT_VALIDATION)
                ->translatable();
        }

        $attributes[] = $schema;

        if($is_canonical) {
            $canonical = Text::make('Canonical')->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION)->translatable();

            $attributes[] = $canonical;
        }

        return (new Panel('SEO', $attributes));
    }

    /**
     * @param bool $isRequired
     * @param string $mediaCollection
     * @param string $name
     * @param bool $single
     * @param string|null $helpText
     * @return Medialibrary
     */
    public static function image(bool $isRequired, string $mediaCollection, string $name = 'Image', bool $single = true, string $helpText = null): Medialibrary
    {
        $image = Medialibrary::make($name, $mediaCollection)->fields(function() {
            return [
                Text::make('File Name', 'file_name')->rules('required', 'min:2'),
                Text::make('Image Title', 'img_title')->translatable()->rules(NULLABLE_STRING_VALIDATION),
                Text::make('Image Alt', 'img_alt')->translatable()->rules(NULLABLE_STRING_VALIDATION),
                GeneratedConversions::make('Conversions')->withTooltips(),
            ];
        })->attachRules($isRequired ? REQUIRED_IMAGE_VALIDATION : NULLABLE_IMAGE_VALIDATION)
            ->accept('image/*')
            ->autouploading()->sortable()->attachOnDetails()
            ->hideFromIndex()->attachExisting($mediaCollection)
            ->croppable('cropper')
            ->help($helpText);

        if($single)
            $image->single();

        return $image;
    }

    /**
     * @param bool $isRequired
     * @param string $mediaCollection
     * @param string $name
     * @param bool $single
     * @param string|null $helpText
     * @return Medialibrary
     */
    public static function file(bool $isRequired, string $mediaCollection, string $name = 'File', bool $single = true, string $helpText = null): Medialibrary
    {
        $file = Medialibrary::make($name, $mediaCollection)->fields(function() {
            return [
                Text::make('File Name', 'file_name')->rules('required', 'min:2')
            ];
        })->attachRules($isRequired ? REQUIRED_FILE_VALIDATION : NULLABLE_FILE_VALIDATION)
            ->accept('*')
            ->autouploading()->sortable()->attachOnDetails()
            ->hideFromIndex()->attachExisting($mediaCollection)
            ->help($helpText);

        if($single)
            $file->single();

        return $file;
    }
}
