<?php

namespace App\Http\Controllers;

use App\Billing\PaytabsBilling;
use Devinweb\LaravelPaytabs\Enums\TransactionClass;
use Devinweb\LaravelPaytabs\Enums\TransactionType;
use Devinweb\LaravelPaytabs\Facades\LaravelPaytabsFacade;
use Devinweb\LaravelPaytabs\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Actions\CreatePaymentPage;
use App\Actions\RefundTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::paid()->withCount('children')->latest()->paginate(30);
        return view('transactions')->with('transactions', $transactions);
    }

    public function create(Request $request)
    {
        $transaction = app(CreatePaymentPage::class)($request);

        return view('new-transaction')->with('transaction', $transaction);
    }
    public function refund($transactionRef)
    {
        $response = app(RefundTransaction::class)($transactionRef);
        return $response;
    }
}
