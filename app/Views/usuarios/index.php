<div class="container py-5">

    <?= Alertas::mensagem('usuario') ?>

    <div class="card">

        <div class="artcor card-header">

            <h5 class="tituloIndex">Usuários
                <div style="float: right;">
                    <a href="<?= URL ?>/UsuariosController/cadastrar" class="btn btn-artcor">Novo Usuário</a>
                </div>
            </h5>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome Convidado</th>
                            <th scope="col">E-mail</th>  
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exibe mensagem caso não tenha nenhum evento
                        if (empty($dados['usuarios'])) { ?>

                            <tr>
                                <td colspan="3" class="align-middle">Nenhum Usuário cadastrado</td>
                            </tr>


                        <?php  }


                        foreach ($dados['usuarios'] as $usuarios) { ?>

                            <tr>
                                <td><?= ucfirst($usuarios->ds_nome_usuario) ?></td>
                                <td><?= $usuarios->ds_email_usuario ?></td>                                

                            <td><a href="<?= URL . '/UsuariosController/editar/' . $usuarios->id_usuario ?>" class="btn btn-artcor"><i class="bi bi-pencil-square"></i></a></td>
                            <td>
                                <form action="<?= URL . '/UsuariosController/deletar/' . $usuarios->id_usuario ?>" method="POST">
                                    <button type="submit" class="btn btn-danger"><span><i class="bi bi-trash-fill"></i></span></button>
                                </form>
                            </td>

                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>