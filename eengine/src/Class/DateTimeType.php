<?php

namespace Rekrutacyjne\Class;

use DateTime;

class DateTimeType implements DataType 
{
    private string $format;

    public function __construct(string $datetime, string $format="Y-m-d H:i:s")
    {
        $this->format = $format['format'];
    }

    public function format(string $value): string 
    {
        $date = new DateTime($value);
        return $date->format($this->format);
    }
}  