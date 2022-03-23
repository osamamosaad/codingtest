<?php

namespace App\Machine;

use App\Machine\Contracts\ChangeCalculatorInterface;
use App\Machine\Contracts\CoinInterface;

class ChangeCalculator implements ChangeCalculatorInterface
{
    private array $changeResult = [];
    private array $coinDenominations = CoinInterface::COIN_DENOMINATIONS;

    public function calculate(float $amount): array
    {
        $coinsKeys = array_keys($this->coinDenominations);
        $coinPointer = array_pop($coinsKeys);

        $remainInCoins = $this->convertToCents($amount);
        while ($remainInCoins > 0) {
            if ($remainInCoins >= $coinPointer) {
                $this->increaseCoinType(CoinInterface::COIN_DENOMINATIONS[$coinPointer]);
                $remainInCoins -= $coinPointer;
            } else {
                $coinPointer = array_pop($coinsKeys);
            }
        }

        return $this->changeResult;
    }

    protected function convertToCents(float $amount)
    {
        return round($amount * CoinInterface::ONE_EURO_TO_CENTS);
    }

    protected function increaseCoinType($cointype)
    {
        if (!isset($this->changeResult[$cointype])) {
            $this->changeResult[$cointype] = [$cointype, 0];
        }

        $this->changeResult[$cointype][1]++;
    }
}
