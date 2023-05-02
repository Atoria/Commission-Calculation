<?php


namespace Tests\Mock;


class TransactionData
{

    public static function getData()
    {
        return [
            [
                "date" => "2014-12-31",
                "userId" => 4,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 1200.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2015-01-01",
                "userId" => 4,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 1000.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-01-05",
                "userId" => 4,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 1000.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-01-05",
                "userId" => 1,
                "user_type" => "private",
                "operation_type" => "deposit",
                "amount" => 200.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-01-06",
                "userId" => 2,
                "user_type" => "business",
                "operation_type" => "withdraw",
                "amount" => 300.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-01-06",
                "userId" => 1,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 30000,
                "currency" => "JPY"
            ],
            [
                "date" => "2016-01-07",
                "userId" => 1,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 1000.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-01-07",
                "userId" => 1,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 100.00,
                "currency" => "USD"
            ],
            [
                "date" => "2016-01-10",
                "userId" => 1,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 100.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-01-10",
                "userId" => 2,
                "user_type" => "business",
                "operation_type" => "deposit",
                "amount" => 10000.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-01-10",
                "userId" => 3,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 1000.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-02-15",
                "userId" => 1,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 300.00,
                "currency" => "EUR"
            ],
            [
                "date" => "2016-02-19",
                "userId" => 5,
                "user_type" => "private",
                "operation_type" => "withdraw",
                "amount" => 3000000,
                "currency" => "JPY"
            ]
        ];
    }
}
