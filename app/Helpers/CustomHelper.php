<?php

function generateUniqNumber($length = 12) {
    if (function_exists("random_int")) {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return random_int($min, $max);
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
}

function numberFromString($string){
    $str = preg_match_all('/[\d,]+(?:\.\d+)?/', $string, $matches);

    return str_replace(',', '.', implode('', $matches[0]));
}
