<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link  href="<?= $data['rootUrl'] ?>global/css/switcher.css" type="text/css" rel="stylesheet"/>
<script src="<?= $data['rootUrl']; ?>global/js/jquery.switcher.js"></script>
<style>
canvas {
  border: 2px solid #CCCCCC;

  cursor: crosshair;
}

</style>
<section class="content-header">
    <h1>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"></li>
    </ol>
</section>
<br>
<br/>


<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>entry/saveEdit" enctype="multipart/form-data" method="post" name="form1">
    <input type='hidden' value='<?php echo $data["entrada"]->id  ?>' name='id' id='id' >

        <div class="box-body">
        <fieldset style="width:97%;">
                <legend>General information</legend>
                <div class="col-lg-4">
                    <label id="l_serial">LAST CARGO/ULTIMA CARGA:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <select class='elements form-control' name="last_cargo" id="last_cargo">
                       
                            <?php foreach($data["lastcargo"] as $lastcargo){?>
                                <option  <?= $data["entrada"]->last_cargo==$lastcargo["id"] ? 'selected' : ''  ?>  value="<?php echo $lastcargo["id"] ?>"><?php echo $lastcargo["nombre"] ?></option>
                            <?php } ?>
                        </select>
                       <!-- <input type="text" class="form-control pull-right" value="<?//= $data["entry"]["last_cargo"] ?>" id="last_cargo" name="last_cargo" >-->
                    </div><!-- /.input group -->
                </div>                
                <div class="col-lg-4">
                    <label id="l_fecha">DATE/FECHA:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $data["entrada"]->fecha  ?>" id="fecha" name="fecha">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_serial">STATUS:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <select class='elements form-control' name="status" id="status">
                        <?php foreach($data["status"] as $status){ ?>
                            <option  <?= $data["entrada"]->status==$status->id  ? 'selected' : ''  ?> value='<?= $status->id ?>'><?= $status->status_name ?></option>
                        <?php } ?>
                        </select>  
                    </div><!-- /.input group -->
                </div>
                
                
                
                <div class="col-lg-4">
                    <label id="l_serial">POSITION:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <select class='elements form-control' name="posicion" id="posicion">
                        <?php foreach($data["posiciones"] as $posicion){ ?>
                            <option value='<?= $posicion['id'] ?>'  <?= $data["entrada"]->posicion==$posicion['id']  ? 'selected' : ''  ?>><?= $posicion['posicion'] ?></option>
                        <?php } ?>
                        </select>  
                    </div><!-- /.input group -->
                </div>
        </fieldset>
        <div class="clearfix"></div><br>
            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>
            </div>
            <div class="clearfix"></div><br>

           
            <?php  if($_SESSION["login"]->role==12){ ?>
                <fieldset style="width:97%;">
                        <legend>Departure information</legend>

                        <div class="col-lg-4">
                            <label id="l_fecha">GATE OUT DATE/FECHA:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa   fa-clock-o  "></i>
                                </div>
                                <input type="date" class="form-control pull-right" value="" id="fecha_m" name="fecha_m">
                            </div><!-- /.input group -->
                        </div>

                        <div class="col-lg-4">
                            <label id="l_fecha">REFERENCE:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa   fa-code-fork  "></i>
                                </div>
                                <input type="text" class="form-control pull-right" value="<?= $data["cliente"]["reference_out"] ?>" id="reference" name="reference">
                            </div><!-- /.input group -->
                        </div>
                        <div class="clearfix"></div><br>
                        
                        <div class="col-lg-4">
                            <label id="l_serial">STATUS:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-code-fork "></i>
                                </div>
                                <select class='elements form-control' name="status_a" id="status_a">
                                <?php foreach($data["status"] as $status){ ?>
                                    <option  <?= $data["entrada"]->status==$status->id  ? 'selected' : ''  ?> value='<?= $status->id ?>'><?= $status->status_name ?></option>
                                <?php } ?>
                                </select>  
                            </div><!-- /.input group -->
                        </div>
                        <div class="clearfix"></div><br>


                        <div class="col-lg-12">
                            <label id="l_fecha">Observation:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-code-fork"></i>
                                </div>
                           <textarea class='form-control' name="observation" id="observation" ></textarea>
                            </div><!-- /.input group -->
                        </div>
                      
                <div class="box-footer col-md-4 pull-right">
                    <button type="button" id="btn-exit-tank" class="btn  bg-green pull-right">
                        <i class="fa fa-save "></i> Save
                    </button>
                </div>
            </fieldset>
        <?php } ?>

            
        <div>
    <form>
<div>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script>
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>entrys';
    });

    $("#btn-save").click(function(e){
        e.preventDefault();
        $("#form1").submit();
    })

    $("#btn-exit-tank").click(function(e){
        if($("#fecha_m").val() != ""){
            $.post("<?= $patch; ?>entrys/gateout",{
            fecha_m:$("#fecha_m").val(),
            observacion:$("#observation").val(),
            reference:$("#reference").val(),
            status:$("#status_a").val(),
            id:$("#id").val()},function(data){
                window.location = '<?= $patch; ?>entrys';
                window.open("<?= $patch; ?>entrys/invoice/L/"+$("#id").val())
            })
        }else{
            alert("Please choose a date of gate out ")
        }
    })
    
</script>
