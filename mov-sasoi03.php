<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 02/06/2020
 */

require_once("../conexao.php");



//ESCANEIA CAMINHO PARA CARREGAR ARQUIVO SASOI03
$dir = 'csv';
$files = scandir("../" .$dir);//SCANEIA ARQUIVOS PASTA CSV

$flag = 0;//FLAG DE ARQUIVO CORRESPONDENTE A FILTRO
$flag_2 = 0;//TRAZ A DATA ASSOCIADA A SASOI03 DO SISTEMA QUE ESTA
$sas03 = "";//INICIALIZA VARIAVEL SASOI03

$res = $pdo->query("SELECT DISTINCT data FROM sac_movimentacoes ORDER BY data DESC");
if ($res->rowCount() > 0) {
    $rel_datas = $res->fetchAll(PDO::FETCH_ASSOC);
    $data_array = [];
    $data_filtro_array = [];
    foreach ($rel_datas as $rel_data) {
        $converte = date_create($rel_data['data']);
        $data = date_format($converte, 'd/m/Y');

        $data_array [] = $rel_data['data'];
        $data_filtro = $data . " ATE " . $data;
        $data_filtro_array [] = $data_filtro;
    }

    foreach ($files as $key => $file) {
        if ($key > 1) 
        {       //IGNORA OS DOIS PRIMEIROS, ASSIM RETORNA SOMENTE OS ARQUIVOS CORRETOS
            $csv = array_map('str_getcsv', file('../csv/' .$file));
          
            $count = 0;
            foreach ($csv as $k => $linha) {
                $coluna_array = explode(";", $linha[0]);//TRANSFORMA REGISTRO EM ARRAY
              //  print_r($coluna_array);
                //AO PASSAR PELA LINHA DA DATA, BUSCA COLUNA E VERIFICA SE DATA BATE COM DATAS DE MOVIMENTACOES
                if ($k == 1) {
                    foreach ($data_filtro_array as $key => $data_filtro) {
                        if ($coluna_array[3] == $data_filtro) {
                            $flag = 1;//VERIFICA SE CSV CORRESPONDE A DATA FILTRO
                            $flag_2 = $data_array [$key];//SALVA DATA DO RELATORIO NA FLAG
                            break;
                        }
                    }
                }

                if ($flag && $k > 1) {//ARQUIVO CSV CORREPONDENTE ENCONTRADO

                    //PESQUISA SOMENTE OS OPERADORES QUE TIVERAM MOVIMENTACAO NA DATA RELACIONADA COM A SASOI03
                    $res = $pdo->query("SELECT matricula FROM sac_movimentacoes WHERE data = '$flag_2'");
                    $operadores = $res->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($operadores as $operador) {

                        $matricula = $operador['matricula'];
                        $matricula_sasoi03 = strlen($coluna_array[0]);
                        $matricula_sistema = strlen($operador['matricula']);
                        if ($matricula_sasoi03 !== $matricula_sistema) {
                            $corte = abs($matricula_sistema - $matricula_sasoi03);
                            $matricula_cut = substr($operador['matricula'], $corte);
                            if ($matricula_cut = $coluna_array[0]) {
                                $matricula = substr($operador['matricula'], $corte);
                            }
                        }

                        if ($coluna_array[0] == $matricula) {
                            $data = $data_array[$key];
                            $matricula = $coluna_array[0];
                            $sas03 = $coluna_array[2];




                            //                        ATUALIZA BANCO DE DADOS COM A COLUNA SASOI03
                            $res = $pdo->prepare("UPDATE sac_movimentacoes SET sasoi03 = :s WHERE matricula = :m AND data = :d");
                            $res->bindValue(":s", $sas03);
                            $res->bindValue(":d", $data);
                            $res->bindValue(":m", $operador['matricula']);
                            $res->execute();
                        }
                    }
                }
            }
            $flag = 0;
			
			$arquivo = 'log.txt';
			$data = date("d/m/Y H:i:s");
			$texto = "sasoi03: {$file} adicionada data/hora: {$data}";

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
        }
    }
    array_map ('unlink' , glob('../csv/*.csv'));//APAGA ARQUIVO SASOI03 APOS INSERIR NO BANCO DE DADOS
}
?>


