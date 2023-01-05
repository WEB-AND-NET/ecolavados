<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["request"]; 
 ?>


<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Register Request' : 'Update Request'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Request</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Register Request' : 'Register Request'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>request/save" enctype="multipart/form-data" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                
                <div class="col-lg-4">
                    <label id="l_clientes_id">Client*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="clientes_id" id="clientes_id">
                            <option value="N">[Select]</option>
                            <?php foreach($data["clientes"] as $cliente){?>
                                <option  value="<?php echo $cliente["id"] ?>"    ><?php echo $cliente["nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_clientes_id">Entry*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-cube"></i>
                        </span>
                        <select class='form-control' name="id_entrada" id="id_entrada">
                           
                        </select>
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_email_subject">Descripcion*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-envelope"></i>
                        </span>
                        <textarea class='form-control' id='descripcion' name='descripcion'></textarea>
                    </div><!-- /.input group -->
                </div>

                <div class="clearfix"></div>

                <div class="col-lg-4">
                    <label id="l_email_subject">Email Subject*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-envelope"></i>
                        </span>
                        <textarea class='form-control' id='email_subject' name='email_subject'></textarea>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_email_body">Email Body*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-envelope"></i>
                        </span>
                        <textarea class='form-control' id='email_body' name='email_body'></textarea>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_invoice_description">Invoice Description*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa  fa-calculator"></i>
                        </span>
                        <textarea class='form-control' id='invoice_description' name='invoice_description'></textarea>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_invoice_description">Invoice image*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-archive"></i>
                        </span>
                        <input  class='form-control' id='img' name='img' type='file'>
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_labour_rate">Labour Rate*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-money"></i>
                        </span>
                        <input  class='form-control' id='labour_rate' name='labour_rate' type='number'>
                    </div><!-- /.input group -->
                </div>





<div class="clearfix"></div>

            <fieldset>
                <legend>Request details</legend>
                <div class="col-lg-4">
                    <label id="l_id_area">Areas*</label>
                    <div class="input-group margin-bottom-20" >
                        <span class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="id_area" id="id_area">
                        <option value="X">Please select a option</option>                        
                        <?php foreach($data["areas"] as $area){ ?>                            
                            <option value="<?= $area["id"] ?>"><?= $area["descripcion"] ?></option>
                        <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>


                <div class="col-lg-4">
                    <label id="l_id_items_area">Item Area*</label>
                    <div class="input-group margin-bottom-20" >
                        <span class="input-group-addon">
                            <i  class="fa fa-cube"></i>
                        </span>
                        <select class='form-control' name="id_items_area" id="id_items_area">
                        </select>
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_id_damage">Damage*</label>
                    <div class="input-group margin-bottom-20" >
                        <span class="input-group-addon">
                            <i  class="fa fa-cubes"></i>
                        </span>
                        <select class='form-control' name="id_damage" id="id_damage">
                            <option value="X">Please select a option</option>                        
                            <?php foreach($data["damages"] as $damage){ ?>                            
                                <option value="<?= $damage["id_damage"] ?>"><?= $damage["damage"] ?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>


                <div class="col-lg-4">
                    <label id="l_id_services">M&R*</label>
                    <div class="input-group margin-bottom-20" >
                        <span class="input-group-addon">
                            <i  class="fa fa-cube"></i>
                        </span>
                        <select class='form-control' name="id_services" id="id_services">
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_hours">Hours*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-clock-o"></i>
                        </span>
                        <input  class='form-control' id='hours' name='hours' type='number'>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_hours">Material*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-money"></i>
                        </span>
                        <input  class='form-control' id='material' name='material' type='number'>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-12">
                    <label id="l_email_subject">Remarks</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-envelope"></i>
                        </span>
                        <textarea class='form-control' id='remarks' name='remarks'></textarea>
                    </div><!-- /.input group -->
                </div>
                
                <div class="clearfix"></div><br>
            <button type="button" id="btn-add" class="btn  bg-green pull-right"><i class="fa fa-plus "></i> Add</button>
            <div class="clearfix"></div> <br>
                <table id='databables' class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Area</th>
                            <th>Item Area</th>
                            <th>Damage Code</th>
                            <th>REP Code</th>
                            <th>Remarks</th>
                            <th>Hours</th>
                            <th>Material</th>
                            <th>Total</th>
                            <th>Img</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                </table>
            </fieldset>

       
                
          
                <div class="clearfix"></div><br>

                <div class="box-footer col-md-4 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                        <i class="fa  fa-arrow-left"></i> Cancel
                    </button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">
                        <i class="fa fa-save "></i> Save
                    </button>
                    <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
                 <!--   <input name="img" type="hidden" id="imgnext" value="<?//= $a->img; ?>" />-->
                </div>
            </fieldset>
        </div>
    </form>
</div>


<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>

$("#email").select2({});
var table = $('#databables').DataTable({
        ajax:{
            url:"<?php echo $patch ?>request/getDetailsRequest",
            dataSrc:'data'
        },
        columns:[ 
            { data: "area_name"} ,
            { data: "area_item_name"} ,
            { data: "damage_code" },
            { data: "services_code" },
            { data: "remarks" },           
            { data: "hours" },
            { data: "material" },
            { data: "total" },
            {
                "data": null,
                "defaultContent": "<input type='file' class='img' value='' type='button' name='img'>"
            },
            {
                "data": null,
                "defaultContent": "<input class='btn btn-danger delete' value='Delete' type='button' name='items'>"
            }
        ]
    } );

     $("#btn-add").click(function(){
        const labour_rate = $("#labour_rate").val();
        const id_area = $("#id_area").val();
        const id_items_area = $("#id_items_area").val();
        const id_damage = $("#id_damage").val();
        const id_services = $("#id_services").val();
        const hours = $("#hours").val();
        const material = $("#material").val();
        const remark = $("#remarks").val();
        if(labour_rate=="" || labour_rate == 0){
            alert("Please add labour rate or labour rate should be major to zero.")
            return;
        }        
        if(id_area == "X"){
            alert("Please select a area");
            return;
        }
        if(id_items_area == "X"){
            alert("Please select a item area");
            return;
        }
        if(id_damage == "X"){
            alert("Please select a damage");
            return;
        }
        if(id_services == "X"){
            alert("Please select a services");
            return;
        }
        if(hours < 0 || hours == ""){
            alert("Hours not should be minor to zero or empty");
            return;
        }
        if(material < 0 || material == ""){
            alert("Material not should be minor to zero or empty");
            return;
        }
        $("#labour_rate").prop( "readonly", true );
        $.post("<?= $patch; ?>request/insert",{
            labour_rate,
            id_area, 
            id_items_area, 
            id_damage, 
            id_services,
            hours, 
            material, 
            remark
        },function(data){
            console.log(data);
        });
        table.ajax.reload();
      /*   if($("#paquetes").val()=="R" && $("#clientes_productos").val()=="R"){

        }else{
            if(!$("#paquetes").attr("disabled")){
                $.post("<?= $patch; ?>request/insert",{damage:$("#items_entrada").val(),packete:$("#paquetes").val(),cantidad:$("#cantidad").val()},function(data){
                    console.log(data);
                });
            }else{
                $.post("<?= $patch; ?>request/insert",{damage:$("#items_entrada").val(),productos_cliente:$("#clientes_productos").val(),cantidad:$("#cantidad").val()},function(data){
                    console.log(data);
                });
            }
            
            $("#cantidad").val(1)
        }
        
       */ 
    })

    $('#databables tbody').on( 'click', 'input.img', function () {
        var data = table.row( $(this).parents('tr') );
        $(this).attr("name",`img${data.index()}`)
        alert();
/*
        if(confirm(`Seguro deseas eliminar el item ${data.data()["name_item_repair"]}`)){
           
            $.post("<?//php echo $patch ?>request/deleteItem",{index:data.index()},function(){
                table.ajax.reload();
            })
        }*/
        console.log(data);
       // alert( data["productos_name"] +"'s salary is: "+ data[ 5 ] );
    } );

    $('#databables tbody').on( 'click', 'input.delete', function () {
        var data = table.row( $(this).parents('tr') );
        if(confirm(`Seguro deseas eliminar el item ${data.data()["name_item_repair"]}`)){
           
            $.post("<?php echo $patch ?>request/deleteItem",{index:data.index()},function(){
                table.ajax.reload();
            })
        }
        console.log(data);
       // alert( data["productos_name"] +"'s salary is: "+ data[ 5 ] );
    } );

    function load_selects(cliente,entrada){
         $.post("<?= $patch; ?>/request/getEntradas",{id_cliente:cliente},function(data){
            var html = `<option value='X'>[Select]</option>`;
            data.forEach(function(items){
                html += `<option value='${items.id}' ${items.id==entrada ? 'selected':'' }>#Entry:${items.id},Tank Serial: ${items.serial}</option>`
            })
            $("#id_entrada").html(html);
        },'Json');
        var html ="";
        $.post("<?= $patch; ?>/request/getEmails",{id_cliente:cliente},function(data){
            data=data.split(",")
            data =data;
            data.forEach(function(items){
                html += `<option value='${items}'>${items}</option>`
            })
            $("#email").html(html);
        });
       
        $.post("<?= $patch; ?>/request/getPaquetes",{id_cliente:cliente},function(data){
            var html ="<option value='R'>[Rebot]</option>";
            data.forEach(function(items){
                html += `<option value='${items.id}'>${items.nombre}</option>`
            })
            $("#paquetes").html(html);
        },'Json');
          
        $.post("<?= $patch; ?>request/getClienteProductos",{id_cliente:cliente},function(data){
            var html ="<option value='R'>[Rebot]</option>";
            data.forEach(function(items){
                html += `<option value='${items.id}'>${items.nombre}</option>`
            })
            $("#clientes_productos").html(html);
        },'Json');
    }
  

    $("#clientes_id").change(function(){
        load_selects($(this).val(),"")
    });

    $("#clientes_productos").change(function(){
        if($(this).val()!="R"){
            $("#paquetes").attr("disabled","disabled")
        }else{
            $("#paquetes").removeAttr("disabled")
        }
    })

    $("#paquetes").change(function(){
        if($(this).val()!="R"){
            $("#clientes_productos").attr("disabled","disabled")
        }else{
            $("#clientes_productos").removeAttr("disabled")
        }
    })

    $(document).ready(function(){
        $.post("<?= $patch; ?>/request/getRequest",{id_request:$("#id").val()},function(data){
            if(data){
                 $("#descripcion").val(data.descripcion);
                $("#clientes_id").val(data.id_cliente);
                $("#email_subject").val(data.email_subject)
                $("#invoice_description").val(data.invoice_description)
                $("#email_body").val(data.email_body);
                load_selects(data.id_cliente,data.entrada)
            }
        },'Json');

        function getEntradas(id,entrada){
            $.post("<?= $patch; ?>/request/getEntradas",{id_cliente:id},function(data){
                var html = `<option value='X'>[Select]</option>`;
                data.forEach(function(items){
                    html += `<option value='${items.id}' ${items.id==entrada ? 'selected':'' }>#Entry:${items.id},Tank Serial: ${items.serial}</option>`
                })
                $("#id_entrada").html(html);
            },'Json');
        }
    })


    $("#id_entrada").change(function(data){
        $.post("<?= $patch; ?>/request/getItems",{id_entrada:$(this).val()},function(data){
            var html = `<option value='X'>General</option>`;
            data.forEach(function(items){
                html += `<option value='${items.id}'>${items.damage}</option>`
            })
            $("#items_entrada").html(html);
        },'Json');
    })


    $("#id_area").change(function(data){
        $.post("<?= $patch; ?>/request/getItemsArea",{id_area:$(this).val()},function(data){
            var html = `<option value='X'>Select a option</option>`;
            data.forEach(function(items){
                html += `<option value='${items.id}'>${items.descripcion}</option>`
            })
            $("#id_items_area").html(html);
        },'Json');
    })

    $("#id_damage").change(function(data){
        $.post("<?= $patch; ?>items/mr/getGuidelineItems",{id:$(this).val()},function(data){
            var html = `<option value='X'>Select a option</option>`;
            data.forEach(function(items){
                html += `<option value='${items.id}'>${items.mr}</option>`
            })
            $("#id_services").html(html);
        },'Json');
    })
    

    function validateForm() {

        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#email_subject').val(), $('#l_email_subject').html(), true);
        sErrMsg += validateText($('#email_body').val(), $('#l_email_body').html(), true);
        sErrMsg += validateText($('#invoice_description').val(), $('#l_invoice_description').html(), true);
        sErrMsg += $("#clientes_id option:selected").val()== 'N'? '- Client is required\n': '';
        sErrMsg += $("#id_entrada option:selected").val()== 'X'? '- Entry is required\n': '';
      
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
    
        $("#id_entrada").select2({})

    
    function readFile() {
        if (this.files && this.files[0]) {
        var FR= new FileReader();
        FR.addEventListener("load", function(e) {
            console.log( e.target.result);
            //document.getElementById("img").src       = e.target.result;
            document.getElementById("imgnext").value = e.target.result;
        }); 
        FR.readAsDataURL( this.files[0] );
        }
    }

    document.getElementById("img").addEventListener("change", readFile);


    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>request';
    });
</script>
