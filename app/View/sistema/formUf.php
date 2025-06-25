<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 1200px; width: 100%; border-radius: 1rem;">

        <div class="text-center mb-4">
            <h3 class="fw-bold mb-0">Cadastro de UF</h3>
            <hr>
        </div>

        <form method="POST" action="<?= $this->request->formAction() ?>" enctype="multipart/form-data">

            <input type="hidden" name="id" id="id" value="<?= setValor("id") != "" ? setValor("id") : 0 ?>">

            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="sigla" class="form-label fw-semibold">Sigla</label>
                    <input type="text" class="form-control"
                        id="sigla"
                        name="sigla"
                        placeholder="Sigla UF"
                        maxlength="2"
                        value="<?= setValor("sigla") ?>"
                        required
                        autofocus>
                    <?= setMsgFilderError("sigla") ?>
                </div>

                <div class="col-md-10 mb-3">
                    <label for="descricao" class="form-label fw-semibold">Descrição</label>
                    <input type="text" class="form-control"
                        id="descricao"
                        name="descricao"
                        placeholder="Descrição da UF"
                        maxlength="50"
                        value="<?= setValor("descricao") ?>"
                        required>
                    <?= setMsgFilderError("descricao") ?>
                </div>
            </div>

            <?php if (in_array($this->request->getAction(), ['insert', 'update'])): ?>
                <div class="mb-3">
                    <label for="bandeira" class="form-label fw-semibold">Imagem da Bandeira da UF</label>
                    <input type="file" class="form-control" id="bandeira" name="bandeira" placeholder="Anexar a Imagem da Bandeira da UF" maxlength="100" value="<?= setValor('bandeira') ?>">
                    <?= setMsgFilderError('bandeira') ?>
                </div>
            <?php endif; ?>

            <?php if (trim(setValor("bandeira")) != ""): ?>
                <div class="mb-3 text-center">
                    <h5>Imagem Atual</h5>
                    <img src="<?= baseUrl() . 'imagem.php?file=uf/' . setValor("bandeira") ?>" class="img-thumbnail" height="120" width="240" alt="Imagem Bandeira UF">
                    <input type="hidden" name="nomeImagem" id="nomeImagem" value="<?= setValor("bandeira") ?>">
                </div>
            <?php endif; ?>

            <div class="d-grid mt-4">
                <?= formButton() ?>
            </div>

        </form>

    </div>
</div>