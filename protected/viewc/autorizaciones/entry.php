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
    <form id="form1" class="form" action="<?= $patch; ?>authorization/entry/save" enctype="multipart/form-data" method="post" name="form1">
    <input type='hidden' value='<?php echo $data["entrada"]->id  ?>' name='id' id='id' >
    <input type='hidden' value='<?php echo $data["entrada"]->autorizacion_ingreso_id  ?>' name='autorizacion_ingreso_id' id='autorizacion_ingreso_id' >
    <input type='hidden' value='<?php echo $data["entry"]["id_tanque"] ?>' name='id_tanque' id='id_tanque' >
    <input type='hidden' value='<?php echo $data["entry"]["id_cliente"] ?>' name='clientes_id' id='clientes_id' >
        <div class="box-body">
        <fieldset style="width:97%;">
                <legend>General information</legend>
                <div class="col-lg-4">
                    <label id="l_fecha_estimada">CLIENT/CLIENTE:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-group"></i>
                        </div>
                        <input type="text" disabled class="form-control pull-right" value="<?= $data["entry"]["cliente"] ?>" id="cliente" name="cliente" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_serial">SERIAL/IDENTIFICACION TANQUE:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $data["entry"]["serial"] ?>" id="serial" name="serial" >
                    </div><!-- /.input group -->
                </div>
                
                <div class="col-lg-4">
                    <label id="l_serial">LAST CARGO/ULTIMA CARGA:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <select class='elements form-control' name="last_cargo" id="last_cargo">
                       
                            <?php foreach($data["lastcargo"] as $lastcargo){?>
                                <option <?= $data["entry"]["last_cargo"] == $lastcargo["id"] ? "selected": ""   ?> value="<?php echo $lastcargo["id"] ?>"><?php echo $lastcargo["nombre"] ?></option>
                            <?php } ?>
                        </select>
                       <!-- <input type="text" class="form-control pull-right" value="<?//= $data["entry"]["last_cargo"] ?>" id="last_cargo" name="last_cargo" >-->
                    </div><!-- /.input group -->
                </div>
                
                <div class="col-lg-4">
                    <label id="l_transportista">TRANSPORT/TRANSPORTADORA:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $data["entry"]["transportista"] ?>" id="transportista" name="transportista" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_conductor">DRIVER </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-road  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $data["entry"]["conductor"] ?>" id="conductor" name="conductor">
                    </div><!-- /.input group -->
                </div>
                
                <div class="col-lg-4">
                    <label id="l_transportadora">PLATE:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $data["entry"]["placa"] ?>" id="placa" name="placa" >
                    </div><!-- /.input group -->
                </div>
                
                <div class="col-lg-4">
                    <label id="l_fecha">DATE/FECHA:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $data["entry"]["fecha"] ?>" id="fecha" name="fecha">
                    </div><!-- /.input group -->
                </div>
                
                
                  <div class="col-lg-4">
                    <label id="l_make_date">Manufacturing date*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $data["entry"]["make_date"] ?>" id="make_date" name="make_date" maxlength="45">
                    </div><!-- /.input group -->
                </div>
                
                
                <div class="col-lg-4">
                    <label id="l_serial">TEST 2.5:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $data["entry"]["test30"] ?>" id="test30" name="test30" >
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_serial">TEST 5:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="<?= $data["entry"]["test60"] ?>" id="test60" name="test60" >
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
                            <option value='<?= $status->id ?>'><?= $status->status_name ?></option>
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
                            <option value='<?= $posicion['id'] ?>'><?= $posicion['posicion'] ?></option>
                        <?php } ?>
                        </select>  
                    </div><!-- /.input group -->
                </div>



                <div class="col-lg-4">
                    <label id="l_serial">City:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <select class='elements form-control' name="ciudad" id="ciudad">
                        <?php foreach($data["ciudades"] as $city){ ?>
                            <option value='<?= $city['id'] ?>'><?= $city['municipio'] ?></option>
                        <?php } ?>
                        </select>  
                    </div><!-- /.input group -->
                </div>
                
        </fieldset>
        <div class="clearfix"></div>
        <br>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                <?php $cont=0; foreach($data["items"] as $item){ ?>
                    <li class="<?php echo  $cont==0 ? "active"  : '';$cont++;  ?>"><a href="#tab_<?= $item["id"] ?>" data-toggle="tab" aria-expanded="true"><?= $item["descripcion"] ?></a></li>
                <?php  } ?>

                </ul>
            <div class="tab-content">
                <?php $cont=0; foreach($data["items"] as $item){ ?>
                    <div class="tab-pane <?php echo  $cont==0 ? "active"  : '';$cont++;  ?>" id="tab_<?= $item["id"] ?>">
                       <table>    
                           <thead>
                                <tr>
                                    <th>&nbsp</th>
                                    <th>&nbsp</th> 
                                    <th>&nbsp</th> 
                                </tr> 
                            </thead>
                             <tbody>                  
                                <?php  foreach($item["sub_item"] as $sub ){?>
                                    <tr>
                                        <?php if($sub["editable"]=="N"){ ?>
                                            <td>
                                                <label id='la<?=$sub["id"] ?>'>
                                                    <?php echo $sub["descripcion"] ?><span class='area-replace<?=$sub["id"] ?>'><?php echo  $sub["valor"] ? '-'.$sub["valor"] : '' ?></span>
                                                </label>
                                            </td>
                                            <th>
                                                <input name='item<?php echo $sub["id"] ?>'  class="minimal"  <?=  $sub["valor"]=='OK' ? 'checked'  :''  ?> type="radio" value="<?php echo $sub["id"] ?>" />
                                            </td>
                                            <th>
                                                <input name='item<?php echo $sub["id"] ?>'  class="minimal"  <?=  $sub["valor"]!='OK' ? 'checked'  :''  ?> data-acept='N'  type="radio" value="<?php echo $sub["id"] ?>" />
                                            </td>
                                        <?php }else{ ?>
                                            <td>
                                                <label id='la<?=$sub["id"] ?>'>
                                                    <?php echo $sub["descripcion"] ?>
                                                </label>
                                            </td>
                                            <td>    
                                                <input class='input-item' data-id='<?php echo $sub["id"] ?>' type="text" id='item<?php echo $sub["id"] ?>' value="<?php echo  $sub["valor"]  ?>" />
                                            </td> 
                                            <td>50</td>
                                    <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>      
         
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
                <!-- Hasta acá-->
        <div class="clearfix"></div>
     
            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>
                
            </div>
        <div>



    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Ratings</h4>
                </div>
                <div class="modal-body"><!-- Modal Body-->
                <div id='take' class="content">
                    
                </div>

                </div><!--end of Modal Body-->
                <div class="clearflix"></div><br>

                <div class="modal-footer">

                    <div class="mailbox-controls" style="float:right;">
                            <!-- Check all button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


        <div id="modalcamara" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Take Photo</h4>
                    </div>
                    <div class="modal-body"><!-- Modal Body-->
                    <div  class="content">
                        <input name='dataimagen' type="file"  accept="image/*" multiple="multiple" capture="camera"> <br>
                        <div >
                            <button   class='btn bg-navy btn-flat  photo'>Save Photo</button>
                        </div> 
                    </div>

                    </div><!--end of Modal Body-->
                <div class="clearflix"></div><br>
                    <div class="modal-footer">
                        <div class="mailbox-controls" style="float:right;">
                                <!-- Check all button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    <form>
<div>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

    <script>
        $.switcher('input[type=radio]');
    </script>
<script>
    $(".input-item").keyup(function(e){
        var option = $(this).attr("data-id");
        $.post("<?= $data["rootUrl"] ?>authorization/entry/itemsEntrada",{id_item:option,valor:$(this).val(),id_entrada:$("#id").val()},function(data){
        })
    })

    $(document).ready(function () {
       
        calcJob()
    });
    

    function calcJob(){
        var total = $('input[type=radio]').length
        var avance = $('input[type=radio]:checked').length
        resultado = avance*100/total;
    //    $(".progress-bar").attr("aria-valuenow",resultado).css('width', `${resultado}%`).html(`${resultado}%`);
    }
    $('input[type=radio]').on('click', function(event){
        var i = 0;
        $(this).attr("checked",true)
        var option = $(this).val();
        var html='';
        $.post("<?= $data["rootUrl"] ?>authorization/entry/getItemsCalificaciones",{id:$(this).val()},function(data){
            data.forEach(function(item){
                if(item.descripcion!="ESCRIBA"){
                    html+=`<div ><button causes-log='${item.causes_log}' data-id='${item.id}'  class='btn bg-navy btn-flat btn-block select'>${item.descripcion}</button></div> <br>`;
                }
            })
            $("#take").html(html);
            $("#myModal").modal();
            $(".select").click(function(e){
                var select = $(this).html();
                e.preventDefault();
                if($(this).attr("causes-log")=='S'){
                    if(confirm("This qualification generates an evidence you want to save it?")){

                        $("#modalcamara").modal("show");
                        $(".photo").click(function(e){
                             if(i==0){
                                i++;
                            e.preventDefault();
                            var formData = new FormData(document.getElementById("form1"));
                          //  formData.append("data",
                            formData.append("id_item",option)
                            formData.append("valor",select)
                            formData.append("id_entrada",$("#id").val())
                            formData.append("causes_log","S")
                            $.ajax({
                                url: "<?= $data["rootUrl"] ?>authorization/entry/itemsEntrada",
                                type: "post",
                                dataType: "html",
                                data:formData,
                                cache: false,
                                contentType: false,
                                processData: false
                            }).success(function (data) { 
                                $("#myModal").modal("hide");
                                $("#modalcamara").modal("hide");
                                calcJob()
                            });
                            }
                        })
                    }else{
                        calcJob()
                        $(".area-replace"+option).html("-"+$(this).html())
                        $("#myModal").modal("hide");
                        $.post("<?= $data["rootUrl"] ?>authorization/entry/itemsEntrada",{id_item:option,valor:$(this).html(),id_entrada:$("#id").val()},function(data){
                        })
                    }
                }else{
                    calcJob()
                    $(".area-replace"+option).html("-"+$(this).html())
                    $("#myModal").modal("hide");
                    $.post("<?= $data["rootUrl"] ?>authorization/entry/itemsEntrada",{id_item:option,valor:$(this).html(),id_entrada:$("#id").val()},function(data){
                    })
                }
               
        
              
            })
            
        },'Json')
    });

    $("#btn-save").click(function(e){
        e.preventDefault();
        if(validateForm()){
            $("#form1").submit();
        }
    })


    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#transportista').val(), $('#l_transportista').html(), true);
        sErrMsg += validateDate($('#make_date').val(), $('#l_make_date').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }  
    
</script>
