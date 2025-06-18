
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
                <?php foreach ($dados['lista'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['id']) ?></td>
                        <td><?= htmlspecialchars($item['nome'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($item['cidade'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($item['celular']) ?></td>
                        <td><?= htmlspecialchars($item['email']) ?></td>
                        <td><?= !empty($item['nascimento']) ? date('d/m/Y', strtotime($item['nascimento'])) : '-' ?></td>
                        <td class="text-center">
                            <a href="<?= $this->request->controller ?>/visualizar/<?= $item['id'] ?>" class="btn btn-sm btn-outline-info">Ver</a>
                            <a href="<?= $this->request->controller ?>/form/<?= $item['id'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
                            <a href="<?= $this->request->controller ?>/delete/<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
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