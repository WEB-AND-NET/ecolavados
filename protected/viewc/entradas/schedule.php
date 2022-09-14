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
    <form id="form1" class="form" action="<?= $patch; ?>entrys/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_descripcion">Entry #</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa  fa-hashtag "></i>
                        </div>
                        <input disabled type="text" value='<?= $data["entradas"]["id"] ?>'  class="form-control pull-right" id="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_descripcion">Client</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa  fa-user"></i>
                        </div>
                        <input type="text"  disabled value='<?= $data["entradas"]["nombre"] ?>'  class="form-control pull-right" id="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label id="l_descripcion">Tank</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa   fa-cube"></i>
                        </div>
                        <input type="text" disabled value='<?= $data["entradas"]["serial"] ?>'   class="form-control pull-right" id="">
                    </div>
                </div>

                <div class="col-lg-4">
                    <label id="l_fecha_inicio">Start of services*</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value='<?= $a->fecha_inicio ?>'  class="form-control fecha pull-right" name='fecha_inicio' id="fecha_inicio">
                    </div>
                </div>


                <div class="col-lg-4">
                    <label id="l_fecha_fin">End of services*</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" disabled value='<?= $a->fecha_fin ?>'  class="form-control pull-right" name='fecha_fin' id="fecha_fin">
                    </div>
                </div>

                <div class="col-lg-4">
                    <label id="l_clientes_id">Request*</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal" data-target="#myModal" class="input-group-addon">
                            <i  class="fa  fa-group   "></i>
                        </span>
                    
                        <select class='elements form-control' name="request_activity" id="request_activity">
                         
                            <?php foreach($data["requests"] as $request){?>
                                <option <?php echo $request["id"]==$a->request_activity ? 'selected' :'' ?> value="<?php echo $request["id"] ?>"><?php echo $request["id"]."-".$request["descripcion"] ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_tipo_tarifa">Service</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2"  id="proceso" name="proceso">
                            <?php foreach($data["procesos"] as $procesos){ ?>
                                <option <?php echo $procesos->id == $a->proceso ? 'selected' :'' ?> value='<?echo $procesos->id ?>'> <?echo $procesos->nombre ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="col-lg-4">
                    <label id="l_fobservacion">Observation</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-cube"></i>
                        </div>
                        <input type="text" value='<?= $a->observacion ?>'  class="form-control  pull-right" name='observacion' id="observacion">
                    </div>
                </div>


            </fieldset>
            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>
                <input name="id_entrada" type="hidden" id="id_entrada" value="<?= $data["entradas"]["id"] ?>" />
                <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script>
    
    var fecha=
     $('.fecha').datetimepicker({
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
           $("#form1").submit();
        }
    })
        


    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>entrys';
    });


</script>