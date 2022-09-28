<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include __DIR__ . '/header.php'; ?>
    </head>

    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-12 col-md-9">
                    <br>
                    <div class="form-group text-center py-2">
                        <img src="<?= CONF_MAIN_LOGO ?>">
                    </div>
                    <div class="card o-hidden border-0 shadow-lg my-3">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <form class="user" method="POST">
                                            <div class="form-group">
                                                <div class="small mb-3 text-muted">Validation is done at the same source as the password recovery request.</div>
                                            </div>
                                            <div class="form-group">
                                                <label>E-mail:</label>
                                                <input type="email" name="mail_client" class="form-control" id="email" aria-describedby="email" placeholder="Your account e-mail">
                                            </div>
                                            <input type="submit" class="btn btn-primary btn-block" value="Send by E-mail">
                                        </form>
                                        <?= $this->message()->render(); ?>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= CONF_URL_BASE ?>index/createaccount">Create Account!</a>
                                        </div>
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