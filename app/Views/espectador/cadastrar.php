<div class="col-xl-4 col-md-6 mx-auto p-5">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/EspectadorController">Espectador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Novo Espectador</li>
        </ol>
    </nav>


    <div class="card">
        <div class="card-body">
            <h2>Cadastrar Novo Espectador</h2>
            <small>Preencha o formulário abaixo para cadastrar um novo espectador</small>

            <form name="cadastrar" method="POST" action="<?= URL ?>/EspectadorController/cadastrar">
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
                    <label for="txtTelefone" class="form-label">Idade: *</label>
                    <input type="text" class="form-control <?= $dados['idade_erro'] ? 'is-invalid' : '' ?>" name="txtIdade" id="txtIdade" value="<?= $dados['txtIdade'] ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['idade_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="txtTelefone" class="form-label">Telefone: *</label>
                    <input type="text" class="form-control <?= $dados['telefone_erro'] ? 'is-invalid' : '' ?>" name="txtTelefone" id="txtTelefone" value="<?= $dados['txtTelefone'] ?>" pattern="([0-9]{3})" maxlength="11">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['telefone_erro'] ?></div>
                </div>

                <label for="radioCondicao" class="form-label">Condição: *</label>
                <?php foreach ($dados['condicao'] as $condicao) { ?>
                    <div class="form-check">
                        <label class="form-check-label" for="radioCondicao">
                            <?= $condicao->ds_condicao ?>
                            <input class="form-check-input" type="radio" name="radioCondicao" id="radioCondicao<?= $condicao->id_condicao ?>" value="<?= $condicao->id_condicao ?>">
                        </label>
                    </div>
                <?php } ?>

                <label for="chkAcessoServico" class="form-label mt-3">Acessos / Serviços: *</label>
                <?php foreach ($dados['acessoServico'] as $acessoServico) { ?>
                    <div class="form-check">
                        <label class="form-check-label" for="chkAcessoServico">
                            <?= $acessoServico->ds_acesso_servico ?>
                            <input class="form-check-input" type="checkbox" name="chkAcessoServico" id="chkAcessoServico<?= $acessoServico->id_acesso_servico ?>" value="<?= $acessoServico->id_acesso_servico ?>">
                        </label>
                    </div>
                <?php } ?>


                <label class="form-check-label mt-3 mb-2" for="chkKitLivre">
                    Interesse no Kit Livre? *
                </label>
                <br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkKitLivre">
                        Sim
                        <input class="form-check-input" type="radio" name="chkKitLivre" id="chkKitLivre" value="S">
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkKitLivre">
                        Não
                        <input class="form-check-input" type="radio" name="chkKitLivre" id="chkKitLivre" value="N">
                    </label>
                </div>

                <br>

                <label for="chkTipoDeficiencia" class="form-label mt-3">Tipo Deficiência: *</label>
                <?php foreach ($dados['tipoDeficiencia'] as $tipoDeficiencia) { ?>
                    <div class="form-check">
                        <label class="form-check-label" for="chkTipoDeficiencia">
                            <?= $tipoDeficiencia->ds_tipo_deficiencia ?>
                            <input class="form-check-input" type="checkbox" name="chkTipoDeficiencia" id="chkTipoDeficiencia<?= $tipoDeficiencia->id_tipo_deficiencia ?>" value="<?= $tipoDeficiencia->id_tipo_deficiencia ?>">
                        </label>
                    </div>
                <?php } ?>

                <label class="form-check-label mt-3 mb-2" for="chkAcompanhante">
                    Acompanhante? *
                </label>
                <br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkAcompanhante">
                        Sim
                        <input class="form-check-input" type="radio" name="chkAcompanhante" id="chkAcompanhante" value="S">
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkAcompanhante">
                        Não
                        <input class="form-check-input" type="radio" name="chkAcompanhante" id="chkAcompanhante" value="N">
                    </label>
                </div>
                <br>

                <div class="mb-3 mt-3">
                    <label for="txtNomeAcompanhante" class="form-label">Nome do Acompanhante: *</label>
                    <input type="text" class="form-control <?= $dados['nome_acompanhante_erro'] ? 'is-invalid' : '' ?>" name="txtNomeAcompanhante" id="txtNomeAcompanhante" value="<?= $dados['txtNomeAcompanhante'] ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['nome_acompanhante_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtDocumentoAcompanhante" class="form-label">Documento Acompanhante: *</label>
                    <input type="text" class="form-control <?= $dados['documento_acompanhante_erro'] ? 'is-invalid' : '' ?>" name="txtDocumentoAcompanhante" id="txtDocumentoAcompanhante" value="<?= $dados['txtDocumentoAcompanhante'] ?>" maxlength="11">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['documento_acompanhante_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="txtTelefoneAcompanhante" class="form-label">Telefone Acompanhante: *</label>
                    <input type="text" class="form-control <?= $dados['telefone_acompanhante_erro'] ? 'is-invalid' : '' ?>" name="txtTelefoneAcompanhante" id="txtTelefoneAcompanhante" value="<?= $dados['txtTelefoneAcompanhante'] ?>" pattern="([0-9]{3})" maxlength="11">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['telefone_acompanhante_erro'] ?></div>
                </div>

                <label class="form-check-label mt-3 mb-2" for="chkAcompanhanteMenor">
                    Acompanhante menor de 18 anos? *
                </label>
                <br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkAcompanhanteMenor">
                        Sim
                        <input class="form-check-input" type="radio" name="chkAcompanhanteMenor" id="chkAcompanhanteMenor" value="S">
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="chkAcompanhanteMenor">
                        Não
                        <input class="form-check-input" type="radio" name="chkAcompanhanteMenor" id="chkAcompanhanteMenor" value="N">
                    </label>
                </div>
                <br>

                <div class="mb-3 mt-3">
                    <label for="txtQuantidadeMenor" class="form-label">Quantidade de menores: *</label>
                    <input type="text" class="form-control <?= $dados['quantidade_menor_erro'] ? 'is-invalid' : '' ?>" name="txtQuantidadeMenor" id="txtQuantidadeMenor" value="<?= $dados['txtQuantidadeMenor'] ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['quantidade_menor_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="cboCadeiraDerodas" class="form-label">Cadeira de Rodas Nº: *</label>
                    <select class="form-select <?= $dados['cadeira_de_rodas_erro'] ? 'is-invalid' : '' ?>" name="cboCadeiraDerodas" id="cboCadeiraDerodas">
                        <option value="NULL"></option>
                        <?php foreach ($dados['cadeiraDeRodas'] as $cadeiraDeRodas) { ?>
                            <option value="<?= $cadeiraDeRodas->id_cadeira_rodas ?>"><?= $cadeiraDeRodas->num_cadeira_rodas ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback"><?= $dados['cadeira_de_rodas_erro'] ?></div>
                </div>

                <div class="mb-3">
                    <label for="chkGuardaVolume" class="form-label mt-3">Guarda volumes: *</label>
                    <?php foreach ($dados['guardaVolumes'] as $guardaVolumes) { ?>
                        <div class="form-check">
                            <label class="form-check-label" for="chkGuardaVolume">
                                <?= $guardaVolumes->ds_guarda_volume ?>
                                <input class="form-check-input" type="checkbox" name="chkGuardaVolume" id="chkGuardaVolume<?= $guardaVolumes->id_guarda_volume ?>" value="<?= $guardaVolumes->id_guarda_volume ?>">
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