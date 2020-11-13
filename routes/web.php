<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resources([
    'banners' => 'BannerController',
    'posts' => 'PostController'
]);

Route::post('posts/{id}/comments', 'PostController@comments')->name('posts.comments');
Route::delete('posts/{id}/comments', 'PostController@comments_destroy')->name('posts.comments_destroy');
