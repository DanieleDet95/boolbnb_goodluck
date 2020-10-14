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

// Admin route
Route::prefix('admin')
  ->namespace('Admin')
  ->name('admin.')
  ->middleware('auth')
  ->group(function () {
  // admin route to index/show/create/edit/destroy
  Route::resource('suites', 'SuiteController');
  // admin route to messages
  Route::get('/messages', 'SuiteController@messages')->name('email.messages.index');
  // admin route to mysuites
  Route::get('/mysuites', 'SuiteController@mysuites')->name('suites.mysuites');
  // admin route to statics
  Route::get('/static/{suite}', 'SuiteController@static')->name('suites.static');
  // admin route to promotions
  Route::get('/promotion/{suite}', 'PromotionController@index')->name('promotion');
  // admin route to checkout
  Route::post('/promotion/{suite}/checkout', 'PromotionController@checkout')->name('checkout');
  // admin route to transaction
  Route::get('/promotion/{suite}/transaction', 'PromotionController@transaction')->name('transaction');
});

// Guest route
Route::get('/', 'SuiteController@index')->name('suites.index');
// after register
Route::get('/home', 'SuiteController@index')->name('suites.index');
// guest route to serch
Route::get('/search', 'SuiteController@search')->name('suites.search');
// search with variables
Route::get('/search/submit', 'SuiteController@homeSearch')->name('suites.search.submit');
// guest route to show
Route::get('suites/{suite}', 'SuiteController@show')->name('suites.show');
// guest route to store
Route::post('suites/{suite}', 'SuiteController@store')->name('suites.store');
// guest route to store_message
Route::post('suites/{suite}', 'SuiteController@store_message')->name('suites.store_message');
// route to FAQs
Route::get('/faqs', 'FaqController@index')->name('faqs');
// join handlebars with blade, to show
Route::get('/suites', 'SuiteController@show')->name('suites.handle.show');
