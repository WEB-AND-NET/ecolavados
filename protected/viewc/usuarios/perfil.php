<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $usuario = $data["usuario"]; ?>
<section class="content-header">
    <h1>
        Mi Perfil
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">Mi Perfil</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>perfil/save" method="post" name="form1" enctype="multipart/form-data">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>

                <div class="col-lg-4">
                    <label id="l_usuario">Usuario</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $usuario->usuario ?>" readonly="" id="usuario" name="usuario" maxlength="10">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_identificacion">Identificacion</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $usuario->identificacion ?>" readonly=""  id="identificacion" name="identificacion">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_nombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $usuario->nombre ?>" readonly="" id="nombre" name="nombre" maxlength="40">
                    </div><!-- /.input group -->
                </div>
                <div class="clearfix"></div><br/>

                <div class="col-lg-4">
                    <label id="l_imagen">Imagen</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-camera"></i>
                        </div>
                        <input type="file" id="imagen" name="imagen"  value="<?= $usuario->imagen ?>" />
                    </div>  
                </div>
                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?= $usuario->id; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="0" />
                </div>

        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#usuario').val(), $('#l_usuario').html(), true);
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }
    
    $('#btn-save').click(function () {
        if (validateForm()) {
            $('#form1').submit();
        }
    });
    
    $('#btn-cancel').click(function () {
        window.location = '<?= $data['rootUrl']; ?>';
    });

</script>


