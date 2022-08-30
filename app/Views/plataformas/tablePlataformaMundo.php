<div class="mx-auto p-2 mb-3 mt-3">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/PlataformasController">Plataformas</a></li>
            <li class="breadcrumb-item"><a href="<?= URL . '/PlataformasController/cadastrar/' . $dados['espectador']->id_espectador ?>">Escolher plataforma</a></li>
            <li class=" breadcrumb-item active" aria-current="page">Nova reserva espectador: <?= $dados['espectador']->ds_nome_espectador ?></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Reserva plataforma palco mundo</h2>
            <hr>
            <form name="cadastrar" method="POST" action="<?= URL ?>/PlataformasController/cadastrarPlataformaMundo">

                <div class="mb-3 mt-3 row">
                    <h5>Espectador</h5>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="txtEspectador" id="txtEspectador" value="<?= ucfirst($dados['espectador']->ds_nome_espectador) ?>">
                        <input type="hidden" name="hidIdExpectador" value="<?= $dados['espectador']->id_espectador ?>">
                    </div>
                </div>
                <hr>

                <h5>Número de reservas disponíveis: </h5><span class="numReservas"><?= $dados['numEspaçosDisponiveis'] ?></span>

                <p class="mt-3"></p><?= Alertas::mensagem('erroMarcacaoMundo') ?>

                <div class="table-responsive mt-3">
                    <table class="table text-center table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <td class="table-dark" colspan="18"><b>PALCO MUNDO</b></td>
                            </tr>
                            <tr>
                                <td colspan="18"><b>RAMPA DE ACESSO</b></td>
                            </tr>
                            <tr>
                                <td rowspan="73" style="writing-mode: vertical-rl; text-align: center; vertical-align:middle"><b>CORREDOR</b></td>
                                <td colspan="16"><b>CORREDOR<b></td>
                                <td rowspan="73" style="writing-mode: vertical-lr; text-align: center; vertical-align:middle"><b>CORREDOR</b></td>
                            </tr>

                            <?php
                            $aux = 0;

                            foreach ($dados['visualizarPlataformaMundo'] as $visualizarPlataformaMundo) {

                                $aux++;

                                $lugarMundoChk = '';

                                foreach ($dados['visualizarMarcacoesPlataMundo'] as $visualizarMarcacoesPlataMundo) {

                                    if ($visualizarPlataformaMundo->id_plataforma_mundo == $visualizarMarcacoesPlataMundo->fk_plataforma_mundo) {
                                        $lugarMundoChk = 'checked disabled';
                                    }
                                }

                                if ($visualizarPlataformaMundo->cor_reserva == 'A') { ?>
                                    <td class="table-warning">
                                        <label class="form-check-label" for="chkReservaMundo">
                                            <?= $visualizarPlataformaMundo->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaMundo[]" id="chkReservaMundo<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" value="<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" <?= $lugarMundoChk ?>>
                                        </label>
                                    </td>
                                <?php  } elseif ($visualizarPlataformaMundo->cor_reserva == 'V') { ?>
                                    <td class="table-danger">
                                        <label class="form-check-label" for="chkReservaMundo">
                                            <?= $visualizarPlataformaMundo->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaMundo[]" id="chkReservaMundo<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" value="<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" <?= $lugarMundoChk ?>>
                                        </label>
                                    </td>
                                <?php  } elseif ($visualizarPlataformaMundo->cor_reserva == 'C') { ?>
                                    <td class="table-active">
                                        <label class="form-check-label" for="chkReservaMundo">
                                            <?= $visualizarPlataformaMundo->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaMundo[]" id="chkReservaMundo<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" value="<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" <?= $lugarMundoChk ?>>
                                        </label>
                                    </td>
                                <?php } else { ?>
                                    <td><?= $visualizarPlataformaMundo->num_reserva ?></td>
                                <?php  } ?>


                                <?php if (($aux % 16) == 0) { ?>
                                    </tr>
                                    <tr>
                                <?php  }
                            }

                                ?>
                                    <tr>
                                        <td colspan="16"><b>CORREDOR</b></td>
                                    </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn btn-artcor">Salvar marcações</button>
            </form>
        </div>
    </div>
</div>

<script>
    //Chama função após algum clique em checkbox
    $(":checkbox").click(countChecked);

    //Armazena a contagem total dos campos checked no carregamento da página
    total = $("input:checked").length

    function countChecked() {

        // console.log('total fixo= ', total);
        // console.log('total checados= ', $("input:checked").length)

        //Atribui o total de reservas que o espectador possui
        var limiteReservas = <?= $dados['numEspaçosDisponiveis'] ?>

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