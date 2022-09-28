<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include __DIR__ . '/header.php'; ?>
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="form-group text-center py-4">
                                    <img src="<?= CONF_MAIN_LOGO ?>">
                                </div>
            <div class="row justify-content-center">
                
                <div class="col-xl-8">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="p-5">
                                        <div class="container-fluid">
                                            <!-- 404 Error Text -->
                                            <div class="text-center">
                                                <div class="error mx-auto" data-text="404">404</div>
                                                <p class="lead text-gray-800 mb-5">Page Not Found</p>
                                                <a href="<?= CONF_URL_BASE ?>" class="text-center">← Back to Dashboard</a>
                                            </div>
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