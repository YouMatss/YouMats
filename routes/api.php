<?php

use App\Http\Controllers\Api\GenerateProductController;
use App\Http\Controllers\Api\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('loadData/{category}/product/{product?}', [TemplateController::class, 'loadData']);
Route::get('loadData/{category}/model/{model?}', [GenerateProductController::class, 'loadData']);
