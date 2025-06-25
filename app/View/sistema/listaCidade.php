<?= formTitulo("", true) ?>



<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i> Cidades Cadastradas
    </h2>
    <?php if (count($dados) > 0): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbListaCidade" style="min-width: 700px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 6%;">Id</th>
                        <th style="width: 40%; text-align: left;">Nome</th>
                        <th style="width: 15%;">UF</th>
                        <th style="width: 20%;">Código IBGE</th>
                        <th style="width: 19%;">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $value): ?>
                        <tr>
                            <th scope="row" class="text-center text-secondary"><?= htmlspecialchars($value['id']) ?></th>
                            <td class="text-start"><?= htmlspecialchars($value['nome']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($value['sigla']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($value['codIBGE']) ?></td>
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

<?= datatables("tbListaCidade") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5 text-center fs-5">
        Não foram localizados registros...
    </div>

<?php endif; ?>