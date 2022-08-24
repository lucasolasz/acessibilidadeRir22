<div class="container py-5">

    <?= Alertas::mensagem('brinquedos') ?>

    <div class="card">

        <div class="artcor card-header">

            <h5 class="tituloIndex">Agendamento Brinquedos
                <div style="float: right;">
                    <a href="<?= URL ?>/EspectadorController" class="btn btn-artcor">Novo Agendamento</a>
                </div>
            </h5>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Espectador</th>
                            <th scope="col">Acompanhante</th>
                            <th scope="col">Deficiência/Condição</th>
                            <th scope="col">Brinquedo(s)</th>
                            <th scope="col">Horário(s)</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exibe mensagem caso não tenha nenhum evento
                        if (empty($dados['agendamentos'])) { ?>

                            <tr>
                                <td colspan="6" class="align-middle">Nenhum agendamento cadastrado</td>
                            </tr>

                        <?php  }

                        foreach ($dados['agendamentos'] as $agendamentos) { ?>
                            <tr>
                                <td><?= ucfirst($agendamentos->ds_nome_espectador) ?></td>
                                <td><?= $agendamentos->ds_nome_acompanhante ?></td>
                                <td><?= $agendamentos->ds_condicao ?></td>
                                <?php

                                $db = new Database();
                                $db->query("SELECT id_brinquedo, ds_brinquedo, th.range_hora AS range_tirolesa, th2.range_hora AS range_roda_gigante, tqm2.range_quinze_min AS range_cabum, ttm.range_trinta_min AS range_montanha from tb_brinquedo tb 
                                JOIN tb_agenda_brinquedo tab ON tab.fk_brinquedo = tb.id_brinquedo
                                LEFT JOIN tb_hora th ON th.id_hora = tab.fk_hora_tirolesa
                                LEFT JOIN tb_hora th2 ON th2.id_hora = tab.fk_hora_roda_gigante
                                LEFT JOIN tb_trinta_min ttm ON ttm.id_trinta_min = tab.fk_trinta_min 
                                LEFT JOIN tb_quinze_min tqm2 ON tqm2.id_quinze_min = tab.fk_quinze_min 
                                WHERE tab.fk_espectador = :fk_espectador");
                                $db->bind("fk_espectador", $agendamentos->id_espectador);
                                $resultados = $db->resultados();

                                $brinquedos = '';
                                $horarios = '';

                                foreach ($resultados as $resultados) {
                                    $brinquedos = $brinquedos .  ' / ' . $resultados->ds_brinquedo;

                                    if ($resultados->id_brinquedo == 1) {

                                        $horarios = $horarios . ' / ' .  $resultados->range_tirolesa;
                                    } elseif ($resultados->id_brinquedo == 2) {

                                        $horarios = $horarios . ' / ' .  $resultados->range_montanha;
                                    } elseif ($resultados->id_brinquedo == 3) {

                                        $horarios = $horarios . ' / ' .  $resultados->range_cabum;
                                    } elseif ($resultados->id_brinquedo == 4) {

                                        $horarios = $horarios . ' / ' .  $resultados->range_roda_gigante;
                                    }
                                }

                                $brinquedosLimpo = substr($brinquedos, 3);
                                $horariosLimpo = substr($horarios, 3);
                                ?>
                                <td><?= $brinquedosLimpo ?></td>
                                <td><?= $horariosLimpo ?></td>
                                <td><a href="<?= URL . '/BrinquedosController/editar/' . $agendamentos->id_espectador ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
                                <td>
                                    <form action="<?= URL . '/BrinquedosController/deletar/' . $agendamentos->id_espectador ?>" method="POST">
                                        <button type="submit" class="btn btn-danger"><span><i class="bi bi-trash-fill"></i></span></button>
                                    </form>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>