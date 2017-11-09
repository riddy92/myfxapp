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


use App\Http\Middleware\AdminUser;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin']], function() {
    Route::get('/admin', 'Admin\DashboardController@show')->name('dashboard');

    // Currencies
    Route::get('/admin/currencies', 'Admin\CurrencyController@getCurrencies')->name('currencies');
    Route::get('/admin/fx/currencies', 'Admin\CurrencyController@getExchangeCurrencies')->name('fx.currencies');
    Route::post('/admin/currencies', 'Admin\CurrencyController@create')->name('create.currency');
    Route::patch('/admin/currencies/{currency}', 'Admin\CurrencyController@update')->name('update.currency');
    Route::delete('/admin/currencies/delete/{id}', 'Admin\CurrencyController@destroy')->name('delete.currency');

    // Currency Rates
    Route::get('/admin/rates', 'Admin\RatesController@getRates')->name('rates');
    Route::post('/admin/rates', 'Admin\RatesController@create')->name('create.rate');
    Route::patch('/admin/rates/{rate}', 'Admin\RatesController@update')->name('update.rate');
    Route::get('/admin/rates/history', 'Admin\RatesController@getRateHistory')->name('rates.history');
});
