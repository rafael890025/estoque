<?php 
include('header-instalar.php'); 

$filial_cod = addslashes(isset($_POST['filial_cod']) ? $_POST['filial_cod'] : '');
$permissao_1 = addslashes(isset($_POST['permissao_1']) ? $_POST['permissao_1'] : '');
$test = true;

if($test && $test){
    
   //CRIAÇÃO DE ARQUIVOS
    $arq_conexao = fopen("config.php", "w+");
    fwrite(
        $arq_conexao,"<?php\n"."\t\$filial = "."\"".$filial_cod."\";\n\t\$host = \"localhost\";\n\t\$usuario = \"filial".$filial_cod."\";\n\t\$senha = \"senhafilial\";\n\t\$banco = \"atacadao\";\n?>",
        4096
    );

    chmod("config.php", 0777); 

    $array_permissao = explode(',', $permissao_1);
    $permissoes = '';
    foreach ($array_permissao as $permissao) {
        $permissao = trim($permissao);
        $permissoes .= "\t\"" . $permissao . "\", \n";
    }
    
    $arq_permissoes = fopen("permissoes.php", "a+");
    fwrite(
        $arq_permissoes,"\n<?php\n //LISTA DE USUARIOS COM ACESSO AO ESTOQUE \n"."\$cpd = array(\n".$permissoes.");\n?>",
        4096
    );
    chmod("permissoes.php", 0777); 

    $arq_sasoi03sh = fopen("../../shell/sasoi03.sh", "w");
    fwrite(
        $arq_sasoi03sh, "#!/bin/sh
mv /fs1/save/bk/sas03.".$filial_cod."*.csv /srvrodc/portal/sacolas/csv",
        4096
    );

    //CRIAÇÃO DO BANCO DE DADOS
    
    include_once('conexao.php');

    $sac_movimentacoes = "CREATE TABLE IF NOT EXISTS sac_movimentacoes (
        id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        matricula int(10) DEFAULT NULL,
         KEY matricula (matricula),
        retirada int(2) DEFAULT NULL,
        devolvida int(2) DEFAULT '0',
        vendida int(2) DEFAULT '0',
        sasoi03 int(2) NOT NULL DEFAULT '0',
        data date DEFAULT NULL,
        hora time DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    $sac_operadores = "CREATE TABLE IF NOT EXISTS sac_operadores (
        matricula int(10) NOT NULL PRIMARY KEY,
        nome varchar(50) DEFAULT NULL,
        administrador bit(1) NOT NULL DEFAULT b'0',
        senha varchar(50) NOT NULL,
        deletado bit(1) DEFAULT b'0'
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    $sac_sacolas = "CREATE TABLE IF NOT EXISTS sac_sacolas (
        recebida int(4) DEFAULT NULL,
        data date DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

    $ini_estoque = "INSERT INTO sac_sacolas (recebida, data) VALUES
    (0, curdate())";

    $rel_oper_mov = "ALTER TABLE sac_movimentacoes
    ADD CONSTRAINT sac_oper_movimentacoe FOREIGN KEY (matricula) REFERENCES sac_operadores (matricula)";
    
    $pdo->query($sac_movimentacoes);
    $pdo->query($sac_operadores);
    $pdo->query($sac_sacolas);
    $pdo->query($ini_estoque);
    $pdo->query($rel_oper_mov);

    $res = $pdo->query("SELECT * FROM sac_sacolas");

    if ($res->rowCount() == 1) {
        header("Location: /sacolas");
        die();

    } else {
        header("Location: /sacolas/instalar.php");
        die();

    }
}

include('footer.php');
?>