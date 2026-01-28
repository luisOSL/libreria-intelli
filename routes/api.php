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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('books', 'BookController');
    Route::apiResource('authors', 'AuthorController');

    Route::get('user-profile', function () {
        return auth('api')->user();
    });
    Route::post('logout', 'AuthController@logout');

    Route::get('export-library', 'LibraryController@export');
});
