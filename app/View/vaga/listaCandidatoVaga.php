<form id="filtroAvancado" method="POST" class="row mb-4 g-3">

    <div class="col-md-3">
        <label class="form-label">Cargo pretendido:</label>
        <select name="cargo_id" class="form-select">
            <option value="">Todos</option>
            <?php foreach ($dados['cargos'] as $cargo): ?>
                <option value="<?= $cargo['id'] ?>"><?= htmlspecialchars($cargo['descricao']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Nível de Escolaridade:</label>
        <select name="escolaridade_id" class="form-select">
            <option value="">Todos</option>
            <?php foreach ($dados['escolaridades'] as $esc): ?>
                <option value="<?= $esc['id'] ?>"><?= htmlspecialchars($esc['descricao']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label">Anos de Experiência:</label>
        <input type="number" name="tempo_experiencia" class="form-control" min="0" placeholder="Ex.: 2">
    </div>

    <!-- <div class="col-md-4">
        <label class="form-label">Modalidade:</label>
        <select name="modalidade" class="form-select">
            <option value="">Todas</option>
            <option value="Presencial">Presencial</option>
            <option value="Remoto">Remoto</option>
            <option value="Híbrido">Híbrido</option>
        </select>
    </div> -->
    <!-- 
    <div class="col-md-4">
        <label class="form-label">Tipo de Vínculo:</label>
        <select name="vinculo" class="form-select">
            <option value="">Todos</option>
            <option value="CLT">CLT</option>
            <option value="Estágio">Estágio</option>
            <option value="Temporário">Temporário</option>
        </select>
    </div> -->

    <div class="col-md-4">
        <label class="form-label">Cidade:</label>
        <select name="cidade_id" class="form-select">
            <option value="">Todas</option>
            <?php foreach ($dados['cidades'] as $cidade): ?>
                <option value="<?= $cidade['id'] ?>"><?= htmlspecialchars($cidade['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-filter"></i> Filtrar
        </button>
    </div>

</form>

<!-- <div id="tabelaCandidatos"></div> -->


<div class="my-4 px-3">

    <h2 class="text-center fw-bold mb-4 pb-2 border-bottom border-primary">
        <i class="fa-sharp fa-duotone fa-bell me-2"></i>
        Candidatos da vaga: <?= htmlspecialchars($dados['candidatos'][0]['cargo_descricao'] ?? '---') ?>
    </h2>

    <div class="mb-3 text-center">
        <strong>Cargo:</strong> <?= htmlspecialchars($dados['candidatos'][0]['cargo_descricao'] ?? '---') ?> &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>Estabelecimento:</strong> <?= htmlspecialchars($dados['candidatos'][0]['estabelecimento_nome'] ?? '---') ?> &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>Data da Vaga:</strong> <?= !empty($dados['candidatos'][0]['data']) ? date('d/m/Y', strtotime($dados['candidatos'][0]['data'])) : '---' ?>
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
                                    <a href="<?= baseUrl() ?>Curriculum/form/view/<?= $cand['curriculum_id'] ?>/vaga/<?= $cand['vaga_id'] ?>"
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

<script>
    $('#filtroAvancado').on('submit', function(e) {
        e.preventDefault();

        $.post('<?= baseUrl() ?>Vaga/filtrarCandidatoAvancado', $(this).serialize(), function(response) {

            if (response.length === 0) {
                $('#tbCandidatoVaga').html('<div class="alert alert-info text-center">Nenhum candidato encontrado com os critérios informados.</div>');
                return;
            }

            let html = `<div class="table-responsive shadow rounded">
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
            <tbody>`;

            response.forEach(cand => {
                let statusClass = 'bg-secondary';
                let statusLabel = '—';
                // console.log(cand);
                if (cand.status_candidatura == 1) {
                    statusClass = 'bg-warning text-dark';
                    statusLabel = 'Em Análise';
                } else if (cand.status_candidatura == 2) {
                    statusClass = 'bg-success';
                    statusLabel = 'Aprovado';
                } else if (cand.status_candidatura == 3) {
                    statusClass = 'bg-danger';
                    statusLabel = 'Rejeitado';
                }

                html += `<tr>
                    <td class="text-center text-secondary">${cand.candidatura_id}</td>
                    <td class="text-start">${cand.candidato_nome}</td>
                    <td class="text-center">${formatarCPF(cand.cpf)}</td>
                    <td class="text-center">${cand.data_candidatura ? formatarData(cand.data_candidatura) : '—'}</td>
                    <td class="text-center"><span class="badge ${statusClass}">${statusLabel}</span></td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="<?= baseUrl() ?>Curriculum/form/view/${cand.curriculum_id}" class="btn btn-sm btn-outline-primary" title="Visualizar Currículo">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="<?= baseUrl() ?>Vaga/formAtualizarCandidatura/${cand.vaga_id}/${cand.usuario_id}" class="btn btn-sm btn-outline-success" title="Atualizar Candidatura">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="<?= baseUrl() ?>Vaga/convidarEntrevista/${cand.vaga_id}/${cand.usuario_id}" class="btn btn-sm btn-outline-warning" title="Convidar para Entrevista">
                                <i class="fa-solid fa-envelope"></i>
                            </a>
                        </div>
                    </td>
                    </tr>`;

            });

            html += `</tbody></table></div>`;
            $('#tbCandidatoVaga').html(html);
        }, 'json');
    });

    function formatarCPF(cpf) {
        return cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');
    }

    function formatarData(data) {
        const d = new Date(data);
        return d.toLocaleDateString('pt-BR');
    }
</script>