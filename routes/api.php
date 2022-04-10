<?php

use App\Http\Controllers\Api\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('loadData/{product_id}', [TemplateController::class, 'loadData']);
