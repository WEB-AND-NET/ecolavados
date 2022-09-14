<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $festivo = $data['festivo'] ?>
<section class="content-header">
    <h1>
        <?php echo ($festivo->id == "" ? 'Add' : 'Update'); ?> Holidays
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>holidays">Holidays</a></li>
        <li class="active"><?php echo ($festivo->id == "" ? 'Add' : 'Update'); ?> Holidays</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>holidays/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>

                <div class="col-lg-6">
                    <label id="l_fecha">Date</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o "></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?php echo $festivo->fecha ?>" id="fecha" name="fecha">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-6">
                    <label id="l_descripcion">Description</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-buysellads"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?php echo $festivo->descripcion ?>"  id="descripcion" name="descripcion">
                    </div><!-- /.input group -->
                </div>


                <div class="clearfix"></div>
                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?php echo $festivo->id; ?>" />
                </div>

        </div>
    </form>
</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#fecha').val(), $('#l_fecha').html(), true);
        sErrMsg += validateText($('#descripcion').val(), $('#l_descripcion').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }
    
    $('#btn-save').click(function () {
        if (validateForm()) {
            $("#form1").submit()
        }
    });
    
    $('#btn-cancel').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>holidays';
    });

</script>


