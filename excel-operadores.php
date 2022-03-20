<?php
    
    /**
     * User: Felipe L. Costa - 294507
     * Date: 17/05/2020
     * Update: 16/06/2021 by Edenilson Souza - 328107 - Filial 274 
     */
    require_once("conexao.php");

    $dadosXls  = "";
    $dadosXlsTitulo = "";
    $dadosXlsTitulo .= "<meta charset='utf-8'/>";
    $dadosXlsTitulo .= "  <table border='1' >";
    $dadosXlsTitulo .= "<td colspan='2'>Relatório de colaboradores</td>";
    $dadosXlsTitulo .= "  </table>";
    echo $dadosXlsTitulo;
    $dadosXls .= "  <table border='1' >";
    $dadosXls .= "          <tr>";
    $dadosXls .= "          <th>Nome</th>";
    $dadosXls .= "          <th>Matricula</th>";
    $dadosXls .= "      </tr>";
    //GERA LISTA COM AS INFORMAÇÕES DO FUNCIONDARIO
    $res = $pdo->query("SELECT matricula, nome FROM sac_operadores WHERE deletado = 0");
    $resultUser = $res-> rowCount();
    if($resultUser > 0){
       
       foreach($res as $dados){
            $dadosXls .= "      <tr>";
            $dadosXls .= "          <td>".$dados['nome']."</td>";
            $dadosXls .= "          <td>".$dados['matricula']."</td>";
            $dadosXls .= "      </tr>";
        }

        $dadosXls .= "  </table>";

    }else{
        $dadosXls = "ERRO AO CRIAR TABELA - NENHUM DADO EXISTENTE";
    }
  
    require_once('classes/PHPExcel.php');
    header('Content-Type: application/vdn.ms-excel');
    header('Content-Disposition: attachment;filename="relatorio-operadores.xls"');
    header('Cache-Control: max-age=0');
       
    echo $dadosXls;
    exit;

?>
