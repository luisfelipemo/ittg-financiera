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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/clients', 'ClientsController@index')
//     ->name('clients.index');
// Route::get('/clients/new', 'ClientsController@create')
//     ->name('clients.create');
// Route::post('/clients', 'ClientsController@store')
//     ->name('clients.store');
// Route::delete('/clients/{id}', 'ClientsController@destroy')
//     ->name('clients.destroy');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('clients', 'ClientsController');
    Route::resource('loans', 'LoansController')->except(['create']);
    Route::resource('payments', 'PaymentsController');
    Route::get('/loans/create/{id}', 'LoansController@create')->name('loans.create');
    Route::get('/loans/status/{id}', 'LoansController@status')->name('loans.status');
    Route::delete('/clients/{id}', 'ClientsController@destroy')->name('clients.destroy');
    Route::delete('/loans/{id}', 'LoansController@destroy')->name('loans.destroy');
    Route::post('/payments', 'PaymentsController@store')->name('payments.store');
    Route::get('/payments/create/{id}', 'PaymentsController@create')->name('payments.create');
    Route::get('export-client-excel', 'ClientsController@exportExcel')->name('clients.export.excel');
    Route::post('import-client-excel', 'ClientsController@importExcel')->name('clients.import.excel');
    Route::get('export-payments', 'LoansController@export')->name('loans.export');
});

