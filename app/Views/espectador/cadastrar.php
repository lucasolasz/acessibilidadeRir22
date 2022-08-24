<div class="col-xl-4 col-md-6 mx-auto p-5">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/EspectadorController">Espectador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Novo Espectador</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Cadastrar Novo Espectador</h2>
            <small>Preencha o formulário abaixo para cadastrar um novo espectador</small>

            <form name="cadastrar" method="POST" action="<?= URL ?>/EspectadorController/cadastrar" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="txtNomeEspectador" class="form-label">Nome do Espectador: *</label>
                    <input type="text" class="form-control" name="txtNomeEspectador" id="txtNomeEspectador" value="">
                </div>
                <div class="mb-3">
                    <label for="txtDocumento" class="form-label">Documento: *</label>
                    <input type="text" class="form-control" name="txtDocumento" id="txtDocumento" value="" maxlength="11" placeholder="Somente números">
                </div>

                <div class="mb-3">
                    <label for="txtIdade" class="form-label">Idade: *</label>
                    <input type="text" class="form-control" name="txtIdade" id="txtIdade" value="" maxlength="2">
                </div>

                <div class="mb-3">
                    <label for="txtTelefone" class="form-label">Telefone: *</label>
                    <input type="text" class="form-control" name="txtTelefone" id="txtTelefone" value="" maxlength="11" placeholder="Somente números">
                </div>

                <label for="radioCondicao" class="form-label">Condição: *</label>
                <?php foreach ($dados['condicao'] as $condicao) {
                    $condicaoChecked = '';
                    if (isset($dados['radioCondicao'])) {
                        if ($dados['radioCondicao'] == $condicao->id_condicao) {
                            $condicaoChecked = 'checked';
                        }
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
                <?php foreach ($dados['acessoServico'] as $acessoServico) { ?>
                    <div class="form-check">
                        <label class="form-check-label" for="chkAcessoServico">
                            <?= $acessoServico->ds_acesso_servico ?>
                            <input class="form-check-input" type="checkbox" name="chkAcessoServico[]" id="chkAcessoServico<?= $acessoServico->id_acesso_servico ?>" value="<?= $acessoServico->id_acesso_servico ?>">
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

                if ($dados['chkKitLivre'] == 'N') {
                    $kitlivreN = 'checked';
                }
                if ($dados['chkKitLivre'] == 'S') {
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
                        <input class="form-check-input" type="radio" name="chkKitLivre" id="chkKitLivre" value="N" <?= $kitlivreN ?> checked>
                    </label>
                </div>

                <br>

                <div class="p-0 form-check" id="divTipoDeficiencia">
                    <label for="chkTipoDeficiencia" class="form-label mt-3">Tipo Deficiência: *</label>
                    <?php foreach ($dados['tipoDeficiencia'] as $tipoDeficiencia) { ?>
                        <div class="form-check">
                            <label class="form-check-label" for="chkTipoDeficiencia">
                                <?= $tipoDeficiencia->ds_tipo_deficiencia ?>
                                <input class="form-check-input" type="checkbox" name="chkTipoDeficiencia[]" id="chkTipoDeficiencia<?= $tipoDeficiencia->id_tipo_deficiencia ?>" value="<?= $tipoDeficiencia->id_tipo_deficiencia ?>">
                            </label>
                        </div>
                    <?php } ?>
                </div>

                <div class="pl-5 form-check" id="divTipoDeficienciaFisica">
                    <div class="mb-3 mt-3">
                        <label for="cboTipoDeficienciaFisica" class="form-label">Tipo deficiencia física:</label>
                        <select class="form-select" name="cboTipoDeficienciaFisica" id="cboTipoDeficienciaFisica">
                            <option value=""></option>
                            <?php foreach ($dados['tipoDeficienciaFisica'] as $tipoDeficienciaFisica) { ?>

                                <option value="<?= $tipoDeficienciaFisica->id_tipo_deficiencia_fisica ?>"><?= $tipoDeficienciaFisica->ds_tipo_deficiencia_fisica ?></option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label for="txtDeficienciaFisica">Descrição deficiência física:</label>
                        <textarea class="form-control" id="txtDeficienciaFisica" placeholder="Descrição opcional" name="txtDeficienciaFisica"></textarea>
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

                    if (isset($dados['chkAcompanhante'])) {
                        if ($dados['chkAcompanhante'] == 'S') {
                            $acompanhanteS = 'checked';
                        }
                        if ($dados['chkAcompanhante'] == 'N') {
                            $acompanhanteN = 'checked';
                        }
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
                            <input class="form-check-input" type="radio" name="chkAcompanhante" id="chkAcompanhante" value="N" <?= $acompanhanteN ?> checked>
                        </label>
                    </div>
                    <br>
                </div>

                <div class="p-0 form-check" id="divAcompanhanteItens">
                    <div class="mb-3 mt-3">
                        <label for="txtNomeAcompanhante" class="form-label">Nome do Acompanhante: *</label>
                        <input type="text" class="form-control" name="txtNomeAcompanhante" id="txtNomeAcompanhante" value="">
                    </div>
                    <div class="mb-3">
                        <label for="txtDocumentoAcompanhante" class="form-label">Documento Acompanhante: *</label>
                        <input type="text" class="form-control" name="txtDocumentoAcompanhante" id="txtDocumentoAcompanhante" value="" maxlength="11" placeholder="Somente números">
                    </div>

                    <div class="mb-3">
                        <label for="txtTelefoneAcompanhante" class="form-label">Telefone Acompanhante: *</label>
                        <input type="text" class="form-control" name="txtTelefoneAcompanhante" id="txtTelefoneAcompanhante" value="" maxlength="11" placeholder="Somente números">

                    </div>

                    <label class="form-check-label mt-3 mb-2" for="chkAcompanhanteMenor">
                        Acompanhante menor de 18 anos?
                    </label>
                    <br>
                    <?php
                    $menorS = '';
                    $menorN = '';

                    if (isset($dados['chkAcompanhanteMenor'])) {
                        if ($dados['chkAcompanhanteMenor'] == 'S') {
                            $menorS = 'checked';
                        }
                        if ($dados['chkAcompanhanteMenor'] == 'N') {
                            $menorN = 'checked';
                        }
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
                            <input class="form-check-input" type="radio" name="chkAcompanhanteMenor" id="chkAcompanhanteMenor" value="N" <?= $menorN ?> checked>
                        </label>
                    </div>
                    <br>
                </div>

                <div class="p-0 form-check" id="divQtmenores">
                    <div class="mb-3 mt-3">
                        <label for="cboQuantidadeMenor" class="form-label">Quantidade menores:</label>
                        <select class="form-select" name="cboQuantidadeMenor">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divCadeiraRodas">
                    <div class="mb-3 mt-3">
                        <label for="cboCadeiraDerodas" class="form-label">Cadeira de Rodas Nº:</label>
                        <select class="form-select" name="cboCadeiraDerodas" id="cboCadeiraDerodas">
                            <option value=""></option>
                            <?php foreach ($dados['cadeiraDeRodasUsadas'] as $cadeiraDeRodasUsadas) { ?>

                                <option value="<?= $cadeiraDeRodasUsadas->id_cadeira_rodas ?>"><?= $cadeiraDeRodasUsadas->num_cadeira_rodas ?></option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fileTermoAdesao" class="form-label">Termo de adesão:</label>
                        <input class="form-control" type="file" id="fileTermoAdesao" name="fileTermoAdesao">
                    </div>
                </div>

                <div class="p-0 form-check" id="divGuardaVolumes">
                    <div class="mb-3">
                        <label for="chkGuardaVolume" class="form-label mt-3">Guarda volumes:</label>
                        <?php foreach ($dados['guardaVolumes'] as $guardaVolumes) { ?>
                            <div class="form-check">
                                <label class="form-check-label" for="chkGuardaVolume">
                                    <?= $guardaVolumes->ds_guarda_volume ?>
                                    <input class="form-check-input" type="checkbox" name="chkGuardaVolume[]" id="chkGuardaVolume<?= $guardaVolumes->id_guarda_volume ?>" value="<?= $guardaVolumes->id_guarda_volume ?>">
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <input type="submit" value="Cadastrar" class="btn btn-artcor">
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
        $("#divCadeiraRodas").hide();
        $("#divGuardaVolumes").hide();

        $("#txtDocumento").keyup(function() {
            $("#txtDocumento").val(this.value.match(/[0-9]*/));
        });

        $("#txtTelefone").keyup(function() {
            $("#txtTelefone").val(this.value.match(/[0-9]*/));
        });

        $("#txtTelefoneAcompanhante").keyup(function() {
            $("#txtTelefoneAcompanhante").val(this.value.match(/[0-9]*/));
        });

        $("#txtDocumentoAcompanhante").keyup(function() {
            $("#txtDocumentoAcompanhante").val(this.value.match(/[0-9]*/));
        });

        $("#txtIdade").keyup(function() {
            $("#txtIdade").val(this.value.match(/[0-9]*/));
        });    


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