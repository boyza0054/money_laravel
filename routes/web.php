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

Route::get("user/logout", ["as" => "logout", "uses" => "LoginController@logout"]);

Route::group(['middleware' => 'auth'], function () {

    Route::get("/", ["as" => "index", "uses" => "HomeController@index"]);

    Route::group(["prefix" => "users"], function () {
        Route::get("list", ["as" => "users/list", "uses" => "UserController@list"]);
        Route::get("create", ["as" => "users/create", "uses" => "UserController@create"]);
        Route::post("insert", ["as" => "users/insert", "uses" => "UserController@insert"]);
        Route::get("info", ["as" => "users/info", "uses" => "UserController@edit"]);
        Route::post("update", ["as" => "users/update", "uses" => "UserController@update"]);
        Route::post("delete", ["as" => "users/delete", "uses" => "UserController@destroy"]);
        Route::post("checkemail", ["as" => "users/checkemail", "uses" => "UserController@checkemail"]);
    });

    Route::group(["prefix" => "payment"], function () {
        Route::get("list", ["as" => "payment/list", "uses" => "PaymentController@list"]);
        Route::get("create", ["as" => "payment/create", "uses" => "PaymentController@create"]);
        Route::post("insert", ["as" => "payment/insert", "uses" => "PaymentController@insert"]);
        Route::get("info", ["as" => "payment/info", "uses" => "PaymentController@edit"]);
        Route::post("update", ["as" => "payment/update", "uses" => "PaymentController@update"]);
        Route::post("delete", ["as" => "payment/delete", "uses" => "PaymentController@destroy"]);
    });

    Route::get('file-upload',["as" => "upload/list", "uses" => "FileController@fileUpload"]);
    Route::post('file-upload','FileController@fileUploadPost')->name('fileUploadPost');
});