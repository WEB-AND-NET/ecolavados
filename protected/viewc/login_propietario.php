<?php
$patch = $data['rootUrl'];
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="es" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="es" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="es"> <!--<![endif]-->
    <head>
        <title><?= C_TITLE; ?></title>
        
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Carlos Meriño Iriarte">        
        <meta name="description" content="">
        <meta name="keywords" content="">
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">

        <!-- Web Fonts -->
        <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

        <!-- CSS Global Compulsory -->
        <link rel="stylesheet" href="<?= $patch ?>global/plugins/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= $patch ?>global/plugins/css/style.css">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="<?= $patch ?>global/plugins/plugins/animate.css">
        <link rel="stylesheet" href="<?= $patch ?>global/plugins/plugins/line-icons/line-icons.css">
        <link rel="stylesheet" href="<?= $patch ?>global/plugins/plugins/font-awesome/css/font-awesome.min.css">

        <!-- CSS Page Style -->
        <link rel="stylesheet" href="<?= $patch ?>global/plugins/css/pages/page_log_reg_v2.css">

        <!-- CSS Customization -->
        <link rel="stylesheet" href="<?= $patch ?>global/plugins/css/custom.css">
    </head>

    <body>

        <!--=== Content Part ===-->
        <div class="container">
            <!--Reg Block-->
            <div class="reg-block">
                <div class="reg-block-header">
                    <h2>Ingresar</h2>

                    <p>Propietarios.</p>
                </div>
                <?php if (isset($data['error'])) {
                    ?>
                    <div role="alert" class="alert alert-danger alert-dismissible fade in">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                        <strong><?= $data['error'] ?></strong>
                    </div>

                <?php } ?>
                <form name="form1" role="form" class="login-form " action="<?= $patch ?>postloginpropietarios" method="post">
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control" placeholder="User" name="usuario" id="usuario">
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" >
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <button type="submit" class="btn-u btn-block">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!--End Reg Block-->
        </div><!--/container-->
        <!--=== End Content Part ===-->

        <!-- JS Global Compulsory -->
        <script type="text/javascript" src="<?= $patch ?>global/plugins/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?= $patch ?>global/plugins/plugins/jquery/jquery-migrate.min.js"></script>
        <script type="text/javascript" src="<?= $patch ?>global/plugins/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- JS Implementing Plugins -->
        <script type="text/javascript" src="<?= $patch ?>global/plugins/plugins/back-to-top.js"></script>
        <script type="text/javascript" src="<?= $patch ?>global/plugins/plugins/backstretch/jquery.backstretch.min.js"></script>
        <!-- JS Customization -->
        <script type="text/javascript" src="<?= $patch ?>global/plugins/js/custom.js"></script>
        <!-- JS Page Level -->
        <script type="text/javascript" src="<?= $patch ?>global/plugins/js/app.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                App.init();
            });
        </script>
        <script type="text/javascript">
            $.backstretch([
                "global/img/login/backgrounds/1.jpg",
                "global/img/login/backgrounds/2.jpg",
            ], {
                fade: 1000,
                duration: 7000
            });
        </script>
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.js"></script>
        <script src="assets/plugins/html5shiv.js"></script>
        <script src="assets/plugins/placeholder-IE-fixes.js"></script>
        <![endif]-->

    </body>
</html>
