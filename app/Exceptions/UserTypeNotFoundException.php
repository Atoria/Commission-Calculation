<?php

namespace App\Exceptions;

use Throwable;

class UserTypeNotFoundException extends NotFoundException {
    public function __construct($userType, $message = "", $code = 0, Throwable $previous = null) {
        parent::__construct("User type: {$userType}", $message, $code, $previous);
    }
}
