<?= formTitulo("Pessoa Física") ?>

<div class="m-2">

    <form method="POST" action="<?= $this->request->formAction() ?>">

        <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
            <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8 mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text"
                    class="form-control"
                    id="nome"
                    name="nome"
                    placeholder="Nome completo"
                    maxlength="150"
                    value="<?= setValor("nome") ?>"
                    required
                    autofocus>
                <?= setMsgFilderError("nome") ?>
            </div>

            <div class="col-md-4 mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text"
                    class="form-control"
                    id="cpf"
                    name="cpf"
                    placeholder="Somente números"
                    maxlength="11"
                    value="<?= setValor("cpf") ?>"
                    required>
                <?= setMsgFilderError("cpf") ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="visitante_id" class="form-label">Visitante ID</label>
                <input type="number"
                    class="form-control"
                    id="visitante_id"
                    name="visitante_id"
                    placeholder="ID do visitante (se aplicável)"
                    value="<?= setValor("visitante_id") ?>">
                <?= setMsgFilderError("visitante_id") ?>
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

        <?= formButton("Salvar Pessoa Física") ?>
    </form>

</div>