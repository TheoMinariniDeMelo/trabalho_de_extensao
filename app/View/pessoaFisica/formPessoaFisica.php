<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 1200px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-4">
            <h3 class="fw-bold mb-0">Cadastro de Pessoa Física</h3>
            <hr>
        </div>

        <form method="POST" action="<?= $this->request->formAction() ?>">

            <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
                <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
            <?php endif; ?>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="nome" class="form-label fw-semibold">Nome Completo</label>
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
                    <label for="cpf" class="form-label fw-semibold">CPF</label>
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

            <div class="mb-4 col-md-4">
                <label for="statusRegistro" class="form-label fw-semibold">Status</label>
                <select class="form-select" name="statusRegistro" id="statusRegistro" required>
                    <option value="" <?= setValor('statusRegistro') == ""  ? "SELECTED" : "" ?>>Selecione</option>
                    <option value="1" <?= setValor('statusRegistro') == "1" ? "SELECTED" : "" ?>>Ativo</option>
                    <option value="2" <?= setValor('statusRegistro') == "2" ? "SELECTED" : "" ?>>Inativo</option>
                </select>
            </div>

            <div class="d-grid">
                <?= formButton("Salvar Pessoa Física") ?>
            </div>

        </form>
    </div>
</div>