<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 10/05/2020
 */


require_once("../conexao.php");

$matricula = addslashes($_POST['mov_matricula']);
$sacola_dev = addslashes($_POST['mov_num_sacola']);

$res = $pdo->query("SELECT recebida FROM sac_sacolas");
$recebida = $res->fetch();

//VERIFICAR HORA DA ULTIMA RETIRADA ATE A ATUAL DEVOLUCAO, COMPARANDO COM DATA ATUAL
$res = $pdo->query("SELECT * FROM sac_operadores WHERE matricula = '$matricula'");
$flag = $res->fetch(PDO::FETCH_ASSOC);

$res = $pdo->query("SELECT retirada FROM sac_movimentacoes WHERE matricula = '$matricula' AND data = CURRENT_DATE");

if ($res->rowCount() > 0 && !$flag['deletado']) {
    $retirada = $res->fetch();
    $retirada = $retirada[0];//QUANTIDADE RETIRADA

    $res = $pdo->query("SELECT SUM(devolvida) FROM sac_movimentacoes WHERE matricula = '$matricula' AND data = CURRENT_DATE");
    $sac_dev_anterior = $res->fetch(PDO::FETCH_ASSOC);
    $sac_dev_anterior = $sac_dev_anterior['SUM(devolvida)'];//QUANTIDADE DEVOLVIDA ANTERIORMENTE NO DIA$
    $sac_de_total = $sac_dev_anterior + $sacola_dev;

    if (!empty($matricula) && !empty($sacola_dev) && $sac_de_total <= $retirada) {

        $res = $pdo->prepare("UPDATE sac_movimentacoes SET devolvida = :d, vendida = :v WHERE matricula = :m AND data = CURRENT_DATE");
        $res->bindValue(":d", $sac_de_total);
        $res->bindValue(":v", $retirada - ($sac_de_total));//QUANTIDADE VENDIDAS
        $res->bindValue(":m", $matricula);
        $res->execute();

        $res = $pdo->prepare("UPDATE sac_sacolas SET recebida = :q, data = CURRENT_DATE");
        $res->bindValue(":q", $recebida[0] + $sacola_dev);
        $res->execute();

        echo "<span class='sucesso'>Sacolas devolvidas com sucesso!</span>";

        $arquivo = 'log.txt';
        $data = date("d/m/Y H:i:s");
        $texto = "mat: {$matricula} dev: {$sacola_dev} data/hora: {$data} \n";

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

    } elseif ($sac_de_total > $retirada){

        echo "<span class='erro'>Erro! Número de sacolas devolvidas excedem o que foi retirado</span>";

    } else {

        echo "<span class='erro'>Preencha todos os campos</span>";

    }

} else {

    echo "<span class='erro'>Erro! Operador não retirou sacolas hoje!</span>";

}
?>