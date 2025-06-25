<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4" style="max-width: 420px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-4">
            <img src="/assets/img/AtomPHP-logo.png" alt="Logo" width="130" class="mb-2">
            <h3 class="fw-bold">Recuperação de Senha</h3>
        </div>

        <div class="card-body">
            <form action="<?= baseUrl() ?>login/esqueciASenhaEnvio" method="POST">

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Informe seu e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Informe seu e-mail de acesso" value="<?= setValor("email") ?>" required autofocus>
                    <small class="text-muted mt-2 d-block">
                        Você receberá um link para redefinir sua senha.
                    </small>
                </div>

                <?= exibeAlerta() ?>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary fw-bold">Enviar</button>
                </div>

                <div class="d-grid">
                    <a href="<?= baseUrl() ?>login" class="btn btn-outline-primary">Voltar</a>
                </div>

            </form>
        </div>
    </div>
</div>