<?php $a = $data["clientes"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Customers Registration' : 'Update of clients'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Customers Registration' : 'Update of Clients'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>clientes/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>
                <div class="col-lg-4">
                    <label id="l_cedula">Id:</label>
                    <div class="input-group">
                        <div class="input-group-addon" id='id_cliente'>
                            <i class="fa fa-sort-numeric-desc"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->identificacion; ?>" id="identificacion" name="identificacion" >
                    </div><!-- /.input group -->
                </div>
                
                <div class="col-lg-4">
                    <label id="l_nombre">Name*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_nombre">State*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->departamento; ?>" id="departamento" name="departamento">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_nombre">City*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->ciudad; ?>" id="ciudad" name="ciudad">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_celular">Cell phone number*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->celular; ?>" id="celular" name="celular" >
                    </div><!-- /.input group -->
                </div>
               
                
                <div class="col-lg-4">
                    <label id="l_direccion">Address:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->direccion; ?>" id="direccion" name="direccion" >
                    </div><!-- /.input group -->
                </div>
           

                <!-- Días Habiles-->
                <div class="col-lg-4">
                    <label id="l_email">Business days: </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input  type="number" class="form-control pull-right" value="<?= $a->dias_habiles; ?>" id="dias_habiles" name="dias_habiles" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_tipo_identificacion">Customer type</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2"  id="tipo" name="tipo">
                            <option <?= ($a->tipo == "N" ? 'selected="selected"' : ''); ?> value="N">Natural</option>
                            <option <?= ($a->tipo == "L" ? 'selected="selected"' : ''); ?> value="L">Legal</option>
                        </select>
                    </div>
                </div>
       
                <div class="col-lg-4">
                    <label id="l_tipo_tarifa">rate type</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2"  id="tipo_tarifa" name="tipo_tarifa">
                            <option <?= ($a->tipo_tarifa == "G" ? 'selected="selected"' : ''); ?> value="G">General</option>
                            <option <?= ($a->tipo_tarifa == "C" ? 'selected="selected"' : ''); ?> value="C">Customized</option>
                        </select>
                    </div>
                </div>


                             
                <div class="col-lg-4">
                    <label id="l_email">Email: </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" data-role="tagsinput" value="<?= $a->email; ?>" id="email" name="email" >
                    </div><!-- /.input group -->
                </div>

                <div class="clearfix"></div>
                <br/>
               
                


            </fieldset>

            <fieldset>
                <legend>Contact information</legend>

                    <div class="col-lg-4">
                        <label id="l_nombre">Contact Name*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-text-width"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->c_nombre; ?>" id="c_nombre" name="c_nombre" >
                        </div><!-- /.input group -->
                    </div>

                    <div class="col-lg-4">
                        <label id="l_celular">Cell phone number*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-mobile"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->c_celular; ?>" id="c_celular" name="c_celular" >
                        </div><!-- /.input group -->
                    </div>

                    <div class="col-lg-4">
                        <label id="l_email">Contac Email: </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a->c_email; ?>" id="c_email" name="c_email" >
                        </div><!-- /.input group -->
                    </div>

                <div class="clearfix"></div>
                <br/>
     
                
            </fieldset>
            <fieldset>
                <legend>Contract information</legend>

                <div class="col-lg-2">
                    <label id="l_tipo_tarifa">Service</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                        </div>
                        <select class="form-control select2"  id="servicio" name="servicio">
                            <?php foreach($data["procesos"] as $procesos){ ?>
                                <option value='<?echo $procesos->id ?>'> <?echo $procesos->nombre ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label id="l_productos">Purpose of contract</label>
                    <div class="input-group">
                        <div class="input-group-addon"data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-bitbucket"></i>
                        </div>
                        <select class="form-control select2"  id="productos" name="productos">
                          <!--  <?//php foreach($data["productos"] as $producto){ ?>
                            <option value='<?//echo $producto->id ?>'> <?//echo $producto->nombre ?> </option>
                            <?//php } ?> -->
                        </select>
                    </div>
                </div

                  <!-- Días Habiles-->
                <div class="col-lg-2">
                    <label id="l_price">Price: </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input  type="text" class="form-control pull-right" value="" id="price" name="price" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-2">
                    <label id="l_tipo_tarifa">Currency</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <select class="form-control select2"  id="moneda" name="moneda">
                            <option  value="D">Dolars</option>
                            <option value="P">Peso</option>
                        </select>
                    </div>
                </div>

                <!-- Días Habiles-->
                <div class="col-lg-2">
                    <label id="l_free_days">Invoice Always:</label>
                    <div class="input-group">
                        <select class='form-control' name='invoice_always' id='invoice_always'>
                            <option value='N'>No</option>
                            <option value='S'>Yes</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                     <!-- Días Habiles-->
                <div class="col-lg-2">
                    <label id="l_free_days">Free Days:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input  type="number" class="form-control pull-right" value="" id="free_days" name="free_days" >
                    </div><!-- /.input group -->
                </div>


            <div class="clearfix"></div><br>
            <button type="button" id="btn-add" class="btn  bg-green pull-right"><i class="fa fa-plus "></i> Add</button>
            <div class="clearfix"></div> <br>
                <table id='databables' class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Process</th>
                        <th>Tank contents</th>
                        <th>Description</th>
                        <th>Group</th>
                        <th>Price</th>
                        <th>Currency</th>
                        <th>Invoice Always</th>
                        <th>Free Days</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
                <div class="box-footer col-md-4 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default"><i class="fa  fa-arrow-left"></i> Cancel</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right"><i class="fa fa-save "></i> Save</button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                    <input id="deleted" name="deleted" type="hidden" value="1" />
                </div>
            </fieldset>
        </div>
    </form>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Register a new contents for Tanks </h4>
      </div>
      <div class="modal-body">
      <!-- -->
        <div class="col-lg-12">
            <label id="l_price">Name*</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-text-width"></i>
                </div>
                <input type="text" class="form-control pull-right" value="" id="name" name="name" maxlength="45">
            </div><!-- /.input group -->
        </div>

        <!--   -->
        <div class="col-lg-12">
            <label id="l_price"> Unit of measurement*</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input type="text" class="form-control pull-right" value="" id="unidad" name="unidad" maxlength="45">
            </div><!-- /.input group -->
        </div>
        <div class="clearfix"></div><br>
        <button type="button" id="btn-new-product" class="btn  bg-green pull-right"><i class="fa fa-save "></i> Save</button>

       <div class="clearfix"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!--  Edit -->

<!-- Modal -->
<div id="modalEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit the products of clients</h4>
      </div>
      <div class="modal-body">
      <!-- -->
        <div class="col-lg-12">
            <label id="l_tipo_tarifa">Service:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-users"></i>
                </div>
                <select class="form-control select2"  id="id_proceso" name="id_proceso">
                    <?php foreach($data["procesos"] as $procesos){ ?>
                        <option value='<?echo $procesos->id ?>'> <?echo $procesos->nombre ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <!--   -->


        <div class="col-lg-12">
            <label id="l_price">Price: </label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                </div>
                <input  type="text" class="form-control pull-right" value="" id="precio" name="precio" >
            </div><!-- /.input group -->
        </div>
    

        <div class="col-lg-12">
                    <label id="l_tipo_tarifa">Currency</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <select class="form-control select2"  id="money" name="money">
                            <option  value="D">Dolars</option>
                            <option value="P">Peso</option>
                        </select>
                    </div>
                </div>

                <!-- Días Habiles-->
                <div class="col-lg-12">
                    <label id="l_free_days">Invoice Always:</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <select class='form-control' name='invoicealways' id='invoicealways'>
                            <option value='N'>No</option>
                            <option value='S'>Yes</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                     <!-- Días Habiles-->
        <div class="col-lg-12">
            <label id="l_free_days">Free Days:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-eye"></i>
                </div>
                <input  type="number" class="form-control pull-right" value="" id="f_days" name="f_days" >
            </div><!-- /.input group -->
        </div>

        <div class="clearfix"></div><br>
        <button type="button" id="btn-update-product" class="btn  bg-green pull-right"><i class="fa fa-save "></i> Save</button>

       <div class="clearfix"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
<input type='hidden' id='cp' >
  </div>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">;   

var table = $('#databables').DataTable({
        ajax:{
            url:"<?php echo $patch ?>clientes/productos",
            dataSrc:'data',
            data:{
                id_cliente: $("#id").val()
            }
        },
        columns:[ 
            { data: "id"} ,
            { data: "service"} ,
            { data: "content" },
            { data: "description" },
             { data: "name" },
            { data: "precio" },
            { data: "moneda" },
            { data: "invoice_always" },
            { data: "dias_libre" },
            {
                "data": null,
                "defaultContent": `
                <button class='btn btn-warning edit' type='button' name='iteme'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</button>
                `
            }

        ]
    });
        $('#databables tbody').on( 'click', 'button.edit', function () {
            var data = table.row( $(this).parents('tr') );
            $.post("<?php echo $patch ?>clientes/getItem",{id:data.data()["id"]},function(response){
                console.log(response);
                $("#cp").val(response.id);
                $("#id_proceso").val(response.id_proceso);
                $("#precio").val(response.precio);
                $("#f_days").val(response.dias_libre)
                $("#invoicealways").val(response.invoice_always)
                $("#money").val(response.moneda);
                $("#modalEdit").modal();
            },'Json')
        })

        $('#databables tbody').on( 'click', 'button.delete', function () {
            var data = table.row( $(this).parents('tr') );
            $.post("<?php echo $patch ?>clientes/deleteItem",{id:data.data()["id"]},function(response){table.ajax.reload();},'Json')
        });

    $("#btn-add").click(function(e){
        if(validateForm1()){
            $.post("<?= $patch ?>clientes/saveClientsProducts",{
                clientes_id:$("#id").val(),
                servicio_id:$("#servicio").val(),
                productos_id:$("#productos").val(),
                dias_libre:$("#free_days").val(),
                moneda:$("#moneda").val(),
                precio:$("#price").val()
            },function(data){table.ajax.reload();
            })
        }
    }); 

    $("#btn-update-product").click(function(e){
        if(validateForm2()){
            $.post("<?= $patch ?>clientes/updateClientsProducts",{
                clientes_id:$("#id").val(),
                id:$("#cp").val(),
                invoice_always:$("#invoicealways").val(),
                servicio_id:$("#id_proceso").val(),
                dias_libre:$("#f_days").val(),
                moneda:$("#money").val(),
                precio:$("#precio").val()
            },function(data){table.ajax.reload();
            })
        }
    });

    $("#btn-new-product").click(function(){
        $.post("<?php echo $patch ?>/clientes/addProductos",{nombre:$("#name").val(),unidad_medida:$("#unidad").val()},function(data){
            if(data){
                $('#myModal').modal('hide');
            }
        })
    })

      function validateForm1() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#free_days').val(), $('#l_free_days').html(), true);
        sErrMsg += validateText($('#price').val(), $('#l_price').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;

    }     
    function validateForm2() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#f_days').val(), $('#l_free_days').html(), true);
        sErrMsg += validateText($('#precio').val(), $('#l_price').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    } 

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#identificacion').val(), $('#l_cedula').html(), true);
        sErrMsg += ($('#tipo').val() === "" ? '- Debe seleccionar Un Tipo de Cliente.\n' : '');
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += validateNumber($('#celular').val(), $('#l_celular').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>clientes';
    });

    $("#id_cliente").dblclick(function(){
       $.post("<?= $patch ?>clientes/getId",{},function(data){
           $("#identificacion").val(data);
       });
    })

    $('#btn-save').click(function () {
        if (validateForm()) {
            validarID();
            $("#form1").submit();
        }
    });

    $('#identificacion').change(function () {
        validarID();
    });

    function validarID() {
        $("#form1").mask("Espere...");
        $.post('<?= $patch; ?>clientes/validar', 
            {
                tipo: "NJ", ced: $('#identificacion').val(), id: $("#id").val()
            },
            function (data) {
                $("#form1").unmask();
                if (data=='true') {
                    alert('The ID  is already registered');
                    $('#identificacion').val("");
                } 
            }
        );
    }

    $('#btn-cancel').click(function () {
        $.post('<?= $patch; ?>clientes/clean', {}, function (data) {
            window.location = '<?= $patch; ?>clientes';
        });
    });

    $('#productos').select2({
            tags: true,
            ajax:{
                url:'<?php echo $data["rootUrl"] ?>clientes/getContents',
                dataType: 'json',
                data:function(params){
                    var query={
                        search:params.term,
                    }
                    return  query;
                },
                processResults:function(data){
                    if(data){
                        return{
                            results: $.map(data.item,function(item){

                                return{
                                    text:item.nombre,
                                    id:item.id,
                                }
                            })
                        }
                    }else{
                        return{
                            results:null
                        }
                    }
                }
            }
        });//end od search category
        
        
        
  
    
    
</script>
