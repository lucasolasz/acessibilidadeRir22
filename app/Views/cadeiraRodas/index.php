<div class="container py-5">

    <?= Alertas::mensagem('cadeiraRodas') ?>

    <div class="card">

        <div class="artcor card-header">

            <h5 class="tituloIndex">Cadeira Rodas
                <div style="float: right;">
                    <a href="<?= URL ?>/CadeiraRodasController/cadastrar" class="btn btn-artcor">Nova cadeira</a>
                </div>
            </h5>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Cadeiras</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exibe mensagem caso não tenha nenhum evento
                        if (empty($dados['cadeiraRodas'])) { ?>

                            <tr>
                                <td colspan="2" class="align-middle">Nenhuma cadeira cadastrada</td>
                            </tr>

                        <?php  }


                        foreach ($dados['cadeiraRodas'] as $cadeiraRodas) { ?>

                            <tr>
                                <td><?= $cadeiraRodas->num_cadeira_rodas ?></td>

                                <td><a href="<?= URL . '/CadeiraRodasController/editar/' . $cadeiraRodas->id_cadeira_rodas ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
                                <td>
                                    <form action="<?= URL . '/CadeiraRodasController/deletar/' . $cadeiraRodas->id_cadeira_rodas ?>" method="POST">
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