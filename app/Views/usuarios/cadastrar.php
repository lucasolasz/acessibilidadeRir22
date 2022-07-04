<div class="col-xl-4 col-md-6 mx-auto p-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/UsuariosController">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastro de Usuário</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <h2>Cadastro de Usuário</h2>
            <small>Preencha o formulário abaixo para cadastrar um novo usuário</small>

            <form name="cadastrar" method="POST" action="<?= URL ?>/UsuariosController/cadastrar">

                <div class="mb-3 mt-3">
                    <label for="txtNome" class="form-label">Nome: *</label>
                    <input type="text" class="form-control <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>" name="txtNome" id="txtNome" value="<?= $dados['txtNome'] ?>">
                    <!-- Div para exibir o erro abaixo do campo -->
                    <div class="invalid-feedback"><?= $dados['nome_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtEmail" class="form-label">E-mail: *</label>
                    <input type="text" class="form-control <?= $dados['email_erro'] ? 'is-invalid' : '' ?>" name="txtEmail" id="txtEmail" value="<?= $dados['txtEmail'] ?>">
                    <div class="invalid-feedback"><?= $dados['email_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtSenha" class="form-label">Senha: *</label>
                    <input type="password" class="form-control <?= $dados['senha_erro'] ? 'is-invalid' : '' ?>" name="txtSenha" id="txtSenha" value="<?= $dados['txtSenha'] ?>">
                    <div class="invalid-feedback"><?= $dados['senha_erro'] ?></div>
                </div>
                <div class="mb-3">
                    <label for="txtConfirmaSenha" class="form-label">Confirmar Senha: *</label>
                    <input type="password" class="form-control <?= $dados['confirma_senha_erro'] ? 'is-invalid' : '' ?>" name="txtConfirmaSenha" id="txtConfirmaSenha">
                    <div class="invalid-feedback"><?= $dados['confirma_senha_erro'] ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" value="Cadastrar" id="btn" class="btn btn-artcor">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>