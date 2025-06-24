<?= formTitulo("Estabelecimento") ?>

<?php
$aUsuario = $dados['aUsuario'];

?>
<div class="m-2">

    <form method="POST" action="<?= $this->request->formAction() ?>">

        <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
            <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text"
                    class="form-control"
                    id="nome"
                    name="nome"
                    placeholder="Nome do estabelecimento"
                    maxlength="50"
                    value="<?= setValor("nome") ?>"
                    required
                    autofocus>
                <?= setMsgFilderError("nome") ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="E-mail de contato"
                    maxlength="150"
                    value="<?= setValor("email") ?>">
                <?= setMsgFilderError("email") ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text"
                    class="form-control"
                    id="endereco"
                    name="endereco"
                    placeholder="Endereço completo"
                    maxlength="200"
                    value="<?= setValor("endereco") ?>">
                <?= setMsgFilderError("endereco") ?>
            </div>

            <div class="col-md-4 mb-3">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text"
                    class="form-control"
                    id="cidade"
                    name="cidade"
                    placeholder="Nome da cidade"
                    maxlength="12"
                    value="<?= setValor("cidade") ?>">
                <?= setMsgFilderError("cidade") ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text"
                    class="form-control"
                    id="latitude"
                    name="latitude"
                    placeholder="Latitude"
                    maxlength="12"
                    value="<?= setValor("latitude") ?>">
                <?= setMsgFilderError("latitude") ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text"
                    class="form-control"
                    id="longitude"
                    name="longitude"
                    placeholder="Longitude"
                    maxlength="12"
                    value="<?= setValor("longitude") ?>">
                <?= setMsgFilderError("longitude") ?>
            </div>


            <div class="col-md-6">
                <label for="usuario_id" class="form-label">Usuário</label>
                <select
                    class="form-select <?= setMsgFilderError("usuario_id") ? 'is-invalid' : '' ?>"
                    name="usuario_id"
                    id="usuario_id"
                    <?= !empty($aUsuario) ? 'required' : "" ?>>
                    <option value="">Selecione</option>
                    <?php foreach ($aUsuario as $value): ?>
                        <option value="<?= $value['id'] ?>" <?= setValor("usuario_id") == $value['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($value['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= setMsgFilderError("usuario_id") ?>
            </div>

            <div class="mb-3 col-md-6">
                <label for="statusRegistro" class="form-label">Status</label>
                <select class="form-control" name="statusRegistro" id="statusRegistro" required>
                    <option value="" <?= setValor('statusRegistro') == ""  ? "SELECTED" : "" ?>>...</option>
                    <option value="1" <?= setValor('statusRegistro') == "1" ? "SELECTED" : "" ?>>Ativo</option>
                    <option value="2" <?= setValor('statusRegistro') == "2" ? "SELECTED" : "" ?>>Inativo</option>
                </select>
            </div>
        </div>

        <?= formButton("Salvar Estabelecimento") ?>
    </form>

</div>