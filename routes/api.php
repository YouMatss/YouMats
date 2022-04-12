<?php

use App\Http\Controllers\Api\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('loadData/{category}/product/{product?}', [TemplateController::class, 'loadData']);
