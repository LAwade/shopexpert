<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Taxas de Categorias de Produtos</h3>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Atribuir ou Remover
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="<?= url("categorytax/store") ?>">
                        <div class="form-group row">
                            <div class="col-md-4 mb-3">
                                <select name="category_id" class="form-control" id="region">
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category->id ?>" <?= isset($selected) && $category->id == $selected ? "selected" : ""; ?>><?= $category->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="submit" class="btn btn-primary" name="select" value="Selecionar" />
                            </div>
                        </div>

                        <?php if (isset($taxes) || isset($categorytaxes)) { ?>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <h4 class="small font-weight-bold">Disponível (Taxa/Imposto)</h4>
                                    <select name="tax_id_add" class="custom-select" id="region" multiple>
                                        <?php foreach ($taxes as $tax) { ?>
                                            <option value="<?= $tax->id ?>"><?= $tax->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-1 d-flex flex-column align-self-center">
                                    &nbsp;
                                    <input type="submit" class="btn btn-success" name="add" value="Adicionar >" />
                                    &nbsp;
                                    <input type="submit" class="btn btn-danger" name="rm" value="< Remover" />
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <h4 class="small font-weight-bold">Incluído(s) (Taxa/Imposto)</h4>
                                    <select name="tax_id_rm" class="custom-select" id="region" multiple>
                                        <?php foreach ($categorytaxes as $ctax) { ?>
                                            <option value="<?= $ctax->ctx_id ?>"><?= $ctax->tax_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <?= session()->flash(); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header">
                    <i class="far fa-question-circle"></i> Legenda
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <p class="text-monospace">> Adicione ou Remova o Imposto da Categoria do Produto.</p>
                            <p class="text-monospace">1. Selecione a categoria do produto para ver os impostos disponíveis e os já atribuidos.</p>
                            <p class="text-monospace">2. Seleciona o Imposto da esquerda e adiocione para direita, isso para atribuir o imposto.</p>
                            <p class="text-monospace">3. Seleciona o Imposto da direita e remova para direita, isso para remover atribuir o imposto.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>