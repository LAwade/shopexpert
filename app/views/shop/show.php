<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Produtos</h3>
    </div>
    <hr>
    <div class="row">
        <?php foreach ($categories as $category) { ?>
            <div class="col-sm-2 mb-3 mb-sm-0">
                <a class="btn btn-md btn-block <?= isset($selected) && $category->id == $selected ? "btn-primary" : "btn-outline-primary" ?> " href="<?= url("shop/show/{$category->id}") ?>"><?= $category->name ?></a>
            </div>
        <?php } ?>
    </div>

    <?php if (isset($products) && count($products)) { ?>
        <form method="POST" action="<?= url("shop/addcart/{$selected}") ?>">
            <div class="row py-3 text-center">
                <?php foreach ($products as $product) { ?>
                    <?php $valueTaxes = 0; ?>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal"><?= $product->name ?></h4>
                            </div>
                            <div class="card-body">
                                <?php foreach ($product->taxes as $taxes) { ?>
                                    <?php $valueTaxes += $product->price * $taxes->rate; ?>
                                <?php } ?>
                                <h3 class="card-title pricing-card-title">R$ <?= str_format_reais($product->price + $valueTaxes) ?></h3>
                                <?php $description = explode("|", $product->description) ?>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <?php foreach ($description as $dsc) { ?>
                                        <li>- <?= trim($dsc) ?></li>
                                    <?php } ?>
                                </ul>
                                <input type="submit" class="btn btn-lg btn-block btn-outline-primary" name="product[<?= $product->id ?>]" value="Comprar" />
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </form>
    <?php } else { ?>
        <div class="row py-5 text-center">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="mb-4">
                    <h4>Não foi cadastrado nenhum item nessa sessão!</h4>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <?= session()->flash(); ?>
        </div>
    </div>
</div>