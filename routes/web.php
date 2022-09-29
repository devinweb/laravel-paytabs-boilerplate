<?php

use App\Http\Controllers\TransactionController;
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

Route::get('/transactions', [TransactionController::class, 'index'])->middleware(['auth'])->name('transactions');
Route::get('/transactions/create', [TransactionController::class, 'create'])->middleware(['auth'])->name('new-transaction');
Route::post('/transactions/{transactionRef}/refund', [TransactionController::class, 'refund'])->middleware(['auth'])->name('refund-transaction');
Route::get('/transaction/finalized', function () {
    return view('transaction-done');
});

require __DIR__ . '/auth.php';
