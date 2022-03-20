<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 11/05/2020
 */


require_once("../conexao.php");

if (isset($_POST['filtro']) && $_POST['filtro'] != "") {
    $filtro = addslashes($_POST['filtro']);
    $data = "WHERE data = '$filtro'";
    $converte = date_create($filtro);
    $data_br = date_format($converte, 'd/m/yy');
    $data_filtro = $data_br . " ATE " . $data_br;
} else {
    $data = "WHERE data = CURRENT_DATE";
    $data_br = "";
    $data_filtro = "";
}

//GERA LISTA COM AS INFORMAÇÕES DA SOMA DAS MOVIMENTAÇOES DE CADA FUNCIONDARIO
$res = $pdo->query("SELECT oper.matricula, oper.nome, oper.deletado, SUM(mov.retirada), SUM(mov.devolvida), SUM(mov.vendida) AS venda, mov.data FROM sac_movimentacoes mov JOIN sac_operadores oper ON mov.matricula = oper.matricula ".$data." GROUP BY matricula ORDER BY nome");
$res_count =  $res;
if ($res->rowCount() > 0) {
    foreach ($res->fetchAll(PDO::FETCH_ASSOC) as $operador) {
        $flag = 0;
        ?>
        <div class="row lista-oper grid">
            <div class="col element-item">
                <div class="col-2">
                    <div class="matricula">
                        <div class="numero">
                            <?= $operador['matricula'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-4 lista-oper--borda-esq">
                    <div class="nome">
                        <?= substr($operador['nome'], 0, 35) ?>
                    </div>
                </div>
                <div class="col-2 lista-oper--borda-esq">
                    <div class="retirada">
                        <?= $operador['SUM(mov.retirada)'] ?>
                    </div>
                </div>
                <div class="col-2 lista-oper--borda-esq">
                    <div class="devolvida">
                        <?= $operador['SUM(mov.devolvida)'] ?>
                    </div>
                </div>
                <div class="col-2 lista-oper--borda-esq">
                    <div class="total">
                        <?php echo $operador['venda'] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

$res = $pdo->query("SELECT SUM(retirada), SUM(devolvida), SUM(vendida) FROM sac_movimentacoes ".$data);
$total = $res->fetchAll(PDO::FETCH_ASSOC);

if ($res_count->rowCount() > 1) {
    ?>

    <div class="row lista-oper totais">
        <div class="col element-item">
            <div class="col-2">
                Total
            </div>
            <div class="col-4">
            </div>
            <div class="col-2 lista-oper--borda-esq">
                <?= $total[0]['SUM(retirada)'] ?>
            </div>
            <div class="col-2 lista-oper--borda-esq">
                <?= $total[0]['SUM(devolvida)'] ?>
            </div>
            <div class="col-2 lista-oper--borda-esq">
                <?= $total[0]['SUM(vendida)'] ?>
            </div>
        </div>
    </div>
    <?php

}