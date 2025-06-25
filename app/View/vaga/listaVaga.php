<?= formTitulo("", true) ?>



<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i> Vagas Cadastradas
    </h2>
    <?php if (count($dados) > 0): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbListaVaga" style="min-width: 900px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 6%;">ID</th>
                        <th style="width: 15%; text-align: left;">Cargo</th>
                        <th style="width: 15%; text-align: left;">Estabelecimento</th>
                        <th style="width: 20%; text-align: left;">Descrição</th>
                        <th style="width: 10%;">Data</th>
                        <th style="width: 10%;">Modalidade</th>
                        <th style="width: 10%;">Vínculo</th>
                        <th style="width: 7%;">Oferta Pública</th>
                        <th style="width: 7%;">Status</th>
                        <th style="width: 15%;">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $value): ?>
                        <tr>
                            <th scope="row" class="text-center text-secondary"><?= htmlspecialchars($value['id']) ?></th>
                            <td class="text-start"><?= htmlspecialchars($value['cargo_descricao'] ?? $value['cargo_id']) ?></td>
                            <td class="text-start"><?= htmlspecialchars($value['estabelecimento_nome'] ?? $value['estabelecimento_id']) ?></td>
                            <td class="text-start"><?= htmlspecialchars($value['descricao']) ?></td>
                            <td class="text-center"><?= !empty($value['data']) ? date("d/m/Y", strtotime($value['data'])) : '—' ?></td>
                            <td class="text-center">
                                <?= match ($value['modalidade']) {
                                    1 => 'Presencial',
                                    2 => 'Remoto',
                                    3 => 'Híbrido',
                                    default => '—'
                                }; ?>
                            </td>
                            <td class="text-center">
                                <?= match ($value['vinculo']) {
                                    1 => 'CLT',
                                    2 => 'Estágio',
                                    3 => 'Temporário',
                                    default => '—'
                                }; ?>
                            </td>
                            <td class="text-center">
                                <span class="badge <?= $value['ofertaPublica'] ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $value['ofertaPublica'] ? 'Sim' : 'Não' ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge <?= $value['statusVaga'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $value['statusVaga'] == 1 ? 'Ativa' : 'Inativa' ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Ações">
                                    <?= buttons('view', $value['id']) ?>
                                    <?= buttons('update', $value['id']) ?>
                                    <?= buttons('delete', $value['id']) ?>

                                    <a href="<?= baseUrl() ?>Vaga/visualizarcandidatoVaga/<?= $value['id'] ?>"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Visualizar Candidatos">
                                        <i class="fa-solid fa-users"></i> Candidatos
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

</div>

<?= datatables("tbListaVaga") ?>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5 text-center fs-5">
        Não foram localizadas vagas...
    </div>

<?php endif; ?>