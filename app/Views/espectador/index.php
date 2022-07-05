<div class="container py-5">

    <?= Alertas::mensagem('espectador') ?>

    <div class="card">

        <div class="artcor card-header">

            <h5>Espectador
                <div style="float: right;">
                    <a href="<?= URL ?>/EspectadorController/cadastrar" class="btn btn-artcor">Novo Espectador</a>
                </div>
            </h5>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exibe mensagem caso não tenha nenhum evento
                        if (empty($dados['espectador'])) { ?>

                            <tr>
                                <td colspan="2" class="align-middle">Nenhum espectador cadastrado</td>
                            </tr>

                        <?php  }


                        foreach ($dados['espectador'] as $espectador) { ?>

                            <tr>
                                <td><?= ucfirst($espectador->ds_nome_espectador) ?></td>

                                <td><a href="<?= URL . '/EspectadorController/editar/' . $editorias->id_editoria ?>" class="btn btn-artcor"><i class="bi bi-pencil-square"></i></a></td>
                                <td>
                                    <form action="<?= URL . '/EspectadorController/deletar/' . $editorias->id_editoria ?>" method="POST">
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