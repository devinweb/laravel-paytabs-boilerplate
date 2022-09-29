<?php

namespace App\Http\Controllers;

use Devinweb\LaravelPaytabs\Enums\TransactionClass;
use Devinweb\LaravelPaytabs\Enums\TransactionType;
use Devinweb\LaravelPaytabs\Facades\LaravelPaytabsFacade;
use Devinweb\LaravelPaytabs\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::paid()->withCount('children')->latest()->paginate(30);
        return view('transactions')->with('transactions', $transactions);
    }

    public function create()
    {
        $transaction = LaravelPaytabsFacade::setCustomer(Auth::user())
            ->setCart($this->prepareCartData())
            ->framedPage()
            ->hideShipping()
            ->setRedirectUrl(config('app.url') . "/transaction/finalized", )
            ->initiate(TransactionType::SALE, TransactionClass::ECOM);

        return view('new-transaction')->with('transaction', $transaction);

    }
    public function refund($transactionRef)
    {
        $response = LaravelPaytabsFacade::setTransactionRef($transactionRef)
            ->setCart($this->prepareCartData())
            ->setCustomer(Auth::user())
            ->followUpTransaction(TransactionType::REFUND, TransactionClass::ECOM);
        return $response;
    }

    private function prepareCartData(): array
    {
        return [
            'id' => Str::random(6),
            'amount' => 80,
            'description' => "Cart description",
        ];
    }

}
