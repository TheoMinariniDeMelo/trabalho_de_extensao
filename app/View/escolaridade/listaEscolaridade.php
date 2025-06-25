<?= formTitulo("", true) ?>



<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i> Escolaridades Cadastradas
    </h2>
    <?php if (count($dados) > 0): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbListaEscolaridade" style="min-width: 600px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 10%;">Id</th>
                        <th style="width: 55%; text-align: left;">Descrição</th>
                        <th style="width: 20%;">Status Registro</th>
                        <th style="width: 15%;">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $value): ?>
                        <tr>
                            <th scope="row" class="text-center text-secondary"><?= htmlspecialchars($value['id']) ?></th>
                            <td class="text-start"><?= htmlspecialchars($value['descricao']) ?></td>
                            <td class="text-center">
                                <span class="badge <?= ($value['statusRegistro'] == 1) ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= htmlspecialchars(getStatusDescricao($value['statusRegistro'])) ?>
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

</div>

<?= datatables("tbListaEscolaridade") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5 text-center fs-5">
        Não foram localizados registros...
    </div>

<?php endif; ?>