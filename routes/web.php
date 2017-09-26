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


Auth::routes();

Route::get('/', 'PostController@getPosts')->name('post.list');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{slug}', 'PostController@getPost')->name("post.view");

Route::get('/post/create', 'PostController@getCreatePost')->name('post.create')->middleware('auth');
Route::post('/post/create', 'PostController@createPost')->name('post.create')->middleware('auth');

Route::get('/my-posts', 'UserController@getPosts')->name('user.posts');

Route::get('/post/edit/{slug}', 'PostController@getEditPost')->name('post.edit');
Route::put('/post/edit/{slug}', 'PostController@editPost')->name('post.edit');

Route::delete('/post/delete', 'PostController@deletePost')->name('post.delete');

Route::post('/comment/{slug}', 'CommentController@createComment')->name('comment.create');