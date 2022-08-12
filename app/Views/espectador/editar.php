<?php

$fk_condicao = $dados['espectador']->fk_condicao;


$guarda_volumes = false;
$cadeira_rodas = false;

foreach ($dados['relacAcessoServico'] as $relacAcessoServico) {

    if ($relacAcessoServico->fk_acesso_servico == 5) {
        $guarda_volumes = true;
    }

    if ($relacAcessoServico->fk_acesso_servico == 4) {
        $cadeira_rodas = true;
    }
}

$deficienciaFisica = false;

foreach ($dados['relacTipoDeficiencia'] as $relacTipoDeficiencia) {

    if ($relacTipoDeficiencia->fk_tipo_deficiencia == 1) {
        $deficienciaFisica = true;
    }
}



?>

<div class="col-xl-4 col-md-6 mx-auto p-5">
    <!-- <pre><?php var_dump($dados['fotoAdesao']); ?></pre> -->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/EspectadorController">Espectador</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $dados['espectador']->ds_nome_espectador ?></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Editar Espectador</h2>
            <small>Preencha o formulário abaixo para editar o espectador</small>

            <form name="editar" method="POST" action="<?= URL . '/EspectadorController/editar/' . $dados['espectador']->id_espectador ?>" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="txtNomeEspectador" class="form-label">Nome do Espectador: *</label>
                    <input type="text" class="form-control" name="txtNomeEspectador" id="txtNomeEspectador" value="<?= $dados['espectador']->ds_nome_espectador ?>">
                </div>
                <div class="mb-3">
                    <label for="txtDocumento" class="form-label">Documento: *</label>
                    <input type="text" class="form-control" name="txtDocumento" id="txtDocumento" value="<?= $dados['espectador']->ds_documento_espectador ?>" maxlength="11" placeholder="Somente números">
                </div>

                <div class="mb-3">
                    <label for="txtIdade" class="form-label">Idade: *</label>
                    <input type="text" class="form-control" name="txtIdade" id="txtIdade" value="<?= $dados['espectador']->idade_espectador ?>" maxlength="2">
                </div>

                <div class="mb-3">
                    <label for="txtTelefone" class="form-label">Telefone: *</label>
                    <input type="text" class="form-control" name="txtTelefone" id="txtTelefone" value="<?= $dados['espectador']->tel_espectador ?>" maxlength="11" placeholder="Somente números">
                </div>

                <label for="radioCondicao" class="form-label">Condição: *</label>
                <?php foreach ($dados['condicao'] as $condicao) {
                    $condicaoChecked = '';

                    if ($dados['espectador']->fk_condicao == $condicao->id_condicao) {
                        $condicaoChecked = 'checked';
                    }

                ?>
                    <div class="form-check">
                        <label class="form-check-label" for="radioCondicao">
                            <?= $condicao->ds_condicao ?>
                            <input class="form-check-input" type="radio" name="radioCondicao" id="radioCondicao<?= $condicao->id_condicao ?>" value="<?= $condicao->id_condicao ?>" <?= $condicaoChecked ?>>
                        </label>
                    </div>
                <?php } ?>

                <label for="chkAcessoServico" class="form-label mt-3">Acessos / Serviços: *</label>
                <?php foreach ($dados['acessoServico'] as $acessoServico) {

                    $servicoChk = '';

                    foreach ($dados['relacAcessoServico'] as $relacAcessoServico) {

                        if ($relacAcessoServico->fk_acesso_servico == $acessoServico->id_acesso_servico) {
                            $servicoChk = 'checked';
                        }
                    }

                ?>
                    <div class="form-check">
                        <label class="form-check-label" for="chkAcessoServico">
                            <?= $acessoServico->ds_acesso_servico ?>
                            <input class="form-check-input" type="checkbox" name="chkAcessoServico[]" id="chkAcessoServico<?= $acessoServico->id_acesso_servico ?>" value="<?= $acessoServico->id_acesso_servico ?>" <?= $servicoChk ?>>
                        </label>
                    </div>
                <?php } ?>


                <label class="form-check-label mt-3 mb-2" for="chkKitLivre">
                    Interesse no Kit Livre? *
                </label>
                <br>
                <?php
                $kitlivreS = '';
                $kitlivreN = '';

                if ($dados['espectador']->chk_kit_livre == 'N') {
                    $kitlivreN = 'checked';
                }
                if ($dados['espectador']->chk_kit_livre == 'S') {
                    $kitlivreS = 'checked';
                }
                ?>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkKitLivre">
                        Sim
                        <input class="form-check-input" type="radio" name="chkKitLivre" id="chkKitLivre" value="S" <?= $kitlivreS ?>>
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkKitLivre">
                        Não
                        <input class="form-check-input" type="radio" name="chkKitLivre" id="chkKitLivre" value="N" <?= $kitlivreN ?>>
                    </label>
                </div>

                <br>

                <div class="p-0 form-check" id="divTipoDeficiencia">
                    <label for="chkTipoDeficiencia" class="form-label mt-3">Tipo Deficiência: *</label>
                    <?php foreach ($dados['tipoDeficiencia'] as $tipoDeficiencia) {

                        $tipoDeficienciaChk = '';
                        foreach ($dados['relacTipoDeficiencia'] as $relacTipoDeficiencia) {
                            if ($relacTipoDeficiencia->fk_tipo_deficiencia == $tipoDeficiencia->id_tipo_deficiencia) {
                                $tipoDeficienciaChk = 'checked';
                            }
                        }

                    ?>
                        <div class="form-check">
                            <label class="form-check-label" for="chkTipoDeficiencia">
                                <?= $tipoDeficiencia->ds_tipo_deficiencia ?>
                                <input class="form-check-input" type="checkbox" name="chkTipoDeficiencia[]" id="chkTipoDeficiencia<?= $tipoDeficiencia->id_tipo_deficiencia ?>" value="<?= $tipoDeficiencia->id_tipo_deficiencia ?>" <?= $tipoDeficienciaChk ?>>
                            </label>
                        </div>
                    <?php } ?>
                </div>

                <div class="pl-5 form-check" id="divTipoDeficienciaFisica">
                    <div class="mb-3 mt-3">
                        <label for="cboTipoDeficienciaFisica" class="form-label">Tipo deficiencia física:</label>
                        <select class="form-select" name="cboTipoDeficienciaFisica" id="cboTipoDeficienciaFisica">
                            <option value=""></option>
                            <?php foreach ($dados['tipoDeficienciaFisica'] as $tipoDeficienciaFisica) {

                                $tipoDeficienciaFisicaChk = '';

                                if ($tipoDeficienciaFisica->id_tipo_deficiencia_fisica == $dados['espectador']->fk_tipo_deficiencia_fisica) {
                                    $tipoDeficienciaFisicaChk = 'selected';
                                }
                            ?>

                                <option value="<?= $tipoDeficienciaFisica->id_tipo_deficiencia_fisica ?>" <?= $tipoDeficienciaFisicaChk ?>><?= $tipoDeficienciaFisica->ds_tipo_deficiencia_fisica ?></option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="txtDeficienciaFisica">Descrição deficiência física:</label>
                        <textarea class="form-control" id="txtDeficienciaFisica" placeholder="Descrição opcional" name="txtDeficienciaFisica"><?= $dados['espectador']->ds_descricao_deficiencia ?></textarea>
                    </div>

                </div>

                <div class="p-0 form-check" id="divAcompanhante">
                    <label class="form-check-label mt-3 mb-2" for="chkAcompanhante">
                        Acompanhante? *
                    </label>
                    <br>
                    <?php
                    $acompanhanteS = '';
                    $acompanhanteN = '';


                    if ($dados['espectador']->chk_acompanhante == 'S') {
                        $acompanhanteS = 'checked';
                    }
                    if ($dados['espectador']->chk_acompanhante == 'N') {
                        $acompanhanteN = 'checked';
                    }

                    ?>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="chkAcompanhante">
                            Sim
                            <input class="form-check-input" type="radio" name="chkAcompanhante" id="chkAcompanhante" value="S" <?= $acompanhanteS ?>>
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="chkAcompanhante">
                            Não
                            <input class="form-check-input" type="radio" name="chkAcompanhante" id="chkAcompanhante" value="N" <?= $acompanhanteN ?>>
                        </label>
                    </div>
                    <br>
                </div>

                <div class="p-0 form-check" id="divAcompanhanteItens">
                    <div class="mb-3 mt-3">
                        <label for="txtNomeAcompanhante" class="form-label">Nome do Acompanhante: *</label>
                        <input type="text" class="form-control" name="txtNomeAcompanhante" id="txtNomeAcompanhante" value="<?= $dados['espectador']->ds_nome_acompanhante ?>">
                    </div>
                    <div class="mb-3">
                        <label for="txtDocumentoAcompanhante" class="form-label">Documento Acompanhante: *</label>
                        <input type="text" class="form-control" name="txtDocumentoAcompanhante" id="txtDocumentoAcompanhante" value="<?= $dados['espectador']->ds_documento_acompanhante ?>" maxlength="11">
                    </div>

                    <div class="mb-3">
                        <label for="txtTelefoneAcompanhante" class="form-label">Telefone Acompanhante: *</label>
                        <input type="text" class="form-control" name="txtTelefoneAcompanhante" id="txtTelefoneAcompanhante" value="<?= $dados['espectador']->tel_acompanhante ?>" maxlength="11" placeholder="Somente números">

                    </div>

                    <label class="form-check-label mt-3 mb-2" for="chkAcompanhanteMenor">
                        Acompanhante menor de 18 anos?
                    </label>
                    <br>
                    <?php
                    $menorS = '';
                    $menorN = '';

                    if ($dados['espectador']->chk_menor_idade == 'S') {
                        $menorS = 'checked';
                    }
                    if ($dados['espectador']->chk_menor_idade == 'N' or $dados['espectador']->chk_menor_idade == NULL) {
                        $menorN = 'checked';
                    }

                    ?>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="chkAcompanhanteMenor">
                            Sim
                            <input class="form-check-input" type="radio" name="chkAcompanhanteMenor" id="chkAcompanhanteMenor" value="S" <?= $menorS ?>>
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="chkAcompanhanteMenor">
                            Não
                            <input class="form-check-input" type="radio" name="chkAcompanhanteMenor" id="chkAcompanhanteMenor" value="N" <?= $menorN ?>>
                        </label>
                    </div>
                    <br>
                </div>

                <?php

                $quantidadeMenor = $dados['espectador']->qtd_menor_idade;

                // var_dump($quantidadeMenor);
                // exit();

                $qtMenorUmChk = '';
                $qtMenorDoisChk = '';
                $qtMenorTresChk = '';
                $qtMenorQuatroChk = '';
                $qtMenorCincoChk = '';

                if ($quantidadeMenor == 1) {
                    $qtMenorUmChk = 'selected';
                } elseif ($quantidadeMenor == 2) {
                    $qtMenorDoisChk = 'selected';
                } elseif ($quantidadeMenor == 3) {
                    $qtMenorTresChk = 'selected';
                } elseif ($quantidadeMenor == 4) {
                    $qtMenorQuatroChk = 'selected';
                } elseif ($quantidadeMenor == 5) {
                    $qtMenorCincoChk = 'selected';
                }

                ?>

                <div class="p-0 form-check" id="divQtmenores">
                    <div class="mb-3 mt-3">
                        <label for="cboQuantidadeMenor" class="form-label">Quantidade menores:</label>
                        <select class="form-select" name="cboQuantidadeMenor">
                            <option value=""></option>
                            <option value="1" <?= $qtMenorUmChk ?>>1</option>
                            <option value="2" <?= $qtMenorDoisChk ?>>2</option>
                            <option value="3" <?= $qtMenorTresChk ?>>3</option>
                            <option value="4" <?= $qtMenorQuatroChk ?>>4</option>
                            <option value="5" <?= $qtMenorCincoChk ?>>5</option>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divCadeiraRodas">

                    <?php if (!$dados['espectador']->fk_cadeira_rodas == NULL) { ?>

                        <div class="mb-3 mt-3">
                            <label for="numCadeiraSelecionada" class="form-label">Cadeira Selecionada Nº:</label>
                            <span name="numCadeiraSelecionada"><b><?= $dados['espectador']->num_cadeira_rodas ?></b></span>
                        </div>

                    <?php } else { ?>

                        <div class="mb-3 mt-3">
                            <label for="cboCadeiraDerodas" class="form-label">Cadeira de Rodas Nº:</label>
                            <select class="form-select" name="cboCadeiraDerodas" id="cboCadeiraDerodas">
                                <option value=""></option>
                                <?php foreach ($dados['cadeiraDeRodasUsadas'] as $cadeiraDeRodasUsadas) { ?>

                                    <option value="<?= $cadeiraDeRodasUsadas->id_cadeira_rodas ?>"><?= $cadeiraDeRodasUsadas->num_cadeira_rodas ?></option>

                                <?php } ?>
                            </select>
                        </div>

                    <?php } ?>

                    <?= Alertas::mensagem('imagem') ?>

                    <?php if (!empty($dados['fotoAdesao'])) { ?>
                        <hr>


                        <?php foreach ($dados['fotoAdesao'] as $fotoAdesao) { ?>
                            <div class="text-center m-3">
                                <p>Termo adesão</p>
                                <small>Clique na imagem para ampliar</small>
                                <button type="button" class="bordaImagem" data-bs-toggle="modal" data-bs-target="#fullScreenModal"> <img src="<?= URL . DIRECTORY_SEPARATOR . $fotoAdesao->nm_path_arquivo . DIRECTORY_SEPARATOR . $fotoAdesao->nm_arquivo ?>" class="rounded img-fluid" alt="<?= $fotoAdesao->nm_arquivo ?>"></button>

                                <a href="<?= URL . '/EspectadorController/deletarImagem/' . $dados['espectador']->id_espectador ?>" class="btn btn-danger mt-1"> Excluir imagem <i class="bi bi-trash-fill"></i></a>
                            </div>
                        <?php } ?>

                        <!-- FullScreen Modal -->
                        <div class="modal fade" id="fullScreenModal" tabindex="-1" aria-labelledby="fullScreenModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fullScreenModal">Termo adesão espectador: <?= $dados['espectador']->ds_nome_espectador ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="<?= URL . DIRECTORY_SEPARATOR . $fotoAdesao->nm_path_arquivo . DIRECTORY_SEPARATOR . $fotoAdesao->nm_arquivo ?>" class="rounded img-fluid" alt="<?= $fotoAdesao->nm_arquivo ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <small>Para substituir o termo atual, envie outra foto abaixo:</small>
                        <hr>
                    <?php } ?>
                    <div class="mb-3 mt-3">
                        <label for="fileTermoAdesao" class="form-label">Termo de adesão:</label>
                        <input class="form-control" type="file" id="fileTermoAdesao" name="fileTermoAdesao">
                    </div>

                    <?php if (!$dados['espectador']->fk_cadeira_rodas == NULL) { ?>

                        <div class="mb-3 mt-3">
                            <label for="cboCadeiraDerodas" class="form-label">Selecionar outra cadeira:</label>
                            <select class="form-select" name="cboCadeiraDerodas" id="cboCadeiraDerodas">
                                <option value=""></option>
                                <?php foreach ($dados['cadeiraDeRodasUsadas'] as $cadeiraDeRodasUsadas) { ?>

                                    <option value="<?= $cadeiraDeRodasUsadas->id_cadeira_rodas ?>"><?= $cadeiraDeRodasUsadas->num_cadeira_rodas ?></option>

                                <?php } ?>
                            </select>
                        </div>

                    <?php } ?>
                </div>

                <div class="p-0 form-check" id="divGuardaVolumes">
                    <div class="mb-3">
                        <label for="chkGuardaVolume" class="form-label mt-3">Guarda volumes:</label>
                        <?php foreach ($dados['guardaVolumes'] as $guardaVolumes) {

                            $guardaVolChk = '';
                            foreach ($dados['relacGuardaVolumes'] as $relacGuardaVolumes) {
                                if ($relacGuardaVolumes->fk_guarda_volumes == $guardaVolumes->id_guarda_volume) {
                                    $guardaVolChk = 'checked';
                                }
                            }
                        ?>
                            <div class="form-check">
                                <label class="form-check-label" for="chkGuardaVolume">
                                    <?= $guardaVolumes->ds_guarda_volume ?>
                                    <input class="form-check-input" type="checkbox" name="chkGuardaVolume[]" id="chkGuardaVolume<?= $guardaVolumes->id_guarda_volume ?>" value="<?= $guardaVolumes->id_guarda_volume ?>" <?= $guardaVolChk ?>>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <input type="submit" value="Atualizar" class="btn btn-artcor">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#divTipoDeficiencia").hide();
        $("#divTipoDeficienciaFisica").hide();
        $("#divAcompanhante").hide();
        $("#divAcompanhanteItens").hide();
        $("#divQtmenores").hide();


        <?php if ($fk_condicao == '1') { ?>
            $("#divTipoDeficiencia").show();
            <?php if ($deficienciaFisica) { ?>
                $("#divTipoDeficienciaFisica").show();
            <?php } ?>
            $("#divAcompanhante").show();
            <?php if ($dados['espectador']->chk_acompanhante == 'S') { ?>
                $("#divAcompanhanteItens").show();
                <?php if ($dados['espectador']->chk_menor_idade == 'S') { ?>
                    $("#divQtmenores").show();
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php if ($fk_condicao == '2') { ?>
            $("#divAcompanhante").show();
            <?php if ($dados['espectador']->chk_acompanhante == 'S') { ?>
                $("#divAcompanhanteItens").show();
                <?php if ($dados['espectador']->chk_menor_idade == 'S') { ?>
                    $("#divQtmenores").show();
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php if (!$cadeira_rodas) { ?>
            $("#divCadeiraRodas").hide();
        <?php } ?>

        <?php if (!$guarda_volumes) { ?>
            $("#divGuardaVolumes").hide();
        <?php } ?>

    });

    //Monitora campo condição
    $("input[name=radioCondicao]").click(function() {
        id_condicao = $("input[name=radioCondicao]:checked").val();
        disableTipoDeficiencia(id_condicao);
        disableAcompanhante(id_condicao);
    });

    //Monitora campo condição para marcação automática de acessos / serviços
    $("input[name=radioCondicao]").click(function() {
        id_condicao = $("input[name=radioCondicao]:checked").val();
        chkAcessoServico(id_condicao);
    });

    //Monitora campo acompanhante
    $("input[name=chkAcompanhante]").click(function() {
        chk_acompanhante = $("input[name=chkAcompanhante]:checked").val();
        disableAcompanhanteItens(chk_acompanhante);
    });

    //Monitora campo acompanhante menor
    $("input[name=chkAcompanhanteMenor]").click(function() {
        chk_acompanhante_menor = $("input[name=chkAcompanhanteMenor]:checked").val();
        disableQuantidadeMenores(chk_acompanhante_menor);
    });

    //Monitora campo chk Serviço Cadeira de rodas
    $("#chkAcessoServico4").click(function() {
        chk_servicos = $("#chkAcessoServico4:checked").val();
        disableCadeiraRodas(chk_servicos);
    });

    //Monitora campo chk serviço guarda volumes
    $("#chkAcessoServico5").click(function() {
        chk_servicos = $("#chkAcessoServico5:checked").val();
        disableGuardaVolumes(chk_servicos);
    });

    //Monitora campo chk tipo deficiencia
    $("#chkTipoDeficiencia1").click(function() {
        chk_tipo_deficiencia = $("#chkTipoDeficiencia1:checked").val();
        disableTipoDeficienciaFisica(chk_tipo_deficiencia);
    });
</script>