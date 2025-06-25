<?php

use Core\Library\Session;

$exibeNovo = true;

if (Session::get('userNivel') > 20) {
    $exibeNovo = false;
}

$curriculo = $dados['data'][0] ?? [];
$escolaridades = $dados['data']['escolaridade'] ?? [];
$experiencias = $dados['data']['experiencia'] ?? [];
$qualificacoes = $dados['data']['qualificacao'] ?? [];
$pessoa_fisica = $dados['data']['pessoa_fisica'] ?? [];

?>

<?php formTitulo("Cadastrar Currículo", $exibeNovo) ?>

<div class="form-card">

    <form method="POST" action="<?= $this->request->formAction() ?>" enctype="multipart/form-data">

        <input type="hidden" name="pessoa_fisica_id" id="pessoa_fisica_id" value="<?= $dados['data'][0]['pessoa_fisica_id'] ?>">
        <?php if (trim($curriculo['foto']) != ""): ?>
            <div class="text-center mb-4">
                <h5>Foto</h5>
                <img src="<?= baseUrl() . 'imagem.php?file=curriculum/' . $curriculo['foto'] ?>"
                    class="img-thumbnail mx-auto d-block"
                    style="height: 180px; width: 240px;"
                    alt="Foto do Currículo">
                <input type="hidden" name="nomeImagem" id="nomeImagem" value="<?= $curriculo['foto'] ?>">
            </div>
        <?php endif; ?>

        <?php if (in_array($this->request->getAction(), ['insert', 'update'])): ?>
            <div class="mb-4">
                <label for="foto" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="foto" name="foto" maxlength="100">
                <?= setMsgFilderError('foto') ?>
            </div>
        <?php endif; ?>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Logradouro</label>
                <input type="text" class="form-control" name="logradouro" value="<?= setValor('logradouro', $curriculo['logradouro'] ?? '') ?>" maxlength="60" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Número</label>
                <input type="text" class="form-control" name="numero" value="<?= setValor('numero', $curriculo['numero'] ?? '') ?>" maxlength="4">
            </div>
            <div class="col-md-4">
                <label class="form-label">Complemento</label>
                <input type="text" class="form-control" name="complemento" value="<?= setValor('complemento', $curriculo['complemento'] ?? '') ?>" maxlength="20">
            </div>

            <div class="col-md-6">
                <label class="form-label">Bairro</label>
                <input type="text" class="form-control" name="bairro" value="<?= setValor('bairro', $curriculo['bairro'] ?? '') ?>" maxlength="50">
            </div>
            <div class="col-md-3">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control" name="cep" value="<?= setValor('cep', $curriculo['cep'] ?? '') ?>" maxlength="8" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Cidade</label>
                <select name="cidade_id" class="form-select" required>
                    <option value="">Selecione uma cidade</option>
                    <?php foreach ($dados['aCidade'] as $cidade): ?>
                        <option value="<?= $cidade['id'] ?>" <?= setValor('cidade_id', $curriculo['cidade_id'] ?? '') == $cidade['id'] ? 'selected' : '' ?>>
                            <?= $cidade['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Celular</label>
                <input type="text" class="form-control" name="celular" value="<?= setValor('celular', $curriculo['celular'] ?? '') ?>" maxlength="11">
            </div>
            <div class="col-md-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= setValor('email', $curriculo['email'] ?? '') ?>" maxlength="120">
            </div>
            <div class="col-md-2">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpf" value="<?= setValor('cpf', $pessoa_fisica[0]['cpf'] ?? '') ?>" maxlength="11" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Nascimento</label>
                <input type="date" class="form-control" name="nascimento" value="<?= setValor('nascimento', $curriculo['nascimento'] ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sexo</label>
                <select name="sexo" class="form-select">
                    <option value="M" <?= setValor('sexo', $curriculo['sexo'] ?? '') == 'M' ? 'selected' : '' ?>>Masculino</option>
                    <option value="F" <?= setValor('sexo', $curriculo['sexo'] ?? '') == 'F' ? 'selected' : '' ?>>Feminino</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Apresentação Pessoal</label>
                <textarea class="form-control" name="apresentacaoPessoal" rows="3"><?= setValor('apresentacaoPessoal', $curriculo['apresentacaoPessoal'] ?? '') ?></textarea>
            </div>
        </div>

        <hr>

        <!-- Escolaridade -->
        <h5 class="section-title">Escolaridade</h5>
        <div id="escolaridade-container">
            <?php if (empty($escolaridades)) $escolaridades[] = []; ?>
            <?php foreach ($escolaridades as $i => $esc): ?>


                <div class="escolaridade-item item-container">
                    <?php if (!empty($esc['id'])): ?>
                        <input type="hidden" name="escolaridade[<?= $i ?>][id]" value="<?= $esc['id'] ?>">
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label>Início (Ano)</label>
                            <input type="number" class="form-control" name="escolaridade[<?= $i ?>][inicioAno]" value="<?= setValor("escolaridade[{$i}][inicioAno]", $esc['inicioAno'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Fim (Mês/Ano)</label>
                            <div class="d-flex gap-2">
                                <input type="number" class="form-control" name="escolaridade[<?= $i ?>][fimMes]" value="<?= setValor("escolaridade[{$i}][fimMes]", $esc['fimMes'] ?? '') ?>">
                                <input type="number" class="form-control" name="escolaridade[<?= $i ?>][fimAno]" value="<?= setValor("escolaridade[{$i}][fimAno]", $esc['fimAno'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Instituição</label>
                            <input type="text" class="form-control" name="escolaridade[<?= $i ?>][instituicao]" value="<?= setValor("escolaridade[{$i}][instituicao]", $esc['instituicao'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Descrição</label>
                            <input type="text" class="form-control" name="escolaridade[<?= $i ?>][descricao]" value="<?= setValor("escolaridade[{$i}][descricao]", $esc['descricao'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Cidade</label>
                            <select name="escolaridade[<?= $i ?>][cidade_id]" class="form-select">
                                <option value="">Selecione uma cidade</option>
                                <?php foreach ($dados['aCidade'] as $cidade): ?>
                                    <option value="<?= $cidade['id'] ?>" <?= setValor("escolaridade[{$i}][cidade_id]", $esc['cidade_id'] ?? '') == $cidade['id'] ? 'selected' : '' ?>>
                                        <?= $cidade['nome'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Escolaridade</label>
                            <select name="escolaridade[<?= $i ?>][escolaridade_id]" class="form-select">
                                <option value="">Selecione uma escolaridade</option>
                                <?php foreach ($dados['aEscolaridade'] as $escolaridade): ?>
                                    <option value="<?= $escolaridade['id'] ?>" <?= setValor("escolaridade[{$i}][escolaridade_id]", $esc['escolaridade_id'] ?? '') == $escolaridade['id'] ? 'selected' : '' ?>>
                                        <?= $escolaridade['descricao'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" onclick="duplicar('escolaridade-container', 'escolaridade-item')" class="btn btn-sm btn-outline-secondary mb-3">+ Escolaridade</button>

        <hr>

        <!-- Experiência -->
        <h5 class="section-title">Experiência Profissional</h5>
        <div id="experiencia-container">
            <?php if (empty($experiencias)) $experiencias[] = []; ?>
            <?php foreach ($experiencias as $i => $exp): ?>


                <div class="experiencia-item item-container">
                    <?php if (!empty($exp['id'])): ?>
                        <input type="hidden" name="experiencia[<?= $i ?>][id]" value="<?= $exp['id'] ?>">
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label>Estabelecimento</label>
                            <input type="text" class="form-control" name="experiencia[<?= $i ?>][estabelecimento]" value="<?= setValor("experiencia[{$i}][estabelecimento]", $exp['estabelecimento'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Cargo</label>
                            <select name="experiencia[<?= $i ?>][cargo_id]" class="form-select">
                                <option value="">Selecione um cargo</option>
                                <?php foreach ($dados['aCargo'] as $cargo): ?>
                                    <option value="<?= $cargo['id'] ?>" <?= setValor("experiencia[{$i}][cargo_id]", $exp['cargo_id'] ?? '') == $cargo['id'] ? 'selected' : '' ?>>
                                        <?= $cargo['descricao'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Descrição do Cargo</label>
                            <input type="text" class="form-control" name="experiencia[<?= $i ?>][cargoDescricao]" value="<?= setValor("experiencia[{$i}][cargoDescricao]", $exp['cargoDescricao'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Atividade Exercida</label>
                            <textarea class="form-control" name="experiencia[<?= $i ?>][atividadeExercida]" rows="2"><?= setValor("experiencia[{$i}][atividadeExercida]", $exp['atividadeExercida'] ?? '') ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Período (Início Ano / Fim Mês/Ano)</label>
                            <div class="d-flex gap-2">
                                <input type="number" class="form-control" name="experiencia[<?= $i ?>][inicioAno]" value="<?= setValor("experiencia[{$i}][inicioAno]", $exp['inicioAno'] ?? '') ?>">
                                <input type="number" class="form-control" name="experiencia[<?= $i ?>][fimMes]" value="<?= setValor("experiencia[{$i}][fimMes]", $exp['fimMes'] ?? '') ?>">
                                <input type="number" class="form-control" name="experiencia[<?= $i ?>][fimAno]" value="<?= setValor("experiencia[{$i}][fimAno]", $exp['fimAno'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" onclick="duplicar('experiencia-container', 'experiencia-item')" class="btn btn-sm btn-outline-secondary mb-3">+ Experiência</button>

        <hr>

        <!-- Qualificação -->
        <h5 class="section-title">Qualificação</h5>
        <div id="qualificacao-container">
            <?php if (empty($qualificacoes)) $qualificacoes[] = []; ?>
            <?php foreach ($qualificacoes as $i => $qual): ?>


                <div class="qualificacao-item item-container">
                    <?php if (!empty($qual['id'])): ?>
                        <input type="hidden" name="qualificacao[<?= $i ?>][id]" value="<?= $qual['id'] ?>">
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label>Mês</label>
                            <input type="number" class="form-control" name="qualificacao[<?= $i ?>][mes]" value="<?= setValor("qualificacao[{$i}][mes]", $qual['mes'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Ano</label>
                            <input type="number" class="form-control" name="qualificacao[<?= $i ?>][ano]" value="<?= setValor("qualificacao[{$i}][ano]", $qual['ano'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Carga Horária</label>
                            <input type="number" class="form-control" name="qualificacao[<?= $i ?>][cargaHoraria]" value="<?= setValor("qualificacao[{$i}][cargaHoraria]", $qual['cargaHoraria'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Descrição</label>
                            <input type="text" class="form-control" name="qualificacao[<?= $i ?>][descricao]" value="<?= setValor("qualificacao[{$i}][descricao]", $qual['descricao'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Estabelecimento</label>
                            <input type="text" class="form-control" name="qualificacao[<?= $i ?>][estabelecimento]" value="<?= setValor("qualificacao[{$i}][estabelecimento]", $qual['estabelecimento'] ?? '') ?>">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" onclick="duplicar('qualificacao-container', 'qualificacao-item')" class="btn btn-sm btn-outline-secondary mb-3">+ Qualificação</button>

        <input type="hidden" name="usuario_id" value="<?= Session::get('userNivel') ?>">
        <?php if ($curriculo['id'] != "" && $curriculo['id'] != "0"): ?>
            <input type="hidden" name="id" id="id" value="<?= $curriculo['id'] ?>">
        <?php endif; ?>

        <hr>
        <div class="d-grid">
            <?= formButton("Salvar Currículo") ?>
        </div>

    </form>
</div>

<script>
    function duplicar(containerId, className) {
        const container = document.getElementById(containerId);
        const items = container.querySelectorAll('.' + className);
        const lastItem = items[items.length - 1];
        const clone = lastItem.cloneNode(true);
        const index = items.length;

        clone.querySelectorAll('[name]').forEach(function(input) {
            input.name = input.name.replace(/\[\d+\]/, `[${index}]`);

            if (input.type !== 'file') {
                input.value = '';
            }

            // Limpa sempre o campo 'id' se for hidden
            if (input.type === 'hidden' && input.name.includes('[id]')) {
                input.value = '';
            }
        });

        container.appendChild(clone);
    }
</script>