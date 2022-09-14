<?php
$patch = $data['rootUrl'];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?= C_TITLE; ?></title>
        
        <!-- Meta -->        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Carlos Meriño Iriarte">
        <meta name="description" content="">
        <meta name="keywords" content="">
        
        <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon" /> 
        <!-- CSS -->
        <link rel="stylesheet" href="<?= $patch ?>global/css/login/bootstrap.min.css">
        <link rel="stylesheet" href="<?= $patch ?>global/css/login/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="<?= $patch ?>global/js/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="content">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="logo span4">
                            <h1><a href=""><?= C_TITLE; ?></a></h1>
                        </div>
                        <div class="links span8">
                            <a class="home" href="" rel="tooltip" data-placement="bottom" data-original-title="Home"></a>
                            <a class="blog" href="" rel="tooltip" data-placement="bottom" data-original-title="Blog"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="register-container container">
                <div class="row">
                    <div class="iphone span5">
                        <img src="global/img/login/iphone.png" alt="">
                    </div>
                    <div class="register span6">
                        <form action="" method="post">
                            <h2>Create a free account</span></h2>
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="enter your email...">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" class="validate">
                            <label for="rpassword">Confirm Password</label>
                            <input id="rpassword" name="rpassword" type="password" class="validate">
                            <div class="col-lg-6">
                                <label class="span1" for="trade">Industry</label>
                            </div>
                            <div class="col-lg-6">
                                <select class="form-control" id="trade" name="trade">
                                    <option value="">&nbsp;&nbsp;Choose your option</option>
                                    <?php foreach ($data['trades'] as $t) { ?>
                                        <option value="<?= $t['_id']; ?>"><?= $t['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button id="btn-save" type="button">REGISTER</button>
                            <br/><br/>
                            <span>Already have an account?</span>
                            <a style="cursor: pointer;" id="login">Sign in</a>
                            <!--<div id="Info"></div>-->
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
        <!-- Javascript -->
        <script src="<?= $patch ?>global/js/jquery.min.js"></script>
        <script src="<?= $patch ?>global/js/bootstrap.min.js"></script>
        <script src="<?= $patch ?>global/js/login/scripts.js"></script>
        <script src="<?= $patch ?>global/js/login/jquery.backstretch.min.js"></script>
        <script src="<?= $patch; ?>global/js/form/utils.js"></script>
        <script>
            $(function () {

                $("#login").click(function () {
                    window.location = "login";
                });

                function check_username_availability()
                {
                    //$('#Info').html('<img src="<?//= $patch; ?>global/img/loader.gif" alt="" />').fadeOut(1000);

                    var email = $(this).val();
                    //var dataString = 'username='+username;

                    $.ajax({
                        type: "POST",
                        url: "<?= $patch ?>check_username_availability",
                        data: {email: email},
                        success: function (data) {
                            //$('#Info').fadeIn(1000).html(data);
                            //console.log(data);
                        }
                    });
                }

                $('#email').blur(check_username_availability);

                function validarUsuario(user) {
                    console.log("Email : " + user.email + "\nPassword : " + user.password + "\nRPassword : " + user.rpassword);

                    if (user.password !== user.rpassword) {
                        console.log("Error : Contraseñas no coinciden");
                    } else {

                        $.post('<?= $patch ?>postsignup', user, function (data) {
                            //console.log(data);
                            $.post('<?= $patch ?>postlogin', user, function (data) {
                                location.href = '<?= $patch ?>';
                            });
                        });

                    }
                }

                function save()
                {
                    var data_send = $('form').serializeObject();
                    //console.log( data_send );

                    validarUsuario(data_send);

                    /*
                     $.post('<?//= $patch ?>postsignup', data_send, function (data) {
                     //alert(data);
                     }).done(function () {
                     //alert( "second success" );
                     }).fail(function () {
                     //alert( "Error!" );                       
                     }).always(function () {
                     //alert( "finished" );
                     //setInterval(function () {
                     //}, 800);
                     });  */
                }

                $('#btn-save').click(save);

            });
        </script>
    </body>
</html>
