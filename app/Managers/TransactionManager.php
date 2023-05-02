<?php

namespace App\Managers;

use App\Exceptions\TransactionTypeNotFoundException;
use App\Models\Transaction;
use App\Models\User;

class TransactionManager
{
    /**
     * Returns fee depending on transaction type
     *
     * @throws \Exception
     */
    public static function calculateTransactionFee(Transaction $transaction, User $user): float
    {
        $type = $transaction->getOperationType();
        if ($type === Transaction::TYPE_DEPOSIT) {
            return $user->calculateDepositFee($transaction);
        } else if ($type === Transaction::TYPE_WITHDRAW) {
            return $user->calculateWithdrawFee($transaction);
        }

        throw new TransactionTypeNotFoundException($type);
    }

}
