<?php

use Core\Library\Session;
?>
<div class="d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4" style="max-width: 420px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-3">
            <img src="/assets/img/AtomPHP-logo.png" alt="Logo" width="130" class="mb-2">
            <h3 class="fw-bold">Trocar Senha</h3>
        </div>

        <?= exibeAlerta() ?>

        <div class="card-body">
            <form method="POST" action="<?= baseUrl() ?>Usuario/updateNovaSenha">

                <input type="hidden" name="id" id="id" value="<?= Session::get("userId") ?>">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Usuário</label>
                    <input type="text" class="form-control bg-light" value="<?= Session::get('userNome') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="senhaAtual" class="form-label fw-semibold">Senha Atual</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input name="senhaAtual" id="senhaAtual" type="password" class="form-control" placeholder="Digite sua senha atual" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="novaSenha" class="form-label fw-semibold">Nova Senha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                        <input name="novaSenha" id="novaSenha" type="password" class="form-control" placeholder="Crie uma nova senha" required
                            onkeyup="checa_segur_senha('novaSenha', 'msgSenhaNova', 'btEnviar')">
                    </div>
                    <div id="msgSenhaNova" class="mt-2 text-danger small"></div>
                </div>

                <div class="mb-4">
                    <label for="novaSenha2" class="form-label fw-semibold">Confirme a Nova Senha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                        <input name="novaSenha2" id="novaSenha2" type="password" class="form-control" placeholder="Confirme a nova senha" required
                            onkeyup="checa_segur_senha('novaSenha2', 'msgSenhaNova2', 'btEnviar')">
                    </div>
                    <div id="msgSenhaNova2" class="mt-2 text-danger small"></div>
                </div>

                <div class="d-grid mb-3">
                    <button class="btn btn-primary fw-bold" id="btEnviar" disabled>Atualizar</button>
                </div>

                <div class="text-center">
                    <a href="<?= baseUrl() ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fa-solid fa-arrow-left"></i> Voltar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="<?= baseUrl(); ?>assets/js/usuario.js"></script>