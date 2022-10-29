<?php

namespace App\Nova\Actions;

use App\Imports\SubscribersImport;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportSubscribers extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $showOnIndex = false;
    public $showOnDetail = false;

    public function handle(ActionFields $fields) {
        Excel::import(new SubscribersImport, $fields->file);

        return Action::message('It worked!');
    }

    public function fields()
    {
        return [
            File::make('File')->rules(REQUIRED_EXCEL_VALIDATION),
        ];
    }
}
