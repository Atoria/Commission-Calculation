<?php

namespace App\Models;


use App\Helpers\Math;
use App\Store\RatesStore;

class PrivateUser extends User
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
        $withdrawFee = floatval(config('fee.private_withdraw_fee'));
        $freeChargeCount = floatval(config('fee.max_fee_charge_count'));
        $list = $this->getPreviousTransactions();
        $date = $transaction->getDate();
        $amount = $transaction->getAmount();
        $currency = $transaction->getCurrency();
        $weekNumber = date('oW', strtotime($date));

        //Check if transaction is eligible for discount.
        $eligibleDiscount = !isset($list[$weekNumber]) || $list[$weekNumber]['transaction_count'] < $freeChargeCount;

        if ($eligibleDiscount) {
            //Convert amount to base currency to apply discount logic
            $amountEur = $amount * $this->ratesStore->getRate($currency, config('fee.base_currency'));
            //Check how much discount money is left
            $freeChargeAmount = isset($list[$weekNumber]) ? $list[$weekNumber]['free_amount'] : floatval(config('fee.fee_of_charge'));
            if ($freeChargeAmount >= $amountEur) {
                return 0;
            }
            $exceededEur = ($amountEur - $freeChargeAmount) * $withdrawFee / 100;
            return Math::roundUp($exceededEur * $this->ratesStore->getRate(config('fee.base_currency'), $currency), $transaction->getCurrency());
        }

        return Math::roundUp($amount * $withdrawFee / 100, $transaction->getCurrency());

    }


    private function getPreviousTransactions(): array
    {
        $feeChargeAmount = floatval(config('fee.fee_of_charge'));
        $result = [];
        foreach ($this->getTransactions() as $transaction) {
            $weekNumber = date('oW', strtotime($transaction->getDate()));
            if ($transaction->getOperationType() == Transaction::TYPE_WITHDRAW) {
                if (!isset($result[$weekNumber])) {
                    $result[$weekNumber] = [
                        'transaction_count' => 0,
                        'amount' => 0,
                        'free_amount' => $feeChargeAmount
                    ];
                }

                $result[$weekNumber]['transaction_count'] += 1;
                $result[$weekNumber]['amount'] += $transaction->getAmount() * $this->ratesStore->getRate($transaction->getCurrency(), config('fee.base_currency'));
                $result[$weekNumber]['free_amount'] = max(($result[$weekNumber]['free_amount'] - $result[$weekNumber]['amount']), 0);
            }
        }

        return $result;
    }

}
