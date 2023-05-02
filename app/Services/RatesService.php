<?php

namespace App\Services;

use App\Http\Transformers\Response\ApiResponse;
use App\Http\Transformers\Response\ErrorResponse;
use App\Http\Transformers\Response\SuccessResponse;
use App\Store\RatesStore;
use Illuminate\Support\Facades\Http;

class RatesService
{

    private readonly RatesStore $ratesStore;

    public function __construct(RatesStore $ratesStore)
    {
        $this->ratesStore = $ratesStore;
    }

    public function getRates(): ApiResponse
    {

        $url = config("fee.exchange_rates_url");
        $ratesResponse = Http::get($url);
        $status = $ratesResponse->status();

        //If we can't fetch rates then process needs to be stopped, since we can not run logic
        if ($status !== 200) {
            return new ErrorResponse($status, "Could not fetch rates");
        }

        $body = $ratesResponse->json();
        $base = $body['base'];

        $list = [];
        foreach ($body['rates'] as $currecny => $rate) {
            $list[] = [
                'from' => $base,
                'to' => $currecny,
                'rate' => $rate,
                'inverse_rate' => 1 / $rate
            ];
        }

        $this->ratesStore->setRates($list);


        return new SuccessResponse(200, []);

    }
}
