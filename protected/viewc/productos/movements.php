<?php $a = $data["productos"]; ?>
<section class="content-header">
    <h1 style="color: #6c9cd9;">
   Name of Product: <?php echo $a["nombre"]; ?>,  Quantity in stock : <?= $a["cantidad"]; ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> <?= ($a["id"] == "" ? 'Customers Registration' : 'Update of Clients'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>products/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General Information</legend>


                <div class="col-lg-4">
                        <label id="l_movement">movement type*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-object-group"></i>
                            </div>
                            <select class='form-control' name='movement' id='movement'>
                                <option  value='I'>Entry</option>
                                <option  value='D'>Dispatch</option>
                                <option  value='U'>Update</option>
                            </select>
                        </div><!-- /.input group -->
                    </div>
                    
                    <div class="col-lg-4">
                        <label id="l_cantidad">Name*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th"></i>
                            </div>
                            <input type="text" class="form-control pull-right"  value="<?php echo $a["nombre"]; ?>" id="nombre" name="nombre" maxlength="45">
                        </div><!-- /.input group -->
                    </div>
                    <div class="col-lg-4">
                        <label id="l_cantidad">Quantity*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="" id="cantidad" name="cantidad" maxlength="45">
                        </div><!-- /.input group -->
                    </div>

                    <div class="col-lg-4">
                        <label id="l_unidad_medida">Unit of measurement*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa ffa-object-ungroup"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?= $a["unidad_medida"]; ?>" id="unidad_medida" name="unidad_medida" maxlength="45">
                        </div><!-- /.input group -->
                    </div>

                    <div class="col-lg-4">
                        <label id="l_group">Groups*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-object-group"></i>
                            </div>
                            <select class='form-control' name='group' id='group'>
                                <?php foreach($data["grupos"] as $grupos ){ ?>
                                    <option <?= $a["grupo"]==$grupos->id ? 'selected' : '' ?> value='<?= $grupos->id ?>'><?= $grupos->name?></option>
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
                        <input type="text" class="form-control pull-right" value="<?= $a["precio_compra"]; ?>" id="precio_compra" name="precio_compra" maxlength="45">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-12">
                    <label id="l_description">Description of product*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa fa-th"></i>
                        </div>
                        <textarea class="form-control pull-right" name="description" id="description" ><?= $a["description"]; ?></textarea>
                    </div><!-- /.input group -->
                </div>


                <div class="col-lg-12">
                    <label id="l_details">Description of movement*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa fa-th"></i>
                        </div>
                        <textarea class="form-control pull-right" name="details" id="description" ></textarea>
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
                    <input name="id" type="hidden" id="id" value="<?= $a["id"]; ?>" />
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script>
    $("#btn-save").click(function(){
        if(validateForm()){
            $("#form1").submit();
        }
    })
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        if($("#movement").val()!="U"){
            sErrMsg += validateText($('#cantidad').val(), $('#l_cantidad').html(), true);
            sErrMsg += validateText($('#unidad_medida').val(), $('#l_unidad_medida').html(), true);
        }
            
        
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>products';
    });
</script>
