<section class="content-header">
    <h1>
        Cambiar Contrase&ntilde;a
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>tarifas">Tarifas</a></li>
        <li class="active">Cambiar Contrase&ntilde;a</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>cambiar" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>



                <div class="col-lg-4">
                    <label id="l_oldkey">Antigua Contrase&ntilde;a</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <input type="password" class="form-control pull-right"  id="oldkey" name="oldkey" maxlength="15">
                    </div><!-- /.input group -->
                </div> 

                <div class="col-lg-4">
                    <label id="l_key">Contrase&ntilde;a</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <input type="password" class="form-control pull-right"  id="key" name="key" maxlength="15">
                    </div><!-- /.input group -->
                </div> 

                <div class="col-lg-4">
                    <label>Repetir Constrase&ntilde;a</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <input type="password" class="form-control pull-right"  id="repetir" name="repetir" maxlength="15">
                    </div><!-- /.input group -->
                </div> 
                <div class="clearfix"></div>

                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default col-lg-6 col-lg-12">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green col-lg-6 col-lg-12 pull-right">Guardar</button>
                </div>
            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#key').val(), $('#l_key').html(), true);
        sErrMsg += ($('#key').val() != $('#repetir').val() ? '- Las ' + $('#l_key').html() + 's no Coinciden.\n' : '');
        sErrMsg += ($('#key').val().length < 8 ? 'Minimo 8 Caracteres\n' : '');
        if (sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }

    function validar() {
        $.post('<?php echo $data['rootUrl']; ?>cambiar/validar', {
            oldkey: $('#oldkey').val()
        },
        function (data) {
            if (data) {
                $('#form1').submit();
            } else {
                alert('La ' + $('#l_key').html() + ' no es correcta');
            }
        }
        );
    }

    $('#btn-save').click(function () {
        if (validateForm()) {
            validar();
        }
    })

    $('#btn-cancel').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>';
    })

</script>


