<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Load the routes for the v1 API
Route::prefix('v1')
->middleware('auth:sanctum')
    ->group(function () {
        \App\Helpers\Routes\RouteHelper::includeRouteFiles(__DIR__ . '/v1');

    });
