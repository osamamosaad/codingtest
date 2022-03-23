<?php

namespace App\Command;

use App\Machine\Contracts\PurchaseTransactionInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * PurchaseTransaction
 *
 * @package App\API
 */
class PurchaseTransaction implements PurchaseTransactionInterface
{
    private ServerRequestInterface $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @return integer
     */
    public function getItemQuantity()
    {
        // return ;
    }

    /**
     * @return float
     */
    public function getPaidAmount()
    {
        // return ;
    }
}
