<?php

declare(strict_types=1);

use Rekrutacyjne\Class\DefaultConfig;
use Rekrutacyjne\Class\HtmlDataGrid;
use Rekrutacyjne\Class\HttpState;

require_once realpath('vendor/autoload.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataGrid</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    try
    {
        if(($rows = json_decode(file_get_contents('data.json'), true)) == false)
            throw new \InvalidArgumentException("Dane w pliku data.json mają niewłaściwy format");

        $dataGrid = new HtmlDataGrid();
        $config = (new DefaultConfig)
            ->addIntColumn('id')
            ->addTextColumn('name')
            ->addIntColumn('age')
            ->addTextColumn('company')
            ->addCurrencyColumn('balance', 'USD')
            ->addTextColumn('phone')
            ->addTextColumn('email');
    
        $state = HttpState::create();
        $dataGrid->withConfig($config)->render($rows, $state); 
    }
    catch(Exception $e)
    {
        echo '<div class="alert alert-danger" role="alert">
            <img src="assets/icons/exclamation-triangle-fill.svg" />Bład krytyczny - '.$e->getMessage().'</div>';
    }
    ?>
    <script>
        if($("#arrow").attr('src') == 'assets/icons/arrow-down.svg')
            $("#arrow").parent().attr('href','?');
    </script>
</body>
</html>

