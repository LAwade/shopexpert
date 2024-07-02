<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <?php include __DIR__ . '/header.php'; ?>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= CONF_URL_BASE ?>/"><?= CONF_NAME_SYSTEM ?></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <div class="input-group">
            <div class="input-group-append ">
            </div>
        </div>
        <?php if (session()->data(CONF_SESSION_LOGIN)) { ?>
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= CONF_URL_BASE . '/index/logoff' ?>">Logout</a>
                    </div>
                </li>
            </ul>
        <?php } else { ?>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <div class="col-4">
                    <a class="btn btn-outline-light" href="<?= url('/shop/cart'); ?>">
                        <i class="fas fa-shopping-cart"></i> <span class="badge badge-light">
                            <?php
                            if (session()->has('my_cart')) {
                                echo count(session()->data('my_cart')->getProduct());
                            } else {
                                echo "0";
                            }
                            ?>
                        </span>
                    </a>
                    <a href="<?= CONF_URL_BASE . '/index/login' ?>" class="btn btn-light">Acessar</a>
                </div>
            </div>
        <?php } ?>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <?php if (session()->data(CONF_SESSION_LOGIN)) { ?>
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <a class="nav-link" href="<?= CONF_URL_BASE . '/home/index' ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Cadastros</div>
                            <a class="nav-link" href="<?= CONF_URL_BASE . '/category/index' ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fa fa-tag"></i>
                                </div>
                                Categorias
                            </a>

                            <a class="nav-link" href="<?= CONF_URL_BASE . '/tax/index' ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                Taxas/Impostos
                            </a>

                            <a class="nav-link" href="<?= CONF_URL_BASE . '/product/index' ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                Produtos
                            </a>

                            <a class="nav-link" href="<?= CONF_URL_BASE . '/categorytax/index' ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                Taxas de Categorias
                            </a>
                        <?php } else { ?>
                            <div class="sb-sidenav-menu-heading">Produtos</div>
                            <a class="nav-link" href="<?= CONF_URL_BASE . '/shop/show' ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Shoppping
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <?php if (session()->data(CONF_SESSION_LOGIN)) { ?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logado com:</div><?= session()->data(CONF_SESSION_LOGIN)->name ?>
                    </div>
                <?php } else { ?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Você está Deslogado <a href="<?= CONF_URL_BASE . '/login' ?>">Login</a></div>
                    </div>
                <?php } ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="row">
                        <?php $this->view($view, $data); ?>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <?= date('Y') ?> - <?= CONF_NAME_SYSTEM ?> | Developer by <a href="https://github.com/LAwade">Lucas Awade </a> <img src="<?= CONF_URL_BASE ?>/public/img/main/more/br.png"> | Version: <?= CONF_VERSION_CURRENT ?></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php include __DIR__ . '/js.php'; ?>
</body>

</html>