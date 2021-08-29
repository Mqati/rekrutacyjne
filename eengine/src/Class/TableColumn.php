<?php

namespace Rekrutacyjne\Class;

class TableColumn implements Column {
    
    private DataType $dataType;
    private string $key;
    private string $align;

    public function __construct(DataType $dataType)
    {
        $this->dataType = $dataType;
    }

    public function withDataType(DataType $type): Column
    {
        $this->dataType = $type;
        return $this;
    }

    public function withAlign(string $align): Column 
    {
        $this->align = $align;
        return $this;
    }

    public function withLabel(string $label): Column
    {
        $this->label = $label;
        return $this;
    }

    public function getDataType() : DataType 
    {
        return $this->dataType;
    }

    public function getLabel() : string
    {
        return $this->label;
    }

    public function getAlign(): string
    {
        return $this->align;
    }
}