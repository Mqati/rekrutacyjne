<?php

namespace Rekrutacyjne\Class;

class DefaultConfig implements Config 
{
    public Array $columns;

    public function __construct()
    {
        $this->columns = [];
    }

    public function addColumn(string $key, Column $column): Config
    {
        $column->withLabel($key);
        $this->columns[$key] = $column;
        return $this;
    }

    public function getColumns(): array 
    {
        return $this->columns;
    }

    private function generateColumn(DataType $dataType): Column
    {
        $column = new TableColumn($dataType);
        return $column;
    }

    public function addIntColumn(string $key, string $align = "center"): Config 
    {
        $column = $this->generateColumn((new NumberType(['precision' => 0, 'thousands_separator' => ''])));
        $column->withAlign($align);
        $this->addColumn($key, $column);
        return $this;
    }

    public function addTextColumn(string $key, string $align = "center"): Config
    {
        $column = $this->generateColumn((new TextType()));
        $column->withAlign('center');
        $this->addColumn($key, $column);
        return $this;
    }

    public function addCurrencyColumn(string $key, string $currency="USD", string $align = "center"): Config
    {
        $column = $this->generateColumn((new MoneyType($currency)));
        $column->withAlign('center');
        $this->addColumn($key, $column);
        return $this;
    }
}