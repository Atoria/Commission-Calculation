<?php

namespace App\Managers;

use App\Exceptions\UserTypeNotFoundException;
use App\Models\BusinessUser;
use App\Models\PrivateUser;
use App\Models\User;

class UserManager
{
    /**
     *
     * Returns User subclass based on type.
     *
     * @throws \Exception
     */
    public static function getUserClass(string $type): User
    {
        if ($type === User::TYPE_PRIVATE) {
            return app(PrivateUser::class);
        } else if ($type === User::TYPE_BUSINESS) {
            return app(BusinessUser::class);
        }
        throw new UserTypeNotFoundException($type);
    }

}
