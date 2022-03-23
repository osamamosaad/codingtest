<?php

namespace App\Machine;

use App\Machine\Contracts\ChangeCalculatorInterface;
use App\Machine\Contracts\PurchaseTransactionInterface;
use App\Machine\Contracts\MachineInterface;
use App\Machine\Contracts\PurchasedItemInterface;
use App\Machine\Exceptions\InvalidAmount;
use App\Machine\Exceptions\InvalidQuantity;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    const ITEM_PRICE = 4.99;

    private ChangeCalculatorInterface $changeCalculator;

    public function __construct(ChangeCalculatorInterface $changeCalculator)
    {
        $this->changeCalculator = $changeCalculator;
    }
    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface
    {
        $purchasedItem = new PurchasedItem();
        $purchasedItem->setItemQuantity($purchaseTransaction->getItemQuantity());
        $purchasedItem->setAmountItem(self::ITEM_PRICE);
        $purchasedItem->setTotalAmount($purchaseTransaction->getItemQuantity() * self::ITEM_PRICE);

        $this->validation($purchaseTransaction, $purchasedItem);

        $remain = $purchaseTransaction->getPaidAmount() - $purchasedItem->getTotalAmount();
        $changeResult = $this->changeCalculator->calculate($remain);
        $purchasedItem->setChange($changeResult);
        return $purchasedItem;
    }

    /**
     * Transaction Validation
     *
     * @return void
     *
     * @throws InvalidQuantity
     * @throws InvalidAmount
     */
    protected function validation(
        PurchaseTransactionInterface $purchaseTransaction,
        PurchasedItemInterface $purchasedItem
    ) {
        if ($purchaseTransaction->getItemQuantity() < 1) {
            throw new InvalidQuantity('The quantity should be 1 or more');
        }

        if (round($purchaseTransaction->getPaidAmount(), 2) < round($purchasedItem->getTotalAmount(), 2)) {
            throw new InvalidAmount('The amount that you paied is less than the total price');
        }
    }
}
