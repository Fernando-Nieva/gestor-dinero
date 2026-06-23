<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('format_amount')) {
    function format_amount($value, int $decimals = 2, string $dec_point = ',', string $thousands_sep = '.'): string
    {
        if (!is_numeric($value)) {
            return (string) $value;
        }
        if ((float) $value == floor((float) $value)) {
            return number_format((float) $value, 0, $dec_point, $thousands_sep);
        }
        return number_format((float) $value, $decimals, $dec_point, $thousands_sep);
    }
}

if (!function_exists('format_amount_short')) {
    function format_amount_short($value): string
    {
        return format_amount($value, 0);
    }
}

if (!function_exists('db_date_part')) {
    function db_date_part(string $part, string $column): string
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql') {
            return $part === 'YEAR' ? "YEAR($column)" : "MONTH($column)";
        }

        return $part === 'YEAR'
            ? "EXTRACT(YEAR FROM $column)"
            : "EXTRACT(MONTH FROM $column)";
    }
}
