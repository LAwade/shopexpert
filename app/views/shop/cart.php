<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Meu Carrinho</h3>
    </div>
    <hr>
    <div class="row">
        <?php if (isset($products)) { ?>
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Itens adicionados</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php $amountTaxes = 0; ?>
                    <?php $amount = 0; ?>
                    <?php foreach ($products as $product) { ?>
                        <?php $valueTaxes = 0; ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?= $product->name ?> <span class="badge badge-secondary badge-pill"><?= $product->quantity ?></span></h6>
                                <p class="text-muted"><?= $product->description ?></p>
                                <?php foreach ($product->taxes as $taxes) { ?>
                                    <?php $amountTaxes += ($product->price * $product->quantity) * $taxes->rate; ?>
                                    <?php $valueTaxes += ($product->price * $product->quantity) * $taxes->rate; ?>
                                    <small class="text-muted">Imposto <?= $taxes->name . " R$ " . str_format_reais(($product->price * $product->quantity) * $taxes->rate) ?></small>
                                    <br>
                                <?php } ?>
                            </div>
                            <?php $amount += ($product->price * $product->quantity) + $valueTaxes; ?>
                            <span class="text-muted">R$ <?= str_format_reais(($product->price * $product->quantity) + $valueTaxes) ?></span>
                        </li>
                    <?php } ?>

                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-danger">
                            <h6 class="my-0">Taxas e Impostos</h6>
                            <small>Valor apenas dos impostos e taxas</small>
                        </div>
                        <span class="text-success">R$ <?= str_format_reais($amountTaxes) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (REAL)</span>
                        <strong>R$ <?= str_format_reais($amount) ?></strong>
                    </li>
                </ul>
                <form method="POST" action="<?= url('shop/sale') ?>">
                    <input type="submit" class="btn btn-success" value="Finalizar Compra"/>
                </form>
            </div>
        <?php } ?>
    </div>

    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <?= session()->flash(); ?>
        </div>
    </div>
</div>