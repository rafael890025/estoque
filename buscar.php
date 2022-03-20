<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 07/05/2020
 */

require_once("../conexao.php");

$res = $pdo->query("SELECT * FROM sac_operadores WHERE deletado = 0 ORDER BY nome");
if ($res->rowCount() > 0) {
    foreach ($res->fetchAll(PDO::FETCH_ASSOC) as $operador) {
            ?>
            <div class="row lista-oper grid">
                <div class="col element-item categoria_3">
                    <div class="col-2">
                        <div class="matricula">
                            <a href="codigo-barras.php?matricula=<?= $operador['matricula'] ?>&nome=<?= $operador['nome'] ?>" target="_blank">
                                <img src="assets/images/atacadao-barcode.png" alt="">
                            </a>
                            <div class="numero">
                                <?= $operador['matricula'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 lista-oper--borda-esq">
                        <div class="nome">
                            <?= $operador['nome'] ?>
                        </div>
                    </div>
                    <div class="col-2 lista-oper--borda-esq">
                        <div class="edicao">
                            <button class="editar" value="<?= $operador['matricula'] ?>" data-toggle="modal"
                                    data-target=".modal-editar">
                                <span class="btn_editar">
                                    Editar
                                </span>
                                <img src="assets/images/atacadao-lapis-b.png" alt="">
                            </button>
                        </div>
                        <div class="excluir">
                            <button class="deletar" value="<?= $operador['matricula'] ?>" data-toggle="modal"
                                    data-target=".modal-excluir">
                                <img src="assets/images/atacadao-lixeira-b.png" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
    }
}