<?php

namespace App\Actions;

use App\Billing\PaytabsBilling;
use Devinweb\LaravelPaytabs\Enums\TransactionClass;
use Devinweb\LaravelPaytabs\Enums\TransactionType;
use Devinweb\LaravelPaytabs\Facades\LaravelPaytabsFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CreatePaymentPage
{
    public function __invoke(Request $request)
    {
        $cart = app(PrepareCartData::class)();
        $transaction = LaravelPaytabsFacade::setCustomer(Auth::user())
            ->setCart($cart);

        if ($request->framed) {
            $transaction = $transaction->framedPage();
        }

        if ($request->add_billing) {
            $transaction = $transaction->addBilling(new PaytabsBilling());
            if ($request->hide_billing) {
                $transaction = $transaction->hideBilling();
            }
        }

        if ($request->add_shipping) {
            $transaction = $transaction->addShipping(new PaytabsBilling());
        }

        if ($request->hide_shipping) {
            $transaction = $transaction->hideShipping();
        }
        $transaction = $transaction->setRedirectUrl(config('app.url') . "/transaction/finalized", )
            ->initiate(TransactionType::SALE, TransactionClass::ECOM);
        return $transaction;
    }
}
