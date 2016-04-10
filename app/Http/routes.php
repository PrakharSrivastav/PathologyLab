<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/**
 * All the routes by default pass through the web middleware
 */
# Authentication related routes
Route::get('/', "Auth\AuthController@index")->name('home');
Route::get('login', "Auth\AuthController@index")->name("login");
Route::post('login', "Auth\AuthController@login")->name("login");
Route::get('logout', "Auth\AuthController@logout")->name("logout");
Route::get("download/{id}","DashboardController@downloadReport")->name("download");

Route::group(['middleware' => 'auth'], function() {
    # dashboard
    Route::get('/report/email/{id}',"DashboardController@sendReportAsEmail")->name("report.email");
    Route::get('dashboard', "DashboardController@index")->name("dashboard");
    # reports related routes
    Route::resource("report", "ReportController");
    # patient related routes
    Route::resource("patient", "PatientController");
});
