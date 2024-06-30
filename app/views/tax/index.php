<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Taxas/Impostos</h3>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Cadastrar
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="<?= url("tax/save" . (isset($tax->id) ? "/$tax->id" : "")) ?>">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Nome:</h4>
                                <input type="text" name="name" value="<?= $tax->name ?? '' ?>" class="form-control" id="name" placeholder="Nome do Imposto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Valor(Decimal): <i>OBS: Valor aceito de 0.0 até 1.0</i></h4>
                                <input type="float" name="rate" value="<?= $tax->rate ?? '' ?>" class="form-control" id="rate" placeholder="Valor do Tributo. Exemplo: 0.4 (40%)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Estado(UF):</h4>
                                <select name="region" class="form-control" id="region" >
                                    <?php foreach($estados as $k => $state){ ?>
                                        <option value="<?= $k ?>" <?= isset($tax->region) && strtoupper($k) == strtoupper($tax->region) ? "selected" : ""; ?> ><?= $state . " - " . $k ?></option>
                                    <?php } ?>
                                </select>
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
                            <th scope="col">Valor</th>
                            <th scope="col">Estado(UF)</th>
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
                                <td><?= $value->rate ?></td>
                                <td><?= $value->region ?></td>
                                <td>
                                    <a href="<?= CONF_URL_BASE . "/tax/edit/{$value->id}" ?>" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                    </a>
                                    <a href="<?= CONF_URL_BASE . "/tax/delete/{$value->id}" ?>" class="btn btn-danger btn-icon-split">
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