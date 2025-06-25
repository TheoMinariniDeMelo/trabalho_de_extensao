<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 1200px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-4">
            <h3 class="fw-bold mb-0">Cadastro de Cidade</h3>
            <hr>
        </div>

        <form method="POST" action="<?= $this->request->formAction() ?>">

            <input type="hidden" name="id" id="id" value="<?= setValor("id") != "" ? setValor("id") : 0 ?>">

            <div class="mb-3">
                <label for="nome" class="form-label fw-semibold">Nome</label>
                <input type="text" class="form-control"
                    id="nome"
                    name="nome"
                    placeholder="Nome da Cidade"
                    maxlength="50"
                    value="<?= setValor("nome") ?>"
                    required
                    autofocus>
                <?= setMsgFilderError("nome") ?>
            </div>

            <div class="row">
                <div class="col-md-9 mb-3">
                    <label for="uf_id" class="form-label fw-semibold">UF</label>
                    <select class="form-select"
                        id="uf_id"
                        name="uf_id"
                        required>
                        <option value="">...</option>
                        <?php foreach ($dados['aUf'] as $value): ?>
                            <option value="<?= $value['id'] ?>" <?= ($value['id'] == setValor("uf_id") ? 'selected' : '') ?>>
                                <?= htmlspecialchars($value['sigla'] . ' - ' . $value['descricao']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= setMsgFilderError("uf_id") ?>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="codIBGE" class="form-label fw-semibold">Código do IBGE</label>
                    <input type="text" class="form-control"
                        id="codIBGE"
                        name="codIBGE"
                        placeholder="Código do IBGE"
                        maxlength="7"
                        value="<?= setValor("codIBGE") ?>"
                        required>
                    <?= setMsgFilderError("codIBGE") ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="wiki" class="form-label fw-semibold">Wiki sobre a cidade</label>
                <textarea class="form-control" id="wiki" name="wiki" rows="6"><?= setValor("wiki") ?></textarea>
                <?= setMsgFilderError("wiki") ?>
            </div>

            <div class="d-grid mt-4">
                <?= formButton() ?>
            </div>

        </form>

    </div>
</div>

<script src="<?= baseUrl() ?>assets/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>

<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#wiki'))
        .catch(error => {
            console.error(error);
        });
</script>