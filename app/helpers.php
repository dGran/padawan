<?php

declare(strict_types=1);

/**
 * @param $value
 * @return string
 */
function numberFormatInt($value): string
{
    return number_format($value, 0, ',', '.');
}
