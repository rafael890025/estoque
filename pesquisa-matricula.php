<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 15/05/2020
 */

require_once('../conexao.php');

$matricula = addslashes($_POST['matricula']);

$res = $pdo->query("SELECT nome, matricula FROM sac_operadores WHERE matricula LIKE '%$matricula%' OR nome LIKE '%$matricula%' AND deletado = 0");
$operadores = $res->fetchAll(PDO::FETCH_ASSOC);

if ($res->rowCount() > 0) {
    ?>
    <div class="autocomplete_nome auto_cabecalho">
        <div class="auto_nome">
            nome
        </div>
        <div class="auto_info">
            <div class="auto_retirada">
                ret
            </div>
            <div class="auto_devolvida">
                dev
            </div>
            <div class="auto_vendida">
                ven
            </div>
        </div>
    </div>
    <?php

    foreach ($operadores as $operador) {
        $matric = $operador['matricula'];

        $res = $pdo->query("SELECT SUM(retirada) AS retirada, SUM(devolvida) AS devolvida, SUM(vendida) AS vendida FROM sac_movimentacoes WHERE matricula = '$matric' AND data = CURRENT_DATE");
        $operador_info = $res->fetch(PDO::FETCH_ASSOC);

        if ($res->rowCount() > 0) {
            ?>
            <div id="<?= $operador['matricula'] ?>" class="autocomplete_nome">
                <div class="auto_nome">
                    <?= substr($operador['nome'], 0, 35) ?>
                </div>
				<div class="auto_info">
					<div class="auto_retirada">
						<?= $operador_info['retirada'] ? $operador_info['retirada'] : 0 ?>
					</div>
					<div class="auto_devolvida">
						<?= $operador_info['devolvida']? $operador_info['devolvida'] : 0 ?>
					</div>
					<div class="auto_vendida">
						<?php echo $operador_info['vendida']? $operador_info['vendida'] : 0 ?>
					</div>
				</div>
            </div>
            <?php
        }
    }
} else {
    echo "<div class='autocomplete_nome erro'>NENHUM REGISTRO ENCONTRADO...</div>";
}
?>
