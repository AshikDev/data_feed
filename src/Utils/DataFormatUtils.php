<?php

namespace App\Utils;

class DataFormatUtils
{
    /**
     * Formats a value based on the specified type.
     *
     * @param mixed $value The value to be formatted.
     * @param string $type The type to format the value.
     * @param int $decimalPrecision The number of decimal places to use for decimal values (default is 2).
     * @return string|int The formatted value as a string or integer, depending on the specified type.
     */
    public static function formatValue(mixed $value, string $type, int $decimalPrecision = 2): string|int
    {
        return match ($type) {
            'int' => intval($value),
            'decimal' => number_format((float)$value, $decimalPrecision, '.', ''),
            default => strval($value),
        };
    }
}
