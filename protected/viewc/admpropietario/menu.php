<?php
    $login = $_SESSION['login'];
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $patch ?>global/img/users/<?= $login->imagen ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $login->nombre ?></p>
                <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>
        <!-- Menu Dinamico: -->
        <?= $login->menu; ?>

    </section>
    <!-- /.Cierre menu dinamico -->
</aside>
