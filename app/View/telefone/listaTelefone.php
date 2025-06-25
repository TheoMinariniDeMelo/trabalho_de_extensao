<?= formTitulo("Lista Telefone", true) ?>

<?php if (count($dados) > 0): ?>

    <div class="m-2">

        <p>
            <i class="fa-sharp-duotone fa-light fa-bell"></i>
        </p>

        <table class="table table-bordered table-striped table-hover table-sm" id="tbListaTelefone">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Estabelecimento</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Status Registro</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $value): ?>
                    <tr>
                        <th scope="row"><?= $value['id'] ?></th>
                        <td><?= $value['estabelecimento_nome'] ?></td>
                        <td><?= $value['responsavel_nome'] ?></td>
                        <td><?= $value['numero'] ?></td>
                        <td><?= getTipoTelefone($value['tipo']) ?></td>
                        <td><?= getStatusDescricao($value['statusRegistro']) ?></td>
                        <td>
                            <?= buttons('view', $value['id'])  ?>
                            <?= buttons('update', $value['id'])  ?>
                            <?= buttons('delete', $value['id'])  ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?= datatables("tbListaTelefone") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5" role="alert">
        Não foram localizados registros...
    </div>

<?php endif; ?>