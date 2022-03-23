<?php

namespace App\Machine\Contracts;

/**
 * Interface PurchasedItemInterface
 * @package App\Machine
 */
interface PurchasedItemInterface
{
    /**
     * @return integer
     */
    public function getItemQuantity();

    /**
     * @return float
     */
    public function getTotalAmount();

    /**
     * @return float
     */
    public function getAmountItem();

    /**
     * Returns the change in this format:
     *
     * Coin Count
     * 0.01 0
     * 0.02 0
     * .... .....
     *
     * @return array
     */
    public function getChange();
}
