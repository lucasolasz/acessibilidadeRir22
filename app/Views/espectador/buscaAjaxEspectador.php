<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Espectador</th>
                <th scope="col">Condição</th>
                <th scope="col">Acessos/Serviços</th>
                <th scope="col">Cadastrado por</th>
                <th scope="col">Data Criação</th>
                <th scope="col">Editar</th>
                <th scope="col" class="text-center">Agendar Brinquedo</th>
                <th scope="col">Apagar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Exibe mensagem caso não tenha nenhum evento
            if (empty($dados['resultado'])) { ?>

                <tr>
                    <td colspan="8" class="align-middle">Nenhum espectador encontrado</td>
                </tr>

            <?php  }


            foreach ($dados['resultado'] as $resultado) { ?>

                <tr>
                    <td><?= ucfirst($resultado->ds_nome_espectador) ?></td>
                    <td><?= ucfirst($resultado->ds_condicao) ?></td>

                    <?php

                    $db = new Database();
                    $db->query("SELECT * FROM tb_relac_acesso_servico tras
                                LEFT JOIN tb_acesso_servico tas ON tas.id_acesso_servico = tras.fk_acesso_servico
                                WHERE fk_espectador = :fk_espectador");
                    $db->bind("fk_espectador", $resultado->id_espectador);
                    $resultados = $db->resultados();

                    $acessosServicos = '';

                    foreach ($resultados as $resultados) {
                        $acessosServicos = $acessosServicos .  ' | ' . $resultados->ds_acesso_servico;
                    }

                    $acessoServicosLimpo = substr($acessosServicos, 3);
                    ?>
                    <td><?= $acessoServicosLimpo ?></td>
                    <td><?= $resultado->ds_nome_usuario ?></td>
                    <td><?= Checa::dataHoraFormatBr($resultado->criado_em) ?></td>


                    <td>
                        <a href="<?= URL . '/EspectadorController/editar/' . $resultado->id_espectador ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    </td>

                    <td class="text-center">

                        <?php
                        $especJaAgendado = false;
                        foreach ($dados['fk_espectador_brinquedo'] as $fk_espectador_brinquedo) {

                            if ($fk_espectador_brinquedo->id_espectador == $resultado->id_espectador) {
                                $especJaAgendado = true;
                            }
                        }

                        if ($especJaAgendado) { ?>

                            <a href="<?= URL . '/BrinquedosController/editar/' . $resultado->id_espectador ?>" class="btn btn-light"><i class="fa-regular fa-calendar"></i> Já agendado. Visualizar</a>

                        <?php } else { ?>
                            <a href="<?= URL . '/BrinquedosController/cadastrar/' . $resultado->id_espectador ?>" class="btn btn-success"><i class="fa-regular fa-calendar"></i> Novo</a>
                        <?php } ?>
                    </td>
                    <td>
                        <form action="<?= URL . '/EspectadorController/deletar/' . $resultado->id_espectador ?>" method="POST">
                            <button type="submit" class="btn btn-danger"><span><i class="bi bi-trash-fill"></i></span></button>
                        </form>
                    </td>
                </tr>

            <?php  } ?>
        </tbody>
    </table>
</div>