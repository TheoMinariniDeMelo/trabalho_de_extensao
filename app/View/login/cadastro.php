<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4" style="max-width: 420px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-3">
            <img src="/assets/img/AtomPHP-logo.png" alt="Logo" width="130" class="mb-2">
            <h3 class="fw-bold">Cadastro</h3>
        </div>

        <div class="card-body">
            <form action="<?= baseUrl() ?>Login/registraUsuario" method="post">

                <div class="mb-3">
                    <label for="register-name" class="form-label fw-semibold">Nome</label>
                    <input type="text" class="form-control" id="register-name" name="register-name" placeholder="Digite seu nome" required>
                </div>

                <div class="mb-3">
                    <label for="register-email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="register-email" name="register-email" placeholder="Digite seu email" required>
                </div>

                <div class="mb-3">
                    <label for="register-password" class="form-label fw-semibold">Senha</label>
                    <input type="password" class="form-control" id="register-password" name="register-password" placeholder="Crie uma senha" required>
                </div>

                <div class="mb-4">
                    <label for="confirm-register-password" class="form-label fw-semibold">Confirmar Senha</label>
                    <input type="password" class="form-control" id="confirm-register-password" name="confirm-register-password" placeholder="Confirme a senha" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary fw-bold">Registrar</button>
                </div>

                <div class="text-center">
                    <small class="text-muted">Já tem uma conta?
                        <a href="<?= baseUrl() ?>Login" class="fw-bold text-decoration-none">Entrar</a>
                    </small>
                </div>

            </form>
        </div>
    </div>
</div>