<?= formTitulo("Cadastrar Currículo") ?>

<?php

// var_dump($dados);
// exit;

?>

<form method="POST" action="<?= $this->request->formAction() ?>" enctype="multipart/form-data">

    <!-- Dados principais -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="logradouro">Logradouro</label>
            <input type="text" class="form-control" name="logradouro" value="<?= setValor("logradouro") ?>" maxlength="60" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="numero">Número</label>
            <input type="text" class="form-control" name="numero" value="<?= setValor("numero") ?>" maxlength="4">
        </div>
        <div class="col-md-4 mb-3">
            <label for="complemento">Complemento</label>
            <input type="text" class="form-control" name="complemento" value="<?= setValor("complemento") ?>" maxlength="20">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" name="bairro" value="<?= setValor("bairro") ?>" maxlength="50">
        </div>
        <div class="col-md-3 mb-3">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" name="cep" value="<?= setValor("cep") ?>" maxlength="8" required >
        </div>
        <div class="col-md-3 mb-3">
            <label for="cidade_id">Cidade</label>
            <select name="cidade_id" class="form-control" required>
                <option value="">Selecione uma cidade</option>
                <?php foreach ($dados['aCidade'] as $cidade): ?>
                    <option value="<?= $cidade['id'] ?>" <?= setValor("cidade_id") == $cidade['id'] ? 'selected' : '' ?>>
                        <?= $cidade['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="celular">Celular</label>
            <input type="text" class="form-control" name="celular" value="<?= setValor("celular") ?>" maxlength="11">
        </div>
        <div class="col-md-4 mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?= setValor("email") ?>" maxlength="120">
        </div>
        <div class="col-md-4 mb-3">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" name="foto">
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="nascimento">Nascimento</label>
            <input type="date" class="form-control" name="nascimento" value="<?= setValor("nascimento") ?>">
        </div>
        <div class="col-md-3 mb-3">
            <label for="sexo">Sexo</label>
            <select name="sexo" class="form-control">
                <option value="M" <?= setValor("sexo") == 'M' ? 'selected' : '' ?>>Masculino</option>
                <option value="F" <?= setValor("sexo") == 'F' ? 'selected' : '' ?>>Feminino</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="apresentacaoPessoal">Apresentação Pessoal</label>
            <textarea name="apresentacaoPessoal" class="form-control"><?= setValor("apresentacaoPessoal") ?></textarea>
        </div>
    </div>

    <hr>

    <!-- Escolaridade -->
    <h5>Escolaridade</h5>
    <div id="escolaridade-container">
        <div class="escolaridade-item border p-3 mb-2">
            <div class="row">
                <div class="col-md-3">
                    <label>Início (Ano)</label>
                    <input type="number" class="form-control" name="escolaridade[0][inicioAno]">
                </div>
                <div class="col-md-3">
                    <label>Fim (Mês/Ano)</label>
                    <div class="d-flex">
                        <input type="number" class="form-control me-2" name="escolaridade[0][fimMes]" placeholder="Mês">
                        <input type="number" class="form-control" name="escolaridade[0][fimAno]" placeholder="Ano">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Instituição</label>
                    <input type="text" class="form-control" name="escolaridade[0][instituicao]">
                </div>
                <div class="col-md-6 mt-2">
                    <label>Descrição</label>
                    <input type="text" class="form-control" name="escolaridade[0][descricao]">
                </div>
                <div class="col-md-3 mt-2">
                    <label>Cidade</label>
                    <select name="escolaridade[0][cidade_id]" class="form-control">
                        <option value="">Selecione uma cidade</option>
                        <?php foreach ($dados['aCidade'] as $cidade): ?>
                            <option value="<?= $cidade['id'] ?>">
                                <?= $cidade['nome'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3 mt-2">
                    <label>Escolaridade</label>
                    <select name="escolaridade[0][escolaridade_id]" class="form-control">
                        <option value="">Selecione uma escolaridade</option>
                        <?php foreach ($dados['aEscolaridade'] as $escolaridade): ?>
                            <option value="<?= $escolaridade['id'] ?>">
                                <?= $escolaridade['descricao'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
        </div>
    </div>
    <button type="button" onclick="duplicar('escolaridade-container', 'escolaridade-item')" class="btn btn-sm btn-outline-secondary mb-3">+ Escolaridade</button>

    <hr>

    <!-- Experiência -->
    <h5>Experiência Profissional</h5>
    <div id="experiencia-container">
        <div class="experiencia-item border p-3 mb-2">
            <div class="row">
                <div class="col-md-4">
                    <label>Estabelecimento</label>
                    <input type="text" class="form-control" name="experiencia[0][estabelecimento]"  maxlength="60">
                </div>
                <div class="col-md-4">
                    <label>Cargo</label>
                    <select name="experiencia[0][cargo_id]" class="form-control">
                        <option value="">Selecione um cargo</option>
                        <?php foreach ($dados['aCargo'] as $cargo): ?>
                            <option value="<?= $cargo['id'] ?>">
                                <?= $cargo['descricao'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="col-md-4">
                    <label>Descrição do Cargo</label>
                    <input type="text" class="form-control" name="experiencia[0][cargoDescricao]" maxlength="60">
                </div>
                <div class="col-md-6 mt-2">
                    <label>Atividade Exercida</label>
                    <textarea class="form-control" name="experiencia[0][atividadeExercida]"></textarea>
                </div>
                <div class="col-md-6 mt-2">
                    <label>Período (Início Ano / Fim Mês/Ano)</label>
                    <div class="d-flex">
                        <input type="number" class="form-control me-2" name="experiencia[0][inicioAno]" placeholder="Início">
                        <input type="number" class="form-control me-2" name="experiencia[0][fimMes]" placeholder="Mês">
                        <input type="number" class="form-control" name="experiencia[0][fimAno]" placeholder="Ano">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" onclick="duplicar('experiencia-container', 'experiencia-item')" class="btn btn-sm btn-outline-secondary mb-3">+ Experiência</button>

    <hr>

    <!-- Qualificação -->
    <h5>Qualificação</h5>
    <div id="qualificacao-container">
        <div class="qualificacao-item border p-3 mb-2">
            <div class="row">
                <div class="col-md-3">
                    <label>Mês</label>
                    <input type="number" class="form-control" name="qualificacao[0][mes]">
                </div>
                <div class="col-md-3">
                    <label>Ano</label>
                    <input type="number" class="form-control" name="qualificacao[0][ano]">
                </div>
                <div class="col-md-3">
                    <label>Carga Horária</label>
                    <input type="number" class="form-control" name="qualificacao[0][cargaHoraria]" >
                </div>
                <div class="col-md-3">
                    <label>Descrição</label>
                    <input type="text" class="form-control" name="qualificacao[0][descricao]"  maxlength="60">
                </div>
                <div class="col-md-6 mt-2">
                    <label>Estabelecimento</label>
                    <input type="text" class="form-control" name="qualificacao[0][estabelecimento]"  maxlength="60">
                </div>
            </div>
        </div>
    </div>
    <button type="button" onclick="duplicar('qualificacao-container', 'qualificacao-item')" class="btn btn-sm btn-outline-secondary mb-3">+ Qualificação</button>

    <hr>
    <?= formButton("Salvar Currículo") ?>
</form>

<!-- Script para clonar campos -->
<script>
    function duplicar(containerId, className) {
        const container = document.getElementById(containerId);
        const items = container.querySelectorAll('.' + className);
        const lastItem = items[items.length - 1];
        const clone = lastItem.cloneNode(true);

        // Atualiza os índices dos nomes dos campos
        const index = items.length;
        clone.querySelectorAll('[name]').forEach(function(input) {
            input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
            input.value = '';
        });

        container.appendChild(clone);
    }
</script>