<?php

namespace App\Machine\Contracts;


/**
 * Interface CigaretteMachine
 * @package App\Machine
 */
interface MachineInterface
{
    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @return PurchasedItemInterface
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface;
}
