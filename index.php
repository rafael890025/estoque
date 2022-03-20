<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 23/05/2020
 */

include('header.php');
?>
    <main>
        <div id="carousel_main" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <form id="sac_movimento" method="post">
                                    <div class="row row_btn_sacola">
                                        <div class="col">
                                            <div class="btn_sacola">
                                                <div class="button retirada">Retirada</div>
                                                <div class="button devolucao">Devolução</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row_input_sacola">
                                        <div class="col sacola_esqueda">
                                            <div class="input_sacola">
                                                <label for="m" class="descricao">
                                                    Nome / Matrícula
                                                </label>
                                                <div class="matricula_pesquisa">
                                                    <input class="mov_matricula" autocomplete="off" id="m" name="mov_matricula"
                                                           type="text" placeholder="Digite nome / matrícula">
                                                    <div id="autocomplete"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col sacola_direita">
                                            <div class="input_sacola">
                                                <label for="s" class="descricao">
                                                    Nº Sacolas
                                                </label>
                                                <div class="">
                                                    <input class="mov_sacola" autocomplete="off" id="s" value="20"" name="mov_num_sacola"
                                                           type="number"
                                                           placeholder="Digite o nº sacolas">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row_btn_enviar">
                                        <div class="col col_btn_enviar">
                                            <div class="btn_enviar">
                                                <button id="operador_sacola">ENVIAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row row_lista_cabecalho">
                            <div class="col-2">Matrícula</div>
                            <div class="col-8 lista_cabecallho--flex lista_cabecallho--borda-esq">
                                Operador
                                <div class="">
                                    <img id="adicionar_oper" data-toggle="modal" data-target=".modal-cadastro"
                                         src="assets/images/atacadao-operadores-adicionar-b.png" alt="">
                                    <span id="num_oper"></span>
                                </div>
                            </div>
                            <div class="col-2 operador_relatorio lista_cabecallho--borda-esq">
                                <a href="excel-operadores.php">
                                    <img src="assets/images/atacadao-baixar.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="container" id="lista"></div>
                </div>
                <div class="carousel-item">
                    <?php
                    if (in_array($usuario, $cpd)):
                        ?>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <form method="post">
                                        <div class="row row_input_sacola row_input_estoque">
                                            <div class="col sacola_esqueda">
                                                <div class="input_sacola">
                                                    <div class="descricao">
                                                        Saldo
                                                    </div>
                                                    <div id="total_sacolas"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row_btn_enviar">
                                            <div class="col col_btn_enviar">
                                                <div class="btn_enviar">
                                                    <button id="enviar_sacolas">ATUALIZAR</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row row_lista_cabecalho row_lista_cabecalho--rel">
                            <div class="col-2">matrícula</div>
                            <div class="col-4 oper_data--flex lista_cabecallho--borda-esq">
                                <div class="operador">
                                    operador
                                </div>
                            </div>
                            <div class="col-2 adicionar lista_cabecallho--borda-esq">retirada</div>
                            <div class="col-2 adicionar lista_cabecallho--borda-esq">devolução</div>
                            <div class="col-1 lista_cabecallho--borda-esq">venda</div>
                            <div class="col-1 lista_cabecallho--borda-esq">
                                <a id="abre_modal_filtro" data-toggle="modal" data-target=".modal-filtro">
                                    <img src="assets/images/atacadao-baixar.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="container" id="lista_rel"></div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                    </div>
                    <div class="container" id="lista_rel"></div>
                </div>
            </div>
        </div>
    </main>
    <input id="texto_credito" type="hidden" value="DESENVOLVIDO POR CPD FILIAL 166 - FELIPE L. COSTA">
<?php
include('footer.php');
?>
