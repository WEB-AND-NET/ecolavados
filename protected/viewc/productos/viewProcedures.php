<section class="content-header">
    <h1>
       Productos Procedure
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Products</a></li>
        <li class="active">Procedure </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>products/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>
                <?php foreach($data['productos_riesgos'] as $p){ ?>
                <div class="col-sm-3 col-md-3">
                    <img src="<?php echo $patch ?>/global/dangerss/<?=  $data['imagenes'][$p['riesgo']]['imagen'] ?>" alt="..." class="img-thumbnail">
                    <div class="caption">
                        <label for="">
                            GHS01 EXPLOSIVO
                        </label>                            
                    </div>                        
                </div>
                <?php }?>
           
                

        </fieldset>
            <fieldset style="width:97%;">
                <legend>General information</legend>
                <div class="col-lg-6">
                    <label id="l_clientes_id">Use of steam*</label>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon" >
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='productos_data form-control' name="use_vapor" id="use_vapor">
                                <option value=" ">Seleccionar</option>
                                <option <?php echo  $data['productos_data']->use_vapor =='S' ? 'selected' : '' ?> value="S">Si</option>
                                <option <?php echo  $data['productos_data']->use_vapor =='N' ? 'selected' : '' ?> value="N">No</option>                       
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-6">
                    <label id="l_quanti">Max Temp*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <input type="text"  class="productos_data form-control pull-right" value="<?= $data['productos_data']->t_max ?>" id="t_max" name="t_max" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-6">
                    <label id="l_quanti">INTERIOR / STEAM PIPES:*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <input type="text" class="productos_data form-control pull-right" value="<?= $data['productos_data']->interior ?>" id="interior" name="interior" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-6">
                    <label id="l_quanti">Duration:*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <input type="text" class="productos_data form-control pull-right" value="<?= $data['productos_data']->duracion ?>" id="duracion" name="duracion" >
                    </div><!-- /.input group -->
                </div>

                

                <div class="col-lg-6">
                    <label id="l_quanti">CARE DANGERS AND REMARKS:*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <textarea name="" id="dificultad" class="productos_data form-control pull-right" ><?= $data['productos_data']->dificultad ?></textarea>                       
                    </div><!-- /.input group -->
                </div>

                
                               
                <div class="col-lg-6">
                    <label id="l_quanti">CONDITIONS THAT INDICATE POOR WASHING:*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <textarea name="mal" id="mal" class="productos_data form-control pull-right" ><?= $data['productos_data']->mal ?></textarea>                       
                    </div><!-- /.input group -->
                </div>

                  
                <div class="col-lg-6">
                    <label id="l_quanti">EXPERIENCES HAD WITH THE WASHING OF THIS PRODUCT:*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <textarea name="caracteristicas" id="caracteristicas" class="productos_data form-control pull-right" ><?= $data['productos_data']->caracteristicas ?></textarea>                       
                    </div><!-- /.input group -->
                </div>

                

            </fieldset>
            <fieldset style="width:97%;">
                <legend>General information</legend>

                
                <div class="clearfix"></div><br>
                <table id='databables' class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th> Unit of Measurement</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                </table>
            </fieldset>

            <fieldset style="width:97%;">
                <legend>General information</legend>
                <table id='databables2' class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Number</th>
                            <th>Activity</th>
                            <th>Time</th>
                            <th></th>                            
                        </tr>
                    </thead>
                </table>

            </fieldset>

            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default pull-right">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
          
                <input name="id" type="hidden" id="id" value="<?= $data["id_producto"]; ?>" />
            </div>
        </div>
    </form>

    <script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
    <script type="text/javascript">
        $("input").attr('disabled','disabled')
        $("select").attr('disabled','disabled')
        $("textarea").attr('disabled','disabled')
        $(".elige").click(function(e){          
            $.post("<?php echo $patch ?>productos/procedures/dangers",{dangerr:e.target.id,id_producto:$("#id").val()},function(data){
               console.log(data);
            })
        })

       

        var table2 = $('#databables2').DataTable({
            ajax:{
                url:"<?php echo $patch ?>productos/procedures/activities/"+$("#id").val(),
                dataSrc:'data'
            },
            columns:[ 
                { data: "id"} ,
                { data: "numero"} ,
                { data: "texto" },
                { data: "tiempo" },           
                {
                    "data": null,
                    "defaultContent": "<input class='btn btn-danger' value='Delete' type='button' name='items'>"
                }
            ]
    });
      var table = $('#databables').DataTable({
        ajax:{
            url:"<?php echo $patch ?>productos/procedures/getItems",
            dataSrc:'data'
        },
        columns:[ 
            { data: "id"} ,
            { data: "productos_name"} ,
            { data: "cantidad" },
            { data: "unidad" },           
            {
                "data": null,
                "defaultContent": "<input class='btn btn-danger' value='Delete' type='button' name='items'>"
            }
            ]
    });
    $("#btn-add").click(function(){
        if($("#quanti").val() != ""){

            if($("id").val()!=$("#productos_id")){
                $.post("<?php echo $patch ?>productos/procedures/setItems",{cantidad:$("#quanti").val(),id_producto:$("#id").val(),id_producto_a:$("#productos_id").val()},function(){
                    table.ajax.reload();
                })
            }else{
                alert("Producto no valido")
            }
           
        }        
    })

    $("#btn-add").click(function(){
        if($("#quanti").val() != ""){

            if($("id").val()!=$("#productos_id")){
                $.post("<?php echo $patch ?>productos/procedures/setItems",{cantidad:$("#quanti").val(),id_producto:$("#id").val(),id_producto_a:$("#productos_id").val()},function(){
                    table.ajax.reload();
                })
            }else{
                alert("Producto no valido")
            }
           
        }        
    })

    $(".productos_data").focusout(function(e){
        var val = $(this).val();
        var clave = e.target.id
        $.post("<?php echo $patch ?>productos/procedures/setData",{"val":val,"clave":clave,id_producto:$("#id").val()},function(){
           
        })
    })
    
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>products';
    });
    $("#productos_id").select2();

    $("#btn-add-act").click(function(){
        if(validateForm()){
            $.post("<?php echo $patch ?>productos/procedures/setActivity",{
                    "tiempo":$('#time').val(),
                    "numero":$('#numero').val(),
                    "texto":$('#activity').val(),
                    "id_producto":$("#id").val()
                },function(){
                    table2.ajax.reload();
            })
        }
    })
   

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#numero').val(), $('#l_numero').html(), true);
        sErrMsg += validateText($('#activity').val(), $('#l_activity').html(), true);
        sErrMsg += validateText($('#time').val(), $('#l_time').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }

    $('#databables tbody').on( 'click', 'input', function () {
        var data = table.row( $(this).parents('tr') );
        if(confirm(`Seguro deseas eliminar el producto ${data.data()["productos_name"]}`)){
            $.post("<?php echo $patch ?>productos/procedures/deleteRelacion",{id_producto:$("#id").val(),id:data.data()["id"]},function(){
                table.ajax.reload();
            })
        }
        console.log(data);
       // alert( data["productos_name"] +"'s salary is: "+ data[ 5 ] );
    } );

    $('#databables2 tbody').on( 'click', 'input', function () {
        var data = table2.row( $(this).parents('tr') );
        console.log(data.data());
        if(confirm(`Seguro deseas eliminar la actividad ${data.data()["texto"]}`)){
            $.post("<?php echo $patch ?>productos/procedures/deleteActivity",{id:data.data()["id"]},function(){
                table2.ajax.reload();
            })
        }
        console.log(data);
       // alert( data["productos_name"] +"'s salary is: "+ data[ 5 ] );
    } );



</script>

