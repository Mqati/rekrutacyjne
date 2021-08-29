<?php

namespace Rekrutacyjne\Class;

class HttpState implements State {
    
    private static HttpState $instance;

    private int $currentPage;
    private int $rowsPerPage;
    private string $sort;
    private $asc; 

    public static function create(int $rows = 9)
    {
        if(!isset(self::$instance))
            self::$instance = new static($rows);

        return self::$instance;
    }

    private function __construct(int $rows)
    {
        $this->rowsPerPage = $rows;

        $this->currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $this->sort = isset($_GET['sort']) ? (string)$_GET['sort'] : '';

        $this->asc = isset($_GET['asc']) ? (bool)$_GET['asc'] : 1;
    }

    public function getCurrentPage() : int 
    {
        return $this->currentPage;
    }

    public function getRowsPerPage() : int
    {
        return $this->rowsPerPage;
    }

    public function getOrderBy() : string 
    {
        return $this->sort;
    }

    public function isOrderAsc() : bool 
    {
        return $this->asc ? true : false;
    }

    public function isOrderDesc(): bool
    {
        return $this->asc ? false : true;
    }

}