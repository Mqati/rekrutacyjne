<?php

namespace Rekrutacyjne\Class;

class NumberType implements DataType 
{
    private string $thousands_separator;
    private int $precision;
    private string $decimals_separator;

    public function __construct(array $format = [])
    {
        $this->precision = isset($format['precision']) ? $format['precision'] : 2;
        $this->decimals_separator = isset($format['decimals_separator']) ? $format['decimals_separator'] : ",";
        $this->thousands_separator = isset($format['thousands_separator']) ? $format['thousands_separator'] : " ";
    }

    public function format(string $value): string 
    {
        if(!is_numeric($value))
            return (new ImageType)->format('assets/icons/exclamation-triangle-fill.svg');
        return number_format($value, $this->precision,
            $this->decimals_separator, $this->thousands_separator);
    }
}  