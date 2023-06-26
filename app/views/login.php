<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include __DIR__ . '/header.php'; ?>
    </head>
    <body class="bg-muted">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <br>
                                <div class="form-group text-center py-2">
                                    <img src="<?= CONF_MAIN_LOGO ?>">
                                </div>
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
                                     <div class="p-5">
                                        <form class="user" method="POST">
                                            <div class="form-group">
                                                <label for="email">E-mail:</label>
                                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-mail" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="senha">Password:</label>
                                                <input type="password" name="password" class="form-control" id="senha" placeholder="Password" required>
                                            </div>
                                            <input type="submit" class="btn btn-primary btn-block" value="Login"/>
                                        </form>
                                        <?= $this->message()->render(); ?>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="<?= CONF_URL_BASE ?>/index/forgotpassword">Forgot Password?</a>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="<?= CONF_URL_BASE ?>/index/createaccount">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php include __DIR__ . '/js.php'; ?>
    </body>
</html>