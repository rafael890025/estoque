<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 07/05/2020
 */

require_once("../conexao.php");

$matricula = addslashes($_POST['matricula']);

$arquivo = 'log.txt';
$data = date("d/m/Y H:i:s");
$texto = "mat: {$matricula} deletado data/hora: {$data} \n";

if(is_writable($arquivo)){
    if(!$log = fopen('log.txt', 'a')){
        echo "Não foi possível abrir o arquivo ($arquivo)";
        exit;
    }

    if(fwrite($log, $texto) === false){
        echo "Não foi possível escrever o arquivo ($arquivo)";
        exit;
    }

    fclose($log);
}

$res = $pdo->query("SELECT * FROM sac_operadores WHERE matricula = '$matricula'");
if ($res->rowCount() > 0) {
    $res = $pdo->prepare("UPDATE sac_operadores SET deletado = 1 WHERE matricula = :m");
    $res->bindValue(":m", $matricula);
    $res->execute();

    echo "Cadastrado deletado com sucesso!";
} else {
    echo "Erro! Operador não cadastrado!";
}
?>