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

Route::group([
    'prefix' => 'v1',
], function() {
    Route::get('tenants/{uuid}', 'Api\\TenantController@show');
    Route::get('tenants', 'Api\\TenantController@index');

    Route::get('categories/{url}', 'Api\\CategoryController@show');
    Route::get('categories', 'Api\\CategoryController@categoriesByTenant');

    Route::get('tables/{identify}', 'Api\\TableController@show');
    Route::get('tables', 'Api\\TableController@tablesByTenant');

    Route::get('products/{flag}', 'Api\\ProductController@show');
    Route::get('products', 'Api\\ProductController@productsByTenant');
});
