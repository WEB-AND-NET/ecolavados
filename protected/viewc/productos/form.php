<?php $a = $data["productos"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Products Registration' : 'Product update'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Products Registration' : 'Update of Products'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>products/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_nombre">Name*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre" maxlength="45">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_cantidad">Quantity*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->cantidad; ?>" id="cantidad" name="cantidad" maxlength="45">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_tipo">Category*</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal" data-target="#myModal" class="input-group-addon">
                            <i  class="fa fa-plus"></i>
                        </span>
                        <select class='form-control' name="tipo" id="tipo">
                            
                            </select>
                    </div><!-- /.input group -->
                </div>

                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <label id="l_unidad_medida">Unit of measurement*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-object-ungroup"></i>
                        </div>
                        <select class='form-control' name='unidad_medida' id='unidad_medida'>
                            <?php foreach($data["unidades"] as $unidad){ ?>
                                <option <?php echo $a->unidad_medida==$unidad->acronimo ? 'selected' : '' ?> value='<?= $unidad->id ?>'><?= $unidad->nombre ?></option>
  
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_group">Groups*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-object-group"></i>
                        </div>
                        <select class='form-control' name='grupo' id='grupo'>
                            <?php foreach($data["grupos"] as $grupos ){ ?>
                                <option <?= $a->grupo==$grupos->id ? 'selected' : '' ?> value='<?= $grupos->id ?>'><?= $grupos->name?></option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-2">
                    <label id="l_precio_compra">Purchase price*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-money "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->precio_compra; ?>" id="precio_compra" name="precio_compra" maxlength="45">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-2">
                    <label id="l_free_days">Available for packages:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-th"></i>
                        </div>
                        <select class='form-control' name='para_paquetes' id='para_paquetes'>
                            <option <?php echo $a->para_paquetes=='N' ? 'selected' : '' ?> value='N'>No</option>
                            <option <?php echo $a->para_paquetes=='S' ? 'selected' : '' ?> value='S'>Yes</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-12">
                    <label id="l_precio_compra">Description*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa fa-th"></i>
                        </div>
                        <textarea class="form-control pull-right" name="description" id="description" ><?= $a->description; ?></textarea>
                    </div><!-- /.input group -->
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
 
    <!--modal-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>

      <div class
      ="modal-body"><!-- Modal Body-->

        <div class="col-lg-12">
            <label id="l_rtipo">Name of category*</label>

            <div class="input-group ">
                <div class="input-group-addon">
                    <i class="fa fa-text-width"></i>
                </div>
                <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="rtipo" name="rtipo" maxlength="45">
            </div>
            <!-- /.input group --><div class='clearfix'></div>
        </div>

      </div><!--end of Modal Body-->
      <div class="clearflix"></div><br>

        <div class="modal-footer">

            <div class="mailbox-controls" style="float:right;">
                    <!-- Check all button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-save-category" class="btn  bg-green pull-right">
                        <i class="fa fa-save"></i> Save
                    </button>
            
                </div>
            </div>
            
        </div>
    </div>
  </div>
</div>
<!-- end of mdal-->
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
         //Searc a category
        $('#tipo').select2({
            tags: true,
            ajax:{
                url:'<?php echo $data["rootUrl"] ?>products/getTipo',
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
                                    text:item.tipo,
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
        });//end od search categor
    })
  

    $("#btn-save-category").click(function(){
        if(validateForm1()){
            $.post("<?php echo $patch  ?>products/saveTipo",{tipo:$("#rtipo").val()},function(data){
                $('#myModal').modal('hide');

            })
        }
        
    })
    
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>products';
    });
    
    $("#btn-save").click(function(){
        if(validateForm()){
           $("#form1").submit();
        }
    })
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += ($('option').length === 0 ? '- Select category.\n' : '');
        sErrMsg += validateText($('#cantidad').val(), $('#l_cantidad').html(), true);
        sErrMsg += validateText($('#unidad_medida').val(), $('#l_unidad_medida').html(), true);
        sErrMsg += validateText($('#precio_compra').val(), $('#l_precio_compra').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
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
        sErrMsg += validateText($('#rtipo').val(), $('#l_rtipo').html(), true);
       
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;

    }

</script>

