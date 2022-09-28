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
                    <div class="text-center py-2">
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
                                                <label>Full Name:</label>
                                                <input type="text" minlength="5" maxlength="150" class="form-control form-validate-letter" id="exampleFirstName" name="name" placeholder="Full Name" required>
                                            </div>

                                            <div class="form-group">
                                                <label>E-mail:</label>
                                                <input type="email" minlength="3" maxlength="150" class="form-control" id="email" name="mail" placeholder="E-mail" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Password:</label>
                                                <input type="password" minlength="5" maxlength="20" class="form-control" id="password" name="password" placeholder="Password" required >  
                                            </div>

                                            <div class="form-group">
                                                <label>Confirm Password:</label>
                                                <input type="password" minlength="5" maxlength="20" class="form-control" id="repassword" name="repassword" placeholder="Confirme Password" required >  
                                            </div>
                                            <input type="submit" class="btn btn-primary btn-block" value="Create Now"/>
                                        </form>
                                        <?= $this->message()->render(); ?>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= CONF_URL_BASE ?>index/forgotpassword">Forgot your password?</a>
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
