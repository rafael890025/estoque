<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 07/05/2020
 */

require_once("../conexao.php");

$matricula = addslashes($_POST['matricula']);
$nome = strtoupper(addslashes($_POST['nome']));
//VERIFICAR SE OPERADOR JA ESTA CADASTRADO OU DELETADO
$res = $pdo->query("SELECT * FROM sac_operadores WHERE matricula = '$matricula'");
$flag = $res->fetch(PDO::FETCH_ASSOC);


//SE OPERADOR NÃO TIVER CADASTRO OU SE ESTIVER MARCADO COMO DELETADO
if ($res->rowCount() == 0 || $flag['deletado']) {
    if (!empty($matricula) && !empty($nome)) {
        if ($flag['deletado']) {
            $res = $pdo->prepare("UPDATE sac_operadores SET nome = :n, deletado = 0 WHERE matricula = :m");
        } else {
            $res = $pdo->prepare("INSERT INTO sac_operadores (matricula, nome, senha) VALUES (:m, :n, 'atacadao@274')");
        }
        $res->bindValue(":m", $matricula);
        $res->bindValue(":n", $nome);
        $res->execute();

        echo "<span class='sucesso'>Cadastrado salvo com sucesso!</span>";
        
        $arquivo = 'log.txt';
        $data = date("d/m/Y H:i:s");
        $texto = "mat: {$matricula} oper: {$nome} adicionado data/hora: {$data} \n";

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
        echo "<span class='erro'>Preencha todos os Campos</span>";
    }
} else {
    echo "<span class='erro'>Erro! Operador já cadastrado!</span>";
}
?>