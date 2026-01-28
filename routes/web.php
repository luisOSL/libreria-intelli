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
    return view('dashboard');
})->name('home');

Route::get('login',  function () {
    return view('login');
})->name('login');
Route::get('register',  function () {
    return view('register');
})->name('register');
Route::view('/dashboard', 'dashboard');

// Route::group(['middleware' => 'auth:api'], function () {
//     Route::get('dashboard',  function () {
//         return view('dashboard');
//     });
// });
