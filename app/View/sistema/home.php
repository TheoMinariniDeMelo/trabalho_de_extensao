<?= exibeAlerta(); ?>

<div class="container mt-5">

    <?php

    use Core\Library\Session;

    if (Session::get('userNivel') > 20): ?>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow-lg border-0 rounded-4 p-4 text-center">

                    <div class="mb-3">
                        <img src="/assets/img/AtomPHP-logo.png" alt="AtomPHP" width="120">
                    </div>

                    <h2 class="fw-bold mb-3">
                        Bem-vindo ao Portal do Candidato
                    </h2>

                    <p class="fs-5 text-muted">
                        Aqui você pode cadastrar seu currículo e se candidatar às vagas disponíveis.
                    </p>

                    <div class="mt-4">
                        <a href="<?= baseUrl() ?>vaga/listarVagas" class="btn btn-primary me-2">
                            <i class="fa fa-search"></i> Ver Vagas Disponíveis
                        </a>
                        <a href="<?= baseUrl() ?>curriculum/meuCurriculo" class="btn btn-outline-primary">
                            <i class="fa fa-user"></i> Meu Currículo
                        </a>
                        <a href="<?= baseUrl() ?>login/signOut" class="btn btn-danger">
                            <i class="fa fa-sign-out-alt"></i> Sair
                        </a>
                    </div>

                </div>

            </div>
        </div>

    <?php else: ?>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow-lg border-0 rounded-4 p-4 text-center">

                    <div class="mb-3">
                        <img src="/assets/img/AtomPHP-logo.png" alt="AtomPHP" width="120">
                    </div>

                    <h2 class="fw-bold mb-3">
                        Bem-vindo à Área Administrativa
                    </h2>

                    <p class="fs-5 text-muted">
                        Utilize o menu lateral para acessar as funcionalidades do <strong>Sistema Conectando Talentos</strong>.
                    </p>

                    <div class="mt-4">
                        <a href="<?= baseUrl() ?>" class="btn btn-outline-primary me-2">
                            <i class="fa fa-home"></i> Ir para o Site
                        </a>
                        <a href="<?= baseUrl() ?>login/signOut" class="btn btn-danger">
                            <i class="fa fa-sign-out-alt"></i> Sair
                        </a>
                    </div>

                </div>

            </div>
        </div>

    <?php endif; ?>

</div>