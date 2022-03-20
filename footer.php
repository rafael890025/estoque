<?php
/**
 * User: Felipe L. Costa - 294507
 * Date: 10/05/2020
 */

//MANTER CREDITOS
$creditos = 'DESENVOLVIDO POR CPD FILIAL 166 - FELIPE L. COSTA';

?>

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="footer_conteudo">
                                <div class="assinatura">
                                    <a href="https://srvsave166/portalintranet/" target="_blank">
                                        <img src="assets/images/atacadao-logo-branco.png" alt="">
                                    </a>
                                </div>
                                <div class="texto texto_alert button balloon"
                                     balloon-data="
                                        Principais colaboradores
                                        Gabriel & Samuel
                                    ">
                                    <?= $creditos ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal modal-cadastro modal-lista-oper fade" tabindex="-1" role="dialog"
     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">
                    <div class="modal_img">
                        <img src="assets/images/atacadao-a-b.png" alt="">
                    </div>
                    <div class="modal_titulo">
                        Cadastro de operador
                    </div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row row_input_sacola">
                        <div class="col-5 sacola_esqueda">
                            <div class="input_sacola">
                                <label for="mc" class="descricao">
                                    Matrícula
                                </label>
                                <div class="modal_balloon balloon" balloon-data="
                                        Digite a matrícula completa
                                    ">
                                    <input class="cad_matricula" autocomplete="off" id="mc" name="matricula"
                                           type="text" pattern="([0-9])" placeholder="Digite a matrícula"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-7 sacola_direita">
                            <div class="input_sacola">
                                <label for="dm" class="descricao">
                                    Nome
                                </label>
                                <div class="input--70">
                                    <input id="dm" autocomplete="off" name="nome" class="nome--100 input_nome" type="text"
                                           placeholder="Digite o nome">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row_btn_enviar">
                        <div class="col col_btn_enviar">
                            <div class="btn_enviar">
                                <button id="salvar_operador" data-dismiss="modal">SALVAR</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-editar modal-lista-oper fade" tabindex="-1" role="dialog"
     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">
                    <div class="modal_img">
                        <img src="assets/images/atacadao-a-b.png" alt="">
                    </div>
                    <div class="modal_titulo">
                        Editar informações do operador
                    </div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div id="mensagem_editar"></div>
                    <div class="row row_btn_enviar">
                        <div class="col col_btn_enviar">
                            <div class="btn_enviar">
                                <button id="atualizar_operador" data-dismiss="modal">
                                    Atualizar
                                    <input name="matricula_editar" type="hidden" value="">
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-excluir modal-lista-oper fade" tabindex="-1" role="dialog"
     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">
                    <div class="modal_img">
                        <img src="assets/images/atacadao-a-b.png" alt="">
                    </div>
                    <div class="modal_titulo">
                        Excluir operador!
                    </div>
                </h5>
            </div>
            <div class="modal-body">
                <div class="row row_input_sacola">
                    <div class="col sacola_diretia sacola_direita--b2b2b2">
                        <div class="input_sacola">
                            <div class="descricao">
                                Deseja excluir informações do operador?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row_btn_enviar">
                    <div class="col col_btn_enviar">
                        <div class="btn_enviar">
                            <button id="sim" data-dismiss="modal">
                                SIM
                            </button>
                        </div>
                    </div>
                    <div class="col col_btn_enviar">
                        <div class="btn_enviar">
                            <button data-dismiss="modal">
                                NÃO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-filtro modal-lista-oper fade" tabindex="-1" role="dialog"
     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">
                    <div class="modal_img">
                        <img src="assets/images/atacadao-a-b.png" alt="">
                    </div>
                    <div class="modal_titulo">
                        Filtrar por data
                    </div>
                </h5>
            </div>
            <div class="modal-body">
                <div class="row row_input_sacola">
                    <div class="col-6 sacola_esqueda">
                        <div class="input_sacola">
                            <label for="data_inicio" class="descricao">
                                De
                            </label>
                            <div class="">
                                <input id="data_inicio" autocomplete="off" class="form-control" type="date">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 sacola_direita">
                        <div class="input_sacola">
                            <label for="data_fim" class="descricao">
                                Até
                            </label>
                            <div class="">
                                <input id="data_fim" autocomplete="off" class="form-control" type="date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row_btn_enviar">
                    <div class="col col_btn_enviar">
                        <div class="btn_enviar">
                                <a href="excel.php" id="filtro">SALVAR</a>
                        </div>
                    </div>
                    <div class="col col_btn_enviar">
                        <div class="btn_enviar">
                            <button data-dismiss="modal">
                                CANCELAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
 
