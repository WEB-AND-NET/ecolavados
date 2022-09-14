<?php
$login = $_SESSION['login'];
?>



<header class="main-header"><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
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
        <div class="col-md-12"style='padding-left:0'>
            <div class="col-md-1"style='padding-left:0'>  
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </div>
            <div class="col-md-8 hidden-xs"style='text-align:center'>
                <a style=' background-color: #01a65a !important;' href="<?= $patch ?>" >
                    <!-- Logo para cuando la web este con tamaño pequeño-->
                    <img  src='<?= $patch ?>global/img/logo-header.png'/>
                </a>
            </div>
            <div class="col-md-3">            
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                            <a href="<?= $patch ?>profile" >
                                <i class="fa fa-users" style="font-size: 20px;"></i>
                            </a>
                        </li>    
                    
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o" style="font-size: 20px;"></i>
                                <span id="push-ordenes-i" class="label label-warning">0</span>
                            </a>
                            <ul class="dropdown-menu">
                            
                                <li>
                                    <ul id="push-ordenes" class="menu">
                                    
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Ver Todas las Solicitudes</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o" style="font-size: 20px;"></i>
                            <span id="push-cancelados-i" class="label label-danger">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li id="push-cancelados-h" class="header">Se cancelo un solicitud</li>
                            <li>
                            <!-- inner menu: contains the actual data -->
                            <ul id="push-cancelados" class="menu">
                            </ul>
                            </li>
                            <li class="footer">
                            <a href="#">Ver todas las cancelaciones</a>
                            </li>
                        </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
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
                                        <a href="<?= $patch ?>profile" class="btn btn-default btn-flat">Mi Perfil</a>
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
            </div>
        </div>
        


        

    </nav>
</header>
