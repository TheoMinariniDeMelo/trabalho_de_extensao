<?php
$aUsuario = $dados['aUsuario'];

?>

<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 1200px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-4">
            <h3 class="fw-bold mb-0">Cadastro de Estabelecimento</h3>
            <hr>
        </div>

        <form method="POST" action="<?= $this->request->formAction() ?>">

            <?php

            use Core\Library\Session;

            if (setValor("id") != "" && setValor("id") != "0"): ?>
                <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label fw-semibold">Nome do Estabelecimento</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome"
                        maxlength="50" value="<?= setValor("nome") ?>" required>
                    <?= setMsgFilderError("nome") ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label fw-semibold">E-mail de Contato</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail"
                        maxlength="150" value="<?= setValor("email") ?>">
                    <?= setMsgFilderError("email") ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="endereco" class="form-label fw-semibold">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco"
                    placeholder="Digite o endereço completo" maxlength="200" value="<?= setValor("endereco") ?>">
                <?= setMsgFilderError("endereco") ?>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Cidade</label>
                    <select name="cidade_id" class="form-select" required>
                        <option value="">Selecione uma cidade</option>
                        <?php foreach ($dados['aCidade'] as $cidade): ?>
                            <option value="<?= $cidade['id'] ?>" <?= setValor('cidade_id', $curriculo['cidade_id'] ?? '') == $cidade['id'] ? 'selected' : '' ?>>
                                <?= $cidade['nome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="latitude" class="form-label fw-semibold">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude"
                        maxlength="12" value="<?= setValor("latitude") ?>">
                    <?= setMsgFilderError("latitude") ?>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="longitude" class="form-label fw-semibold">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude"
                        maxlength="12" value="<?= setValor("longitude") ?>">
                    <?= setMsgFilderError("longitude") ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="usuario_id" class="form-label fw-semibold">Usuário Responsável</label>
                    <select class="form-select <?= setMsgFilderError("usuario_id") ? 'is-invalid' : '' ?>"
                        name="usuario_id" id="usuario_id"
                        <?= !empty($aUsuario) && Session::get('userNivel') > 10 ? 'required' : "" ?>>
                        <option value="">Selecione um usuário</option>
                        <?php foreach ($aUsuario as $value): ?>
                            <option value="<?= $value['id'] ?>" <?= setValor("usuario_id") == $value['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($value['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= setMsgFilderError("usuario_id") ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="statusRegistro" class="form-label fw-semibold">Status</label>
                    <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                        <option value="" <?= setValor('statusRegistro') == ""  ? "SELECTED" : "" ?>>Selecione</option>
                        <option value="1" <?= setValor('statusRegistro') == "1" ? "SELECTED" : "" ?>>Ativo</option>
                        <option value="2" <?= setValor('statusRegistro') == "2" ? "SELECTED" : "" ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="d-grid">
                <?= formButton("Salvar Estabelecimento") ?>
            </div>

        </form>
    </div>
</div>