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
                    <input type="text" class="form-control <?= $dados['nome_espectador_erro'] ? 'is-invalid' : '' ?>" name="txtNomeEspectador" id="txtNomeEspectador" value="<?= $dados['txtNomeEspectador'] ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['nome_espectador_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtDocumento" class="form-label">Documento: *</label>
                    <input type="text" class="form-control <?= $dados['documento_erro'] ? 'is-invalid' : '' ?>" name="txtDocumento" id="txtDocumento" value="<?= $dados['txtDocumento'] ?>" maxlength="11">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['documento_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="txtIdade" class="form-label">Idade: *</label>
                    <input type="text" class="form-control <?= $dados['idade_erro'] ? 'is-invalid' : '' ?>" name="txtIdade" id="txtIdade" value="<?= $dados['txtIdade'] ?>" maxlength="2">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['idade_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="txtTelefone" class="form-label">Telefone: *</label>
                    <input type="text" class="form-control <?= $dados['telefone_erro'] ? 'is-invalid' : '' ?>" name="txtTelefone" id="txtTelefone" value="<?= $dados['txtTelefone'] ?>" maxlength="11">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['telefone_erro'] ?></div>
                </div>

                <label for="radioCondicao" class="form-label">Condição: *</label>
                <!-- <div class="form-check">
                    <label class="form-check-label" for="radioCondicao">Nenhum
                        <input class="form-check-input" type="radio" name="radioCondicao" id="" value="0" checked>
                    </label>
                </div> -->
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
                            <input class="form-check-input" type="checkbox" name="chkAcessoServico<?= $acessoServico->id_acesso_servico ?>" id="chkAcessoServico<?= $acessoServico->id_acesso_servico ?>" value="<?= $acessoServico->id_acesso_servico ?>">
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

                <label for="chkTipoDeficiencia" class="form-label mt-3">Tipo Deficiência: *</label>
                <?php foreach ($dados['tipoDeficiencia'] as $tipoDeficiencia) { ?>
                    <div class="form-check">
                        <label class="form-check-label" for="chkTipoDeficiencia">
                            <?= $tipoDeficiencia->ds_tipo_deficiencia ?>
                            <input class="form-check-input tipoDeficiencia" type="checkbox" name="chkTipoDeficiencia<?= $tipoDeficiencia->id_tipo_deficiencia ?>" id="chkTipoDeficiencia<?= $tipoDeficiencia->id_tipo_deficiencia ?>" value="<?= $tipoDeficiencia->id_tipo_deficiencia ?>" disabled>
                        </label>
                    </div>
                <?php } ?>

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
                        <input class="form-check-input chkAcompanhante" type="radio" name="chkAcompanhante" id="chkAcompanhante" value="S" <?= $acompanhanteS ?> disabled>
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkAcompanhante">
                        Não
                        <input class="form-check-input chkAcompanhante" type="radio" name="chkAcompanhante" id="chkAcompanhante" value="N" <?= $acompanhanteN ?> checked disabled>
                    </label>
                </div>
                <br>

                <div class="mb-3 mt-3">
                    <label for="txtNomeAcompanhante" class="form-label">Nome do Acompanhante: *</label>
                    <input type="text" class="form-control <?= $dados['nome_acompanhante_erro'] ? 'is-invalid' : '' ?>" name="txtNomeAcompanhante" id="txtNomeAcompanhante" value="<?php if (isset($dados['txtNomeAcompanhante'])) {$dados['txtNomeAcompanhante'];} ?>" disabled>
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['nome_acompanhante_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtDocumentoAcompanhante" class="form-label">Documento Acompanhante: *</label>
                    <input type="text" class="form-control <?= $dados['documento_acompanhante_erro'] ? 'is-invalid' : '' ?>" name="txtDocumentoAcompanhante" id="txtDocumentoAcompanhante" value="<?php if (isset($dados['txtDocumentoAcompanhante'])) {$dados['txtDocumentoAcompanhante'];} ?>" maxlength="11" disabled>
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['documento_acompanhante_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="txtTelefoneAcompanhante" class="form-label">Telefone Acompanhante: *</label>
                    <input type="text" class="form-control <?= $dados['telefone_acompanhante_erro'] ? 'is-invalid' : '' ?>" name="txtTelefoneAcompanhante" id="txtTelefoneAcompanhante" value=" <?php if (isset($dados['txtTelefoneAcompanhante'])) {$dados['txtTelefoneAcompanhante']; }?>" maxlength="11" disabled>
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['telefone_acompanhante_erro'] ?></div>
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
                    <label class="form-check-label " for="chkAcompanhanteMenor">
                        Sim
                        <input class="form-check-input chkAcompanhanteMenor" type="radio" name="chkAcompanhanteMenor" id="chkAcompanhanteMenor" value="S" <?= $menorS ?> disabled>
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label chkAcompanhanteMenor" for="chkAcompanhanteMenor">
                        Não
                        <input class="form-check-input chkAcompanhanteMenor" type="radio" name="chkAcompanhanteMenor" id="chkAcompanhanteMenor" value="N" <?= $menorN ?> checked disabled>
                    </label>
                </div>
                <br>

                <div class="mb-3 mt-3">
                    <label for="txtQuantidadeMenor" class="form-label">Quantidade de menores:</label>
                    <input type="text" class="form-control <?= $dados['quantidade_menor_erro'] ? 'is-invalid' : '' ?>" name="txtQuantidadeMenor" id="txtQuantidadeMenor" value="<?php if(isset($dados['txtQuantidadeMenor'])){$dados['txtQuantidadeMenor'];}?>" disabled maxlength="2">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['quantidade_menor_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="cboCadeiraDerodas" class="form-label">Cadeira de Rodas Nº:</label>
                    <select class="form-select <?= $dados['cadeira_de_rodas_erro'] ? 'is-invalid' : '' ?>" name="cboCadeiraDerodas" id="cboCadeiraDerodas" disabled>
                        <option value="NULL"></option>
                        <?php foreach ($dados['cadeiraDeRodas'] as $cadeiraDeRodas) { ?>
                            <option value="<?= $cadeiraDeRodas->id_cadeira_rodas ?>"><?= $cadeiraDeRodas->num_cadeira_rodas ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback"><?= $dados['cadeira_de_rodas_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="fileTermoAdesao" class="form-label">Termo de adesão:</label>
                    <input class="form-control" type="file" id="fileTermoAdesao" name="fileTermoAdesao" disabled>
                </div>

                <div class="mb-3">
                    <label for="chkGuardaVolume" class="form-label mt-3">Guarda volumes:</label>
                    <?php foreach ($dados['guardaVolumes'] as $guardaVolumes) { ?>
                        <div class="form-check">
                            <label class="form-check-label" for="chkGuardaVolume">
                                <?= $guardaVolumes->ds_guarda_volume ?>
                                <input class="form-check-input chkGuardaVolume" type="checkbox" name="chkGuardaVolume<?= $guardaVolumes->id_guarda_volume ?>" id="chkGuardaVolume<?= $guardaVolumes->id_guarda_volume ?>" value="<?= $guardaVolumes->id_guarda_volume ?>" disabled>
                            </label>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
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
        condicao = $("input[name=radioCondicao]:checked").val();
        disableTipoDeficienciaEAcompanhante(condicao);
        disableAcompanhante('N');
        disableQuantidadeMenores('N');
        disableCadeiraRodas(0);
        disableGuardaVolumes(0);
    });


    //Monitora campo condição
    $("input[name=radioCondicao]").click(function() {
        id_condicao = $("input[name=radioCondicao]:checked").val();
        disableTipoDeficienciaEAcompanhante(id_condicao);
        // disableAcompanhante(id_condicao);
    });

    //Monitora campo acompanhante
    $("input[name=chkAcompanhante]").click(function() {
        acompanhante = $("input[name=chkAcompanhante]:checked").val();
        disableAcompanhante(acompanhante);
    });

    //Monitora campo radio Acompanhante Menor
    $("input[name=chkAcompanhanteMenor]").click(function() {
        acompanhanteMenor = $("input[name=chkAcompanhanteMenor]:checked").val();
        disableQuantidadeMenores(acompanhanteMenor);
    });

    //Monitora campo chk Serviço Cadeira de rodas
    $("input[name=chkAcessoServico4]").click(function() {
        servicos = $("input[name=chkAcessoServico4]:checked").val();
        disableCadeiraRodas(servicos);
    });

    //Monitora campo chk Serviço Cadeira de rodas
    $("input[name=chkAcessoServico5]").click(function() {
        servicos = $("input[name=chkAcessoServico5]:checked").val();
        disableGuardaVolumes(servicos);
    });
</script>