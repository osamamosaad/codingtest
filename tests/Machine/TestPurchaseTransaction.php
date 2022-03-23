<?php

namespace Tests\Machine;

use App\Machine\Contracts\PurchaseTransactionInterface;

class TestPurchaseTransaction implements PurchaseTransactionInterface
{
    private $paidAmount;
    private $itemQuantity;

    public function __construct($itemQuantity, $paidAmount)
    {
        $this->paidAmount = $paidAmount;
        $this->itemQuantity = $itemQuantity;
    }
    /**
     * @return integer
     */
    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    /**
     * @return float
     */

    public function getPaidAmount()
    {
        return $this->paidAmount;
    }
}
