<?php

namespace App\Interfaces;


use App\Models\Transaction;

interface UserInterface
{
    /**
     * @throws \Exception
     */
    public function calculateDepositFee(Transaction $transaction): float;

    /**
     * @throws \Exception
     */
    public function calculateWithdrawFee(Transaction $transaction): float;

    public function addTransaction(Transaction $transaction): void;
}
