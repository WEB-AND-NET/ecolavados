<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["paquetes"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Pack Register' : 'Pack update'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Packs</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Pack Register' : 'Pack update'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>packs/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>
                
                <div class="col-lg-4">
                    <label id="l_clientes_id">Client*</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="clientes_id" id="clientes_id">
                            <option value="N">[Select]</option>
                            <?php foreach($data["clientes"] as $cliente){?>
                                <option <?php echo  $a->clientes_id==$cliente["id"] ? 'selected' : '' ?> value="<?php echo $cliente["id"] ?>"><?php echo $cliente["nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>
                <!-- Clientes productos -->
                <div class="col-lg-4">
                    <label id="l_clientes_id">Contract Item*</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="clientes_productos" id="clientes_productos">
                            
                        </select>
                    </div><!-- /.input group -->
                </div>



                <div class="col-lg-4">
                    <label id="l_nombre">Name*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" >
                    </div><!-- /.input group -->
                </div>

          

                <div class="col-lg-4">
                    <label id="l_nombre">Total Value*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <input type="number"  class="form-control pull-right" value="<?= $a->precio=="" ? 0:$a->precio ; ?>" id="precio" name="precio" readonly maxlength="45">
                    </div><!-- /.input group -->
                </div>

            </fieldset>

            <div class="clearfix"> </div><br>


            <fieldset>

                <legend>Items of Pack</legend>

                <div class="col-lg-4">
                    <label id="l_clientes_id">Product*</label>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon" >
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="productos_id" id="productos_id">
                            <?php foreach($data["productos"] as $productos){ ?>
                                <option value="<?php echo $productos["id"] ?>"><?php echo "Product: ".$productos["nombre"].', Unity:'.$productos["unidad_medida"] ?></option>
                            <?php 
                        } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_quanti">Quantity*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <input type="number" class="form-control pull-right" value="" id="quanti" name="quanti" maxlength="45">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_price">Price*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                        </div>
                        <input type="number" class="form-control pull-right" value="" id="price" name="price" maxlength="45">
                    </div><!-- /.input group -->
                </div>

            </fieldset>
            <div class="box-footer col-md-1 pull-right">
                   <!-- <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                        <i class="fa  fa-bitbucket"></i> delete
                    </button>-->
                    <button type="button" id="btn-insert" class="btn  bg-green ">
                        <i class="fa  fa-save "></i> Insert
                    </button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
            </div>
            <div class="clearfix"></div><br>
            <table id='databables' class="table table-bordered table-striped">
                <thead>
                    <tr>
                    
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                        
                    </tr>
                </thead>
            </table>
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
   var table = $('#databables').DataTable({
        ajax:{
            url:"<?php echo $patch ?>packs/getItems",
            dataSrc:'data'
        },
        columns:[ 

            { data: "productos_name"} ,
            { data: "cantidad" },
            { data: "precio" },
            { data: "total" },
            {
                "data": null,
                "defaultContent": "<input class='btn btn-danger' value='Delete' type='button' name='items'>"
            }
            ]
    });

    $('#databables tbody').on( 'click', 'input', function () {
        var data = table.row( $(this).parents('tr') );
        if(confirm(`Seguro deseas eliminar el producto ${data.data()["productos_name"]}`)){
            var  precio = parseInt($("#precio").val())-parseInt(data.data()["precio"]);
            $("#precio").val(precio)
            $.post("<?php echo $patch ?>packs/deleteItem",{index:data.index()},function(){
                table.ajax.reload();
            })
        }
        console.log(data);
       // alert( data["productos_name"] +"'s salary is: "+ data[ 5 ] );
    } );

    if("<?= $data["ClientesProductosPaquetes"] ?>"=="<?= $a->id ?>"){
        getClientesProductos(<?php echo $a->clientes_id ?>);
        $.post("<?php echo $patch ?>packs/productosItem",{id_paquete:$("#id").val()},function(e){
            $("#clientes_productos").val(e);
        })  
    }

    $("#clientes_id").change(function(){
        getClientesProductos($(this).val())
    })


    function getClientesProductos(id){
        var html="";
        $.get("<?php echo $patch ?>clientes/productos",{id_cliente:id},function(data){
            console.log(data)
            if(!data || data.data.length==0){
                alert("No items in the contract")
            }else{
                html=`<option value"0">[Select]</option>`;
                data.data.forEach(function(item){
                    html += `<option value="${item.id}">Service:${item.service},<b> Tank content:</b>${item.content}</option>`;
                })
            }
            $("#clientes_productos").html(html)
            
        },'Json');
    }

    $("#clientes_productos").change(function(e){
        $("<?php echo $patch ?>clientes/getClientesProductos",{},function(){
            
        })
    });

    $("#btn-insert").click(function(){
        if(validateForm()){
            var elementos = [];
            elementos=table.column().data();
            insert=false;
            var product = $("#productos_id option:selected").text();
            if(elementos.length>0){
                if(elementos.indexOf(product) < 0  ){
                    insert=true;
                }else{
                    alert(`Product is already added in the package: ${product}`)
                }
            }else{
                insert=true;
            } 

            if(insert==true){
                var oldprice=parseFloat($("#precio").val())
                var newprice=parseFloat($("#price").val())
                var cantidad=$("#quanti").val();
                var totalUnit=newprice*cantidad;
                var total=oldprice+(newprice*cantidad)
                $("#precio").val(total)
                $.post("<?php echo $patch ?>packs/insert",
                {
                    productos_name:$("#productos_id option:selected").text(),
                    productos_id:$("#productos_id").val(),
                    cantidad:cantidad,
                    precio:newprice,
                    total:totalUnit,
                    deleted:1,
                    id:0,
                },function(data){
                    table.ajax.reload();
                });
            }
        }
    });

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#quanti').val(), $('#l_quanti').html(), true);
        sErrMsg += validateText($('#price').val(), $('#l_price').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
    function validateForm1() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#nombre').val(), $('#l_quanti').html(), true);

        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>packs';
    });
    
    $("#btn-save").click(function(){
        if(validateForm1()){
           $("#form1").submit();
        }
    })
</script>