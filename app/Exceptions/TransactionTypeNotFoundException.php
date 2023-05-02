<?php

namespace App\Exceptions;

use Throwable;

class TransactionTypeNotFoundException extends NotFoundException {
    public function __construct($transactionType, $message = "", $code = 0, Throwable $previous = null) {
        parent::__construct("Transaction type: {$transactionType}", $message, $code, $previous);
    }
}
