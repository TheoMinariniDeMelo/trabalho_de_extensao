<?php

use Core\Library\Session;



?>

<?= exibeAlerta(); ?>
<h1>Convidar Candidato para Entrevista</h1>

<div class="card">
    <div class="card-body">

        <form action="<?= baseUrl() ?>Vaga/enviarConviteEntrevista" method="post">

            <div class="mb-3">
                <label class="form-label">Para (E-mail do Candidato)</label>
                <input type="email" class="form-control" name="email"
                    value="<?= htmlspecialchars($dados['candidatura']['curriculum_email']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Assunto</label>
                <input type="text" class="form-control" name="assunto"
                    value="Convite para Entrevista - <?= htmlspecialchars($dados['candidatura']['cargo_nome']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mensagem</label>
                <textarea class="form-control" name="mensagem" rows="6" required>
Olá <?= htmlspecialchars($dados['candidatura']['candidato_nome']) ?>,

Estamos interessados em avançar com sua candidatura para a vaga de <?= htmlspecialchars($dados['candidatura']['cargo_nome']) ?>.

Gostaríamos de convidá-lo para uma entrevista. Por favor, entre em contato no whatsapp +55 (xx) xxxxxxxxx para agendarmos o melhor dia e horário.

Atenciosamente,
<?= Session::get('userNome') ?>
                </textarea>
            </div>

            <input type="hidden" name="vaga_id" id="vaga_id" value="<?= $dados['candidatura']['vaga_id'] ?>">
            <input type="hidden" name="usuario_id" id="usuario_id" value="<?= $dados['candidatura']['usuario_id'] ?>">

            <div class=" d-flex justify-content-end gap-2">
                <a href="<?= baseUrl() ?>vaga/visualizarcandidatoVaga/<?= $dados['candidatura']['vaga_id'] ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> Enviar Convite
                </button>
            </div>

        </form>

    </div>
</div>