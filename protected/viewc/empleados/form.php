<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["empleados"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Employees Register' : 'Employees update'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Employees</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Employees Register' : 'Employees update'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>empleados/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>
                
                <div class="col-lg-4">
                    <label id="l_identificacion">Id </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-barcode"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->identificacion; ?>" id="identificacion" name="identificacion" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_nombre">Name </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-bars  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_apellido">Last Name </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-bars"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->apellido; ?>" id="apellido" name="apellido" >
                    </div><!-- /.input group -->
                </div>

               

                <div class="col-lg-4">
                    <label id="l_tipo_de_sangre">RH</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-bold"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->tipo_de_sangre; ?>" id="tipo_de_sangre" name="tipo_de_sangre" >
                    </div><!-- /.input group -->
                </div>

                
                <div class="col-lg-4">
                    <label id="l_telefono">Phone Number</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fax"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->telefono; ?>" id="telefono" name="telefono" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_direccion">Address</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->direccion; ?>" id="direccion" name="direccion" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_eps">EPS</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-medkit "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->eps; ?>" id="eps" name="eps" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_arl">ARL</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-medkit"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->arl; ?>" id="arl" name="arl" >
                    </div><!-- /.input group -->
                </div>


                <div class="col-lg-4">
                    <label id="l_cargo">Charges*</label>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon">
                            <i class="fa fa-group"></i>
                        </span>
                        <select class='elements form-control' name="cargo" id="cargo">
                            <?php foreach($data["cargos"] as $cargo){?>
                                <option <?php echo $cargo->id==$a->cargo ? 'selected' :'' ?> value="<?php echo $cargo->id ?>"><?php echo $cargo->cargo ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>
     


            </fieldset>
            <fieldset style="width:97%;">
                <legend>Emergency information</legend>
                <div class="col-lg-4">
                    <label id="l_atencion_en_emergencia">In case of emergency go to</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-medkit"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->atencion_en_emergencia; ?>" id="atencion_en_emergencia" name="atencion_en_emergencia" >
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_contacto_en_emergencia">Call in case of emergency</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-medkit"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->contacto_en_emergencia; ?>" id="contacto_en_emergencia" name="contacto_en_emergencia" >
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_nombre_contacto_emergencia">Name in case of emergency</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-medkit"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre_contacto_emergencia; ?>" id="nombre_contacto_emergencia" name="nombre_contacto_emergencia" >
                    </div><!-- /.input group -->
                </div>
            </fieldset>
            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>
                <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>
        
   
    $("#identificacion").focusout(function(){
        $("#form1").mask();
        $.post("<?= $patch ?>employees/validateId",{id:$("#id").val(),val:$(this).val() },function(data){
            if(data=="TRUE"){
                alert("This identification is already registered");
            }
            $("#form1").unmask();
        })
        
    })

    $("#btn-save").click(function(data){
        if(validateForm()){
            $("#form1").submit()
        }
    })

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += validateText($('#apellido').val(), $('#l_apellido').html(), true);
        sErrMsg += validateNumber($('#identificacion').val(), $('#l_identificacion').html(), true);
        sErrMsg += validateText($('#direccion').val(), $('#l_direccion').html(), true);
        sErrMsg += validateText($('#telefono').val(), $('#l_telefono').html(), true);
        sErrMsg += validateText($('#tipo_de_sangre').val(), $('#l_tipo_de_sangre').html(), true);
        sErrMsg += validateText($('#eps').val(), $('#l_eps').html(), true);
        sErrMsg += validateText($('#arl').val(), $('#l_arl').html(), true);
        sErrMsg += validateText($('#telefono').val(), $('#l_telefono').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }

   

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>employees';
    });




   



    
</script>