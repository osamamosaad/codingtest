<?php

namespace App\Machine;

use App\Machine\Contracts\PurchasedItemInterface;

/**
 * PurchasedItem
 * @package App\Machine
 */
class PurchasedItem implements PurchasedItemInterface
{
    private int $itemQuantity;
    private float $amountItem;
    private float $totalAmount;
    private array $changeResult;

    public function setItemQuantity(int $itemQuantity)
    {
        $this->itemQuantity = $itemQuantity;
    }

    /**
     * @inheritDoc
     */
    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    public function setAmountItem(float $amountItem)
    {
        $this->amountItem = $amountItem;
    }

    /**
     * @inheritDoc
     */
    public function getAmountItem()
    {
        return $this->amountItem;
    }

    public function setTotalAmount(float $totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @inheritDoc
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function setChange(array $changeResult)
    {
        $this->changeResult = $changeResult;
    }

    /**
     * @inheritDoc
     */
    public function getChange()
    {
        return $this->changeResult;
    }
}
