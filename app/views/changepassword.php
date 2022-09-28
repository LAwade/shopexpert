<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include __DIR__ . '/header.php'; ?>
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-12 col-md-9">
                    <br>
                    <div class="form-group text-center py-2">
                        <img src="<?= CONF_MAIN_LOGO ?>">
                    </div>
                    <div class="card o-hidden border-0 shadow-lg my-3">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <form class="user" method="POST">
                                            <div class="form-group">
                                                <label>New Password:</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required >  
                                            </div>

                                            <div class="form-group">
                                                <label>Confirm Password:</label>
                                                <input type="password" class="form-control" id="password" name="repassword" placeholder="Confirm Password" required >  
                                            </div>
                                            <input type="submit" name="exec" class="btn btn-primary btn-block" value="Change"/>
                                        </form>
                                        <?= $this->message()->render(); ?>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= CONF_URL_BASE ?>index">Login!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include __DIR__ . '/js.php'; ?>
    </body>
</html>
