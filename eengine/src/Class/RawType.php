<?php

namespace Rekrutacyjne\Class;

class RawType implements DataType 
{

    public function __construct()
    {
        
    }

    public function format(string $value): string 
    {
        return $value;
    }
}  