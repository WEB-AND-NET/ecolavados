<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["autorizaciones"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Authorization Register' : 'Authorization update'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Authorization Register' : 'Authorization update'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>entry/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>


                <div class="col-lg-4">
                    <label id="l_clientes_id">Tank*</label>
                    <div class="input-group margin-bottom-20" >
                        <span data-toggle="modal" data-target="#myModal" class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="tanques_id" id="tanques_id">
                        <option value="X">[SELECT]</option>
                        <?php  foreach( $data["tanques"] as $tanque){?>
                                <option next60='<?= $tanque["next60"] ?>' falta60='<?= $tanque["falta60"] ?>' next30='<?= $tanque["next30"] ?>'  falta30='<?= $tanque["falta30"] ?>' <?php echo $tanque["id"]==$a->tanques_id ? 'selected' :'' ?> value="<?php echo $tanque["id"] ?>"><?php echo $tanque["serial"] ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

     


                <div class="col-lg-4 ">
                    <label id="type">Type</label>
                    <div class="input-group margin-bottom-20">
                        <span  class="input-group-addon">
                            <i  class="fa fa-bitbucket-square"></i>
                        </span>
                        <select class='elements form-control' name="type" id="type">
                            <option <?= $a->type=='Food Grade'? 'selected' : '' ; ?> value='Food Grade'>Food Grade</option>
                            <option <?= $a->type=='Chemical'? 'selected':'' ; ?> value='Chemical'>Chemical</option>
                            <option <?= $a->type=='Gas'? 'selected':'' ; ?> value='Gas'>Gas</option>
                            <option <?= $a->type=='FlexiBag'? 'selected':'' ; ?> value='FlexiBag'>Flexi Bag</option>
                        </select>
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_conductor">Reference </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa     fa-chain  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->reference; ?>" id="reference" name="reference" >
                    </div><!-- /.input group -->
                </div>
                
                <div class="col-lg-4">
                    <label id="l_last_cargo_suggest">Product Suggest </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-chain    "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->last_cargo_suggest; ?>" id="last_cargo_suggest" name="last_cargo_suggest" >
                    </div><!-- /.input group -->
                </div>
                
                
                <div class="col-lg-4">
                    <label id="l_last_cargo_suggest">Get Out Reference </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-chain    "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->reference_get_out; ?>" id="reference_get_out" name="reference_get_out" >
                    </div><!-- /.input group -->
                </div>
                
                
                
                
            </fieldset>
            <fieldset style="width:97%;">
                <legend>Arrival data</legend>
                <div class="col-lg-4">
                    <label id="l_fecha_estimada">Estimated arrival date *</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $a->fecha_estimada; ?>" id="fecha_estimada" name="fecha_estimada" >
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_transportista">Transport company</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-buysellads  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->transportista; ?>" id="transportista" name="transportista" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_placa">Plate </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-cc-stripe    "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->placa; ?>" id="placa" name="placa" maxlength="45">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_conductor">Driver </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-road  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->conductor; ?>" id="conductor" name="conductor" maxlength="45">
                    </div><!-- /.input group -->
                </div>
            </fieldset>

            <fieldset style="width:97%;">
                <legend>output  data</legend>
                    <div class="col-lg-4">
                        <label id="l_fecha_estimada">Estimated date of departure*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa   fa-clock-o  "></i>
                            </div>
                            <input type="date" class="form-control pull-right" value="<?= $a->fecha_salida; ?>" id="fecha_salida" name="fecha_salida" >
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                    <label id="l_transportista">Transport company</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-buysellads  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->empresa_salida; ?>" id="empresa_salida" name="empresa_salida" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_placa">Plate </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-cc-stripe    "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->placa_salida; ?>" id="placa_salida" name="placa_salida" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_conductor">Driver </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-road  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre_conductor_salida; ?>" id="nombre_conductor_salida" name="nombre_conductor_salida" maxlength="45">
                    </div><!-- /.input group -->
                </div>
            </fieldset>
            <fieldset style="width:97%;">
                <legend>Send to</legend>
                <div class="col-lg-4">
                    <label id="l_transportista">Name</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-bold  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->name_client_send; ?>" id="name_client_send" name="name_client_send" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_placa">Number </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-cc-stripe    "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->numer_client_sed; ?>" id="numer_client_sed" name="numer_client_sed" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_conductor">Color </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eyedropper"></i>
                        </div>
                        <input type="color" class="form-control pull-right" value="<?= $a->color_client_send; ?>" id="color_client_send" name="color_client_send">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_conductor">Reservation </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-cc-stripe"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->reservation; ?>" id="reservation" name="reservation">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_clientes_id">Assign?</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-envelope"></i>
                        </span>
                        <select class='form-control' name="assing" id="assing">
                          <option <?= $a->assing=='N' ? 'selected' : '' ; ?> value='N'>No</option>
                          <option <?= $a->assing=='S' ? 'selected' : '' ; ?>  value='Y'>Yes</option> 
                        </select>
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
                <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>


<script>
   
        
    $(document).ready(function(){
        $("#tanques_id").select2({})
    
    $("#clientes_id").select2({
        placeholder: "Select Client",
        allowClear: true
    })

    if($("#id").val()!=""){
        getTanks($("#clientes_id").val());
    }

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#fecha_estimada').val(), $('#l_fecha_estimada').html(), true);
        sErrMsg += ($('#tanques_id').val() == 'X' ? '- Select a tank.\n' : '');
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
        
    $("#clientes_id").change(function(){
        $("#form1").mask("Waiting...");

        getTanks($(this).val())
    });

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>entry';
    });



    function getTanks(idcliente){
        $.post("<?php echo $data["rootUrl"] ?>authorization/getTanques",{
            cliente: idcliente,
            idtanque: "<?php echo $a->tanques_id=='' ? '':$a->tanques_id  ?>"
            },function(data){
            if(data){   
                var html;
                data.forEach(function(element){
                    console.log(element);
                    html += `<option value='${element.id}'>${element.serial}</option>`
                })
                $("#tanques_id").html(html);
                $("#form1").unmask();
            }
        },'JSON')
        }
    })

   



    
</script>