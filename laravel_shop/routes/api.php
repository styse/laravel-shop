<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'v1', 
    'as' => 'api.', 
    'namespace' => 'App\Http\Controllers', 
    'middleware' => []
], function () {
    Route::post('register', 'UsersController@store');
    Route::post('login', 'UsersController@login');
});


Route::group([
    'prefix' => 'v1', 
    'as' => 'api.', 
    'namespace' => 'App\Http\Controllers', 
    'middleware' => [
            // App\Http\Middleware\HandlePutFormData::class,
            'auth:api',
    ]
], function () {
    Route::apiResource('categories', 'CategoriesController');
    Route::apiResource('products', 'ProductsController');
    Route::apiResource('providers', 'ProvidersController');
    Route::put('person/{phone}', 'usersController@update');
    Route::get('person/{id}', 'usersController@show');
    Route::get('people', 'usersController@index');
    Route::post('changePassword', 'usersController@changePassword');
});