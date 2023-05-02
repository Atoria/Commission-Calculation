<?php

namespace App\Models;


use App\Helpers\Math;
use App\Store\RatesStore;

class BusinessUser extends User
{

    private readonly RatesStore $ratesStore;

    public function __construct(RatesStore $ratesStore)
    {
        $this->ratesStore = $ratesStore;
        parent::__construct();
    }


    public function calculateDepositFee(Transaction $transaction): float
    {
        $rate = $this->ratesStore->getRate($transaction->getCurrency(), config('fee.base_currency'));
        return Math::roundUp($transaction->getAmount() * floatval(config('fee.deposit_fee')) * $rate / 100, $transaction->getCurrency());
    }

    public function calculateWithdrawFee(Transaction $transaction): float
    {
        $rate = $this->ratesStore->getRate($transaction->getCurrency(), config('fee.base_currency'));
        return Math::roundUp($transaction->getAmount() * floatval(config('fee.business_withdraw_fee')) * $rate / 100, $transaction->getCurrency());
    }


}
