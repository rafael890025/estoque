<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 08/05/2020
 */

require_once("../conexao.php");

$matricula = addslashes($_POST['atualizar_matricula']);
$nome = strtoupper(addslashes($_POST['atualizar_nome']));

$arquivo = 'log.txt';
$data = date("d/m/Y H:i:s");
$texto = "mat: {$matricula} oper: {$nome} editado data/hora: {$data} \n";

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

if (!empty($matricula) && !empty($nome)) {
    $res = $pdo->prepare("UPDATE sac_operadores SET nome = :n WHERE matricula = :m");
    $res->bindValue(":m", $matricula);
    $res->bindValue(":n", $nome);
    $res->execute();

    echo "Cadastrado salvo com sucesso!";

} else {

    echo "Preencha todos os Campos";

}

