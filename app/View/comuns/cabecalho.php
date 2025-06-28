<?php

use Core\Library\Session;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AtomPHP, microframework">
    <meta name="author" content="Aldecir Fonseca">

    <title>Conectando Talentos</title>

    <link href="<?= baseUrl() ?>assets/img/AtomPHP-icone.png" rel="icon" type="image/png">
    <link href="<?= baseUrl() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="<?= baseUrl() ?>assets/fontawesome-free-6.7.2-web/css/fontawesome.css" rel="stylesheet">
    <link href="<?= baseUrl() ?>assets/fontawesome-free-6.7.2-web/css/brands.css" rel="stylesheet">
    <link href="<?= baseUrl() ?>assets/fontawesome-free-6.7.2-web/css/solid.css" rel="stylesheet">
    <link href="<?= baseUrl() ?>assets/css/style.css" rel="stylesheet">

    <script src="<?= baseUrl() ?>assets/js/jquery-3.5.1.min.js"></script>

    <style>
        /* Deixa o dropdown no padrão Bootstrap em telas grandes */
        @media (min-width: 992px) {
            .navbar-nav .dropdown-menu {
                min-width: 200px;
            }
        }

        /* Ajusta o dropdown para mobile de forma mais limpa */
        @media (max-width: 991.98px) {
            .navbar-nav .dropdown-menu {
                position: absolute;
                left: 0;
                right: 0;
                background-color: #fff;
                border: 1px solid #ddd;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                margin-top: 0.5rem;
                min-width: 200px;
                z-index: 1000;
            }
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-menu a.text-danger:hover {
            background-color: #f8d7da;
        }
    </style>

</head>

<body>
    <header class="container-fluid shadow-sm mb-3">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="<?= baseUrl() ?>">
                    <img src="<?= baseUrl() ?>assets/img/AtomPHP-logo.png" alt="AtomPHP Logo">
                    <span class="ms-2 fw-bold">Conectando Talentos</span>
                </a>

                <button class="navbar-toggler navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= baseUrl() ?>">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= baseUrl() ?>vaga/listarVagas">Vagas</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= baseUrl() ?>Home/quemSomos">Quem Somos</a>
                        </li>

                        <?php if (Session::get("userId")): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i> <?= Session::get("userNome") ?? 'Usuário' ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="<?= baseUrl() ?>curriculum/meuCurriculo">Meu Currículo</a></li>
                                    <li><a class="dropdown-item" href="<?= baseUrl() ?>vaga/minhaCandidatura">Minhas Candidaturas</a></li>

                                    <?php if ((int)Session::get("userNivel") <= 10): ?>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>categoria">Categoria</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>categoriaEstabelecimento">Categoria Estabelecimento</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>escolaridade">Escolaridade</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>pessoaFisica">Pessoa Física</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>uf">UF's</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>cidade">Cidade</a></li>
                                    <?php endif; ?>

                                    <?php if ((int)Session::get("userNivel") <= 20): ?>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>cargo">Cargo</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>usuario">Usuário</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>curriculum">Currículo</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>estabelecimento">Estabelecimento</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>telefone">Telefone</a></li>
                                        <li><a class="dropdown-item" href="<?= baseUrl() ?>vaga">Vaga</a></li>
                                    <?php endif; ?>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?= baseUrl() ?>usuario/formTrocarSenha">Trocar Senha</a></li>
                                    <li><a class="dropdown-item text-danger" href="<?= baseUrl() ?>login/signOut">Sair</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="btn btn-primary btn-sm ms-2" href="<?= baseUrl() ?>Login">Entrar</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">