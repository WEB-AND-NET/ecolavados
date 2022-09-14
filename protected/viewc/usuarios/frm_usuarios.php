<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $usuario = $data["usuario"]; ?>
<section class="content-header">
    <h1>
        <?php echo ($usuario->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Usuarios
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>usuarios">Usuarios</a></li>
        <li class="active"><?php echo ($usuario->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Usuarios</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>usuarios/save" method="post" name="form1" enctype="multipart/form-data">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>

                <div class="col-lg-4">
                    <label id="l_usuario">Usuario</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?php echo $usuario->usuario ?>" <?php echo ( $usuario->id != '' ? 'readonly' : '') ?> id="usuario" name="usuario" maxlength="10">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_identificacion">Identificacion</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?php echo $usuario->identificacion ?>"  id="identificacion" name="identificacion">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_nombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?php echo $usuario->nombre ?>" id="nombre" name="nombre" maxlength="40">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_role">Rol</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2" id="role" name="role">
                            <option value="">[Seleccionar]</option>
                            <?php foreach ($data["roles"] as $rol) { ?>
                                <option value="<?php echo $rol->id; ?>"  <?php echo ($usuario->role == $rol->id ? 'selected' : '') ?> ><?php echo $rol->role; ?></option>
                            <?php }; ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div><br/>

                <div class="col-lg-4">
                    <label id="l_imagen">Imagen</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-camera"></i>
                        </div>
                        <input type="file" id="imagen" name="imagen"  value="<?php echo $usuario->imagen ?>" />
                    </div>  
                </div>


                <div class="clearfix"></div>
                <?php if ($usuario->id == "") { ?>
                    <div class="col-lg-4">
                        <label id="l_passwonrd">Contrase&ntilde;a</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-unlock-alt"></i>
                            </div>

                            <input type="password" class="form-control pull-right" value="<?php echo $usuario->password ?>" id="password" name="password" maxlength="15" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label id="l_iva">Repetir Constrase&ntilde;a</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-unlock-alt"></i>
                            </div>
                            <input type="password" class="form-control pull-right" value="<?php echo $usuario->password ?>" id="repetir" name="repetir" maxlength="15" />
                        </div>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?php echo $usuario->id; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="0" />
                </div>

        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#usuario').val(), $('#l_usuario').html(), true);
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += ($('#role').val() === "" ? '- Debe seleccionar Un Rol.\n' : '');
        if ($('#id').val() === "") {

            sErrMsg += validateText($('#password').val(), $('#l_passwonrd').html(), true);
            sErrMsg += ($('#password').val() !== $('#repetir').val() ? '- Las ' + $('#l_passwonrd').html() + 's no Coinciden.\n' : '');
        }
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }
    
    function validar() {
        $.post('<?php echo $data['rootUrl']; ?>usuarios/validar', {
            usuario: $('#usuario').val(),
            id: $("#id").val()
        },
        function (data) {
            if (data) {
                alert('El Usuario ' + $('#usuario').val() + ' ya se encuentra registrado ..')
            } else {
                $('#form1').submit();
            }
        }
        );
    }
    
    $('#btn-save').click(function () {
        if (validateForm()) {
            validar();
        }
    });
    
    $('#btn-cancel').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>usuarios';
    });

</script>


