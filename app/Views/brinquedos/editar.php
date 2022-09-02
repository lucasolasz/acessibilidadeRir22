<?php
$brinquedosAgendados = [];
?>

<div class="col-xl-4 col-md-6 mx-auto p-5">

    <?= Alertas::mensagem('horarioErroEditar') ?>


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
                    <label for="txtEspectador" class="col-md-4 col-form-label">Espectador: </label>
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
                                    <select class="form-select <?= $dados['tirolesaErro'] ? 'is-invalid' : '' ?>" name="cboHoraTirolesa" id="cboHoraTirolesa">
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
                                <label for="cboHoraMontanhaRussa" class="col-md-3 col-form-label"><?= $agendamento->ds_brinquedo ?>: </label>
                                <div class="col-md-7">
                                    <select class="form-select <?= $dados['montanhaErro'] ? 'is-invalid' : '' ?>" name="cboHoraMontanhaRussa" id="cboHoraMontanhaRussa">
                                        <optgroup label="Horário Selecionado">
                                            <option value="<?= $agendamento->id_hora_montanha ?>"><?= $agendamento->range_montanha ?></option>
                                        </optgroup>
                                        <optgroup label="Disponíveis">
                                            <?php foreach ($dados['horaMontanhaRussa'] as $horaMontanhaRussa) { ?>

                                                <option value="<?= $horaMontanhaRussa->id_hora ?>"><?= $horaMontanhaRussa->range_hora ?></option>

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
                                <label for="cboQuinzeMinMegaDrop" class="col-md-3 col-form-label"><?= $agendamento->ds_brinquedo ?>: </label>
                                <div class="col-md-7">
                                    <select class="form-select <?= $dados['megaDropErro'] ? 'is-invalid' : '' ?>" name="cboQuinzeMinMegaDrop" id="cboQuinzeMinMegaDrop">
                                        <optgroup label="Horário Selecionado">
                                            <option value="<?= $agendamento->id_quinze_mega_drop ?>"><?= $agendamento->range_mega_drop ?></option>
                                        </optgroup>
                                        <optgroup label="Disponíveis">
                                            <?php foreach ($dados['quinzeMinMegaDrop'] as $quinzeMinMegaDrop) { ?>

                                                <option value="<?= $quinzeMinMegaDrop->id_quinze_min ?>"><?= $quinzeMinMegaDrop->range_quinze_min ?></option>

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
                                    <select class="form-select <?= $dados['rodaGiganteErro'] ? 'is-invalid' : '' ?>" name="cboHoraRodaGigante" id="cboHoraRodaGigante">
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

                        <?php    } elseif ($agendamento->id_brinquedo == 5) {

                            $brinquedosAgendados[] = 5;

                        ?>

                            <div class="mb-3 row">
                                <label for="cboQuinzeCarrosel" class="col-md-3 col-form-label"><?= $agendamento->ds_brinquedo ?>: </label>
                                <div class="col-md-7">
                                    <select class="form-select <?= $dados['carroselErro'] ? 'is-invalid' : '' ?>" name="cboQuinzeCarrosel" id="cboQuinzeCarrosel">
                                        <optgroup label="Horário Selecionado">
                                            <option value="<?= $agendamento->id_quinze_carrosel ?>"><?= $agendamento->range_carrosel ?></option>
                                        </optgroup>
                                        <optgroup label="Disponíveis">
                                            <?php foreach ($dados['quinzeMinCarrosel'] as $quinzeMinCarrosel) { ?>

                                                <option value="<?= $quinzeMinCarrosel->id_quinze_min ?>"><?= $quinzeMinCarrosel->range_quinze_min ?></option>

                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?= URL . '/BrinquedosController/apagarAgendamento/' . $agendamento->id_brinquedo . '&id_espectador=' . $dados['agendamento'][0]->id_espectador ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>



                        <?php    } elseif ($agendamento->id_brinquedo == 6) {

                            $brinquedosAgendados[] = 6;

                        ?>

                            <div class="mb-3 row">
                                <label for="cboQuinzeDiscovery" class="col-md-3 col-form-label"><?= $agendamento->ds_brinquedo ?>: </label>
                                <div class="col-md-7">
                                    <select class="form-select <?= $dados['discoveryErro'] ? 'is-invalid' : '' ?>" name="cboQuinzeDiscovery" id="cboQuinzeDiscovery">
                                        <optgroup label="Horário Selecionado">
                                            <option value="<?= $agendamento->id_quinze_discovery ?>"><?= $agendamento->range_discovery ?></option>
                                        </optgroup>
                                        <optgroup label="Disponíveis">
                                            <?php foreach ($dados['quinzeMinDiscovery'] as $quinzeMinDiscovery) { ?>

                                                <option value="<?= $quinzeMinDiscovery->id_quinze_min ?>"><?= $quinzeMinDiscovery->range_quinze_min ?></option>

                                            <?php } ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?= URL . '/BrinquedosController/apagarAgendamento/' . $agendamento->id_brinquedo . '&id_espectador=' . $dados['agendamento'][0]->id_espectador ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>


                        <?php    }  ?>
                    <?php } ?>
                </div>

                <div class="mb-3">

                    <?php if (count($brinquedosAgendados) != 6) { ?>
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
                        <label for="cboHoraTirolesaNA" class="form-label">Horário tirolesa:</label>
                        <select class="form-select" name="cboHoraTirolesaNA" id="cboHoraTirolesaNA">
                            <option value=""></option>
                            <?php foreach ($dados['horaTirolesa'] as $horaTirolesa) { ?>

                                <option value="<?= $horaTirolesa->id_hora ?>"><?= $horaTirolesa->range_hora ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divHoraMontanhaRussa">
                    <div class="mb-3 mt-3">
                        <label for="cboHoraMontanhaRussaNA" class="form-label">Horário montanha russa:</label>
                        <select class="form-select" name="cboHoraMontanhaRussaNA" id="cboHoraMontanhaRussaNA">
                            <option value=""></option>
                            <?php foreach ($dados['horaMontanhaRussa'] as $horaMontanhaRussa) { ?>

                                <option value="<?= $horaMontanhaRussa->id_hora ?>"><?= $horaMontanhaRussa->range_hora ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divQuinzeMegaDrop">
                    <div class="mb-3 mt-3">
                        <label for="cboQuinzeMinMegaDropNA" class="form-label">Horário Mega drop:</label>
                        <select class="form-select" name="cboQuinzeMinMegaDropNA" id="cboQuinzeMinMegaDropNA">
                            <option value=""></option>
                            <?php foreach ($dados['quinzeMinMegaDrop'] as $quinzeMinMegaDrop) { ?>

                                <option value="<?= $quinzeMinMegaDrop->id_quinze_min ?>"><?= $quinzeMinMegaDrop->range_quinze_min ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divHoraRodaGigante">
                    <div class="mb-3 mt-3">
                        <label for="cboHoraRodaGiganteNA" class="form-label">Horário roda gigante:</label>
                        <select class="form-select" name="cboHoraRodaGiganteNA" id="cboHoraRodaGiganteNA">
                            <option value=""></option>
                            <?php foreach ($dados['horaRodaGigante'] as $horaRodaGigante) { ?>

                                <option value="<?= $horaRodaGigante->id_hora ?>"><?= $horaRodaGigante->range_hora ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divQuinzeCarrosel">
                    <div class="mb-3 mt-3">
                        <label for="cboQuinzeCarroselNA" class="form-label">Horário Carrosel:</label>
                        <select class="form-select" name="cboQuinzeCarroselNA" id="cboQuinzeCarroselNA">
                            <option value=""></option>
                            <?php foreach ($dados['quinzeMinCarrosel'] as $quinzeMinCarrosel) { ?>

                                <option value="<?= $quinzeMinCarrosel->id_quinze_min ?>"><?= $quinzeMinCarrosel->range_quinze_min ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divQuinzeDiscovery">
                    <div class="mb-3 mt-3">
                        <label for="cboQuinzeDiscoveryNA" class="form-label">Horário Discovery:</label>
                        <select class="form-select" name="cboQuinzeDiscoveryNA" id="cboQuinzeDiscoveryNA">
                            <option value=""></option>
                            <?php foreach ($dados['quinzeMinDiscovery'] as $quinzeMinDiscovery) { ?>

                                <option value="<?= $quinzeMinDiscovery->id_quinze_min ?>"><?= $quinzeMinDiscovery->range_quinze_min ?></option>

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
                    <input class="form-control <?= $dados['termoErro'] ? 'is-invalid' : '' ?>" type="file" id="fileTermoResponsabilidade" name="fileTermoResponsabilidade">
                    <div class="invalid-feedback"><?= $dados['termoErro'] ?></div>
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
        $("#divHoraMontanhaRussa").hide();
        $("#divQuinzeMegaDrop").hide();
        $("#divHoraRodaGigante").hide();
        $("#divQuinzeCarrosel").hide();
        $("#divQuinzeDiscovery").hide();

        countChecked();
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

    //Monitora campo brinquedo carrosel
    $("#chkBrinquedo5").click(function() {
        chk_brinquedo = $("#chkBrinquedo5:checked").val();
        disableHorarioCarrosel(chk_brinquedo);
    });

    //Monitora campo brinquedo discovery
    $("#chkBrinquedo6").click(function() {
        chk_brinquedo = $("#chkBrinquedo6:checked").val();
        disableHorarioDiscovery(chk_brinquedo);
    });

    //Chama função após algum clique em checkbox
    $(":checkbox").click(countChecked);

    //Armazena a contagem total dos campos checked no carregamento da página
    total = <?= count($brinquedosAgendados) ?>

    function countChecked() {

        if (total < 2) {
            //Atribui o total de reservas que o espectador possui
            var limiteReservas = 2

            //Iguala o contador dos campos checked com o total do carregamento da página
            //Dando a ideia que "sempre começa em 0", pois independente da quantidade de checkeds ele irá subtrair do total
            adicao = total + $("input:checked").length

            console.log('adicao= ', adicao);
            // console.log('contagem decrescente de vagas= ', contagem)


            if (adicao == limiteReservas) {
                $(':checkbox:not(:checked)').attr('disabled', true);
            } else {
                $(':checkbox:not(:checked)').attr('disabled', false);
            }
        } else {

            $(':checkbox:not(:checked)').attr('disabled', true);
        }

    }
</script>