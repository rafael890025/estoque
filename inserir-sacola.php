<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 10/05/2020
 */

require_once("../conexao.php");

$total_sacolas = addslashes($_POST['total_sacolas']);

if (!empty($total_sacolas)) {

    $res = $pdo->prepare("UPDATE sac_sacolas SET recebida = :q, data = CURRENT_DATE");
    $res->bindValue(":q", $total_sacolas);
    $res->execute();

    echo "Quantidade enviada com sucesso!";

    $arquivo = 'log.txt';
    $data = date("d/m/Y H:i:s");
    $texto = "estoque: {$total_sacolas} atualizado data/hora: {$data} \n";

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


} else {

    echo "Preencha todos os Campo";

}
?>