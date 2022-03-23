<?php

namespace App\Machine\Contracts;

interface ChangeCalculatorInterface
{
    /**
     * To Calculate amount of mony change
     *
     * @param float $amount
     * @return array
     */
    public function calculate(float $amount): array;
}
