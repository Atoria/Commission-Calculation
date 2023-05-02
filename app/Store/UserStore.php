<?php

namespace App\Store;

use App\Managers\UserManager;
use App\Models\User;

class UserStore
{
    private static $_users;


    /**
     * @throws \Exception
     */
    public function findOrCreate($userId, $userType): ?User
    {
        if (isset(self::$_users[$userId])) {
            return self::$_users[$userId];
        }
        $newUser = UserManager::getUserClass($userType);
        $newUser->setId($userId);
        self::$_users[$userId] = $newUser;
        return $newUser;


    }

}
