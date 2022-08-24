<div class="col-xl-6 col-md-6 mx-auto p-5">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/BrinquedosController">Agendamento Brinquedos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Novo Agendamento</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Cadastrar Novo Agendamento</h2>
            <small>Preencha o formulário abaixo para cadastrar um novo evento</small>

            <form name="cadastrar" method="POST" action="<?= URL ?>/BrinquedosController/cadastrar" enctype="multipart/form-data">

                <div class="mb-3 mt-3 row">
                    <label for="txtEspectador" class="col-md-4 col-form-label">Espectador: </label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="txtEspectador" id="txtEspectador" value="<?= ucfirst($dados['espectador']->ds_nome_espectador) ?>">
                        <input type="hidden" name="hidIdExpectador" value="<?= $dados['espectador']->id_espectador ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="chkBrinquedo" class="form-label mt-3">Brinquedos: *</label>
                    <?php foreach ($dados['brinquedos'] as $brinquedos) { ?>
                        <div class="form-check">
                            <label class="form-check-label" for="chkBrinquedo">
                                <?= $brinquedos->ds_brinquedo ?>
                                <input class="form-check-input" type="checkbox" name="chkBrinquedo[]" id="chkBrinquedo<?= $brinquedos->id_brinquedo ?>" value="<?= $brinquedos->id_brinquedo ?>">
                            </label>
                        </div>
                    <?php } ?>
                </div>

                <div class="p-0 form-check" id="divHoraTirolesa">
                    <div class="mb-3 mt-3">
                        <label for="cboHoraTirolesa" class="form-label">Horário tirolesa: <small>1h em 1h</small></label>
                        <select class="form-select" name="cboHoraTirolesa" id="cboHoraTirolesa">
                            <option value=""></option>
                            <?php foreach ($dados['horaTirolesa'] as $horaTirolesa) { ?>

                                <option value="<?= $horaTirolesa->id_hora ?>"><?= $horaTirolesa->range_hora ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divTrintaMontanhaRussa">
                    <div class="mb-3 mt-3">
                        <label for="cboTrintaMinMontanhaRussa" class="form-label">Horário montanha russa: <small>30min em 30min</small></label>
                        <select class="form-select" name="cboTrintaMinMontanhaRussa" id="cboTrintaMinMontanhaRussa">
                            <option value=""></option>
                            <?php foreach ($dados['trintaMinMontanhaRussa'] as $trintaMinMontanhaRussa) { ?>

                                <option value="<?= $trintaMinMontanhaRussa->id_trinta_min ?>"><?= $trintaMinMontanhaRussa->range_trinta_min ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divQuinzeCabum">
                    <div class="mb-3 mt-3">
                        <label for="cboQuinzeMinCabum" class="form-label">Horário Kabum: <small>15min em 15min</small></label>
                        <select class="form-select" name="cboQuinzeMinCabum" id="cboQuinzeMinCabum">
                            <option value=""></option>
                            <?php foreach ($dados['quinzeMinCabum'] as $quinzeMinCabum) { ?>

                                <option value="<?= $quinzeMinCabum->id_quinze_min ?>"><?= $quinzeMinCabum->range_quinze_min ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="p-0 form-check" id="divHoraRodaGigante">
                    <div class="mb-3 mt-3">
                        <label for="cboHoraRodaGigante" class="form-label">Horário roda gigante: <small>1h em 1h</small></label>
                        <select class="form-select" name="cboHoraRodaGigante" id="cboHoraRodaGigante">
                            <option value=""></option>
                            <?php foreach ($dados['horaRodaGigante'] as $horaRodaGigante) { ?>

                                <option value="<?= $horaRodaGigante->id_hora ?>"><?= $horaRodaGigante->range_hora ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="fileTermoResponsabilidade" class="form-label">Termo de responsabilidade:</label>
                    <input class="form-control" type="file" id="fileTermoResponsabilidade" name="fileTermoResponsabilidade">
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
        $("#cboEspectador").selectize({
            sortField: 'text'
        });

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

    //Chama função após algum clique em checkbox
    $(":checkbox").click(countChecked);

    //Armazena a contagem total dos campos checked no carregamento da página
    total = $("input:checked").length

    function countChecked() {

        // console.log('total fixo= ', total);
        // console.log('total checados= ', $("input:checked").length)

        //Atribui o total de reservas que o espectador possui
        var limiteReservas = 2

        //Iguala o contador dos campos checked com o total do carregamento da página
        //Dando a ideia que "sempre começa em 0", pois independente da quantidade de checkeds ele irá subtrair do total
        subtracao = $("input:checked").length - total

        //Contagem decrescente para exibir na tela quantos reservas ainda restam
        contagem = limiteReservas - subtracao


        // console.log('subtracao= ', subtracao);
        // console.log('contagem decrescente de vagas= ', contagem)

        if (contagem == 0) {
            $(".numReservas").html("<i class='fonteVermelha'>Todas as reservas disponíveis foram marcadas</i>")
        } else {
            $(".numReservas").html(contagem)
        }

        if (subtracao == limiteReservas) {
            $(':checkbox:not(:checked)').attr('disabled', true);
        } else {
            $(':checkbox:not(:checked)').attr('disabled', false);
        }
    }

    //Chama função após algum clique em checkbox
    $(":checkbox").click(countChecked);

    //Armazena a contagem total dos campos checked no carregamento da página
    total = $("input:checked").length

    function countChecked() {

        // console.log('total fixo= ', total);
        // console.log('total checados= ', $("input:checked").length)

        //Atribui o total de reservas que o espectador possui
        var limiteReservas = 2

        //Iguala o contador dos campos checked com o total do carregamento da página
        //Dando a ideia que "sempre começa em 0", pois independente da quantidade de checkeds ele irá subtrair do total
        subtracao = $("input:checked").length - total

        //Contagem decrescente para exibir na tela quantos reservas ainda restam
        contagem = limiteReservas - subtracao


        // console.log('subtracao= ', subtracao);
        // console.log('contagem decrescente de vagas= ', contagem)

        if (contagem == 0) {
            $(".numReservas").html("<i class='fonteVermelha'>Todas as reservas disponíveis foram marcadas</i>")
        } else {
            $(".numReservas").html(contagem)
        }

        if (subtracao == limiteReservas) {
            $(':checkbox:not(:checked)').attr('disabled', true);
        } else {
            $(':checkbox:not(:checked)').attr('disabled', false);
        }
    }
</script>