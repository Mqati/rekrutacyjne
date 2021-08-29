<?php

namespace Rekrutacyjne\Class;

class ImageType implements DataType 
{
    private int $width;
    private int $height;

    public function __construct(array $format = [])
    {
        $this->width = isset($format['width']) ? $format['width'] : 16;
        $this->height = isset($format['height']) ? $format['height'] : 16;
    }

    public function format(string $value): string 
    {
        return sprintf('<img src="%s" width="%d" height="%d" />', $value, $this->width, $this->height);
    }
}  