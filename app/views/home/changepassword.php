<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mt-4">Change Password</h3>
    </div>
    <hr>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-key"></i> Enter passwords
                </div>
                <div class="card-body">
                    <form class="user" method="POST">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" minlength="5" maxlength="20" aria-describedby="nova_senha" placeholder="New Password" require>
                        </div>
                        <div class="form-group">
                            <input type="password" name="repassword" class="form-control" minlength="5" maxlength="20" aria-describedby="conf_senha" placeholder="Confirm Password" require>
                        </div>
                        <input type="submit" name="exec" value="Change" class="btn btn-primary btn-user btn-block"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <?= session()->flash(); ?>
        </div>
    </div>
</div>
