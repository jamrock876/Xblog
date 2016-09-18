<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'index']);
Route::get('/about', ['uses' => 'PageController@about', 'as' => 'page.about']);
Route::get('/projects', ['uses' => 'HomeController@projects', 'as' => 'projects']);
Route::get('/search', ['uses' => 'HomeController@search', 'as' => 'search']);

Route::get('/blog', ['uses' => 'PostController@index', 'as' => 'post.index']);
Route::get('/blog/{slug}', ['uses' => 'PostController@show', 'as' => 'post.show']);
Route::get('/blog/{post_id}/comments', ['uses' => 'CommentController@show', 'as' => 'post.comments']);
Route::get('/category/{name}', ['uses' => 'CategoryController@show', 'as' => 'category.show']);
Route::get('/category', ['uses' => 'CategoryController@index', 'as' => 'category.index']);
Route::get('/tag/{name}', ['uses' => 'TagController@show', 'as' => 'tag.show']);
Route::get('/tag', ['uses' => 'TagController@index', 'as' => 'tag.index']);
Route::get('/user/{name}', ['uses' => 'UserController@show', 'as' => 'user.show']);

Route::resource('comment', 'CommentController', ['only' => ['store', 'destroy']]);


Route::group(['prefix' => 'admin', ['middleware' => ['auth', 'admin']]], function () {

    /**
     * admin url
     */
    Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.index']);
    Route::get('/settings', ['uses' => 'AdminController@settings', 'as' => 'admin.settings']);
    Route::post('/settings', ['uses' => 'AdminController@saveSettings', 'as' => 'admin.save-settings']);
    Route::post('/upload/image', ['uses' => 'ImageController@uploadImage', 'as' => 'upload.image']);
    Route::delete('/delete/file', ['uses' => 'FileController@deleteFile', 'as' => 'delete.file']);
    Route::post('/upload/js', ['uses' => 'FileController@uploadJs', 'as' => 'upload.js']);
    Route::post('/upload/css', ['uses' => 'FileController@uploadCss', 'as' => 'upload.css']);


    Route::get('/posts', ['uses' => 'AdminController@posts', 'as' => 'admin.posts']);
    Route::get('/tags', ['uses' => 'AdminController@tags', 'as' => 'admin.tags']);
    Route::get('/users', ['uses' => 'AdminController@users', 'as' => 'admin.users']);
    Route::get('/pages', ['uses' => 'AdminController@pages', 'as' => 'admin.pages']);
    Route::get('/categories', ['uses' => 'AdminController@categories', 'as' => 'admin.categories']);
    Route::get('/images', ['uses' => 'ImageController@images', 'as' => 'admin.images']);
    Route::get('/files', ['uses' => 'FileController@files', 'as' => 'admin.files']);


    Route::post('/post/{post}/restore', ['uses' => 'PostController@restore', 'as' => 'post.restore']);
    Route::get('/post/{slug}/preview', ['uses' => 'PostController@preview', 'as' => 'post.preview']);
    Route::post('/post/{post}/publish', ['uses' => 'PostController@publish', 'as' => 'post.publish']);

    Route::delete('/tag/{tag}', ['uses' => 'TagController@destroy', 'as' => 'tag.destroy']);
    Route::post('/tag', ['uses' => 'TagController@store', 'as' => 'tag.store']);

    /**
     * admin resource
     */
    Route::resource('post', 'PostController', ['except' => ['show', 'index']]);
    Route::resource('category', 'CategoryController', ['except' => ['index', 'show', 'create']]);
    Route::resource('page', 'PageController', ['except' => ['show', 'index']]);

});
