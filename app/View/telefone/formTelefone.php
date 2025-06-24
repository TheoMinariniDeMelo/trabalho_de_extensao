<?= formTitulo("Telefone") ?>

<div class="m-2">

    <form method="POST" action="<?= $this->request->formAction() ?>">

        <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
            <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
        <?php endif; ?>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label for="estabelecimento_id" class="form-label">Estabelecimento</label>
                <select name="estabelecimento_id" id="estabelecimento_id" class="form-control">
                    <option value="">Selecione um estabelecimento</option>
                    <?php foreach ($dados['aEstabelecimento'] as $estab): ?>
                        <option value="<?= $estab['id'] ?>" <?= setValor("estabelecimento_id") == $estab['id'] ? 'selected' : '' ?>>
                            <?= $estab['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= setMsgFilderError("estabelecimento_id") ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="usuario_id" class="form-label">Usuário</label>
                <select name="usuario_id" id="usuario_id" class="form-control">
                    <option value="">Selecione um usuário</option>
                    <?php foreach ($dados['aUsuario'] as $usuario): ?>
                        <option value="<?= $usuario['id'] ?>" <?= setValor("usuario_id") == $usuario['id'] ? 'selected' : '' ?>>
                            <?= $usuario['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= setMsgFilderError("usuario_id") ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label for="numero" class="form-label">Número</label>
                <input type="text"
                    class="form-control"
                    id="numero"
                    name="numero"
                    placeholder="DDD + número (somente números)"
                    maxlength="11"
                    value="<?= setValor("numero") ?>"
                    required>
                <?= setMsgFilderError("numero") ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="">Selecione o tipo</option>
                    <option value="1" <?= setValor("tipo") == '1' ? 'selected' : '' ?>>Residencial</option>
                    <option value="2" <?= setValor("tipo") == '2' ? 'selected' : '' ?>>Celular</option>
                </select>
                <?= setMsgFilderError("tipo") ?>
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

        <?= formButton("Salvar Telefone") ?>
    </form>

</div>