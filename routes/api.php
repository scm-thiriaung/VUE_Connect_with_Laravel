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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'UserController@login')->name('login');
Route::post('/logout', 'UserController@logout')->name('logout');

Route::get('/post/list', 'PostController@postList')->name('postList');
Route::post('/post/download', 'PostController@exportExcel')->name('exportExcel');
Route::post('/post/upload', 'PostController@importExcel')->name('importExcel');
Route::get('/post/search', 'PostController@findPost')->name('findPost');
Route::resource('post','postController');

Route::get('/user/list', 'UserController@userList')->name('userList');
Route::get('/user/searchUser', 'UserController@userSearch')->name('userSearch');
Route::resource('user','UserController');
