<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 10/05/2020
 */

require_once("../conexao.php");

$matricula = addslashes($_POST['mov_matricula']);
$num_sacola = addslashes($_POST['mov_num_sacola']);

$res = $pdo->query("SELECT recebida FROM sac_sacolas");
$recebida = $res->fetch();

$res = $pdo->query("SELECT SUM(vendida) FROM sac_movimentacoes");
$vendida = $res->fetch();

//VERIFICAR SE OPERADOR JA CADASTRADO E NAO DELETADO
$res = $pdo->query("SELECT * FROM sac_operadores WHERE matricula = '$matricula' AND deletado = 0");
if ($res->rowCount() > 0) {
    $operador_info = $res->fetch(PDO::FETCH_ASSOC);
    if (!empty($matricula) && !empty($num_sacola) && $recebida[0] >= $num_sacola && $recebida[0] > 0) {
        $res = $pdo->query("SELECT * FROM sac_movimentacoes WHERE matricula = '$matricula' AND data = CURRENT_DATE");
        if ($res->rowCount() > 0) {
            $sacolas_operador = $res->fetch(PDO::FETCH_ASSOC);
            $sacolas_ret_oper_tot = $sacolas_operador['retirada'] + $num_sacola;//SOMA QUANTIDADE RETIRADA ANTES COM A RETIRADA ATUAL
            $sacolas_ven_oper_tot = $sacolas_operador['vendida'] + $num_sacola;//ATUALIZA VALOR DE SACOLAS VENDIDAS, DESCONSIDERANDO AS SACOLAS QUE SERÃO DEVOLVIDAS POSTERIORMENTE

            $res = $pdo->prepare("UPDATE sac_movimentacoes SET retirada = :r, vendida = :v WHERE matricula = :m AND data = CURRENT_DATE");
            $res->bindValue(":r", $sacolas_ret_oper_tot);
            $res->bindValue(":v", $sacolas_ven_oper_tot);//QUANTIDADE VENDIDAS
            $res->bindValue(":m", $matricula);
            $res->execute();
        } else {
            $res = $pdo->prepare("INSERT INTO sac_movimentacoes (matricula, retirada, vendida, data, hora) VALUES (:m, :r, :v, CURRENT_DATE , CURRENT_TIME)");
            $res->bindValue(":m", $matricula);
            $res->bindValue(":r", $num_sacola);
            $res->bindValue(":v", $num_sacola);
            $res->execute();

        }

        $res = $pdo->prepare("UPDATE sac_sacolas SET recebida = :q, data = CURRENT_DATE");
        $res->bindValue(":q", $recebida[0] - $num_sacola);
        $res->execute();


        echo "<span class='sucesso'>
                Retiradas para:
                " . $operador_info['nome'] . "
            </span>";

        $arquivo = 'log.txt';
        $data = date("d/m/Y H:i:s");
        $texto = "mat: {$matricula} ret: {$num_sacola} data/hora: {$data} \n";

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


    } elseif ($recebida[0] < $num_sacola || $recebida[0] == 0) {

        echo "<span class='erro'>Não foi possível concluir a operação, verifique o estoque!</span>";

    } else {

        echo "<span class='erro'>Preencha todos os campos</span>";
    }

} else {

    echo '<span class="erro">Erro! Operador "' . $matricula . '" não cadastrado!</span>';
}
?>