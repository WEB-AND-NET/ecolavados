<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["items"]; 
 ?>


<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Register entry inspection items' : 'Register entry inspection items'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Register entry inspection items' : 'Register entry inspection items'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>items/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_descripcion">Descripcion*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->descripcion; ?>" id="descripcion" name="descripcion">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_principal">Principal*</label>
                    <div class="input-group margin-bottom-20" >
                        <span class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="principal" id="principal">
                            <option <?= $a->principal=='S' ? 'selected' : '' ?> value="S">YES</option>
                            <option <?= $a->principal=='N' ? 'selected' : '' ?> value="N">NO</option>
                            
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_depende">It depends*</label>
                    <div class="input-group margin-bottom-20" >
                        <span class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control blocks' name="depende" id="depende">
                        <option value="X">Please select a option</option>
                        <option <?= $a->depende=='N' ? 'selected' : '' ?> value="N">NO</option>
                        <?php foreach($data["principales"] as $principal){ ?>
                            
                            <option <?= $a->depende==$principal["id"] ? 'selected' : '' ?> value="<?= $principal["id"] ?>"><?= $principal["descripcion"] ?></option>
                        <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_tipo">Ratings*</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal" data-target="#myModal" class="input-group-addon">
                            <i  class="fa fa-plus"></i>
                        </span>
                        <select multiple class='form-control blocks' name="tipo[]" id="tipo">
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_tipo">Editable*</label>
                    <div class="input-group margin-bottom-20">
                        <span  class="input-group-addon">
                            <i  class="fa fa-plus"></i>
                        </span>
                        <select  class='form-control ' name="editable" id="editable">
                            <option <?= $a->editable == 'N' ? 'selected' :''; ?> value='N'>NO</option>
                            <option <?= $a->editable == 'S' ? 'selected' :''; ?> value='S'>YES</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_tipo">Is Area*</label>
                    <div class="input-group margin-bottom-20">
                        <span  class="input-group-addon">
                            <i  class="fa fa-plus"></i>
                        </span>
                        <select  class='form-control ' name="is_area" id="is_area">
                            <option <?= $a->is_area == 'N' ? 'selected' :''; ?> value='N'>NO</option>
                            <option <?= $a->is_area == 'S' ? 'selected' :''; ?> value='S'>YES</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_tipo">Is Item Area*</label>
                    <div class="input-group margin-bottom-20">
                        <span  class="input-group-addon">
                            <i  class="fa fa-plus"></i>
                        </span>
                        <select  class='form-control ' name="is_item_area" id="is_item_area">
                            <option <?= $a->is_item_area == 'N' ? 'selected' :''; ?> value='N'>NO</option>
                            <option <?= $a->is_item_area == 'S' ? 'selected' :''; ?> value='S'>YES</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_order">Order*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>       
                        </div>
                        <input type="number" class="form-control pull-right" value="<?= $a->item_order; ?>" id="item_order" name="item_order">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_area_to_belong">Areas*</label>
                    <div class="input-group margin-bottom-20" >
                        <span class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="area_to_belong" id="area_to_belong">
                        <option value="">Please select a option</option>                        
                        <?php foreach($data["areas"] as $area){ ?>                            
                            <option <?= $a->area_to_belong==$area["id"] ? 'selected' : '' ?> value="<?= $area["id"] ?>"><?= $area["descripcion"] ?></option>
                        <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

    
                <div class="clearfix"></div><br>

                <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>
                <input name="id" type="hidden" id="id" value="<?= $a->id; ?>" />
            </div>



            </fieldset>
        </div>
    </form>
</div>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Ratings</h4>
      </div>

<div class="modal-body"><!-- Modal Body-->
        <div class="col-lg-12">
            <label id="l_rtipo">Name of Ratings*</label>

            <div class="input-group ">
                <div class="input-group-addon">
                    <i class="fa fa-text-width"></i>
                </div>
                <input type="text" class="form-control pull-right" value="" id="rtipo" name="rtipo" >
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
                    <button type="button" id="btn-save-ratings" class="btn  bg-green pull-right">
                        <i class="fa fa-save"></i> Save
                    </button>
            
                </div>
            </div>
            
        </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script>

    $(".blocks").attr("disabled", "disabled");

    $(document).ready(function(){
        veryfi();
        if($("#id").val()){
            $.post("<?= $data["rootUrl"] ?>items/getItemsCalificaciones",{id:$("#id").val()},function(data){                
                data.forEach(function(item){
                    var option = new Option(item.descripcion,item.id, true, true);
                    $("#tipo").append(option).trigger('change');
                })
            },'Json')
        }
    })

    $("#principal").change(function(){
        veryfi();
    })

    $("#depende").change(function(){
        if($(this).val()=="N"){
            $(".blocks,#editable").attr("disabled", "disabled");
        }else{
            $(".blocks,#editable").removeAttr("disabled");
        }
    })

    $("#is_area").change(function(){
        if($(this).val()=="S"){
            $("#is_item_area").attr("disabled", "disabled");
        }else{
            $("#is_item_area").removeAttr("disabled");
        }
    })
    function veryfi(){
        if($("#principal").val()=="S"){
            $(".blocks,#editable,#is_area,#is_item_area,#item_order").attr("disabled", "disabled");
        }else{
            $(".blocks,#editable,#is_area,#is_item_area,#item_order").removeAttr("disabled");
        }
    }

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#descripcion').val(), $('#l_descripcion').html(), true);
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

    $("#btn-save-ratings").click(function(){
        if(validateForm1()){
            $.post("<?php echo $patch  ?>items/saveTipo",{descripcion:$("#rtipo").val()},function(data){
                $('#myModal').modal('hide');
            })
        }
    })

    $("#btn-save").click(function(){
        if(validateForm()){
            if($("#principal option:selected").val()=="S" && $("#editable option:selected").val()=="S"){
                alert("The principal no is editable");
            }else if($("#is_area option:selected").val()=="S" && $("#order").val()==""){
                alert("Order for area is required!");
            }else{
                $("#form1").submit();
            }
        }
    })
    $('#tipo').select2({        
        ajax:{
            url:'<?php echo $data["rootUrl"] ?>items/getTipo',
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
                                text:item.descripcion,
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
        },tags: true
        });//end od search category

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>items';
    });
</script>
