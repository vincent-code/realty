<?php

if (! function_exists('declension')) {
    function declension($number, $titles = ['квартира', 'квартиры', 'квартир'])
    {
        $cases = [2, 0, 1, 1, 1, 2];
        $format = $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
        return sprintf($format, $number);
    }
}
