<?php

use Illuminate\Http\Request;

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
    'middleware' => 'api',
], function ($router) {
    Route::post('/user/register', 'api\\JWTAuthController@register');
    Route::post('/user/login', 'api\\JWTAuthController@login');
    Route::get('/user/logout', 'api\\JWTAuthController@logout');
    Route::post('/user/refresh', 'api\\JWTAuthController@refresh');
    Route::get('/user/me', 'api\\JWTAuthController@me');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('banners', 'api\\BannerController@index')->name('api.banners.index');