<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception {
    public function __construct($type, $message = "", $code = 0, Throwable $previous = null) {
        $fullMessage = "{$type} not found";
        if (!empty($message)) {
            $fullMessage .= " - {$message}";
        }
        parent::__construct($fullMessage, $code, $previous);
    }
}
