<?php
$brinquedosAgendados = [];
?>

<div class="col-xl-4 col-md-6 mx-auto p-5">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/BrinquedosController">Agendamento Brinquedos</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $dados['agendamento'][0]->ds_nome_espectador ?></li>
        </ol>
    </nav>


    <div class="card">
        <div class="card-body">
            <h2>Editar Agendamento</h2>
            <small>Preencha o formulário abaixo para editar o agendamento</small>

            <form name="cadastrar" method="POST" action="<?= URL . '/BrinquedosController/editar/' . $dados['agendamento'][0]->id_espectador ?>" enctype="multipart/form-data">


                <div class="mb-3 mt-3 row">
                    <label for="txtEspectador" class="col-md-3 col-form-label">Espectador: </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="txtEspectador" value="<?= ucfirst($dados['agendamento'][0]->ds_nome_espectador) ?>">
                    </div>
                </div>

                <?= Alertas::mensagem('remocaoAgendamento') ?>

                <div class="mb-3 row">
                    <h3>Brinquedos agendados:</h3>
                    <?php
                    foreach ($dados['agendamento'] as $agendamento) {

                        if ($agendamento->id_brinquedo == 1) {

                            $brinquedosAgendados[] = 1;
                    ?>

                            <div class="mb-3 mt-3 row">
                                <label for="cboHoraTirolesa" class="col-md-3 col-form-label"><?= $agendamento->ds_brinquedo ?>: </label>
                                <div class="col-md-7">
                                    <select class="form-select" name="cboHoraTirolesa" id="cboHoraTirolesa">
                                        <optgroup label="Horário Selecionado">
                                            <option value="<?= $agendamento->id_hora_tirolesa ?>"><?= $agendamento->range_tirolesa ?></option>
                                        </optgroup>
                                        <optgroup label="Disponíveis">
                                            <?php foreach ($dados['horaTirolesa'] as $horaTirolesa) { ?>

                                                <option value="<?= $horaTirolesa->id_hora ?>"><?= $horaTirolesa->range_hora ?></option>

                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?= URL . '/BrinquedosController/apagarAgendamento/' . $agendamento->id_brinquedo . '&id_espectador=' . $dados['agendamento'][0]->id_espectador ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>

                        <?php  } elseif ($agendamento->id_brinquedo == 2) {

                            $brinquedosAgendados[] = 2;
                        ?>

                            <div class="mb-3 row">
                                <label for="cboTrintaMinMontanhaRussa" class="col-md-3 col-form-label"><?= $agendamento->ds_brinquedo ?>: </label>
                                <div class="col-md-7">
                                    <select class="form-select" name="cboTrintaMinMontanhaRussa" id="cboTrintaMinMontanhaRussa">
                                        <optgroup label="Horário Selecionado">
                                            <option value="<?= $agendamento->id_trinta_montanha ?>"><?= $agendamento->range_montanha ?></option>
                                        </optgroup>
                                        <optgroup label="Disponíveis">
                                            <?php foreach ($dados['trintaMinMontanhaRussa'] as $trintaMinMontanhaRussa) { ?>

                                                <option value="<?= $trintaMinMontanhaRussa->id_trinta_min ?>"><?= $trintaMinMontanhaRussa->range_trinta_min ?></option>

                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?= URL . '/BrinquedosController/apagarAgendamento/' . $agendamento->id_brinquedo . '&id_espectador=' . $dados['agendamento'][0]->id_espectador ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>

                        <?php  } elseif ($agendamento->id_brinquedo == 3) {

                            $brinquedosAgendados[] = 3;
                        ?>

                            <div class="mb-3 row">
                                <label for="cboQuinzeMinCabum" class="col-md-3 col-form-label"><?= $agendamento->ds_brinquedo ?>: </label>
                                <div class="col-md-7">
                                    <select class="form-select" name="cboQuinzeMinCabum" id="cboQuinzeMinCabum">
                                        <optgroup label="Horário Selecionado">
                                            <option value="<?= $agendamento->id_quinze_cabum ?>"><?= $agendamento->range_cabum ?></option>
                                        </optgroup>
                                        <optgroup label="Disponíveis">
                                            <?php foreach ($dados['quinzeMinCabum'] as $quinzeMinCabum) { ?>

                                                <option value="<?= $quinzeMinCabum->id_quinze_min ?>"><?= $quinzeMinCabum->range_quinze_min ?></option>

                                            <?php } ?>
                                        </optgroup>
                                    </select>

                                </div>
                                <div class="col-md-2">
                                    <a href="<?= URL . '/BrinquedosController/apagarAgendamento/' . $agendamento->id_brinquedo . '&id_espectador=' . $dados['agendamento'][0]->id_espectador ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>

                        <?php  } elseif ($agendamento->id_brinquedo == 4) {

                            $brinquedosAgendados[] = 4;

                        ?>

                            <div class="mb-3 row">
                                <label for="cboHoraRodaGigante" class="col-md-3 col-form-label"><?= $agendamento->ds_brinquedo ?>: </label>
                                <div class="col-md-7">
                                    <select class="form-select" name="cboHoraRodaGigante" id="cboHoraRodaGigante">
                                        <optgroup label="Horário Selecionado">
                                            <option value="<?= $agendamento->id_hora_roda_gigante ?>"><?= $agendamento->range_roda_gigante ?></option>
                                        </optgroup>
                                        <optgroup label="Disponíveis">
                                            <?php foreach ($dados['horaRodaGigante'] as $horaRodaGigante) { ?>

                                                <option value="<?= $horaRodaGigante->id_hora ?>"><?= $horaRodaGigante->range_hora ?></option>

                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?= URL . '/BrinquedosController/apagarAgendamento/' . $agendamento->id_brinquedo . '&id_espectador=' . $dados['agendamento'][0]->id_espectador ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>

                        <?php    } ?>
                    <?php } ?>
                </div>

                <div class="mb-3">

                    <?php if (count($brinquedosAgendados) != 4) { ?>
                        <h3>Brinquedos não agendados:</h3>
                    <?php } ?>

                    <?php foreach ($dados['brinquedos'] as $brinquedos) {

                        if (!in_array($brinquedos->id_brinquedo, $brinquedosAgendados)) {   ?>

                            <div class="form-check">
                                <label class="form-check-label" for="chkBrinquedo">
                                    <?= $brinquedos->ds_brinquedo ?>
                                    <input class="form-check-input" type="checkbox" name="chkBrinquedo[]" id="chkBrinquedo<?= $brinquedos->id_brinquedo ?>" value="<?= $brinquedos->id_brinquedo ?>">
                                </label>
                            </div>

                    <?php }
                    } ?>

                </div>

                <div class="p-0 form-check" id="divHoraTirolesa">
                    <div class="mb-3 mt-3">
                        <label for="cboHoraTirolesaNA" class="form-label">Horário tirolesa: <small>1h em 1h</small></label>
                        <select class="form-select" name="cboHoraTirolesaNA" id="cboHoraTirolesaNA">
                            <option value=""></option>
                            <?php foreach ($dados['horaTirolesa'] as $horaTirolesa) { ?>

                                <option value="<?= $horaTirolesa->id_hora ?>"><?= $horaTirolesa->range_hora ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divTrintaMontanhaRussa">
                    <div class="mb-3 mt-3">
                        <label for="cboTrintaMinMontanhaRussaNA" class="form-label">Horário montanha russa: <small>30min em 30min</small></label>
                        <select class="form-select" name="cboTrintaMinMontanhaRussaNA" id="cboTrintaMinMontanhaRussaNA">
                            <option value=""></option>
                            <?php foreach ($dados['trintaMinMontanhaRussa'] as $trintaMinMontanhaRussa) { ?>

                                <option value="<?= $trintaMinMontanhaRussa->id_trinta_min ?>"><?= $trintaMinMontanhaRussa->range_trinta_min ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divQuinzeCabum">
                    <div class="mb-3 mt-3">
                        <label for="cboQuinzeMinCabumNA" class="form-label">Horário Cabum: <small>15min em 15min</small></label>
                        <select class="form-select" name="cboQuinzeMinCabumNA" id="cboQuinzeMinCabumNA">
                            <option value=""></option>
                            <?php foreach ($dados['quinzeMinCabum'] as $quinzeMinCabum) { ?>

                                <option value="<?= $quinzeMinCabum->id_quinze_min ?>"><?= $quinzeMinCabum->range_quinze_min ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divHoraRodaGigante">
                    <div class="mb-3 mt-3">
                        <label for="cboHoraRodaGiganteNA" class="form-label">Horário roda gigante: <small>1h em 1h</small></label>
                        <select class="form-select" name="cboHoraRodaGiganteNA" id="cboHoraRodaGiganteNA">
                            <option value=""></option>
                            <?php foreach ($dados['horaRodaGigante'] as $horaRodaGigante) { ?>

                                <option value="<?= $horaRodaGigante->id_hora ?>"><?= $horaRodaGigante->range_hora ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <?= Alertas::mensagem('imagemResponsabilidade') ?>

                <?php if (!empty($dados['termoResponsabilidade'])) { ?>
                    <hr>


                    <?php foreach ($dados['termoResponsabilidade'] as $termoResponsabilidade) { ?>
                        <div class="text-center m-3">
                            <p><b>Termo responsabilidade</b></p>
                            <small>Clique na imagem para ampliar</small>
                            <button type="button" class="bordaImagem" data-bs-toggle="modal" data-bs-target="#fullScreenModal"> <img src="<?= URL . DIRECTORY_SEPARATOR . $termoResponsabilidade->nm_path_arquivo . DIRECTORY_SEPARATOR . $termoResponsabilidade->nm_arquivo ?>" class="rounded img-fluid" alt="<?= $termoResponsabilidade->nm_arquivo ?>"></button>

                            <a href="<?= URL . '/BrinquedosController/deletarImagem/' . $dados['agendamento'][0]->id_espectador ?>" class="btn btn-danger mt-1"> Excluir imagem <i class="bi bi-trash-fill"></i></a>
                        </div>
                    <?php } ?>

                    <!-- FullScreen Modal -->
                    <div class="modal fade" id="fullScreenModal" tabindex="-1" aria-labelledby="fullScreenModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fullScreenModal">Termo responsabilidade espectador: <?= ucfirst($dados['agendamento'][0]->ds_nome_espectador) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?= URL . DIRECTORY_SEPARATOR . $termoResponsabilidade->nm_path_arquivo . DIRECTORY_SEPARATOR . $termoResponsabilidade->nm_arquivo ?>" class="rounded img-fluid" alt="<?= $termoResponsabilidade->nm_arquivo ?>">
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

                <div class="mb-3">
                    <label for="fileTermoResponsabilidade" class="form-label">Termo de responsabilidade:</label>
                    <input class="form-control" type="file" id="fileTermoResponsabilidade" name="fileTermoResponsabilidade">
                </div>

                <div class="row">
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

        $("#divHoraTirolesa").hide();
        $("#divTrintaMontanhaRussa").hide();
        $("#divQuinzeCabum").hide();
        $("#divHoraRodaGigante").hide();
    });


    //Monitora campo brinquedo tiroleza
    $("#chkBrinquedo1").click(function() {
        chk_brinquedo = $("#chkBrinquedo1:checked").val();
        disableHorarioTiroleza(chk_brinquedo);
    });

    //Monitora campo brinquedo montanha russa
    $("#chkBrinquedo2").click(function() {
        chk_brinquedo = $("#chkBrinquedo2:checked").val();
        disableHorarioMontanhaRussa(chk_brinquedo);
    });

    //Monitora campo brinquedo cabum
    $("#chkBrinquedo3").click(function() {
        chk_brinquedo = $("#chkBrinquedo3:checked").val();
        disableHorarioCabum(chk_brinquedo);
    });

    //Monitora campo brinquedo roda gigante
    $("#chkBrinquedo4").click(function() {
        chk_brinquedo = $("#chkBrinquedo4:checked").val();
        disableHorarioRodaGigante(chk_brinquedo);
    });
</script>