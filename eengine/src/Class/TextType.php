<?php

namespace Rekrutacyjne\Class;

class TextType implements DataType 
{
    public function __construct()
    {

    }

    public function format(string $value): string 
    {
        return filter_var(str_replace(' ', '&nbsp;', trim($value)), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
}  