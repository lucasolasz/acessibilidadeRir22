<div class="col-xl-4 col-md-6 mx-auto p-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/EditoriasController">Editorias</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $dados['editoria']->ds_editoria ?></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <h2>Editar Editoria</h2>
            <small>Preencha o formulário abaixo para editar a Editoria</small>

            <form name="editar" method="POST" action="<?= URL . '/EditoriasController/editar/' . $dados['editoria']->id_editoria ?>">
                <div class="mb-3 mt-3">
                    <label for="txtEditoria" class="form-label">Nome da Editoria: *</label>
                    <input type="text" class="form-control <?= $dados['editoria_erro'] ? 'is-invalid' : '' ?>" name="txtEditoria" id="txtEditoria" value="<?= $dados['editoria']->ds_editoria ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['editoria_erro'] ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" value="Salvar" class="btn btn-artcor">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>