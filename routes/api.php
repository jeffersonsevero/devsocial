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



Route::get('/ping', function(){

    return ['pong' => true];

});



Route::get('/401', 'AuthController@unauthorized')->name('auth.unauthorized');


Route::post('/auth/login', 'AuthController@login')->name('auth.login');
Route::post('/auth/logout', 'AuthController@logout')->name('auth.logout');
Route::post('/auth/refresh', 'AuthController@refresh')->name('auth.refresh');

Route::post('/user', 'AuthController@create')->name('auth.create');
Route::put('/user', 'UserController@update')->name('user.update');
Route::post('/user/avatar', 'UserController@updateAvatar')->name('user.updateAvatar');
// Route::post('/user/cover', 'UserController@updateCover')->name('user.updateCover');


// Route::get('/feed', 'FeedController@read')->name('feed.read');
// Route::get('/user/feed', 'FeedController@userFeed')->name('feed.userFeed');
// Route::get('/user/{id}/feed', 'FeedController@userFeed')->name('user.userFeed.byid');


// Route::get('/user', 'UserController@read')->name('user.read');
// Route::get('/user/{id}', 'UserController@read')->name('user.read.byid');


// Route::post('/feed', 'FeedController@create')->name('feed.create');

// Route::post('/post/{id}/like', 'PostController@like')->name('post.like');
// Route::post('/post/{id}/comment', 'PostController@comment')->name('post.comment');


// Route::get('/search', 'SearchController@search')->name('search.search');













