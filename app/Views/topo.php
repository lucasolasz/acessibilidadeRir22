<header class="artcor">

    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= URL ?>"><?= APP_NOME ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="li-a-artcor nav-link" aria-current="page" href="<?= URL ?>">Home</a>
                        </li>
                        <?php if(isset($_SESSION['id_usuario'])){ ?>
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle li-a-artcor" data-bs-toggle="dropdown" role="button">Cadastro</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/UsuariosController">Usuários</a></li>
                                <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/EspectadorController">Espectador</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle li-a-artcor" data-bs-toggle="dropdown" role="button">Agendas</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/AgendaController">AC encontros Literários</a></li>                                
                            </ul>
                        </li> 
                        <?php } ?>                       
                        <li class="nav-item">
                            <a class="nav-link li-a-artcor" href="<?= URL . '/Paginas/sobre' ?>">Sobre nós</a>
                        </li>
                    </ul>



                    <?php if (isset($_SESSION['id_usuario'])) { ?>
                        <span class="navbar-text">
                            <p style="color: white;">Olá, <?= ucfirst($_SESSION['ds_nome_usuario']); ?>, Seja bem vindo(a)</p>
                            <a class="btn btn-sm btn-danger" href="<?= URL . '/LoginController/sair' ?>">Sair</a>
                        </span>
                    <?php } else { ?>
                        <span class="navbar-text">
                            <a href="<?= URL . '/LoginController/login' ?>" class="btn btn-artcor">Entrar</a>
                        </span>
                    <?php } ?>

                </div>
            </div>
        </nav>
    </div>

</header>