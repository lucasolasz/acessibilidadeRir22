<div class="mx-auto p-2 mb-3 mt-3">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/PlataformasController">Plataformas</a></li>
            <li class="breadcrumb-item"><a href="<?= URL . '/PlataformasController/editar/' . $dados['espectador']->id_espectador ?>">Visualizar plataformas espectador: <?= $dados['espectador']->ds_nome_espectador ?></a></li>
            <li class=" breadcrumb-item active" aria-current="page">Editar reserva espectador: <?= $dados['espectador']->ds_nome_espectador ?></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Reserva plataforma palco sunset</h2>
            <hr>
            <form name="editar" method="POST" action="<?= URL . '/PlataformasController/editarPlataformaSunset/' ?>">

                <div class="mb-3 mt-3 row">
                    <h5>Espectador</h5>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="txtEspectador" id="txtEspectador" value="<?= ucfirst($dados['espectador']->ds_nome_espectador) ?>">
                        <input type="hidden" name="hidIdExpectador" value="<?= $dados['espectador']->id_espectador ?>">
                    </div>
                </div>
                <hr>

                <h5>Número de reservas disponíveis: </h5><span class="numReservas"><?= $dados['contagemMarcacoesSunset'] ?></span>

                <p class="mt-3"></p><?= Alertas::mensagem('erroMarcacaoSunset') ?>

                <div class="table-responsive mt-3">
                    <table class="table text-center table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <td class="table-dark" colspan="17"><b>PALCO SUNSET</b></td>
                            </tr>
                            <tr>
                                <td rowspan="12" style="writing-mode: vertical-rl; text-align: center; vertical-align:middle"><b>CORREDOR</b></td>
                                <td colspan="17"></td>
                                <td rowspan="12" style="writing-mode: vertical-rl; text-align: center; vertical-align:middle"><b>CORREDOR</b></td>
                                <td rowspan="12" style="writing-mode: vertical-rl; text-align: center; vertical-align:middle"><b>RAMPA DE ACESSO</b></td>
                            </tr>

                            <?php
                            $aux = 0;

                            foreach ($dados['visualizarPlataformaSunset'] as $visualizarPlataformaSunset) {

                                $aux++;

                                $lugarSunsetChk = '';

                                foreach ($dados['visualizarMarcacoesPlataSunset'] as $visualizarMarcacoesPlataSunset) {

                                    if ($visualizarPlataformaSunset->id_plataforma_sunset == $visualizarMarcacoesPlataSunset->fk_plataforma_sunset) {

                                        if ($visualizarMarcacoesPlataSunset->fk_espectador == $dados['espectador']->id_espectador) {
                                            $lugarSunsetChk = 'checked';
                                        } else {
                                            $lugarSunsetChk = 'checked disabled';
                                        }
                                    }
                                }

                                if ($visualizarPlataformaSunset->cor_reserva == 'A') { ?>
                                    <td class="table-warning">
                                        <label class="form-check-label" for="chkReservaSunset">
                                            <?= $visualizarPlataformaSunset->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaSunset[]" id="chkReservaSunset<?= $visualizarPlataformaSunset->id_plataforma_sunset ?>" value="<?= $visualizarPlataformaSunset->id_plataforma_sunset ?>" <?= $lugarSunsetChk ?>>
                                        </label>
                                    </td>
                                <?php  } elseif ($visualizarPlataformaSunset->cor_reserva == 'V') { ?>
                                    <td class="table-danger">
                                        <label class="form-check-label" for="chkReservaSunset">
                                            <?= $visualizarPlataformaSunset->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaSunset[]" id="chkReservaSunset<?= $visualizarPlataformaSunset->id_plataforma_sunset ?>" value="<?= $visualizarPlataformaSunset->id_plataforma_sunset ?>" <?= $lugarSunsetChk ?>>
                                        </label>
                                    </td>
                                <?php  } elseif ($visualizarPlataformaSunset->cor_reserva == 'C') { ?>
                                    <td class="table-active">
                                        <label class="form-check-label" for="chkReservaSunset">
                                            <?= $visualizarPlataformaSunset->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaSunset[]" id="chkReservaSunset<?= $visualizarPlataformaSunset->id_plataforma_sunset ?>" value="<?= $visualizarPlataformaSunset->id_plataforma_sunset ?>" <?= $lugarSunsetChk ?>>
                                        </label>
                                    </td>
                                <?php } else { ?>
                                    <td><?= $visualizarPlataformaSunset->num_reserva ?></td>
                                <?php  } ?>


                                <?php if (($aux % 14) == 0) { ?>
                                    </tr>
                                    <tr>
                                <?php  }
                            }

                                ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn btn-artcor">Atualizar marcações</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        countChecked();
    });


    //Chama função após algum clique em checkbox
    $(":checkbox").click(countChecked);

    //Armazena a contagem total dos campos checked no carregamento da página
    total = $("input:checked").length

    function countChecked() {

        // console.log('total fixo= ', total);
        // console.log('total checados= ', $("input:checked").length)

        //Atribui o total de reservas que o espectador possui
        var limiteReservas = <?= $dados['contagemMarcacoesSunset'] ?>

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