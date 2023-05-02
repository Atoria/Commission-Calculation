<?php

namespace App\Helpers;
class Math
{

    /**
     * Ceiling double type of numbers
     *
     * @param $number
     * @param $currency
     * @return float
     */
    public static function roundUp($number, $currency): float
    {
        $precision = Currency::getPrecisions($currency);

        return ceil($number * pow(10, $precision)) / pow(10, $precision);
    }



}
