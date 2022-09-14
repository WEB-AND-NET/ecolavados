<?php
$login = $_SESSION['login'];
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?= $patch ?>" class="logo">
        <!-- Logo para cuando la web este con tamaño pequeño-->
        <span class="logo-mini"><b><?= C_LOGO_M1; ?></b><?= C_LOGO_M2; ?></span>
        <!-- Logo para cuando este tamaño normal (Escritorio) -->
        <span class="logo-lg"><?= C_LOGO; ?></span>
    </a>
    <!-- Opciones para configuracion del usuario y avatar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="user-image" alt="User Image" />
                        <span class="hidden-xs"><?= $login->nombre ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="img-circle" alt="User Image" />
                            <p>
                                <?= $login->nombre ?> - <?= $login->perfil ?>
                                <!--<small>Member since Nov. 2012</small>-->
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= $patch ?>perfil" class="btn btn-default btn-flat">Mi Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= $patch ?>logout" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
