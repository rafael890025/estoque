<?php
    /**
     * User: Felipe L. Costa - 294507
     * Date: 12/05/2020
     */

    require_once("conexao.php");
    require_once('classes/PHPExcel.php');


    $filtro = addslashes($_GET['filtro']);
    $filtro2 = addslashes($_GET['filtro2']);
    if (isset($_GET['filtro']) && !empty($_GET['filtro']) && isset($_GET['filtro2']) && !empty($_GET['filtro2'])) {

        //PREVENÇÃO PARA NÃO PEGAR A DATA CORRENTE QUE ESTA SEM ARQUIVO SASOI03 CASO FOR GERAR RELATORIO ACUMULADO DE DIAS ANTERIORES
        if($filtro !== $filtro2 && $filtro2 == date("Y-m-d")){
            $dia = date("d") -1;
            $mes = date("m");
            $ano = date("Y");
            $data = mktime(0,0,0, $mes, $dia, $ano);
            $filtro2 = date("Y-m-d", $data);
        }

        $data = "WHERE data BETWEEN '$filtro' AND '$filtro2'";
        $converte = date_create($filtro);
        $converte2 = date_create($filtro2);
        $data_br = date_format($converte, 'd/m/y');
        $data_br2 = date_format($converte2, 'd/m/y');
        $data_inicio = date_format($converte, 'dmy');
        $data_fim = date_format($converte2, 'dmy');
        $data_relatorio = $data_inicio . "." . $data_fim;
        $data_filtro = $data_br . " até " . $data_br2;
    } else {
    // $data = "WHERE data BETWEEN '$filtro' AND '$filtro2'";
        $data = "WHERE data = CURRENT_DATE";
        $data_br = "";
        $data_inicio = "";
        $data_fim = "";
        $data_filtro = date("d/m/Y");
        $data_relatorio = date('dmy');
    }

    header('Content-Type: application/vdn.ms-excel');
    header('Content-Disposition: attachment;filename="sas03.f'.$filial.''.$data_relatorio.'.xls"');
    header('Cache-Control: max-age=0');

    $flag = 0;//CASO DATA UNICA, NÃO REPETE DATA PARA CADA LINHA
    if ($data_inicio == $data_fim && $data_inicio !== "") {
        $flag = 1;
        $data_filtro = $data_br;
    }


    //VERIFICA TOTAL DE MOVIMENTACOES REGISTRADAS NA SASOI03 NA DATA FILTRO CASO JA TENHA SIDO SALVA NO BANCO DE DADOS
    $res = $pdo->query("SELECT SUM(sasoi03) AS arqSASOI03 FROM sac_movimentacoes " . $data);
    $arq_sasoi03 = $res->fetch(PDO::FETCH_ASSOC);


    //GERA LISTA COM AS INFORMAÇÕES DA SOMA DAS MOVIMENTAÇOES DE CADA FUNCIONDARIO
    $res = $pdo->query("SELECT oper.matricula, oper.nome, oper.deletado, SUM(mov.retirada) AS retirada, SUM(mov.devolvida) AS devolvida, SUM(mov.vendida) AS venda, SUM(mov.sasoi03) AS sasoi03, mov.data FROM sac_movimentacoes mov JOIN sac_operadores oper ON mov.matricula = oper.matricula " . $data . " GROUP BY matricula ORDER BY nome");

    $dadosXlsTitulo = "";
    $dadosXlsTitulo .= "<meta charset='utf-8'/>";
    $dadosXlsTitulo .= "  <table border='1'>";
    $dadosXlsTitulo .= "          <th colspan='3'>Relatório de vendas de sacolas</th";

    $dadosXls  = "";

    if ($arq_sasoi03['arqSASOI03'] > 0) {

        $dadosXlsTitulo .= "          <th colspan='4'>Data: ".$data_filtro." </th>";
        $dadosXlsTitulo .= "  </table>";
       
    
        $dadosXls .= "  <table border='1' >";
        $dadosXls .= "          <tr>";
        $dadosXls .= "          <th>Matrícula</th>";
        $dadosXls .= "          <th>Operador</th>";
        $dadosXls .= "          <th>Retirada</th>";
        $dadosXls .= "          <th>Devolução</th>";
        $dadosXls .= "          <th>Venda</th>";
        $dadosXls .= "          <th>SASOI03</th>";
        $dadosXls .= "          <th>Diferença</th>";
        $dadosXls .= "      </tr>";
    }else{
        $dadosXlsTitulo .= "          <th colspan='2'>Data: ".$data_filtro." </th>";
        $dadosXlsTitulo .= "  </table>";

        $dadosXls .= "  <table border='1' >";
        $dadosXls .= "          <tr>";
        $dadosXls .= "          <th>Matrícula</th>";
        $dadosXls .= "          <th>Operador</th>";
        $dadosXls .= "          <th>Retirada</th>";
        $dadosXls .= "          <th>Devolução</th>";
        $dadosXls .= "          <th>Venda</th>";
        $dadosXls .= "      </tr>";
    }

    echo $dadosXlsTitulo;

    $totalRetirada = null;
    $totalDevolvida = null;
    $totalVenda = null;
    $totalSasoi03 = null;
    $totalDiferenca = null;

    if ($res->rowCount() > 0) {

        foreach ($res->fetchAll(PDO::FETCH_ASSOC) as $operador) {  
            
            if ($arq_sasoi03['arqSASOI03'] > 0) {
                if ($operador['sasoi03'] !== '0') {
                    $dadosXls .= "      <tr>";
                    $dadosXls .= "          <td>".$operador['matricula']."</td>";
                    $dadosXls .= "          <td>".$operador['nome']."</td>";
                    $dadosXls .= "          <td>".$operador['retirada']."</td>";
                    $dadosXls .= "          <td>".$operador['devolvida']."</td>";
                    $dadosXls .= "          <td>".$operador['venda']."</td>";
                    $dadosXls .= "          <td>".$operador['sasoi03']."</td>";
                    $dadosXls .= "          <td>".($operador['sasoi03'] - $operador['venda'])."</td>";
                    $dadosXls .= "      </tr>";
            
                    $totalRetirada += $operador['retirada'];
                    $totalDevolvida += $operador['devolvida'];
                    $totalVenda += $operador['venda'];
                    $totalSasoi03 += $operador['sasoi03'];
                    $totalDiferenca += ($operador['sasoi03'] - $operador['venda']);
                }
                else{
                    $dadosXls .= "      <tr>";
                    $dadosXls .= "          <td>".$operador['matricula']."</td>";
                    $dadosXls .= "          <td>".$operador['nome']."</td>";
                    $dadosXls .= "          <td>".$operador['retirada']."</td>";
                    $dadosXls .= "          <td>".$operador['devolvida']."</td>";
                    $dadosXls .= "          <td>".$operador['venda']."</td>";
                    $dadosXls .= "          <td></td>";
                    $dadosXls .= "          <td></td>";
                    $dadosXls .= "      </tr>";
            
                    $totalRetirada += $operador['retirada'];
                    $totalDevolvida += $operador['devolvida'];
                    $totalVenda += $operador['venda'];
                }      

            }  else{
                $dadosXls .= "      <tr>";
                $dadosXls .= "          <td>".$operador['matricula']."</td>";
                $dadosXls .= "          <td>".$operador['nome']."</td>";
                $dadosXls .= "          <td>".$operador['retirada']."</td>";
                $dadosXls .= "          <td>".$operador['devolvida']."</td>";
                $dadosXls .= "          <td>".$operador['venda']."</td>";
                $dadosXls .= "      </tr>";
        
                $totalRetirada += $operador['retirada'];
                $totalDevolvida += $operador['devolvida'];
                $totalVenda += $operador['venda'];
            }  
        }

        $dadosXls .= "  </table>";
        echo $dadosXls;
        $dadosXls2 = "";
        $dadosXls2 .= "  <table border='0' >";
        $dadosXls2 .= "      <tr>";
        $dadosXls2 .= "          <td></td>";        
        $dadosXls2 .= "      </tr>";
        $dadosXls2 .= "  </table>";

        echo $dadosXls2;
        $dadosXls3 = "";
        $dadosXls3 .= "  <table border='1' >";
        $dadosXls3 .= "      <tr>";
        $dadosXls3 .= "          <th colspan='2'>Total</th>";
        $dadosXls3 .= "          <td>".$totalRetirada."</td>";
        $dadosXls3 .= "          <td>".$totalDevolvida."</td>";
        $dadosXls3 .= "          <td>".$totalVenda."</td>";
        if ($arq_sasoi03['arqSASOI03'] > 0) {
            $dadosXls3 .= "          <td>".$totalSasoi03."</td>";
            $dadosXls3 .= "           <td>".$totalDiferenca."</td>";
        }
        $dadosXls3 .= "      </tr>";
        $dadosXls3 .= "  </table>";

    }else{

        $dadosXls = "Erro: Nenhum dado encontrado";

    }

    echo $dadosXls3;

?>