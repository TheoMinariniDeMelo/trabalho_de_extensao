<?php
$estabelecimento = !empty($dados['aEstabelecimento']) ? $dados['aEstabelecimento'] : null;
$categoria = $dados['aCategoria'];
?>

<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 1200px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-4">
            <h3 class="fw-bold mb-0">Vincular Estabelecimento à Categoria</h3>
            <hr>
        </div>

        <form method="POST" action="<?= $this->request->formAction() ?>">

            <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
                <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="estabelecimento_id" class="form-label fw-semibold">Estabelecimento</label>
                    <select class="form-select <?= setMsgFilderError("estabelecimento_id") ? 'is-invalid' : '' ?>" name="estabelecimento_id" id="estabelecimento_id" required>
                        <option value="">Selecione</option>
                        <?php foreach ($estabelecimento as $value): ?>
                            <option value="<?= $value['id'] ?>" <?= setValor('estabelecimento_id') == $value['id'] ? 'selected' : '' ?>>
                                <?= $value['nome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= setMsgFilderError("estabelecimento_id") ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="categoria_id" class="form-label fw-semibold">Categoria</label>
                    <select class="form-select <?= setMsgFilderError("categoria_id") ? 'is-invalid' : '' ?>" name="categoria_id" id="categoria_id" required>
                        <option value="">Selecione</option>
                        <?php foreach ($categoria as $value): ?>
                            <option value="<?= $value['id'] ?>" <?= setValor('categoria_id') == $value['id'] ? 'selected' : '' ?>>
                                <?= $value['descricao'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= setMsgFilderError("categoria_id") ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <label for="statusRegistro" class="form-label fw-semibold">Status</label>
                    <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                        <option value="" <?= setValor('statusRegistro') == ""  ? "SELECTED" : "" ?>>Selecione</option>
                        <option value="1" <?= setValor('statusRegistro') == "1" ? "SELECTED" : "" ?>>Ativo</option>
                        <option value="2" <?= setValor('statusRegistro') == "2" ? "SELECTED" : "" ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="d-grid">
                <?= formButton("Salvar Categoria do Estabelecimento") ?>
            </div>

        </form>
    </div>
</div>