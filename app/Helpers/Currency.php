<?php

namespace App\Helpers;
class Currency
{
    private const JPY = "JPY";


    /**
     * Returns precision points by currency.
     *
     * @param $currency
     * @return int
     */
    public static function getPrecisions($currency): int
    {
        return match ($currency) {
            self::JPY => 0,
            default => 2,
        };
    }


}
