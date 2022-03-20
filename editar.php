<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 08/05/2020
 */

require_once("../conexao.php");

$matricula = addslashes($_POST['matricula_editar']);

//VERIFICAR SE OPERADOR JA ESTA CADASTRADO
$res = $pdo->query("SELECT * FROM sac_operadores WHERE matricula = '$matricula'");
if ($res->rowCount() == 1) {
    $operador = $res->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="row row_input_sacola">
        <div class="col-5 sacola_esqueda">
            <label for="de" class="input_sacola">
                <div class="descricao">
                    Matrícula
                </div>
                <input id="de" name="atualizar_matricula" type="number" value="<?= $operador['matricula'] ?>"
                       placeholder="Digite a Matrícula" readonly>
            </label>
        </div>
        <div class="col-7 sacola_direita sacola_direita--b2b2b2">
            <div class="input_sacola">
                <label for="ne" class="descricao">
                    Nome
                </label>
                <div class="input--70">
                    <input id="ne" autocomplete="off" name="atualizar_nome" class="input_nome--upppercase nome--100 input_nome" type="text" value="<?= $operador['nome'] ?>"
                           placeholder="Digite o nome">
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>