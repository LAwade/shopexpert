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
                    <i class="fas fa-user-shield"></i> Create Permission
                </div>
                <div class="card-body">
                    <form class="user" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Name:</h4>
                                <input type="text" name="name_permission" value="<?= $permission->name_permission ?>" class="form-control" id="exampleInputEmail" placeholder="Name Permission">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Value Acess:</h4>
                                <input type="number" name="value_permission" value="<?= $permission->value_permission ?>" min="1" max="100" class="form-control" id="exampleInputEmail" placeholder="Value">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Status:</h4>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="active_permission" value="true" class="form-check-input" id="exampleCheck1" <?= $permission->active_permission ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="exampleCheck1">Active Permission</label>
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
                    <i class="fas fa-user-check"></i> Permission Created
                </div>
                <?php foreach ($all as $value) { ?>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Name: <?= $value->name_permission ?></h4>
                        <h4 class="small font-weight-bold">Value:  <?= $value->value_permission ?></h4>
                        <h4 class="small font-weight-bold">Register:  <?= date_hours_br($value->register_permission) ?></h4>
                        <h4 class="small font-weight-bold">Status: <i class="fas fa-circle text-<?= $value->active_permission ? 'success' : 'danger'; ?>"></i></h4>

                        <a href="<?= CONF_URL_BASE . "admin/permission/edit/{$value->id_permission}" ?>" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                        </a>
                        <a href="<?= CONF_URL_BASE . "admin/permission/delete/{$value->id_permission}" ?>" class="btn btn-danger btn-icon-split">
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
