<?php
$patch = $data['rootUrl'];
$login = $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="es" >
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <title><?= C_TITLE; ?></title>

        <!-- Meta -->
        
        <meta name="author" content="Carlos Meriño Iriarte">  
        <meta name="description" content="">
        <meta name="keywords" content="">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/css/bootstrap.min.css"/>
        <!-- FontAwesome 4.3.0 -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/font-awesome/css/font-awesome.min.css"/>
        <!-- Ionicons 2.0.0 -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/css/ionicons.min.css"/>
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/css/AdminLTE.min.css"/>

        <link rel="stylesheet" href="<?= $patch ?>global/admin/skins/skin-green.min.css"/>

        <!-- iCheck -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/iCheck/minimal/green.css"/>

        <!-- Date Picker -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/datepicker/datepicker3.css"/>
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/daterangepicker/daterangepicker-bs3.css"/>

        <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/select2/select2.min.css"/>

         <!-- Impletacion CSS para el calendario con hora -->
        <link rel="stylesheet" media="all" href="<?= $patch ?>global/admin/css/jquery-ui-timepicker-addon.css" />

        <!-- Implementacion CSS de las mask (Mascara) -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/js/jquery-loadmask-0.4/jquery.loadmask.css"/>
        <!-- Growl -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/jquery.growl/css/jquery.growl.css"> 
        <!-- Tags -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/plugins/tagsinput/bootstrap-tagsinput.css"> 

        <!-- CSS Personalizados -->
        <link rel="stylesheet" href="<?= $patch ?>global/admin/css/personalizado.css"/>
        <!-- jQuery 2.1.4 -->
        <script type='text/javascript'src="<?= $patch ?>global/admin/js/jquery-2.1.4.min.js"></script>

        <!-- Impletacion JS para el calendario con hora -->
        <script type='text/javascript' src="<?= $patch ?>global/admin/js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script>        

        <!-- Implementacion JS de las mask (Mascara) -->
        <script type='text/javascript' src='<?= $patch ?>global/admin/js/jquery-loadmask-0.4/jquery.loadmask.min.js'></script>
        <script type='text/javascript' src='<?= $patch ?>global/js/accounting.min.js'></script>
       
        <script type="text/javascript" src="<?= $patch ?>global/admin/plugins/select2/select2.full.min.js"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?= $patch; ?>global/plugins/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    </head>
    
    <body class="skin-green sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <!-- incluyendo la pagina de Header, ubicada en la cabecera -->
            <?php include 'header.php'; ?>
            <!-- Incluyendo La pagina de Menu -->
            <?php include 'menu.php' ?>
            <!-- Contenedor de la pagina -->
            <div class="content-wrapper">
                <section id="section-content" class="content">
                    <?php include $data['content']; ?>
                </section>                                
            </div><!-- /.Cierre de todo el contenedor de la pagina -->
            <!-- Modal -->
            <!-- incluyendo la pagina de footer -->
            <?php include 'footer.php' ?>
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->
        
    </body>
</html>
<!-- Bootstrap 3.3.2 JS -->
<script type="text/javascript" src="<?= $patch ?>global/admin/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?= $patch; ?>global/plugins/plugins/datetimepicker/timepicker.js"></script>


<!-- Bootstrap WYSIHTML5 -->
<script type="text/javascript" src="<?= $patch ?>global/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- FastClick -->
<script type="text/javascript" src="<?= $patch ?>global/admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $patch ?>global/admin/js/app.min.js" type="text/javascript"></script>
<!-- Growl -->
<script type="text/javascript" src="<?= $patch ?>global/admin/plugins/jquery.growl/js/jquery.growl.js"></script>
 <!-- Implementación de los tags -->
 <script src="<?= $patch ?>global/admin/plugins/tagsinput/bootstrap-tagsinput.js" type="text/javascript"></script>
 <script>

$(document).ready(function(){
    $('form').attr('autocomplete','off');
    var html = "";
    $.post("<?= $patch ?>notificaciones/all",{},function(data){
        console.log(data)
        data.forEach(datas=>{
            html += `<li>
                        <a href="#">
                            <h4 style="white-space: initial;">
                               ${datas.notificacion}
                            </h4>
                            <p>Hora: ${datas.create}</p>
                            <p class='pull-right leida' id='${datas.id}' class=''>Marcar como leida</p>
                        </a>
                    </li>`;
        })
        $("#push-ordenes").html(html)
        $("#push-ordenes-i").html(data.length)
        $(".leida").click(function(e){
            console.log(e.target.id)
            $.post("<?= $patch ?>notificaciones/desactive",{id:e.target.id},function(data){

            });
        })
    },"Json")    
});
</script>
