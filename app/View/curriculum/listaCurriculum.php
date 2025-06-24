<?= formTitulo("Lista Curriculo", true) ?>

<?php if (!empty($dados['lista'])): ?>

    <div class="m-2">
        <p><i class="fa-sharp-duotone fa-light fa-bell"></i></p>

        <table class="table table-bordered table-striped table-hover table-sm" id="tbListaCurriculum">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Nome</th>
                    <th>Cidade</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados['lista'] as $value): ?>
                    <tr>
                        <td><?= htmlspecialchars($value['id']) ?></td>
                        <td><?= htmlspecialchars($value['pessoa_fisica_nome'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($value['cidade'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($value['celular']) ?></td>
                        <td><?= htmlspecialchars($value['email']) ?></td>
                        <td><?= !empty($value['nascimento']) ? date('d/m/Y', strtotime($value['nascimento'])) : '-' ?></td>
                        <td class="text-center">
                            <?= buttons('view', $value['id'])  ?>
                            <?= buttons('update', $value['id'])  ?>
                            <?= buttons('delete', $value['id'])  ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <?= datatables("tbListaCurriculum") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5" role="alert">
        Não foram localizados registros...
    </div>

<?php endif; ?>