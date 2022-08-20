<div class="mx-auto p-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/PlataformasController">Plataformas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nova reserva</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Escolher plataforma</h2>
            <hr>
            <form name="cadastrar" method="POST" action="<?= URL ?>/PlataformasController/cadastrar">

                <div class="mb-3 mt-3 row">
                    <h5>Espectador</h5>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="txtEspectador" id="txtEspectador" value="<?= ucfirst($dados['espectador']->ds_nome_espectador) ?>">
                        <input type="hidden" name="hidIdExpectador" value="<?= $dados['espectador']->id_espectador ?>">
                    </div>
                </div>

                <div class="mb-3 mt-3 row">
                    <h5>Número de reservas disponíveis: </h5><span class="numReservas"><?= $dados['numEspaçosDisponiveis'] ?></span>
                </div>

                <h5 class="mb-3">Escolha a plataforma: </h5>

                <a href="<?= URL . '/PlataformasController/cadastrar/' . $dados['espectador']->id_espectador . '&plataforma=M' ?>" class="btn btn-danger">Plataforma Palco mundo <i class="fa-solid fa-earth-americas"></i></a>

                <a href="<?= URL . '/PlataformasController/cadastrar/' . $dados['espectador']->id_espectador . '&plataforma=S' ?>" class="btn btn-danger">Plataforma Palco Sunset <i class="fa-solid fa-sun"></i></a>

            </form>
        </div>
    </div>
</div>