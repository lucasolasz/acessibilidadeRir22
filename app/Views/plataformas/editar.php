<div class="mx-auto p-5">

    <?= Alertas::mensagem('plataformaEditar') ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/PlataformasController">Plataformas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar plataformas espectador: <?= ucfirst($dados['espectador']->ds_nome_espectador) ?></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Visualizar plataformas</h2>
            <hr>
            <form name="editar" method="POST" action="<?= URL ?>/PlataformasController/editar">

                <div class="mb-3 mt-3 row">
                    <h5>Espectador</h5>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="txtEspectador" id="txtEspectador" value="<?= ucfirst($dados['espectador']->ds_nome_espectador) ?>">
                        <input type="hidden" name="hidIdExpectador" value="<?= $dados['espectador']->id_espectador ?>">
                    </div>
                </div>

                <?php
                $marcacoesSunset = '';

                foreach ($dados['visualizarMarcacoesPlataSunset'] as $visualizarMarcacoesPlataSunset) {

                    if ($visualizarMarcacoesPlataSunset->fk_espectador ==  $dados['espectador']->id_espectador) {

                        $marcacoesSunset = $marcacoesSunset . ' / ' . $visualizarMarcacoesPlataSunset->num_reserva;
                    }
                }

                $marcacoesSunsetLimpo = substr($marcacoesSunset, 3);

                ?>

                <div class="mb-3 mt-3 row">
                    <h6>Número de reservas disponíveis plataforma SUNSET: </h6>
                    <span class="numReservas">Total restante: <?= $dados['contagemMarcacoesSunset'] ?></span>
                    <span>Marcações feitas: <?= $marcacoesSunsetLimpo ?></span>
                </div>

                <?php
                $marcacoesMundo = '';

                foreach ($dados['visualizarMarcacoesPlataMundo'] as $visualizarMarcacoesPlataMundo) {

                    if ($visualizarMarcacoesPlataMundo->fk_espectador ==  $dados['espectador']->id_espectador) {

                        $marcacoesMundo = $marcacoesMundo . ' / ' . $visualizarMarcacoesPlataMundo->num_reserva;
                    }
                }

                $marcacoesMundoLimpo = substr($marcacoesMundo, 3);

                ?>

                <div class="mb-3 mt-3 row">
                    <h6>Número de reservas disponíveis plataforma MUNDO: </h6>
                    <span class="numReservas">Total restante: <?= $dados['contagemMarcacoesMundo'] ?></span>
                    <span>Marcações feitas: <?= $marcacoesMundoLimpo ?></span>
                </div>

                <h5 class="mb-3">Escolha a plataforma para visualizar as marcações: </h5>

                <a href="<?= URL . '/PlataformasController/editar/' . $dados['espectador']->id_espectador . '&plataforma=S' ?>" class="btn btn-danger">Plataforma Palco Sunset <i class="fa-solid fa-sun"></i></a>

                <a href="<?= URL . '/PlataformasController/editar/' . $dados['espectador']->id_espectador . '&plataforma=M' ?>" class="btn btn-danger">Plataforma Palco mundo <i class="fa-solid fa-earth-americas"></i></a>
            </form>
        </div>
    </div>
</div>