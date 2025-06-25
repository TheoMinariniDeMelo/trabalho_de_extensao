<h1>Candidatos da Vaga: <?= $dados['candidatos'][0]['cargo_descricao'] ?> </h1>

<div class="mb-3">
    <strong>Cargo:</strong> <?= $dados['candidatos'][0]['cargo_descricao'] ?? '---' ?><br>
    <strong>Estabelecimento:</strong> <?= $dados['candidatos'][0]['estabelecimento_nome'] ?? '---' ?><br>
    <strong>Data da Vaga:</strong> <?= date('d/m/Y', strtotime($vaga['data'])) ?><br>
</div>

<?php
$candidatos = $dados['candidatos'];

var_dump($dados['candidatos']);
?>
<?php if (count($candidatos) > 0): ?>

    <table class="table table-bordered table-striped table-hover table-sm" id="tbCandidatosVaga">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data Candidatura</th>
                <th>Status</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidatos as $cand): ?>
                <tr>
                    <td><?= $cand['id'] ?></td>
                    <td><?= htmlspecialchars($cand['candidato_nome']) ?></td>
                    <td><?= formatarCPF($cand['cpf']) ?></td>
                    <td><?= date('d/m/Y', strtotime($cand['data_candidatura'])) ?></td>
                    <td>
                        <?= match ($cand['status']) {
                            1 => 'Em Análise',
                            2 => 'Aprovado',
                            3 => 'Rejeitado',
                            default => '—'
                        } ?>
                    </td>
                    <td class="d-flex flex-wrap gap-1">

                        <a href="<?= baseUrl() ?>Curriculum/form/view/<?= $cand['usuario_id'] ?>"
                            class="btn btn-sm btn-outline-primary"
                            title="Visualizar Curriculum">
                            <i class="bi bi-eye"></i> Curriculum
                        </a>

                        <a href="<?= baseUrl() ?>Vaga/formAtualizarCandidatura/<?= $cand['vaga_id'] ?>/<?= $cand['id'] ?>"
                            class="btn btn-sm btn-outline-success"
                            title="Atualizar Candidatura">
                            <i class="bi bi-pencil"></i> Atualizar
                        </a>

                        <a href="<?= baseUrl() ?>Exercicio/convidarEntrevista/<?= $value['id'] ?>"
                            class="btn btn-sm btn-outline-warning"
                            title="Convidar para Entrevista">
                            <i class="bi bi-envelope-plus"></i> Entrevista
                        </a>

                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?= datatables('tbCandidatosVaga') ?>

<?php else: ?>

    <div class="alert alert-info mt-4">
        Nenhum candidato encontrado para esta vaga.
    </div>

<?php endif; ?>