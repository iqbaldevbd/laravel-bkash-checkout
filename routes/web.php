<?php

//Calling All Controllers
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionListController;
use App\Http\Controllers\RefundController;




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
Route::resource('orders',OrderController::class);

Route::get('token','App\Http\Controllers\PaymentController@token')->name('token');
Route::get('createpayment', 'App\Http\Controllers\PaymentController@createpayment')->name('createpayment');
Route::get('executepayment', 'App\Http\Controllers\PaymentController@executepayment')->name('executepayment');

Route::get('querypayment', 'App\Http\Controllers\PaymentController@querypayment')->name('querypayment');

Route::resource('transactions',TransactionListController::class);
Route::get('refund/{paymentID}', 'App\Http\Controllers\RefundController@refund')->name('refund');
Route::get('search-txn', 'App\Http\Controllers\RefundController@searchTXN')->name('search-txn');
Route::get('search-transaction', 'App\Http\Controllers\RefundController@transSearchView')->name('search-transaction');


