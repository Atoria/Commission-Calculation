<?php

namespace App\Exceptions;

use Throwable;

class CurrencyNotFoundException extends NotFoundException {
    public function __construct($currencyCode, $message = "", $code = 0, Throwable $previous = null) {
        parent::__construct("Currency: {$currencyCode}", $message, $code, $previous);
    }
}
