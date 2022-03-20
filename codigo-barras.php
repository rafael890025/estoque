<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 23/05/2020
 */

$matricula = addslashes($_GET['matricula']);
$nome = addslashes($_GET['nome']);

function geraCodigoBarra($numero)
{
    $fino = 2;
    $largo = 6;
    $altura = 50;

    $barcodes[0] = '00110';
    $barcodes[1] = '10001';
    $barcodes[2] = '01001';
    $barcodes[3] = '11000';
    $barcodes[4] = '00101';
    $barcodes[5] = '10100';
    $barcodes[6] = '01100';
    $barcodes[7] = '00011';
    $barcodes[8] = '10010';
    $barcodes[9] = '01010';

    for ($f1 = 9; $f1 >= 0; $f1--) {
        for ($f2 = 9; $f2 >= 0; $f2--) {
            $f = ($f1 * 10) + $f2;
            $texto = '';
            for ($i = 1; $i < 6; $i++) {
                $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
            }
            $barcodes[$f] = $texto;
        }
    }

    echo '<img src="assets/images/p.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
    echo '<img src="assets/images/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
    echo '<img src="assets/images/p.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
    echo '<img src="assets/images/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';

    echo '<img ';

    $texto = $numero;

    if ((strlen($texto) % 2) <> 0) {
        $texto = '0' . $texto;
    }

    while (strlen($texto) > 0) {
        $i = round(substr($texto, 0, 2));
        $texto = substr($texto, strlen($texto) - (strlen($texto) - 2), (strlen($texto) - 2));

        if (isset($barcodes[$i])) {
            $f = $barcodes[$i];
        }

        for ($i = 1; $i < 11; $i += 2) {
            if (substr($f, ($i - 1), 1) == '0') {
                $f1 = $fino;
            } else {
                $f1 = $largo;
            }

            echo 'src="assets/images/p.gif" width="' . $f1 . '" height="' . $altura . '" border="0">';
            echo '<img ';

            if (substr($f, $i, 1) == '0') {
                $f2 = $fino;
            } else {
                $f2 = $largo;
            }

            echo 'src="assets/images/b.gif" width="' . $f2 . '" height="' . $altura . '" border="0">';
            echo '<img ';
        }
    }
    echo 'src="assets/images/p.gif" width="' . $largo . '" height="' . $altura . '" border="0" />';
    echo '<img src="assets/images/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
    echo '<img src="assets/images/p.gif" width="1" height="' . $altura . '" border="0" />';
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-441-dist-css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="icon" href="assets/images/atacadao-a.png">
    <title>Controle de Sacolas</title>
</head>
<body class="cod_barras">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="conteudo">
                <div class="titulo">CÓDIGO DE BARRAS</div>
                <div class="nome"><?= $matricula." - ".$nome?></div>
                <div class="cod">
                    <?php geraCodigoBarra("000".$matricula); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/jquery-350min.js"></script>
<script src="assets/js/bootstrap-441-dist-js/bootstrap.min.js"></script>
<script src="assets/js/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
