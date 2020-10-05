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

Auth::routes();

// admin route added
Route::prefix('admin')
  ->namespace('Admin')
  ->name('admin.')
  ->middleware('auth')
  ->group(function () {
  Route::resource('suites', 'SuiteController');
  Route::post('suites/{suite}', 'SuiteController@store_payment')->name('suites.store_payment');
  Route::get('/messages', 'SuiteController@messages')->name('email.messages.index');
  Route::get('/mysuites', 'SuiteController@mysuites')->name('suites.mysuites');
  Route::get('/payment/{suite}', 'SuiteController@payment')->name('suites.payment');
  Route::get('/static/{suite}', 'SuiteController@static')->name('suites.static');
});

// guest route to index
Route::get('/', 'SuiteController@index')->name('suites.index');
// after register
Route::get('/home', 'SuiteController@index')->name('suites.index');
// guest route to serch
Route::get('/search', 'SuiteController@search')->name('suites.search');
// guest route to show
Route::get('suites/{suite}', 'SuiteController@show')->name('suites.show');
// guest route to store
Route::post('suites/{suite}', 'SuiteController@store')->name('suites.store');
// guest route to store_message
Route::post('suites/{suite}', 'SuiteController@store_message')->name('suites.store_message');
