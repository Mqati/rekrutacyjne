<?php

namespace Rekrutacyjne\Class;

interface DataType
{
    /**
     * Formatuje dane dla danego typu.
     */
    public function format(string $value): string;
}