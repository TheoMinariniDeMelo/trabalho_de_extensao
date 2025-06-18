<?php if (empty($vagas)) : ?>
    <p class="text-muted">Nenhuma vaga encontrada com os filtros selecionados.</p>
<?php else : ?>
    <div class="row">
        <?php foreach ($vagas as $vaga) : ?>
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5><?= $vaga['titulo'] ?></h5>
                        <p><?= $vaga['descricao'] ?></p>
                        <p><small><?= $vaga['cidade'] ?> - <?= $vaga['estado'] ?></small></p>
                        <a href="<?= baseUrl('vaga/detalhes/' . $vaga['id']) ?>" class="btn btn-sm btn-outline-primary">Ver detalhes</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
