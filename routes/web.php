<?php

use App\Http\Livewire\Conversions;

use App\Http\Livewire\Transactions;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/conversions' , Conversions::class)->name('conversion');
Route::middleware(['auth:sanctum', 'verified'])->get('/transactions' , Transactions::class)->name('transaction');



Route::get('make_currency_list', 'App\Http\Controllers\MakeCurrencyList@makeCurrencyList');
