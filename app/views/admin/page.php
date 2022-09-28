<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Pages</h3>
    </div>
    <hr>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <i class="fas fa-scroll"></i> Create Page
                </div>
                <div class="card-body">
                    <form class="user" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Path:</h4>
                                <input type="text" name="path_page" value="<?= $pages->path ?>" class="form-control" id="exampleInputEmail" placeholder="Path Page">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Name:</h4>
                                <input type="text" name="name_page" value="<?= $pages->name ?>" class="form-control" id="exampleInputEmail" placeholder="Name Page">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Menu:</h4>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="id_menu">
                                    <?php foreach ($menu as $value) { ?>
                                        <option value="<?= $value->id ?>" <?= $value->id == $pages->id ? 'selected' : '' ?> ><?= $value->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Access:</h4>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="access_id_permission">
                                    <?php foreach ($permission as $value) { ?>
                                        <option value="<?= $value->id ?>" <?= $value->id == $pages->access_id_permission ? 'selected' : '' ?> ><?= $value->name ?> [<?= $value->value ?>]</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <h4 class="small font-weight-bold">Status:</h4>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="active_page" value="1" class="form-check-input" id="exampleCheck1" <?= $pages->active ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="exampleCheck1">Active Page</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <input type="submit" class="btn btn-success" name="exec" value="Save"/>
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

        <?php if ($all) { ?>
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <i class="fas fa-scroll"></i> Created Page
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Path</th>
                                <th scope="col">Name</th>
                                <th scope="col">Access</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan="2"></th>
                            </tr>
                        </thead>
                        <?php foreach ($all as $value) { ?>
                            <tbody>
                                <tr>
                                    <th scope="row"><?= $value->id ?></th>
                                    <td><?= $value->path ?></td>
                                    <td><?= $value->name ?></td>
                                    <td><?= $value->access ?></td>
                                    <td><?= $value->active ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>" ?></td>
                                    <td> 
                                        <a href="<?= CONF_URL_BASE . "admin/page/edit/{$value->id}" ?>" class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                        </a>
                                        <a href="<?= CONF_URL_BASE . "admin/page/delete/{$value->id}" ?>" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
