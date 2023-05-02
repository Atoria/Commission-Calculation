<?php

return [
    'deposit_fee' => env('DEPOSIT_FEE', 0),
    'private_withdraw_fee' => env('PRIVATE_WITHDRAW_COMMISSION_FEE', 0),
    'business_withdraw_fee' => env('BUSINESS_WITHDRAW_COMMISSION_FEE', 0),
    'fee_of_charge' => env('FEE_OF_CHARGE', 1000),
    'max_fee_charge_count' => env('MAX_FEE_CHARGE_COUNT', 3),
    'exchange_rates_url' => env('EXCHANGE_RATES_URL', ""),
    'base_currency' => env('BASE_CURRENCY', "EUR"),

];
