<!-- <?php var_dump($dados); ?> -->
<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i>
        Candidatos da vaga: <?= htmlspecialchars($dados['candidatos'][0]['cargo_descricao'] ?? '---') ?>
    </h2>

    <div class="mb-3 text-center">
        <strong>Cargo:</strong> <?= htmlspecialchars($dados['candidatos'][0]['cargo_descricao'] ?? '---') ?> &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>Estabelecimento:</strong> <?= htmlspecialchars($dados['candidatos'][0]['estabelecimento_nome'] ?? '---') ?> &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>Data da Vaga:</strong> <?= !empty($vaga['data']) ? date('d/m/Y', strtotime($vaga['data'])) : '---' ?>
    </div>
    <?php if (!empty($dados['candidatos'])): ?>
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle" id="tbCandidatoVaga" style="min-width: 700px;">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 6%;">ID</th>
                        <th style="width: 30%; text-align: left;">Nome</th>
                        <th style="width: 15%;">CPF</th>
                        <th style="width: 15%;">Data Candidatura</th>
                        <th style="width: 14%;">Status</th>
                        <th style="width: 20%;">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados['candidatos'] as $cand): ?>
                        <tr>
                            <td class="text-center text-secondary"><?= htmlspecialchars($cand['id']) ?></td>
                            <td class="text-start"><?= htmlspecialchars($cand['candidato_nome']) ?></td>
                            <td class="text-center"><?= formatarCPF($cand['cpf']) ?></td>
                            <td class="text-center"><?= !empty($cand['data_candidatura']) ? date('d/m/Y', strtotime($cand['data_candidatura'])) : '—' ?></td>
                            <td class="text-center">
                                <?php
                                $statusText = match ($cand['status']) {
                                    1 => ['label' => 'Em Análise', 'class' => 'bg-warning text-dark'],
                                    2 => ['label' => 'Aprovado', 'class' => 'bg-success'],
                                    3 => ['label' => 'Rejeitado', 'class' => 'bg-danger'],
                                    default => ['label' => '—', 'class' => 'bg-secondary']
                                };
                                ?>
                                <span class="badge <?= $statusText['class'] ?>">
                                    <?= $statusText['label'] ?>
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Ações">
                                    <a href="<?= baseUrl() ?>Curriculum/form/view/<?= $cand['curriculum_id'] ?>"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Visualizar Currículo">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="<?= baseUrl() ?>Vaga/formAtualizarCandidatura/<?= $cand['vaga_id'] ?>/<?= $cand['usuario_id'] ?>"
                                        class="btn btn-sm btn-outline-success"
                                        title="Atualizar Candidatura">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <a href="<?= baseUrl() ?>Vaga/convidarEntrevista/<?= $cand['vaga_id'] ?>/<?= $cand['usuario_id'] ?>"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Convidar para Entrevista">
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

</div>

<?= datatables('tbCandidatoVaga') ?>

<?php else: ?>

    <div class="alert alert-info mt-5 mb-5 text-center fs-5">
        Nenhum candidato encontrado para esta vaga.
    </div>

<?php endif; ?>