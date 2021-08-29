<?php

namespace Rekrutacyjne\Class;

class HtmlDataGrid implements DataGrid 
{
    private Config $config;
    private State $state;
    private String $rows; 

    public function __construct()
    {

    }

    public function withConfig(Config $config): DataGrid
    {
        $this->config = $config;
        return $this;
    }

    public function render(array $rows, State $state): void
    {
        $rowsCount = count($rows);
        $pages = ceil($rowsCount / $state->getRowsPerPage());
        $iterator = ($state->getCurrentPage()-1)*$state->getRowsPerPage();
        $max = $iterator + $state->getRowsPerPage() > $rowsCount ? $rowsCount : $iterator + $state->getRowsPerPage();
        $orderBy = $state->getOrderBy();
        $asc = $state->isOrderAsc() ? 1 : -1;
        $desc = $state->isOrderDesc() ? 1 : -1;
        $table = '<table class="table table-bordered"><thead><tr>';
        $columns = $this->config->getColumns();

        /**
         * Link do użycia przy paginacji i klikalnych nagłówkach strony
         */
        
        $link = $orderBy !== '' ? '&sort='.$orderBy.'&asc='.($asc == 1 ? 1 : 0) : '';

        if($rowsCount-1 < $iterator)
            throw new \Exception('Brak danych do wyświetlenia');

        if($orderBy !== '')
            if(key_exists($orderBy,$rows[0]))
                if(is_numeric($rows[0][$orderBy]))
                    usort($rows, function($a, $b) use ($orderBy, $asc, $desc){
                        return $a[$orderBy] > $b[$orderBy] ? $asc : $desc;
                    });
                else 
                    usort($rows, function($a, $b) use ($orderBy, $asc){
                        return strcasecmp($a[$orderBy],$b[$orderBy]) * $asc;
                    });
            else
                throw new \Exception('Niepoprawny klucz sortowania');

        foreach($columns as $column)
        {
            $header = sprintf('<a href="?sort=%s&asc=%d">%s %s</a>',
                $column->getLabel(),
                ($orderBy == $column->getLabel() ? ($state->isOrderAsc() ? 0 : 1): 1),
                ucwords($column->getLabel()),
                ($orderBy == $column->getLabel() ? 
                    '<img id="arrow" src="assets/icons/arrow-'.($state->isOrderAsc() ? 'up' : 'down').'.svg" class="icon" />'  : '')
            );
            $table .= sprintf('<th>%s</th>', $header);
        }
        $table .= '</tr></thead><tbody>';

        for($i = $iterator; $i < $max; $i++)
        {
            $table .= '<tr>';
            $row = $rows[$i];
            foreach($columns as $column)
                $table .= sprintf('<td>%s</td>',$column->getDataType()->format($row[$column->getLabel()]));
            $table .= '</tr>';
        }


        echo $table.'</tbody></table>';
        
        $pagination = '<nav aria-label="Page navigation example">
        <ul class="pagination">';

        for($i = 1; $i <= $pages; $i++)
            $pagination .= sprintf('<li class="page-item%s"><a class="page-link" href="?page=%d%s">%d</a></li>',
                $state->getCurrentPage() == $i ? ' active' : "", $i, $link, $i);
        $pagination .= '</ul></nav>';
        echo $pagination;
    }
}