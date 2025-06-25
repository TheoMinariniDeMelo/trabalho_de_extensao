<?= formTitulo("", true) ?>



<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i> Categorias de Estabelecimento Cadastradas
    </h2>
    <?php if (count($dados) > 0): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbListaCategoriaEstabelecimento" style="min-width: 700px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th class="text-start" style="width: 35%;">Categoria</th>
                        <th class="text-start" style="width: 30%;">Estabelecimento</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 15%;">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $value): ?>
                        <tr>
                            <th scope="row" class="text-center text-secondary"><?= $value['categoria_estabelecimento_id'] ?></th>
                            <td class="text-start"><?= htmlspecialchars($value['categoria_descricao']) ?></td>
                            <td class="text-start"><?= htmlspecialchars($value['estabelecimento_nome']) ?></td>
                            <td class="text-center">
                                <?php
                                $status = getStatusDescricao($value['categoria_statusRegistro']);
                                $badgeClass = match ($value['categoria_statusRegistro']) {
                                    1 => 'badge bg-success',
                                    2 => 'badge bg-warning text-dark',
                                    3 => 'badge bg-danger',
                                    default => 'badge bg-secondary',
                                };
                                ?>
                                <span class="<?= $badgeClass ?> px-3 py-1 rounded-pill fw-semibold">
                                    <?= htmlspecialchars($status) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Ações">
                                    <?= buttons('view', $value['categoria_estabelecimento_id']) ?>
                                    <?= buttons('update', $value['categoria_estabelecimento_id']) ?>
                                    <?= buttons('delete', $value['categoria_estabelecimento_id']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

</div>

<?= datatables("tbListaCategoriaEstabelecimento") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5 text-center fs-5">
        Não foram localizados registros...
    </div>

<?php endif; ?>