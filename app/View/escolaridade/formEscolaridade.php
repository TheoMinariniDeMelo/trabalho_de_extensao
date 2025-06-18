<?= formTitulo("Escolaridade") ?>

<div class="m-2">

    <form method="POST" action="<?= $this->request->formAction() ?>">

        <?php if (setValor("id") != "" && setValor("id") != "0"): ?>
            <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-12 mb-3">
                <label for="descricao" class="form-label">Descricao da categoria</label>
                <input type="text" class="form-control" 
                    id="descricao" 
                    name="descricao" 
                    placeholder="Descrição da categoria "
                    maxlength="50"
                    value="<?= setValor("descricao") ?>"
                    required
                    autofocus>
                <?= setMsgFilderError("descricao") ?>
            </div>
        </div>

        <?= formButton() ?>
    </form>

</div>
