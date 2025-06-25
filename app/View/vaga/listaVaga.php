<?= formTitulo("Lista de Vagas", true) ?>

<?php
var_dump($dados);
?>
<?php if (count($dados) > 0): ?>

    <div class="m-2">

        <table class="table table-bordered table-striped table-hover table-sm" id="tbListaVaga">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Estabelecimento</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Modalidade</th>
                    <th scope="col">Vínculo</th>
                    <th scope="col">Oferta Pública</th>
                    <th scope="col">Status</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $value): ?>
                    <tr>
                        <th scope="row"><?= $value['id'] ?></th>
                        <td><?= $value['cargo_descricao'] ?? $value['cargo_id'] ?></td>
                        <td><?= $value['estabelecimento_nome'] ?? $value['estabelecimento_id'] ?></td>
                        <td><?= $value['descricao'] ?></td>
                        <td><?= date("d/m/Y", strtotime($value['data'])) ?></td>
                        <td>
                            <?php
                            echo match ($value['modalidade']) {
                                1 => 'Presencial',
                                2 => 'Remoto',
                                3 => 'Híbrido',
                                default => '—'
                            };
                            ?>
                        </td>
                        <td>
                            <?php
                            echo match ($value['vinculo']) {
                                1 => 'CLT',
                                2 => 'Estágio',
                                3 => 'Temporário',
                                default => '—'
                            };
                            ?>
                        </td>
                        <td><?= $value['ofertaPublica'] ? 'Sim' : 'Não' ?></td>
                        <td>
                            <?= $value['statusVaga'] == 1 ? 'Ativa' : 'Inativa' ?>
                        </td>
                        <td class="d-flex flex-wrap gap-1">

                            <?= buttons('view', $value['id']) ?>
                            <?= buttons('update', $value['id']) ?>
                            <?= buttons('delete', $value['id']) ?>

                            <a href="<?= baseUrl() ?>Vaga/visualizarcandidatoVaga/<?= $value['id'] ?>"
                                class="btn btn-sm btn-outline-primary"
                                title="Visualizar Candidatos">
                                <i class="bi bi-people"></i> Candidatos
                            </a>

                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?= datatables("tbListaVaga") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5" role="alert">
        Não foram localizadas vagas...
    </div>

<?php endif; ?>