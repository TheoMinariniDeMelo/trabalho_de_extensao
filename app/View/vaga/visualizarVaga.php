<style>
    body {
        background-color: #f8f9fa;
    }

    .vaga-card {
        max-width: 700px;
        margin: 2rem auto;
        border-radius: 1rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .vaga-card h5 {
        font-weight: bold;
    }

    .badge-custom {
        font-size: 0.9rem;
        background-color: #0d6efd;
    }
</style>

<?= exibeAlerta() ?>

<div class="card vaga-card">
    <div class="card-body">
        <h5 class="card-title mb-3">Vaga: <span class="text-primary"><?php echo $dados['data'][0]['descricao'] ?></span></h5>

        <p class="mb-1"><strong>Cargo:</strong> <?php echo $dados['data'][0]['cargo_descricao'] ?></p>
        <p class="mb-1"><strong>Modalidade:</strong> <?php echo textoModalidade($dados['data'][0]['modalidade']) ?> </p>
        <p class="mb-1"><strong>Vínculo:</strong> <?php echo textoVinculo($dados['data'][0]['vinculo']) ?></p>
        <p class="mb-1"><strong>Data da Publicação:</strong> <?php echo formatarData($dados['data'][0]['data']) ?></p>
        <p class="mb-1"><strong>Estabelecimento:</strong> <?php echo $dados['data'][0]['estabelecimento_nome'] ?></p>

        <p class="mt-3"><strong>Observações:</strong></p>
        <p class="text-muted"><?php echo $dados['data'][0]['observacao'] ?></p>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <!-- <span class="badge bg-success"><?php echo $dados['data'][0]['statusVaga'] ?></span> -->

            <!-- Botão de candidatura -->
            <a href="<?= baseUrl() ?>vaga/candidatar/<?php echo $dados['data'][0]['id'] ?>" class="btn btn-primary">
                Me Candidatar
            </a>
        </div>
    </div>
</div>