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
                                                <label>Nome Completo:</label>
                                                <input type="text" minlength="5" value="<?= $name ?>" maxlength="150" class="form-control form-validate-letter" name="name" placeholder="Full Name" require>
                                            </div>

                                            <div class="form-group">
                                                <label>E-mail:</label>
                                                <input type="email" minlength="3" value="<?= $email ?>" maxlength="150" class="form-control" name="email" placeholder="E-mail" require>
                                            </div>

                                            <div class="form-group">
                                                <label>Senha:</label>
                                                <input type="password" minlength="5" maxlength="20" class="form-control" name="password" placeholder="Password" require>  
                                            </div>

                                            <div class="form-group">
                                                <label>Confirme Senha:</label>
                                                <input type="password" minlength="5" maxlength="20" class="form-control" name="repassword" placeholder="Confirme Password" require>  
                                            </div>
                                            <input type="submit" name="exec" class="btn btn-primary btn-block" value="Confirmar"/>
                                        </form>
                                        <?= $this->message()->render(); ?>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?= CONF_URL_BASE ?>/index/forgotpassword">Perdeu sua senha?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="<?= CONF_URL_BASE ?>/index/login">Login!</a>
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
