<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 23/05/2020
 */

require_once('permissoes.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-441-dist-css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="icon" href="assets/images/atacadao-a.png">
    <title>Controle de Sacolas</title>
</head>
<body>
<header>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="estoque_sacolas_deslogado">
                        <img src="assets/images/atacadao-sacola-b.png" alt="">
                        <div id="total_sacolas_menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="carousel_banner" class="carousel slide banner">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/images/atacadao-banner.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/atacadao-banner-2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/atacadao-banner-3.png" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
            <div class="banner">
                <div class="logo">
					<img src="assets/images/atacadao-logo.png" alt="">
                </div>
                <div class="titulo">
                    Sistema de Controle de Sacolas
                </div>
            </div>
        </div>
        <div class="row menu_row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col col--flex">
                            <ul class="menu">
                                <li class="item">
                                    <a href="#" data-target="#carousel_main" data-slide-to="0" class="inicio active">
                                        <img src="assets/images/atacadao-1.png" alt="">
                                        Início
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="#" data-target="#carousel_main" data-slide-to="1">
                                        <img src="assets/images/atacadao-2.png" alt="">
                                        Operadores
                                    </a>
                                </li>
                                <?php
                                if (in_array($usuario, $cpd)):
                                    ?>
                                    <li class="item">
                                        <a href="#" data-target="#carousel_main" data-slide-to="2">
                                            <img src="assets/images/atacadao-3.png" alt="">
                                            Estoque
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="item">
                                    <a href="#" data-target="#carousel_main" data-slide-to="3">
                                        <img src="assets/images/atacadao-4.png" alt="">
                                        Relatório
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>