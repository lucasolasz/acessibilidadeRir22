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
                            <th scope="col">Espectador</th>
                            <th scope="col">Termo</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exibe mensagem caso não tenha nenhum evento
                        if (empty($dados['cadeiraRodas'])) { ?>

                            <tr>
                                <td colspan="4" class="align-middle">Nenhuma cadeira cadastrada</td>
                            </tr>

                        <?php  }


                        foreach ($dados['cadeiraRodas'] as $cadeiraRodas) { ?>

                            <tr>
                                <td><?= $cadeiraRodas->num_cadeira_rodas ?></td>
                                <td><a href=" <?= URL . '/EspectadorController/editar/' . $cadeiraRodas->id_espectador ?>"><?= ucfirst($cadeiraRodas->ds_nome_espectador) ?></a></td>
                                <td>
                                    <?php if (!$cadeiraRodas->ds_nome_espectador == "") { ?>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#fullScreenModal<?= $cadeiraRodas->id_cadeira_rodas ?>" class="btn btn-success"><i class="bi bi-card-image"></i></a>

                                    <?php } ?>
                                </td>
                                </td>
                                <td><a href="<?= URL . '/CadeiraRodasController/editar/' . $cadeiraRodas->id_cadeira_rodas ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
                                <?php if ($_SESSION['fk_perfil_usuario'] == 1) { ?>
                                    <td>
                                        <form action="<?= URL . '/CadeiraRodasController/deletar/' . $cadeiraRodas->id_cadeira_rodas ?>" method="POST">
                                            <button type="submit" class="btn btn-danger"><span><i class="bi bi-trash-fill"></i></span></button>
                                        </form>
                                    </td>
                                <?php } ?>
                            </tr>

                            <!-- FullScreen Modal -->
                            <div class="modal fade" id="fullScreenModal<?= $cadeiraRodas->id_cadeira_rodas ?>" tabindex="-1" aria-labelledby="fullScreenModal<?= $cadeiraRodas->id_cadeira_rodas ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fullScreenModal">Termo adesão espectador: <?= $cadeiraRodas->ds_nome_espectador ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= URL . DIRECTORY_SEPARATOR . $cadeiraRodas->nm_path_arquivo . DIRECTORY_SEPARATOR . $cadeiraRodas->nm_arquivo ?>" class="rounded img-fluid" alt="<?= $cadeiraRodas->nm_arquivo ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>