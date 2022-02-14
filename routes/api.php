<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\DeveloperController;

Route::apiResource('levels', LevelController::class)->names('api.v1.levels');
Route::apiResource('developers', DeveloperController::class)->names('api.v1.developers');

