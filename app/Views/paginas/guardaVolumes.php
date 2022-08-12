<div class="container py-5">

    <div class="card">

        <div class="artcor card-header">

            <h5 class="tituloIndex">Guarda volumes</h5>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Espectador</th>
                            <th scope="col">Condição</th>
                            <th scope="col">Item(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exibe mensagem caso não tenha nenhum espectador
                        if (empty($dados['espectador'])) { ?>

                            <tr>
                                <td colspan="3" class="align-middle">Nenhum espectador usando guarda volumes</td>
                            </tr>

                        <?php  }

                        foreach ($dados['espectador'] as $espectador) { ?>

                            <tr>
                                <td><a href=" <?= URL . '/EspectadorController/editar/' . $espectador->id_espectador ?>"><?= ucfirst($espectador->ds_nome_espectador) ?></a></td>
                                <td><?= ucfirst($espectador->ds_condicao) ?></td>

                                <?php

                                $db = new Database();
                                $db->query("SELECT * FROM tb_relac_guarda_volumes trgv
                                LEFT JOIN tb_guarda_volume tgv ON tgv.id_guarda_volume = trgv.fk_guarda_volumes
                                WHERE fk_espectador = :fk_espectador");
                                $db->bind("fk_espectador", $espectador->id_espectador);
                                $resultados = $db->resultados();

                                $itemGuardaVolume = '';

                                foreach ($resultados as $resultados) {
                                    $itemGuardaVolume = $itemGuardaVolume .  ' | ' . $resultados->ds_guarda_volume;
                                }

                                $itemGuardaVolumeLimpo = substr($itemGuardaVolume, 3);
                                ?>
                                <td><?= $itemGuardaVolumeLimpo ?></td>
                            </tr>

                        <?php  } ?>



                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>