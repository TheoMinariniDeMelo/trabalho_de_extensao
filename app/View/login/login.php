<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4" style="max-width: 420px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-4">
            <img src="/assets/img/AtomPHP-logo.png" alt="Logo" width="130" class="mb-2">
            <h3 class="fw-bold">Acesso ao Sistema</h3>
        </div>

        <div class="card-body">
            <form action="<?= baseUrl() ?>Login/signIn" method="POST">

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Informe seu e-mail" value="<?= setValor('email') ?>" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label fw-semibold">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe sua senha" required>
                </div>

                <?= exibeAlerta(); ?>

                <div class="d-flex justify-content-between mb-3">
                    <a href="<?= baseUrl() ?>Login/esqueciASenha" class="small text-decoration-none">Esqueci minha senha</a>
                    <a href="<?= baseUrl() ?>Login/formCadastrarLogin" class="small fw-bold text-decoration-none">Criar uma conta</a>
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary fw-bold">Entrar</button>
                </div>

                <div class="d-grid">
                    <a href="<?= baseUrl() ?>" class="btn btn-outline-primary">Voltar</a>
                </div>

            </form>
        </div>
    </div>
</div>