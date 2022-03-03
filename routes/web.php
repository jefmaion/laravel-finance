<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionTypeController;
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

Route::resource('category', CategoryController::class);
Route::resource('transaction/type', TransactionTypeController::class);
Route::resource('account', AccountController::class);



Route::delete('transaction/deleteAll', [TransactionController::class, 'deleteAll'])->name('transaction.deleteAll');
Route::get('transaction/form/{id}', [TransactionController::class, 'form'])->name('transaction.form');
Route::get('transaction/{start?}/{end?}', [TransactionController::class, 'index'])->name('transaction.range');

Route::resource('transaction', TransactionController::class);