<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use App\Machine\Contracts\PurchaseTransactionInterface;

/**
 * PurchaseTransaction
 *
 * @package App\Command
 */
class PurchaseTransaction implements PurchaseTransactionInterface
{
    private InputInterface $input;

    public function __construct(InputInterface $input)
    {
        $this->input = $input;
    }

    /**
     * @return integer
     */
    public function getItemQuantity()
    {
        return (int) $this->input->getArgument('packs');
    }

    /**
     * @return float
     */
    public function getPaidAmount()
    {
        return (float) \str_replace(',', '.', $this->input->getArgument('amount'));
    }
}
