<?php

namespace App\Machine\Contracts;

interface CoinInterface
{
    public const ONE_EURO_TO_CENTS = 100;
    public const COIN_DENOMINATIONS = [
        1 => '0.01',
        2 => '0.02',
        5 => '0.05',
        10 => '0.10',
        20 => '0.20',
        50 => '0.50',
        100 => '1.00',
        200 => '2.00',
    ];
}
