<div class="mx-auto p-2">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/PlataformasController">Plataformas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Escolha da plataforma</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            
            <form name="escolhaPlataforma" method="POST" action="<?= URL ?>/PlataformasController/escolhaPlataforma">

                <div class="mb-3 mt-3 row">
                    <h5>Espectador</h5>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" name="txtEspectador" id="txtEspectador" value="<?= ucfirst($dados['espectador']->ds_nome_espectador) ?>">
                        <input type="hidden" name="hidIdExpectador" value="<?= $dados['espectador']->id_espectador ?>">
                    </div>
                </div>
                <hr>

                <h5>Número de reservas disponíveis: </h5><span class="numReservas"><?= $dados['numEspaçosDisponiveis'] ?></span>

                

                <button type="submit" class="btn btn btn-artcor">Escolher</button>
            </form>
        </div>
    </div>
</div>
