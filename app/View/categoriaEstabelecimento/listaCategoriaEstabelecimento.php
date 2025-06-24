<?= formTitulo("Lista Categoria estabelecimento", true) ?>

<?php if (count($dados) > 0): ?>

    <div class="m-2">

        <p>
            <i class="fa-sharp-duotone fa-light fa-bell"></i>
        </p>

        <table class="table table-bordered table-striped table-hover table-sm" id="tbListaCategoria">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Estabelecimento</th>
                    <th scope="col">Status Registro</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $value): ?>
                    <tr>
                        <th scope="row"><?= $value['categoria_estabelecimento_id'] ?></th>
                        <td><?= $value['categoria_descricao'] ?></td>
                        <td><?= $value['estabelecimento_nome'] ?></td>
                        <td><?= getStatusDescricao($value['categoria_statusRegistro']) ?></td>
                        <td>
                            <?= buttons('view', $value['categoria_estabelecimento_id'])  ?>
                            <?= buttons('update', $value['categoria_estabelecimento_id'])  ?>
                            <?= buttons('delete', $value['categoria_estabelecimento_id'])  ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?= datatables("tbListaCategoria") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5" role="alert">
        Não foram localizados registros...
    </div>

<?php endif; ?>