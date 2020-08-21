<?php

/**
 * Random
 * @param int $length
 *
 * @return int
 */
function msgRandom($length = 5) : int
{
    $start = (int) str_pad(1, $length, '0', STR_PAD_RIGHT);
    $end = (int) str_pad(9, $length, '9', STR_PAD_RIGHT);

    return mt_rand($start, $end);
}
