<?php

namespace App\Actions;

use Devinweb\LaravelPaytabs\Enums\TransactionClass;
use Devinweb\LaravelPaytabs\Enums\TransactionType;
use Devinweb\LaravelPaytabs\Facades\LaravelPaytabsFacade;
use Illuminate\Support\Facades\Auth;
use Devinweb\LaravelPaytabs\Models\Transaction;

class RefundTransaction
{
    public function __invoke($transactionRef)
    {
        $transaction = Transaction::where('transaction_ref', $transactionRef)->first();
        $cart = app(PrepareCartData::class)($transaction->amount);
        $response = LaravelPaytabsFacade::setTransactionRef($transactionRef)
            ->setCart($cart)
            ->setCustomer(Auth::user())
            ->followUpTransaction(TransactionType::REFUND, TransactionClass::ECOM);

        return $response;
    }
}
