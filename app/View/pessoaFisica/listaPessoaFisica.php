<?= formTitulo("", true) ?>

<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i> Pessoas Físicas Cadastradas
    </h2>
    <?php if (count($dados) > 0): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbListaPessoaFisica" style="min-width: 650px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 6%;">Id</th>
                        <th style="width: 40%; text-align: left;">Nome</th>
                        <th style="width: 25%;">CPF</th>
                        <th style="width: 15%;">Status Registro</th>
                        <th style="width: 14%;">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $value): ?>
                        <tr>
                            <th scope="row" class="text-center text-secondary"><?= htmlspecialchars($value['id']) ?></th>
                            <td class="text-start"><?= htmlspecialchars($value['nome']) ?></td>
                            <td class="text-center"><?= htmlspecialchars(formatarCPF($value['cpf'])) ?></td>
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

<?= datatables("tbListaPessoaFisica") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5 text-center fs-5">
        Não foram localizados registros...
    </div>

<?php endif; ?>