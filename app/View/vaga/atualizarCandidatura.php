<h1>Atualizar Candidatura</h1>

<div class="card">
    <div class="card-body">

        <form action="<?= baseUrl() ?>Vaga/atualizarCandidatura" method="post">

            <input type="hidden" name="id" value="<?= $dados['candidatura']['candidatura_id'] ?>">

            <input type="hidden" name="vaga_id" value="<?= $dados['candidatura']['vaga_id'] ?>">

            <input type="hidden" name="usuario_id" value="<?= $dados['candidatura']['usuario_id'] ?>">

            <input type="hidden" name="curriculum_id" value="<?= $dados['candidatura']['curriculum_id'] ?>">

            <div class="mb-3">
                <label class="form-label">Candidato</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($dados['candidatura']['candidato_nome']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Vaga</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($dados['candidatura']['cargo_nome']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status da Candidatura</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="1" <?= $dados['candidatura']['status'] == 1 ? 'selected' : '' ?>>Pendente</option>
                    <option value="2" <?= $dados['candidatura']['status'] == 2 ? 'selected' : '' ?>>Aprovado</option>
                    <option value="3" <?= $dados['candidatura']['status'] == 3 ? 'selected' : '' ?>>Rejeitado</option>
                </select>
                <?= setMsgFilderError("status") ?>
            </div>

            <div class="mb-3">
                <label for="observacao" class="form-label">Observação</label>
                <textarea class="form-control" id="observacao" name="observacao" rows="4"><?= htmlspecialchars($dados['candidatura']['observacao'] ?? '') ?></textarea>
                <?= setMsgFilderError("observacao") ?>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button onclick="goBack()" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Salvar Alterações
                </button>
            </div>

        </form>

    </div>
</div>