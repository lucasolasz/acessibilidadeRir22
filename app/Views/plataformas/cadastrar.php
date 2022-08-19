<div class="mx-auto p-5">

    <!-- <pre><?php var_dump($dados['visualizarPlataformaMundo']) ?></pre> -->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/PlataformasController">Plataformas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nova marcação</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Palco mundo</h2>
            <small>Escolha os lugares</small>

            <form name="cadastrar" method="POST" action="<?= URL ?>/PlataformasController/cadastrar">
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-responsive">
                        <tbody>
                            <tr>
                                <td colspan="16"><b>RAMPA DE ACESSO</b></td>
                            </tr>
                            <tr>
                                <td rowspan="73"></td>
                                <td colspan="16"><b>CORREDOR<b></td>
                                <td rowspan="73"></td>
                            </tr>

                            <?php
                            $aux = 0;

                            foreach ($dados['visualizarPlataformaMundo'] as $visualizarPlataformaMundo) {

                                $aux++;

                                if ($visualizarPlataformaMundo->cor_reserva == 'A') { ?>
                                    <td class="table-warning">
                                        <label class="form-check-label" for="chkReservaMundo">
                                            <?= $visualizarPlataformaMundo->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaMundo[]" id="chkReservaMundo<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" value="<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>">
                                        </label>
                                    </td>
                                <?php  } elseif ($visualizarPlataformaMundo->cor_reserva == 'V') { ?>
                                    <td class="table-danger">
                                        <label class="form-check-label" for="chkReservaMundo">
                                            <?= $visualizarPlataformaMundo->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaMundo[]" id="chkReservaMundo<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" value="<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>">
                                        </label>
                                    </td>
                                <?php  } elseif ($visualizarPlataformaMundo->cor_reserva == 'C') { ?>
                                    <td class="table-active">
                                        <label class="form-check-label" for="chkReservaMundo">
                                            <?= $visualizarPlataformaMundo->num_reserva ?>
                                            <input class="form-check-input" type="checkbox" name="chkReservaMundo[]" id="chkReservaMundo<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>" value="<?= $visualizarPlataformaMundo->id_plataforma_mundo ?>">
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
            </form>
        </div>
    </div>
</div>