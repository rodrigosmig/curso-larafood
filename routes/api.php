<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('sanctum/token/', 'Api\\Auth\\AuthClientController@auth');

Route::group([
    'middleware' => ['auth:sanctum']
], function() {
    Route::get('auth/me', 'Api\\Auth\\AuthClientController@me');
    Route::post('auth/logout', 'Api\\Auth\\AuthClientController@logout');
    Route::post('auth/orders', 'Api\\OrderController@store');
    Route::get('auth/my-orders', 'Api\\OrderController@myOrders');

    Route::post('auth/orders/{identify}/evaluations', 'Api\\EvaluationController@store');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function() {
    Route::get('tenants/{uuid}', 'TenantController@show');
    Route::get('tenants', 'TenantController@index');

    Route::get('categories/{identify}', 'CategoryController@show');
    Route::get('categories', 'CategoryController@categoriesByTenant');

    Route::get('tables/{identify}', 'TableController@show');
    Route::get('tables', 'TableController@tablesByTenant');

    Route::get('products/{identify}', 'ProductController@show');
    Route::get('products', 'ProductController@productsByTenant');

    Route::post('clients/', 'Auth\\RegisterController@store');

    Route::post('orders/', 'OrderController@store');
    Route::get('orders/{identify}', 'OrderController@show');
});
