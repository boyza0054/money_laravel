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
Route::get('login', function () {
    return view('login');
})->name('login');

Route::post("user/login", "LoginController@login");

Route::get("user/logout", ["as" => "user/logout", "uses" => "LoginController@logout"]);

Route::group(['middleware' => 'auth'], function () {

    Route::get("/", ["as" => "index", "uses" => "HomeController@index"]);

    Route::group(["prefix" => "users"], function () {
        Route::get("list", ["as" => "users/list", "uses" => "UserController@list"]);
        Route::get("info", ["as" => "users/info", "uses" => "UserController@edit"]);
    });

    Route::get('file-upload',["as" => "upload/list", "uses" => "FileController@fileUpload"]);
    Route::post('file-upload','FileController@fileUploadPost')->name('fileUploadPost');
});