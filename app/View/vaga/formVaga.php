<?php

use Core\Library\Session;

exibeAlerta() ?>

<div class="d-flex justify-content-center align-items-start mt-5 mb-5">
    <div class="card shadow-lg p-4" style="max-width: 1200; width: 100%; border-radius: 1rem;">

        <form method="POST" action="<?= $this->request->formAction() ?>">

            <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
                <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
            <?php endif; ?>

            <div class="row g-3">

                <div class="col-md-6">
                    <label for="cargo_id" class="form-label fw-semibold">Cargo</label>
                    <select name="cargo_id" id="cargo_id" class="form-select" required>
                        <option value="">Selecione o cargo</option>
                        <?php foreach ($dados['aCargo'] as $cargo): ?>
                            <option value="<?= $cargo['id'] ?>" <?= setValor("cargo_id") == $cargo['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cargo['descricao']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= setMsgFilderError("cargo_id") ?>
                </div>

                <div class="col-md-6">
                    <label for="estabelecimento_id" class="form-label fw-semibold">Estabelecimento</label>
                    <select name="estabelecimento_id" id="estabelecimento_id" class="form-select" required>

                        <?php if (Session::get('userEstabelecimentoId')): ?>

                            <?php foreach ($dados['aEstabelecimento'] as $estab): ?>
                                <?php if ($estab['id'] == Session::get('userEstabelecimentoId')): ?>
                                    <option value="<?= $estab['id'] ?>" selected>
                                        <?= htmlspecialchars($estab['nome']) ?>
                                    </option>
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

                <div class="col-md-6">
                    <label for="descricao" class="form-label fw-semibold">Descrição</label>
                    <input type="text"
                        class="form-control"
                        id="descricao"
                        name="descricao"
                        maxlength="60"
                        placeholder="Descrição da vaga"
                        value="<?= setValor("descricao") ?>"
                        required>
                    <?= setMsgFilderError("descricao") ?>
                </div>

                <div class="col-md-6">
                    <label for="data" class="form-label fw-semibold">Data</label>
                    <input type="date"
                        class="form-control"
                        id="data"
                        name="data"
                        value="<?= setValor("data") ?>"
                        required>
                    <?= setMsgFilderError("data") ?>
                </div>

                <div class="col-md-6">
                    <label for="modalidade" class="form-label fw-semibold">Modalidade</label>
                    <select name="modalidade" id="modalidade" class="form-select" required>
                        <option value="">Selecione</option>
                        <option value="1" <?= setValor("modalidade") == '1' ? 'selected' : '' ?>>Presencial</option>
                        <option value="2" <?= setValor("modalidade") == '2' ? 'selected' : '' ?>>Remoto</option>
                        <option value="3" <?= setValor("modalidade") == '3' ? 'selected' : '' ?>>Híbrido</option>
                    </select>
                    <?= setMsgFilderError("modalidade") ?>
                </div>

                <div class="col-md-6">
                    <label for="vinculo" class="form-label fw-semibold">Vínculo</label>
                    <select name="vinculo" id="vinculo" class="form-select" required>
                        <option value="">Selecione</option>
                        <option value="1" <?= setValor("vinculo") == '1' ? 'selected' : '' ?>>CLT</option>
                        <option value="2" <?= setValor("vinculo") == '2' ? 'selected' : '' ?>>Estágio</option>
                        <option value="3" <?= setValor("vinculo") == '3' ? 'selected' : '' ?>>Temporário</option>
                    </select>
                    <?= setMsgFilderError("vinculo") ?>
                </div>

                <div class="col-12">
                    <label for="observacao" class="form-label fw-semibold">Observação</label>
                    <textarea name="observacao"
                        id="observacao"
                        class="form-control"
                        rows="4"
                        placeholder="Detalhamento da vaga"><?= setValor("observacao") ?></textarea>
                    <?= setMsgFilderError("observacao") ?>
                </div>

                <div class="col-md-6">
                    <label for="statusVaga" class="form-label fw-semibold">Status</label>
                    <select name="statusVaga" id="statusVaga" class="form-select" required>
                        <option value="">Selecione</option>
                        <option value="1" <?= setValor("statusVaga") == '1' ? 'selected' : '' ?>>Ativa</option>
                        <option value="0" <?= setValor("statusVaga") == '0' ? 'selected' : '' ?>>Inativa</option>
                    </select>
                    <?= setMsgFilderError("statusVaga") ?>
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <div class="form-check mt-4">
                        <input class="form-check-input"
                            type="checkbox"
                            name="ofertaPublica"
                            id="ofertaPublica"
                            value="1"
                            <?= setValor("ofertaPublica") ? 'checked' : '' ?>>
                        <label class="form-check-label" for="ofertaPublica">
                            Oferta Pública
                        </label>
                    </div>
                    <?= setMsgFilderError("ofertaPublica") ?>
                </div>

            </div>

            <div class="d-grid mt-4">
                <?= formButton("Salvar Vaga") ?>
            </div>

        </form>

    </div>
</div>

<script src="<?= baseUrl() ?>assets/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>

<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#observacao'))
        .catch(error => {
            console.error(error);
        });
</script>