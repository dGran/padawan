<?php

declare(strict_types=1);

function numberFormatInt(int $value): string
{
    return number_format($value, 0, ',', '.');
}

function numberFormatFloat(float $value): string
{
    return number_format($value, 2, ',', '.');
}
