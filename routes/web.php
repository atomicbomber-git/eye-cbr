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
    return view('verified_case.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/verified_case', 'as' => 'verified_case.'], function() {
    Route::get('/index', 'VerifiedCaseController@index')->name('index');
    Route::get('/create', 'VerifiedCaseController@create')->name('create');
    Route::post('/store', 'VerifiedCaseController@store')->name('store');
    Route::get('/edit/{verified_case}', 'VerifiedCaseController@edit')->name('edit');
    Route::post('/update/{verified_case}', 'VerifiedCaseController@update')->name('update');
    Route::post('/delete/{verified_case}', 'VerifiedCaseController@delete')->name('delete');
});
