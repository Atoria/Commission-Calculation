<?php

namespace Tests\Unit;

use App\Http\Transformers\Response\SuccessResponse;
use App\Models\Transaction;
use App\Services\CommissionService;
use App\Services\RatesService;
use App\Store\RatesStore;
use Tests\Mock\TransactionData;
use Tests\TestCase;

class CommissionTest extends TestCase
{

    protected $ratesStore;
    protected $commisionService;

    public function setUp(): void
    {
        parent::setUp();

        $this->ratesStore = app(RatesStore::class);
        $this->commisionService = app(CommissionService::class);

        $this->ratesStore->setRates([
            [
                'from' => "EUR",
                'to' => "USD",
                'rate' => 1.1497,
                'inverse_rate' => 0.8697921196833957
            ],
            [
                'from' => "EUR",
                'to' => "JPY",
                'rate' => 129.53,
                'inverse_rate' => 0.0077202192542268
            ]
        ]);
    }

    /**
     * Check calculating unit tests for currencies: EUR:USD - 1:1.1497, EUR:JPY - 1:129.53.
     */
    public function test_check_commission_fee(): void
    {

        $transactions = TransactionData::getData();
        $data = [];
        foreach ($transactions as $transaction) {
            $data[] = new Transaction(
                $transaction['date'],
                $transaction['userId'],
                $transaction['user_type'],
                $transaction['operation_type'],
                $transaction['amount'],
                $transaction['currency'],
            );
        }

        $result = $this->commisionService->calculate($data);


        $expectedResult = new SuccessResponse(200, [
            "0.60",
            "3.00",
            "0.00",
            "0.06",
            "1.50",
            "0",
            "0.70",
            "0.30",
            "0.30",
            "3.00",
            "0.00",
            "0.00",
            "8,612"
        ]);

        $this->assertEquals($result->getCode(), $expectedResult->getCode());
        $this->assertEquals($result->toArray(), $expectedResult->toArray());
    }
}
