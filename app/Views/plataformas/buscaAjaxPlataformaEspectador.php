<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Espectador</th>
                <th scope="col">Plataforma</th>
                <th scope="col">Marcações</th>
                <th scope="col">Checkin entrada Sunset</th>
                <th scope="col">Limpa Sunset</th>
                <th scope="col">Plataforma</th>
                <th scope="col">Marcações</th>
                <th scope="col">Checkin entrada Mundo</th>
                <th scope="col">Limpa Mundo</th>
                <th scope="col">Editar</th>
                <th scope="col">Apagar tudo</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Exibe mensagem caso não tenha nenhum evento
            if (empty($dados['resultado'])) { ?>

                <tr>
                    <td colspan="11" class="align-middle">Nenhum espectador encontrado</td>
                </tr>

            <?php  }

            foreach ($dados['resultado'] as $resultado) { ?>
                <tr>
                    <td><a href=" <?= URL . '/EspectadorController/editar/' . $resultado->id_espectador ?>"><?= ucfirst($resultado->ds_nome_espectador) ?></a></td>
                    <td>Sunset</td>

                    <?php
                    $marcacoesSunset = '';

                    foreach ($dados['fk_espectador_plataforma_sunset'] as $fk_espectador_plataforma_sunset) {

                        if ($fk_espectador_plataforma_sunset->fk_espectador ==  $resultado->id_espectador) {

                            $marcacoesSunset = $marcacoesSunset . ' / ' . $fk_espectador_plataforma_sunset->num_reserva;
                        }
                    }

                    $marcacoesSunsetLimpo = substr($marcacoesSunset, 3);

                    ?>
                    <td><?= $marcacoesSunsetLimpo ?></td>
                    <td class="text-center">
                        <?php if ($resultado->chk_entrada_sunset == 'S') { ?>
                            <a href="<?= URL . '/PlataformasController/checkOutEspectadorSunset/' . $resultado->id_espectador ?>" class="btn btn-success"><i class="bi bi-check-square"></i></a>
                        <?php } else { ?>
                            <a href="<?= URL . '/PlataformasController/checkInEspectadorSunset/' . $resultado->id_espectador ?>" class="btn btn-outline-success"><i class="bi bi-check-square"></i></a>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <a href="<?= URL . '/PlataformasController/limparMarcacoesSunset/' . $resultado->id_espectador ?>" class="btn btn-outline-danger"><i class="bi bi-x-circle"></i></a>
                    </td>

                    <td>Mundo</td>

                    <?php
                    $marcacoesMundo = '';

                    foreach ($dados['fk_espectador_plataforma_mundo'] as $fk_espectador_plataforma_mundo) {

                        if ($fk_espectador_plataforma_mundo->fk_espectador ==  $resultado->id_espectador) {

                            $marcacoesMundo = $marcacoesMundo . ' / ' . $fk_espectador_plataforma_mundo->num_reserva;
                        }
                    }

                    $marcacoesMundoLimpo = substr($marcacoesMundo, 3);

                    ?>
                    <td><?= $marcacoesMundoLimpo ?></td>
                    <td class="text-center">
                        <?php if ($resultado->chk_entrada_mundo == 'S') { ?>
                            <a href="<?= URL . '/PlataformasController/checkOutEspectadorMundo/' . $resultado->id_espectador ?>" class="btn btn-success"><i class="bi bi-check-square"></i></a>
                        <?php } else { ?>
                            <a href="<?= URL . '/PlataformasController/checkInEspectadorMundo/' . $resultado->id_espectador ?>" class="btn btn-outline-success"><i class="bi bi-check-square"></i></a>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <a href="<?= URL . '/PlataformasController/limparMarcacoesMundo/' . $resultado->id_espectador ?>" class="btn btn-outline-danger"><i class="bi bi-x-circle"></i></a>
                    </td>
                    <td><a href="<?= URL . '/PlataformasController/editar/' . $resultado->id_espectador ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
                    <td class="text-center"><a href="<?= URL . '/PlataformasController/deletarGeral/' . $resultado->id_espectador ?>" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a></td>
                </tr>
            <?php  } ?>
        </tbody>
    </table>
</div>