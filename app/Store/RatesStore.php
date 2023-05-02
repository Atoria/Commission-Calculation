<?php

namespace App\Store;

use App\Exceptions\CurrencyNotFoundException;

class RatesStore
{
    private static $_rates;

    public function setRates($rates): void
    {
        self::$_rates = $rates;
    }

    public function getRates(): array
    {
        return self::$_rates;
    }


    /**
     * @throws \Exception
     */
    public function getRate($from, $to): float
    {
        if ($from == $to) {
            return 1;
        }

        foreach (self::$_rates as $item) {
            if ($item['from'] === $from && $item['to'] == $to) {
                return $item['rate'];
            } else if ($item['from'] === $to && $item['to'] == $from) {
                return $item['inverse_rate'];
            }
        }
        throw new CurrencyNotFoundException("From: " . $from . ' To:' . $to);
    }


}
