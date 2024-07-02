<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Relatórios de Vendas</h3>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="accordion" id="accordionExample">
                <?php foreach ($all as $value) { ?>
                    <div class="card">
                        <div class="card-header" id="heading<?= $value->id ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $value->id ?>" aria-expanded="true" aria-controls="collapse<?= $value->id ?>">
                                    Venda #<?= $value->id ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse<?= $value->id ?>" class="collapse" aria-labelledby="heading<?= $value->id ?>" data-parent="#accordionExample">
                            <div class="card-body">
                                <h3>Produtos da Venda</h3>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Preço</th>
                                            <th scope="col">Impostos</th>
                                            <th scope="col">Categoria</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $amount = 0; ?>
                                        <?php $amountTaxes = 0; ?>
                                        <?php foreach ($value->products as $product) { ?>
                                            <?php $producttaxes = 0; ?>
                                            <?php
                                            foreach ($value->taxes as $taxe) {
                                                $producttaxes += $product->price * $taxe->rate;
                                                $amountTaxes += $producttaxes;
                                            }
                                            ?>
                                            <?php $amount += $product->price; ?>
                                            <tr>
                                                <td><?= $product->id ?></td>
                                                <td><?= $product->name ?></td>
                                                <td>R$ <?= str_format_reais($product->price) ?></td>
                                                <td>R$ <?= str_format_reais($producttaxes) ?></td>
                                                <td><?= $product->category_name ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tr>
                                            <th colspan="5"><i>Valor total dos Produtos R$ <?= str_format_reais($amount) ?></i></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5"><i>Valor Produtos + Impostos R$ <?= str_format_reais($amount + $amountTaxes) ?></i></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>