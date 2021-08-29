<?php

namespace Rekrutacyjne\Class;

class MoneyType implements DataType 
{
    private string $currency;
    private string $thousands_separator;
    private int $precision;
    private string $decimals_separator;

    public function __construct(string $currency, array $format = [])
    {
        if(!in_array($currency, array('USD', 'PLN', 'BHD')))
            throw new \Exception('Nieobsługiwana waluta ' .$currency);
        $this->currency = $currency;
        $this->precision = isset($format['precision']) ? $format['precision'] : 2;
        $this->decimals_separator = isset($format['decimals_separator']) ? $format['decimals_separator'] : ",";
        $this->thousands_separator = isset($format['thousands_separator']) ? $format['thousands_separator'] : "&nbsp;";
    }

    public function format(string $value): string 
    {
        if(!is_numeric($value))
            return (new ImageType)->format('assets/icons/exclamation-triangle-fill.svg');
        return number_format($value, $this->precision,
            $this->decimals_separator, $this->thousands_separator).'&nbsp'.$this->currency;
    }
}  