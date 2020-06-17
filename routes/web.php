<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('videos', 'VideoController', ['only' => ['index', 'create', 'edit', 'update', 'store', 'show']]);
Route::get('/videos/delete/{id}', 'VideoController@delete');
Route::get('/videos/destroy/{id}', 'VideoController@destroy');

Route::get('/', 'VideoController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/comments/{id}', 'CommentController@index');

Route::get('/comments/create/{id}', 'CommentController@create');

Route::post('/comments', 'CommentController@store');

Route::get('/comments/edit/{id}', 'CommentController@edit');
Route::patch('/comments/{id}', 'CommentController@update');

Route::get('/comments/delete/{id}', 'CommentController@delete');
Route::get('/comments/destroy/{id}', 'CommentController@destroy');

Route::get('/users', 'UserController@index');

Route::get('/users/{id}', 'UserController@show');

Route::get('/users/edit/{id}', 'UserController@edit');

Route::patch('/users/{id}', 'UserController@update');

Route::post('/likes', 'LikeController@store');
Route::post('/likes/destroy', 'LikeController@destroy');

Route::post('/subscriptions', 'SubscriptionController@store');
Route::post('/subscriptions/destroy', 'SubscriptionController@destroy');
