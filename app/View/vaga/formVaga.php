<?= formTitulo("Cadastro de Vaga") ?>

<div class="m-2">

    <form method="POST" action="<?= $this->request->formAction() ?>">

        <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
            <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
        <?php endif; ?>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label for="cargo_id" class="form-label">Cargo</label>
                <select name="cargo_id" id="cargo_id" class="form-control" required>
                    <option value="">Selecione o cargo</option>
                    <?php foreach ($dados['aCargo'] as $cargo): ?>
                        <option value="<?= $cargo['id'] ?>" <?= setValor("cargo_id") == $cargo['id'] ? 'selected' : '' ?>>
                            <?= $cargo['descricao'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= setMsgFilderError("cargo_id") ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="estabelecimento_id" class="form-label">Estabelecimento</label>
                <select name="estabelecimento_id" id="estabelecimento_id" class="form-control" required>
                    <option value="">Selecione o estabelecimento</option>
                    <?php foreach ($dados['aEstabelecimento'] as $est): ?>
                        <option value="<?= $est['id'] ?>" <?= setValor("estabelecimento_id") == $est['id'] ? 'selected' : '' ?>>
                            <?= $est['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= setMsgFilderError("estabelecimento_id") ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label for="descricao" class="form-label">Descrição</label>
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

            <div class="col-md-6 mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" 
                       class="form-control" 
                       id="data" 
                       name="data" 
                       value="<?= setValor("data") ?>"
                       required>
                <?= setMsgFilderError("data") ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label for="modalidade" class="form-label">Modalidade</label>
                <select name="modalidade" id="modalidade" class="form-control" required>
                    <option value="">Selecione</option>
                    <option value="1" <?= setValor("modalidade") == '1' ? 'selected' : '' ?>>Presencial</option>
                    <option value="2" <?= setValor("modalidade") == '2' ? 'selected' : '' ?>>Remoto</option>
                    <option value="3" <?= setValor("modalidade") == '3' ? 'selected' : '' ?>>Híbrido</option>
                </select>
                <?= setMsgFilderError("modalidade") ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="vinculo" class="form-label">Vínculo</label>
                <select name="vinculo" id="vinculo" class="form-control" required>
                    <option value="">Selecione</option>
                    <option value="1" <?= setValor("vinculo") == '1' ? 'selected' : '' ?>>CLT</option>
                    <option value="2" <?= setValor("vinculo") == '2' ? 'selected' : '' ?>>Estágio</option>
                    <option value="3" <?= setValor("vinculo") == '3' ? 'selected' : '' ?>>Temporário</option>
                </select>
                <?= setMsgFilderError("vinculo") ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-12 mb-3">
                <label for="observacao" class="form-label">Observação</label>
                <textarea name="observacao" 
                          id="observacao" 
                          class="form-control" 
                          rows="4"
                          placeholder="Observações adicionais"><?= setValor("observacao") ?></textarea>
                <?= setMsgFilderError("observacao") ?>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label for="statusVaga" class="form-label">Status</label>
                <select name="statusVaga" id="statusVaga" class="form-control" required>
                    <option value="">Selecione</option>
                    <option value="1" <?= setValor("statusVaga") == '1' ? 'selected' : '' ?>>Ativa</option>
                    <option value="0" <?= setValor("statusVaga") == '0' ? 'selected' : '' ?>>Inativa</option>
                </select>
                <?= setMsgFilderError("statusVaga") ?>
            </div>

            <div class="col-md-6 mb-3 d-flex align-items-center">
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

        <?= formButton("Salvar Vaga") ?>
    </form>

</div>
