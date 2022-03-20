<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 10/05/2020
 */

require_once("../conexao.php");

$res = $pdo->query("SELECT recebida FROM sac_sacolas");
$recebida = $res->fetch();
?>

<input name="total_sacolas" class="estoque_sacolas" autocomplete="off" value="<?= $recebida[0] ?>" type="number" placeholder="0">
