<?= formTitulo("", true) ?>

<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-phone me-2"></i> Telefones Cadastrados
    </h2>

    <?php if (count($dados) > 0): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbListaTelefone" style="min-width: 900px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 6%;">ID</th>
                        <th style="width: 20%; text-align: left;">Estabelecimento</th>
                        <th style="width: 20%; text-align: left;">Usuário</th>
                        <th style="width: 15%; text-align: left;">Número</th>
                        <th style="width: 15%;">Tipo</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 14%;">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $value): ?>
                        <tr>
                            <th scope="row" class="text-center text-secondary"><?= htmlspecialchars($value['id']) ?></th>
                            <td class="text-start"><?= htmlspecialchars($value['estabelecimento_nome'] ?? $value['estabelecimento_id']) ?></td>
                            <td class="text-start"><?= htmlspecialchars($value['responsavel_nome'] ?? $value['usuario_id']) ?></td>
                            <td class="text-start"><?= htmlspecialchars($value['numero']) ?></td>
                            <td class="text-center">
                                <?= match ($value['tipo']) {
                                    1 => 'Residencial',
                                    2 => 'Celular',
                                    default => 'Outro'
                                }; ?>
                            </td>
                            <td class="text-center">
                                <span class="badge <?= $value['statusRegistro'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $value['statusRegistro'] == 1 ? 'Ativo' : 'Inativo' ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Ações">
                                    <?= buttons('view', $value['id']) ?>
                                    <?= buttons('update', $value['id']) ?>
                                    <?= buttons('delete', $value['id']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?= datatables("tbListaTelefone") ?>

    <?php else: ?>

        <div class="alert alert-warning mt-5 mb-5 text-center fs-5">
            Não foram localizados telefones...
        </div>

    <?php endif; ?>

</div>