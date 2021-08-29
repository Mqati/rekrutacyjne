<?php

namespace Rekrutacyjne\Class;

use DateTime;

class DateType implements DataType 
{
    private string $format;

    public function __construct(string $format="Y-m-d")
    {
        $this->format = $format['format'];
    }

    public function format(string $value): string 
    {
        $date = new DateTime($value);
        return $date->format($this->format);
    }
}  