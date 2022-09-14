<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link  href="<?= $patch; ?>global/plugins/plugins/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet"/>
<?php $a = $data["schedule"]; ?>

<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Schedule Register' : 'Schedule update'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>entrys">Current Inventory</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Schedule Register' : 'Schedule update'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>entrys/save/assing" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information </legend>


                <div class="col-lg-2">
                    <label id="l_fecha_inicio">Consecutive</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" disabled="disabled" value='<?= $data['consecutivo']['consecutivo'] ?>'  class="form-control  pull-right" name='consecutivo' id="consecutivo">
                    </div>
                </div>


                <div class="col-lg-2">
                    <label id="l_fecha_inicio">Start of service*</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value='<?= $a->fecha_inicio ?>'  class="form-control fecha pull-right" name='fecha_inicio' id="fecha_inicio">
                    </div>
                </div>

                <div class="col-lg-2">
                    <label id="l_fecha_fin">End of service*</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" disabled value='<?= $a->fecha_fin ?>'  class="form-control pull-right" name='fecha_fin' id="fecha_fin">
                    </div>
                </div>

        

                <div class="col-lg-2">
                    <label id="l_tipo_tarifa">Service</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select readonly class="form-control select2"  id="proceso" name="proceso">
                            <?php foreach($data["procesos"] as $procesos){ ?>
                                <option <?php echo $procesos->id == $a->proceso ? 'selected' :'' ?> value='<?echo $procesos->id ?>'> <?echo $procesos->nombre ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label id="l_id_empleado_autorizado">Name of the operator:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="id_empleado" id="id_empleado_autorizado">
                            <option value="N">[Select]</option>
                            <?php foreach($data["empleados"] as $empleados){?>
                                <option <?//php echo  $a->id_empleado_autorizado==$empleados->id ? 'selected' : '' ?> value="<?php echo $empleados->id ?>"><?php echo $empleados->nombre." ".$empleados->apellido ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>


                <div class="col-lg-12">
                    <label id="l_observation">Observation:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <textarea class="form-control pull-right" name="observacion" id="observacion" ></textarea>
                    </div><!-- /.input group -->
                </div>

            </fieldset>
            <div class="col-md-6">
                <fieldset>
                    <legend>Certificates require</legend>
                    <table class='table table-responsive table-bordered table-stripped'>
                        <thead>
                            <tr>
                                <th>Item</th>
                            </tr>
                        </thead>
                        <?php foreach($data["requeridos"] as $requiere){ ?>
                            <tr>
                                <td><?echo $requiere["nombre"] ?></td>
                            </tr>
                        <?php } ?>

                    </table>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend>Item Obtained</legend>
                    <table class='table table-responsive table-bordered table-stripped'>
                        <thead>
                            <tr>
                                <th>Item</th>
                            </tr>
                        </thead>
                        <tbody class='tbody'>
                        </tbody>

                    </table>
                </fieldset>
            </div>

           <div class="clearfix">   </div>
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible  fade bad" role="alert">
                    This operator does not have sufficient permits
                </div>
            </div>
                    

            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade  good" role="alert">
                    his operator has sufficient permits.
                </div>
            </div>
            

            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" disabled  id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>

                <input name="id_programacion" type="hidden" id="id_programacion" value="<?= $a->id; ?>" />
                <input name='count' type='hidden' id='count' value='<?= count($data["requeridos"]); ?>' />
            </div>
        </div>
       
        
    </form>
</div>

<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script>
    var permisos;
    var fecha=$('.fecha').datetimepicker({
        format:'yyyy-mm-dd hh:ii:ss'
    }).on('changeDate', function(ev){
    fecha=ev;
        $('#fecha_fin').removeAttr("disabled");
    });

    $('#fecha_fin').datetimepicker({
        format:'yyyy-mm-dd hh:ii:ss'
    })

    .on('changeDate', function(ev){
        if ( ev.date.valueOf() < fecha.date.valueOf() ){
           alert("End of wash can not be less than the star");
           $('#fecha_fin').val("")
        }
    });

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#fecha_inicio').val(), $('#l_fecha_inicio').html(), true);
        sErrMsg += validateText($('#fecha_fin').val(), $('#l_fecha_fin').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }

    $("#btn-save").click(function(){
        if(validateForm()){
            permisos.forEach(function(item){
                $.post("<?= $patch ?>entrys/schedule/updatePermission",
                {
                consecutivo:$("#consecutivo").val(),
                typ:item.typ,
                id:item.id
                },function(data){
                    console.log(data)
                })
            })
           $("#form1").submit();
        }
    })
        
    
    $("#id_empleado_autorizado").change(function(){
        var html='';
        $.post("<?= $patch ?>entrys/schedule/permisosEmpleados",{empleado:$(this).val(),proceso:$("#proceso").val()},function(data){
            data.forEach(function(item){
                html+=`<tr>
                            <td>${item.nombre}</td>
                        </tr>`
            })
            permisos=data;
            $(".tbody").html( html);
            if(data.length == $("#count").val()){
                $("#btn-save").attr("disabled",false)
                $(".good").removeClass("fade")
                $(".bad").addClass("fade")
            }else{
                $("#message").html("This operator does not have sufficient permits");
                $(".bad").removeClass("fade")
                $(".good").addClass("fade")
            }
        },'Json')
       
    })

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>entrys';
    });


</script>