<?= formTitulo("", true) ?>



<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i> Currículos Cadastrados
    </h2>
    <?php if (!empty($dados['lista'])): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbListaCurriculum" style="min-width: 700px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 6%;">#ID</th>
                        <th style="width: 20%; text-align: left;">Nome</th>
                        <th style="width: 15%; text-align: left;">Cidade</th>
                        <th style="width: 12%;">Celular</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 12%;">Nascimento</th>
                        <th style="width: 15%;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados['lista'] as $value): ?>
                        <tr>
                            <td class="text-center text-secondary"><?= htmlspecialchars($value['id']) ?></td>
                            <td class="text-start"><?= htmlspecialchars($value['pessoa_fisica_nome'] ?? '-') ?></td>
                            <td class="text-start"><?= htmlspecialchars($value['cidade'] ?? '-') ?></td>
                            <td class="text-center"><?= htmlspecialchars($value['celular']) ?></td>
                            <td class="text-center text-truncate" style="max-width: 180px;"><?= htmlspecialchars($value['email']) ?></td>
                            <td class="text-center"><?= !empty($value['nascimento']) ? date('d/m/Y', strtotime($value['nascimento'])) : '-' ?></td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Ações">
                                    <?= buttons('view', $value['id']) ?>
                                    <?= buttons('update', $value['id']) ?>
                                    <?= buttons('delete', $value['id']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

</div>

<?= datatables("tbListaCurriculum") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5 text-center fs-5">
        Não foram localizados registros...
    </div>

<?php endif; ?>