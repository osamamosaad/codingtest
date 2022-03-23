<?php

namespace App\Machine\Exceptions;

use Exception;

class InvalidQuantity extends Exception
{
    public function __construct(string $message, int $code = 2, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
