<h2>Vagas Abertas</h2>

<p>Alguma vaga combina com você?<br>
    Candidate-se e venha construir uma carreira de sucesso com a gente!</p>

<form method="GET" action="" class="mb-4" id="form-filtro">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="input-group">
                <input type="text" name="busca" id="busca" class="form-control" placeholder="Digite o nome da vaga" value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</form>

<div id="lista-vagas">
    <!-- Resultados aparecerão aqui -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('#form-filtro').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize(); // coleta dados do form

            $.ajax({
                url: '/Vaga/ajaxFiltrar', // ajuste se necessário
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var container = $('#lista-vagas');
                    if (!data.length) {
                        container.html('<p>Nenhuma vaga encontrada.</p>');
                        return;
                    }

                    var tabela = '<table class="table table-striped">';
                    tabela += '<thead><tr><th>Título</th><th>Local</th><th>Tipo</th><th>Ações</th></tr></thead><tbody>';

                    data.forEach(function(vaga) {
                        tabela += '<tr>';
                        tabela += '<td>' + $('<div>').text(vaga.descricao).html() + '</td>';
                        tabela += '<td>' + $('<div>').text((vaga.cidade ?? '') + ' - ' + (vaga.estado ?? '')).html() + '</td>';
                        tabela += '<td>' + formatVinculo(vaga.vinculo) + '</td>';
                        tabela += '<td><a href="/vaga/visualizarVaga/' + vaga.id + '" class="btn btn-primary btn-sm">Ver detalhes</a></td>';
                        tabela += '</tr>';
                    });

                    tabela += '</tbody></table>';
                    container.html(tabela);
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao buscar vagas:");
                    console.error("Status:", status);
                    console.error("Erro:", error);
                    console.error("Resposta completa:", xhr.responseText);
                    $('#lista-vagas').html('<p class="text-danger">Erro ao buscar vagas.</p>');
                }
            });
        });

        function formatVinculo(codigo) {
            switch (codigo) {
                case '1':
                    return 'CLT';
                case '2':
                    return 'Estágio';
                case '3':
                    return 'Temporário';
                case '4':
                    return 'Freelancer';
                default:
                    return 'Outro';
            }
        }
    });
</script>