if($_SERVER['REQUEST_URI'] === '/sacolas/instalar.php') {
?>
<form id="form_instalar" action="/sacolas/instalar.php" method="post">
<div class="modal modal-aviso modal-lista-oper fade" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-toggle='modal' data-backdrop='static' data-keyboard='false'>
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">
                        <div class="modal_img">
                            <img src="assets/images/atacadao-a-b.png" alt="">
                        </div>
                        <div class="modal_titulo">
                            Aviso!
                        </div>
                    </h5>
                </div>
                <div class="modal-body">    
                    <div class="row row_input_sacola">
                        <div class="col sacola_diretia sacola_direita--b2b2b2">
                            <div class="input_sacola aviso">
                                <div class="descricao">
                                    <p>Siga os próximos passos, <b>observando o manual</b>, 
                                    para que não haja dúvidas no procedimento.</p>

                                    <p>Também é importante saber quem terá acesso ao <b>estoque</b>,
                                     pois será solicitado que entre com o usuário AD do(s) mesmo(s) para liberar o acesso.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row_btn_enviar">
                        <div class="col col_btn_enviar">
                            <div class="btn_enviar">
                                <button data-dismiss="modal" data-toggle="modal" data-target=".modal-instalar">Próximo</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-instalar modal-lista-oper fade" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-toggle='modal' data-backdrop='static' data-keyboard='false'>
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">
                        <div class="modal_img">
                            <img src="assets/images/atacadao-a-b.png" alt="">
                        </div>
                        <div class="modal_titulo">
                            Filial
                        </div>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row row_input_sacola">
                        <div class="col-12 sacola_esqueda">
                            <div class="input_sacola instalacao instalacao_margin">
                                <label for="filial_cod" class="descricao">
                                    Filial
                                </label> 
                                <div>
                                    <input id="filial_cod" autocomplete="off" name="filial_cod"
                                        type="text" placeholder="Digite o código da filial" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row_btn_enviar">
                        <div class="col col_btn_enviar">
                            <div class="btn_enviar">
                                <button data-dismiss="modal" data-toggle="modal" data-target=".modal-permissoes">Próximo</button>
                                <div class="seta_voltar" data-dismiss="modal" data-toggle="modal" data-target=".modal-aviso">
                                        <img src="assets/images/_flecha-cima.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-permissoes modal-lista-oper fade" tabindex="-1" role="dialog"
     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-toggle='modal' data-backdrop='static' data-keyboard='false'>
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">
                        <div class="modal_img">
                            <img src="assets/images/atacadao-a-b.png" alt="">
                        </div>
                        <div class="modal_titulo">
                            Lista de permissões
                        </div>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row row_input_sacola">
                        <div class="col-12 sacola_esqueda">
                            <div class="input_sacola instalacao permissao instalacao_margin">
                                <label for="permissao_1" class="descricao">
                                    Estoque 
                                </label>  
                                <div>
                                    <textarea  id="permissao_1" name="permissao_1" placeholder="Ex: usuarioAD01, usuarioAD02, ..." cols="40" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row_btn_enviar ">
                        <div class="col col_btn_enviar"> 
                            <div class="btn_enviar instalacao">
                                <div class="seta_voltar" data-dismiss="modal" data-toggle="modal" data-target=".modal-instalar">
                                    <img src="assets/images/_flecha-cima.png" alt="">
                                </div>
                                <button>
                                    <input id="instalar" type="submit" value="Instalar">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</form>

<?php
 } 
 ?>

<input id="creditos" type="hidden" value="<?= sha1($creditos) ?>">


<script src="assets/js/jquery-350min.js"></script>
<script src="assets/js/bootstrap-441-dist-js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<script src="assets/js/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/js/script.js"></script>
</body>