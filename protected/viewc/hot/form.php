<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["ats"]; ?>
<link  href="<?= $patch; ?>global/plugins/plugins/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet"/>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'CERTIFICATE OF HOT WORK' : 'CERTIFICATE OF HOT WORK'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Ats</a></li>
        <li class="active"> <?= ($a->id == "" ? 'CERTIFICATE OF HOT WORK' : 'CERTIFICATE OF HOT WORK'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>hot/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>
                
                <div class="col-lg-4">
                    <label id="l_id_trabajo">Work to do:</label>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="id_trabajo" id="id_trabajo">
                            <option value="N">[Select]</option>
                            <?php foreach($data["works"] as $works){?>
                                <option <?php echo  $a->id_trabajo==$works->id ? 'selected' : '' ?> value="<?php echo $works->id ?>"><?php echo $works->nombre ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>             

                <div class="col-lg-4">
                    <label id="l_id_empleado_autorizado">Name of the operator:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="id_empleado_autorizado" id="id_empleado_autorizado">
                            <option value="N">[Select]</option>
                            <?php foreach($data["empleados"] as $empleados){?>
                                <option <?php echo  $a->id_empleado_autorizado==$empleados["id"] ? 'selected' : '' ?> value="<?php echo $empleados["id"] ?>"><?php echo $empleados["nombre"]." ".$empleados["apellido"] ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-2">
                    <label id="l_hora_inicio">Start time*</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text"  value='<?= $a->hora_inicio ?>'  class="form-control pull-right" name='hora_inicio' id="hora_inicio">
                    </div>
                </div>
                <div class="col-lg-2">
                    <label id="l_hora_final">End time</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text"  value='<?= $a->hora_final ?>'  class="form-control pull-right" name='hora_final' id="hora_final">
                    </div>
                </div>

<div class="clearfix"></div>
<br>
<div class="html"></div>
<div class="clearfix"></div>
<br>
          
            <div class="box-footer col-md-4 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                        <i class="fa  fa-arrow-left"></i> Cancel
                    </button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">
                        <i class="fa fa-save "></i> Save
                    </button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
            </div>
            <div class="clear"></div>
        </div>
       
    </form>
</div>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>
$('#hora_inicio').datetimepicker({
    format:'yyyy-mm-dd hh:ii:ss'
  });
  $('#hora_final').datetimepicker({
    format:'yyyy-mm-dd hh:ii:ss'
  });
  $("#id_trabajo").change(function(){
    getAssociate($(this).val())
  })
  function getAssociate(id){
        $.post("<?= $patch ?>hot/getAssociate",{id},function(data){
            $(".html").html(data)
        })
    }
    function validateForm() {
        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#hora_inicio').val(), $('#l_hora_inicio').html(), true);
        sErrMsg += validateText($('#hora_final').val(), $('#l_hora_final').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
 
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>hot';
    });
    
    $("#btn-save").click(function(){
        if($("#id_trabajo option:selected").val()=='N'){
            alert("Select Work");
            return;
        }
        if($("#id_empleado_autorizado option:selected").val()=='N'){
            alert("Select Operator");
            return;
        }
        if(validateForm()){
             $(this).attr("disabled","true")
            var ids={};
            var bad=false;
            $(".labeltask").each(function(element,attr){
                if($('div[data-name=task'+`${attr.attributes.dataid.value}`+"][data-acept="+attr.attributes.datad.value+"]").attr("aria-checked")=="truea"){
                    ids[attr.dataset.name]=attr.attributes.dataid.value;
                }
            }) 
            if(bad){
               $.post("<?= $patch ?>hot/setBadAssociate",
               {
                   ids,
                   id_trabajo:$("#id_trabajo").val(),
                   id_empleado_autorizado:$("#id_empleado_autorizado").val(),
                   hora_inicio:$("#hora_inicio").val(),
                   hora_final:$("#hora_final").val(),
                   status:'N'
               },function(data){
                    window.location = '<?= $patch; ?>hot/sing/'+data;
                }) 
            }else{
                $.post("<?= $patch ?>hot/setAssociate",
               {
                   id_trabajo:$("#id_trabajo").val(),
                   id_empleado_autorizado:$("#id_empleado_autorizado").val(),
                   hora_inicio:$("#hora_inicio").val(),
                   hora_final:$("#hora_final").val(),
                   status:'S'
               },function(data){
                    window.location = '<?= $patch; ?>hot/sing/'+data;
                }) 
            }
            
        }
    })
</script>