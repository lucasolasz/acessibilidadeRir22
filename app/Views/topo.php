<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="<?= URL ?>/public/img/Acessibilidade.png">
    <!-- <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?= URL ?>/public/js/jquery.funcoes.js"></script>
    <script src="<?= URL ?>/public/js/qcTimepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="<?= URL ?>/public/css/estilos.css" rel="stylesheet">
    <title><?= APP_NOME ?></title>
</head>

<body>



    <header class="artcor">

        <div class="container">
            <nav class="navbar navbar-expand-sm navbar-dark">
                <div class="container-fluid">
                    <!-- <a class="navbar-brand" href="<?= URL ?>"><?= APP_NOME ?></a> -->

                    <a class="navbar-brand p-0" href="<?= URL ?>">
                        <figure class="figure">
                            <img src="<?= URL . '/public/img/Acessibilidade.png' ?>" class="figure-img img-fluid btnHome" alt="Botão home">
                        </figure>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="li-a-artcor nav-link" aria-current="page" href="<?= URL ?>">Home</a>
                            </li>
                            <?php if (isset($_SESSION['id_usuario'])) { ?>
                                <!-- <li class="nav-item">
                                    <a class="li-a-artcor nav-link" aria-current="page" href="<?= URL ?>/EspectadorController/cadastrar">Novo Espectador</a>
                                </li> -->
                                <li class="dropdown">
                                    <a class="nav-link dropdown-toggle li-a-artcor" data-bs-toggle="dropdown" role="button">Cadastro</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/UsuariosController">Usuários</a></li>
                                        <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/EspectadorController">Espectador</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link dropdown-toggle li-a-artcor" data-bs-toggle="dropdown" role="button">Controles</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/CadeiraRodasController">Cadeiras</a></li>
                                        <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/PlataformasController">Plataforma</a></li>
                                        <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/BrinquedosController">Brinquedos</a></li>
                                        <li><a class="dropdown-artcor nav-link dropdown-item" aria-current="page" href="<?= URL ?>/Paginas/guardaVolumes">Guarda Volume</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <!-- <li class="nav-item">
                                <a class="nav-link li-a-artcor" href="<?= URL . '/Paginas/sobre' ?>">Brinquedos</a>
                            </li> -->
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