<?php
$cargos = $dados['aCargo'];
$estabelecimentos = $dados['aEstabelecimento'];

?>

<?= exibeAlerta(); ?>
<h2>Vagas Abertas</h2>

<p>Alguma vaga combina com você?<br>
    Candidate-se e venha construir uma carreira de sucesso com a gente!</p>

<form method="POST" action="" class="mb-4" id="form-filtro">
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="busca" id="busca" class="form-control" placeholder="Digite nome da vaga ou cargo">
        </div>

        <div class="col-md-3">
            <select name="cargo_id" id="cargo_id" class="form-select">
                <option value="">Todos os Cargos</option>
                <?php foreach ($cargos as $cargo): ?>
                    <option value="<?= $cargo['id'] ?>"><?= htmlspecialchars($cargo['descricao']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <select name="estabelecimento_id" id="estabelecimento_id" class="form-select">
                <option value="">Todos os Estabelecimentos</option>
                <?php foreach ($estabelecimentos as $estabelecimento): ?>
                    <option value="<?= $estabelecimento['id'] ?>"><?= htmlspecialchars($estabelecimento['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-2">
            <select name="ofertaPublica" id="ofertaPublica" class="form-select">
                <option value="">Oferta Pública?</option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>

        <div class="col-md-2 mt-2">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </div>
</form>

<div id="lista-vagas">
    <!-- Resultados AJAX aparecem aqui -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {

        function carregarVagas() {
            var formData = $('#form-filtro').serialize();

            $.ajax({
                url: '/vaga/ajaxFiltrar',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    var container = $('#lista-vagas');
                    container.empty();

                    if (!data.length) {
                        container.html('<p>Nenhuma vaga encontrada.</p>');
                        return;
                    }

                    var tabela = '<table class="table table-striped">';
                    tabela += '<thead><tr><th>Cargo</th><th>Descrição</th><th>Modalidade</th><th>Vínculo</th><th>Data</th><th>Ações</th></tr></thead><tbody>';

                    data.forEach(function(vaga) {
                        tabela += '<tr>';
                        tabela += '<td>' + $('<div>').text(vaga.cargo_descricao ?? '---').html() + '</td>';
                        tabela += '<td>' + $('<div>').text(vaga.descricao ?? '').html() + '</td>';
                        tabela += '<td>' + (formatarCampo('modalidade', vaga.modalidade) ?? '') + '</td>';
                        tabela += '<td>' + (formatarCampo('vinculo', vaga.vinculo) ?? '') + '</td>';
                        tabela += '<td>' + (formatarCampo('data', vaga.data) ?? '') + '</td>';
                        tabela += '<td><a href="/vaga/visualizarVaga/' + vaga.id + '" class="btn btn-sm btn-primary">Ver detalhes</a></td>';
                        tabela += '</tr>';
                    });

                    tabela += '</tbody></table>';
                    container.html(tabela);
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao buscar vagas:", error);
                    $('#lista-vagas').html('<p class="text-danger">Erro ao buscar vagas.</p>');
                }
            });
        }

        // Carrega no início
        carregarVagas();

        // Submete o filtro via AJAX
        $('#form-filtro').on('submit', function(e) {
            e.preventDefault();
            carregarVagas();
        });
    });
</script>