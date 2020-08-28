<?php


/**
 * Random
 *
 * @param int $length
 *
 * @return int
 */
function msgRandom($length = 5): int
{
    $start = (int)str_pad(1, $length, '0', STR_PAD_RIGHT);
    $end   = (int)str_pad(9, $length, '9', STR_PAD_RIGHT);

    return mt_rand($start, $end);
}

/**
 * parameterList
 *
 * @param \EasyIM\Kernel\Parameter ...$parameters
 *
 * @return \EasyIM\Kernel\ParameterList
 */
function parameterList(\EasyIM\Kernel\Parameter ...$parameters)
{
    return new EasyIM\Kernel\ParameterList(...$parameters);
}

/**
 *
 * @param $value
 *
 * @return bool
 */
function free($value)
{
    if (is_null($value)) {
        return true;
    }

    if (is_string($value)) {
        return trim($value) === '';
    }

    if (is_numeric($value) || is_bool($value)) {
        return false;
    }

    if ($value instanceof Countable) {
        return count($value) === 0;
    }

    return empty($value);
}
