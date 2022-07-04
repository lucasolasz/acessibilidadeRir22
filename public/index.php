<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');
include './../app/config/configuracao.php';
include './../app/autoload.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">    
    <link rel="shortcut icon" href="<?= URL ?>/public/img/Acessibilidade.png">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?= URL ?>/public/js/jquery.funcoes.js"></script>
    <script src="<?= URL ?>/public/js/qcTimepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="<?= URL ?>/public/css/estilos.css" rel="stylesheet">
    <title><?= APP_NOME ?></title>
</head>

<body>
    
    <?php
    include APP.'/views/topo.php';
    $rotas = new Rota();
    include APP.'/views/rodape.php';
    ?>

</body>

</html>