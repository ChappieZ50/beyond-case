<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::middleware('answered')->group(function () {
        Route::middleware('is.admin')->group(function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');

            Route::prefix('answer')->as('answer.')->controller('Pages\AnswerController')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{answer}','show')->name('show');
                Route::post('/{answer}','vote')->name('vote');
            });
        });

        Route::resource('record', 'RecordController')->only('index', 'store');
    });

    Route::get('logout', fn() => redirect()->route('login.index'))->name('logout');
});

Route::get('answered', fn() => view('pages.answered'))->name('answered');

Route::namespace('Auth')->group(function () {
    Route::resource('login', 'LoginController')->only('index', 'store');
    Route::resource('register', 'RegisterController')->only('index', 'store');
});
