<?= formTitulo("CategoriaEstabelecimento") ?>

<?php
$estabelecimento = $dados['aEstabelecimento'];
$categoria = $dados['aCategoria'];
?>

<div class="m-2">
    <form method="POST" action="<?= $this->request->formAction() ?>">

        <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
            <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
        <?php endif; ?>

        <!-- Campo Estabelecimento -->
        <div class="row">
            <div class="col-12 mb-3">
                <label for="estabelecimento_id" class="form-label">Estabelecimento</label>
                <select class="form-select" name="estabelecimento_id" id="estabelecimento_id" required>
                    <option value="">Selecione</option>
                    <?php foreach ($estabelecimento as $value): ?>
                        <option value="<?= $value['id'] ?>" <?= setValor('estabelecimento_id') == $value['id'] ? 'selected' : '' ?>>
                            <?= $value['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= setMsgFilderError("estabelecimento_id") ?>
            </div>
        </div>

        <!-- Campo Categoria -->
        <div class="row">
            <div class="col-12 mb-3">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select class="form-select" name="categoria_id" id="categoria_id" required>
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

        <div class="mb-3 col-4">
            <label for="statusRegistro" class="form-label">Status</label>
            <select class="form-control" name="statusRegistro" id="statusRegistro" required>
                <option value="" <?= setValor('statusRegistro') == ""  ? "SELECTED" : "" ?>>...</option>
                <option value="1" <?= setValor('statusRegistro') == "1" ? "SELECTED" : "" ?>>Ativo</option>
                <option value="2" <?= setValor('statusRegistro') == "2" ? "SELECTED" : "" ?>>Inativo</option>
            </select>
        </div>

        <?= formButton() ?>
    </form>
</div>