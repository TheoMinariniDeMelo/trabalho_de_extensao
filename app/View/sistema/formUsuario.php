<script type="text/javascript" src="<?= baseUrl(); ?>assets/js/usuario.js"></script>

<?php
$aEstabelecimento = $dados['aEstabelecimento'];
?>

<div class="d-flex justify-content-center align-items-start mt-5 mb-5">
    <div class="card shadow-lg p-4" style="max-width: 900px; width: 100%; border-radius: 1rem;">

        <form method="POST" action="<?= $this->request->formAction() ?>">

            <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
                <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
            <?php endif; ?>

            <div class="row g-3">

                <div class="col-md-8">
                    <label for="nome" class="form-label fw-semibold">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Usuário" maxlength="60" value="<?= setValor('nome') ?>" required autofocus>
                    <?= setMsgFilderError('nome') ?>
                </div>

                <div class="col-md-4">
                    <label for="nivel" class="form-label fw-semibold">Nível</label>
                    <select class="form-select" name="nivel" id="nivel" aria-label="Large select nivel" required>
                        <option value="0" <?= (setValor('nivel') == ""   ? 'selected' : "") ?>>...</option>
                        <option value="1" <?= (setValor('nivel') == "1"  ? 'selected' : "") ?>>Super Administrador</option>
                        <option value="11" <?= (setValor('nivel') == "11" ? 'selected' : "") ?>>Empresa</option>
                        <option value="21" <?= (setValor('nivel') == "21" ? 'selected' : "") ?>>Candidato</option>
                    </select>
                    <?= setMsgFilderError('tipo') ?>
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email do Usuário" maxlength="150" value="<?= setValor('email') ?>" required>
                    <?= setMsgFilderError('email') ?>
                </div>

                <div class="col-md-4">
                    <label for="estabelecimento_id" class="form-label fw-semibold">Estabelecimento</label>
                    <select class="form-select" id="estabelecimento_id" name="estabelecimento_id">
                        <option value="">...</option>
                        <?php foreach ($aEstabelecimento as $value): ?>
                            <option value="<?= $value['id'] ?>" <?= ($value['id'] == setValor("estabelecimento_id") ? 'selected' : '') ?>>
                                <?= htmlspecialchars($value['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= setMsgFilderError("estabelecimento_id") ?>
                </div>

                <div class="col-md-4">
                    <label for="statusRegistro" class="form-label fw-semibold">Status</label>
                    <select class="form-select" name="statusRegistro" id="statusRegistro" aria-label="Large select statusRegistro" required>
                        <option value="0" <?= (setValor('statusRegistro') == ""  ? 'selected' : "") ?>>...</option>
                        <option value="1" <?= (setValor('statusRegistro') == "1" ? 'selected' : "") ?>>Ativo</option>
                        <option value="2" <?= (setValor('statusRegistro') == "2" ? 'selected' : "") ?>>Inativo</option>
                    </select>
                    <?= setMsgFilderError('statusRegistro') ?>
                </div>

                <?php if (in_array($this->request->getAction(), ['insert', 'update'])): ?>
                    <div class="col-md-6">
                        <label for="senha" class="form-label fw-semibold">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha"
                            placeholder="Informe uma senha" maxlength="60"
                            onkeyup="checa_segur_senha('senha', 'msgSenha', 'btEnviar');"
                            <?= ($this->request->getAction() == "insert" ? 'required' : '') ?>>
                        <div id="msgSenha" class="mt-2"></div>
                        <?= setMsgFilderError('senha') ?>
                    </div>

                    <div class="col-md-6">
                        <label for="confSenha" class="form-label fw-semibold">Confirma a Senha</label>
                        <input type="password" class="form-control" id="confSenha" name="confSenha"
                            placeholder="Digite a senha para conferência" maxlength="60"
                            onkeyup="checa_segur_senha('confSenha', 'msgConfSenha', 'btEnviar');"
                            <?= ($this->request->getAction() == "insert" ? 'required' : '') ?>>
                        <div id="msgConfSenha" class="mt-2"></div>
                        <?= setMsgFilderError('confSenha') ?>
                    </div>
                <?php endif; ?>

            </div>

            <div class="d-grid mt-4">
                <?= formButton() ?>
            </div>

        </form>

    </div>
</div>