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
Route::get('/my-posts', 'UserController@getPosts')->name('user.posts');
Route::get('/post/{slug}', 'PostController@getPost')->name("post.view");

// There routes require the user to be logged in
Route::middleware(['auth'])->group(function() {
    Route::prefix('post')->group(function() {
        Route::get('create', 'PostController@getCreatePost')->name('post.create');
        Route::post('create', 'PostController@createPost')->name('post.create');

        Route::get('edit/{slug}', 'PostController@getEditPost')->name('post.edit');
        Route::put('edit/{slug}', 'PostController@editPost')->name('post.edit');
        
        Route::delete('delete', 'PostController@deletePost')->name('post.delete');
    });

    Route::prefix('comment')->group(function (){
        Route::post('{slug}', 'CommentController@addComment')->name('comment.add');
        Route::put('/edit', 'CommentController@editComment')->name('comment.edit');
        Route::delete('/delete', 'CommentController@deleteComment')->name('comment.delete');
    });
});