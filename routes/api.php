<?php

use App\Http\Controllers\Api\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('getTemplate/{category_id}', [TemplateController::class, 'get']);
