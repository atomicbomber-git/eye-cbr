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
    return redirect()->route('verified_case.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/verified_case', 'as' => 'verified_case.'], function() {
    Route::get('/index', 'VerifiedCaseController@index')->name('index');
    Route::get('/create', 'VerifiedCaseController@create')->name('create');
    Route::post('/store', 'VerifiedCaseController@store')->name('store');
    Route::get('/edit/{case_record}', 'VerifiedCaseController@edit')->name('edit');
    Route::post('/update/{case_record}', 'VerifiedCaseController@update')->name('update');
    Route::post('/delete/{case_record}', 'VerifiedCaseController@delete')->name('delete');
});

Route::group(['prefix' => '/unverified_case', 'as' => 'unverified_case.'], function() {
    Route::get('/index', 'UnverifiedCaseController@index')->name('index');
    Route::get('/create', 'UnverifiedCaseController@create')->name('create');
    Route::post('/store', 'UnverifiedCaseController@store')->name('store');
    Route::get('/edit/{case_record}', 'UnverifiedCaseController@edit')->name('edit');
    Route::post('/update/{case_record}', 'UnverifiedCaseController@update')->name('update');
    Route::post('/delete/{case_record}', 'UnverifiedCaseController@delete')->name('delete');

    Route::post('/verify/{case_record}', 'CaseVerificationController@create')->name('verify');
});