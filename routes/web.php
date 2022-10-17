<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
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
Route::post('/transactions/create', [TransactionController::class, 'create'])->middleware(['auth'])->name('new-transaction');
Route::post('/transactions/{transactionRef}/refund', [TransactionController::class, 'refund'])->middleware(['auth'])->name('refund-transaction');

Route::get('/transaction/finalized', function (Request $request) {
    return view('transaction-done')->with('response', $request->all());
});
Route::get('/transactions/options', function (Request $request) {
    return view('transaction-options');
})->name('transaction-options');



require __DIR__ . '/auth.php';
