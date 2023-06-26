<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Permission</h3>
    </div>
    <hr>
    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <i class="fas fa-user-shield"></i> Create
                </div>
                <div class="card-body">
                    <form class="user" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Name:</h4>
                                <input type="text" name="name" value="<?= $permission->name ?>" class="form-control" id="exampleInputEmail" placeholder="Name Permission">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Value Acess:</h4>
                                <input type="number" name="value" value="<?= $permission->value ?>" min="1" max="100" class="form-control" id="exampleInputEmail" placeholder="Value">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Default:</h4>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="is_default" value="1" class="form-check-input" id="exampleCheck1" <?= $permission->is_default ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="exampleCheck1">Default</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Status:</h4>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="active" value="1" class="form-check-input" id="exampleCheck1" <?= $permission->active ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="exampleCheck1">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <?= session()->flash(); ?>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <input type="submit" class="btn btn-success" value="Save"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <i class="fas fa-user-check"></i> Created
                </div>
                <?php foreach ($permissions as $value) { ?>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Name: <?= $value->name ?></h4>
                        <h4 class="small font-weight-bold">Value:  <?= $value->value ?></h4>
                        <h4 class="small font-weight-bold">Register:  <?= date_hours_br($value->created_at) ?></h4>
                        <h4 class="small font-weight-bold">Default: <i class="fas fa-circle text-<?= $value->is_default ? 'success' : 'danger'; ?>"></i></h4>
                        <h4 class="small font-weight-bold">Status: <i class="fas fa-circle text-<?= $value->active ? 'success' : 'danger'; ?>"></i></h4>

                        <a href="<?= CONF_URL_BASE . "/admin/permission/edit/{$value->id}" ?>" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                        </a>
                        <a href="<?= CONF_URL_BASE . "/admin/permission/delete/{$value->id}" ?>" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>
                    </div>
                    <hr>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
