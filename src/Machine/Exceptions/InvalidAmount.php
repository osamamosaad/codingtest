<?php

namespace App\Machine\Exceptions;

use UnexpectedValueException;

class InvalidAmount extends UnexpectedValueException
{
    public function __construct(string $message, int $code = 1, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
