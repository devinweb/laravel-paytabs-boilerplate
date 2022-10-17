<?php

namespace App\Actions;

use Illuminate\Support\Str;

class PrepareCartData
{
    public function __invoke($amount = null): array
    {
        return [
            'id' => Str::random(6),
            'amount' => $amount ?: random_int(10, 100),
            'description' => "Cart description",
        ];
    }
}
