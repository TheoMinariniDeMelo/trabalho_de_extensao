<?php

use Core\Library\Session;

?>

<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 1200px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-4">
            <h3 class="fw-bold mb-0">Cadastro de Telefone</h3>
            <hr>
        </div>

        <form method="POST" action="<?= $this->request->formAction() ?>">

            <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
                <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="estabelecimento_id" class="form-label fw-semibold">Estabelecimento</label>
                    <select name="estabelecimento_id" id="estabelecimento_id" class="form-select" required>
                        <?php if (Session::get('userEstabelecimentoId')): ?>
                            <?php foreach ($dados['aEstabelecimento'] as $estab): ?>
                                <?php if ($estab['id'] == Session::get('userEstabelecimentoId')): ?>
                                    <option value="<?= $estab['id'] ?>" selected><?= htmlspecialchars($estab['nome']) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Selecione um estabelecimento</option>
                            <?php foreach ($dados['aEstabelecimento'] as $estab): ?>
                                <option value="<?= $estab['id'] ?>" <?= setValor('estabelecimento_id') == $estab['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($estab['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <?= setMsgFilderError("estabelecimento_id") ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="usuario_id" class="form-label fw-semibold">Usuário</label>
                    <select name="usuario_id" id="usuario_id" class="form-select">
                        <option value="">Selecione um usuário</option>
                        <?php foreach ($dados['aUsuario'] as $usuario): ?>
                            <option value="<?= $usuario['id'] ?>" <?= setValor("usuario_id") == $usuario['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($usuario['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= setMsgFilderError("usuario_id") ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numero" class="form-label fw-semibold">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="DDD + número (somente números)" maxlength="11" value="<?= setValor("numero") ?>" required>
                    <?= setMsgFilderError("numero") ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tipo" class="form-label fw-semibold">Tipo</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="">Selecione o tipo</option>
                        <option value="1" <?= setValor("tipo") == '1' ? 'selected' : '' ?>>Residencial</option>
                        <option value="2" <?= setValor("tipo") == '2' ? 'selected' : '' ?>>Celular</option>
                    </select>
                    <?= setMsgFilderError("tipo") ?>
                </div>
            </div>

            <div class="mb-4 col-md-4">
                <label for="statusRegistro" class="form-label fw-semibold">Status</label>
                <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                    <option value="" <?= setValor('statusRegistro') == ""  ? "selected" : "" ?>>Selecione</option>
                    <option value="1" <?= setValor('statusRegistro') == "1" ? "selected" : "" ?>>Ativo</option>
                    <option value="2" <?= setValor('statusRegistro') == "2" ? "selected" : "" ?>>Inativo</option>
                </select>
            </div>

            <div class="d-grid">
                <?= formButton("Salvar Telefone") ?>
            </div>

        </form>
    </div>
</div>