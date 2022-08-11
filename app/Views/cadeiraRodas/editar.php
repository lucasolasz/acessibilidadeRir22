<div class="col-xl-4 col-md-6 mx-auto p-5">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/CadeiraRodasController">Cadeiras</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $dados['cadeiraRodas']->num_cadeira_rodas ?></li>
        </ol>
    </nav>


    <div class="card">
        <div class="card-body">
            <h2>Editar Cadeira</h2>
            <small>Preencha o formulário abaixo para editar uma nova cadeira</small>

            <form name="editar" method="POST" action="<?= URL . "/CadeiraRodasController/editar/" . $dados['cadeiraRodas']->id_cadeira_rodas ?>">
                <div class=" mb-3 mt-3">
                    <label for="txtCadeiraRodas" class="form-label">Número Cadeira: *</label>
                    <input type="text" class="form-control <?= $dados['cadeira_erro'] ? 'is-invalid' : '' ?>" name="txtCadeiraRodas" id="txtCadeiraRodas" value="<?= $dados['cadeiraRodas']->num_cadeira_rodas ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['cadeira_erro'] ?></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" value="Atualizar" class="btn btn-artcor">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>