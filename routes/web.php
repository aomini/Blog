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
    return view('article/articles');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('article/create', function(){
	return view('article/create-article');
});

Route::post('article', 'ArticleController@store');

// List articles
Route::get('articles', 'ArticleController@index');

// List single article
Route::get('article/{article}', 'ArticleController@show');

// Create new article
Route::post('article', 'ArticleController@store');

// Update article
Route::put('article', 'ArticleController@store');

// Delete article
Route::delete('article/{article}', 'ArticleController@destroy');

// Comment on a article
Route::post('article/{article}/comment', 'CommentController@store');

/* Profile */

Route::get('/profile/{user}', 'ProfileController@index');