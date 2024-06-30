<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Produtos</h3>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Cadastrar
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="<?= url("product/save" . (isset($product->id) ? "/$product->id" : "")) ?>">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Nome:</h4>
                                <input type="text" name="name" value="<?= $product->name ?? '' ?>" class="form-control" id="name" placeholder="Nome do Imposto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Descrição:</h4>
                                <input type="float" name="description" value="<?= $product->description ?? '' ?>" class="form-control" id="description" placeholder="Descrição do Produto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Preço: </h4>
                                <input type="float" name="price" value="<?= $product->price ?? '' ?>" class="form-control" id="price" placeholder="Valor do produto">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Categoria:</h4>
                                <select name="category_id" class="form-control" id="region">
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category->id ?>" <?= isset($product->category_id) && strtoupper($category->id) == strtoupper($product->category_id) ? "selected" : ""; ?>><?= $category->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Status:</h4>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="active" value="1" class="form-check-input" id="active" <?= isset($product->active) && $product->active ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="exampleCheck1">Ativo</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <input type="submit" class="btn btn-success" name="exec" value="Salvar" />
                            </div>
                        </div>
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

        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <i class="fas fa-scroll"></i> Registros
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Status</th>
                            <th scope="col">Registrado</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!count($all)) { ?>
                            <tr>
                                <td colspan="10" align="center">Nenhum registro até o momento!</td>
                            </tr>
                        <?php } ?>
                        <?php foreach ($all as $value) { ?>
                            <tr>
                                <th scope="row"><?= $value->id ?></th>
                                <td><?= $value->name ?></td>
                                <td><?= $value->description ?></td>
                                <td>R$ <?= str_format_reais($value->price) ?></td>
                                <td><?= $value->category_name ?></td>
                                <td><?= $value->active ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" ?></td>
                                <td><?= date_hours_br($value->created_at) ?></td>
                                <td>
                                    <a href="<?= CONF_URL_BASE . "/product/edit/{$value->id}" ?>" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                    </a>
                                    <a href="<?= CONF_URL_BASE . "/product/delete/{$value->id}" ?>" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>