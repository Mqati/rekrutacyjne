<?php

namespace Rekrutacyjne\Class;

class LinkType implements DataType 
{

    public function __construct(array $format = [])
    {
        $this->type = isset($format['type']) ? $format['type'] : 'a';
        $this->class = isset($format['class']) ? $format['class'] : 'info';
        if($this->type == 'button') $this->class = 'btn-'.$this->class;
    }

    public function format(string $value): string 
    {
        return sprintf('<a href="%s" class="%s %s" height="" />%s</a>',
            $value,
            ($this->type == 'button' ? 'btn' :''),
            $this->class,
            $value);
    }
}  