<?php

function randStr($length = 10, $case = 'lower') {
    $range = "abcdefghijklmnopqrstuvwxyz";
    $len = strlen($range);
    $output = "";

    for ($i = 0; $i < $length; $i++) {
        $ind = random_int(0, $len - 1);
        $char = $range[$ind];

        switch ($case)
        {
            case "upper":
                $char = strtoupper($char);
                break;
            case "mixed":
                $roll = random_int(1, 2);
                if ($roll == 2) {
                    $char = strtoupper($char);
                }
                break;
            case "lower":
            default:
                break;
        }

        $output .= $char;
    }

    return $output;
}