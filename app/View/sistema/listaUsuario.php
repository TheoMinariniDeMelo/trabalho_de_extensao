<?php

use Core\Library\Session;

$aNivel  = ["1" => "Super Administrador", "11" => "Empresa", "21" => "Candidato"];
$aStatus = ["1" => "Ativo", "2" => "Inativo", "3" => "Bloqueado"];

?>

<?= formTitulo("", true) ?>



<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i> Usuários Cadastrados
    </h2>
    <?php if (count($dados) > 0): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbListaUsuario" style="min-width: 750px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 6%;">Id</th>
                        <th style="width: 20%; text-align: left;">Nome</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 12%;">Nível</th>
                        <th style="width: 15%; text-align: left;">Estabelecimento</th>
                        <th style="width: 12%;">Status</th>
                        <th style="width: 15%;">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $value): ?>
                        <tr>
                            <th scope="row" class="text-center text-secondary"><?= htmlspecialchars($value['id']) ?></th>
                            <td class="text-start"><?= htmlspecialchars($value['nome']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($value['email']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($aNivel[$value['nivel']] ?? '-') ?></td>
                            <td class="text-start"><?= htmlspecialchars($value['estabelecimento_nome']) ?></td>
                            <td class="text-center">
                                <span class="badge 
                                    <?php
                                    echo ($value['statusRegistro'] == 1) ? 'bg-success' : (($value['statusRegistro'] == 2) ? 'bg-secondary' : 'bg-danger');
                                    ?>">
                                    <?= htmlspecialchars($aStatus[$value['statusRegistro']] ?? 'Desconhecido') ?>
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

<?= datatables("tbListaUsuario") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5 text-center fs-5">
        Não foram localizados registros...
    </div>

<?php endif; ?>