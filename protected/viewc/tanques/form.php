<?php $a = $data["tanques"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Tanks Register' : 'Tanks update'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Tanks</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Tanks Registration' : 'Update of Tanks'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>tanks/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>
            </fieldset>

            <div class="col-lg-4">
                <label id="l_plate">Plate*</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-text-width"></i>
                    </div>
                    <input type="text" class="form-control pull-right" value="<?= $a->serial; ?>" id="serial" name="serial" maxlength="45">
                </div><!-- /.input group -->
            </div>
            
            <div class="col-lg-4">
                <label id="l_make_date">Manufacturing date*</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa   fa-clock-o  "></i>
                    </div>
                    <input type="date" class="form-control pull-right" value="<?= $a->make_date; ?>" id="make_date" name="make_date" maxlength="45">
                </div><!-- /.input group -->
            </div>

            <div class="col-lg-4">
                <label id="l_test30">Test 2,5*</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa   fa-clock-o  "></i>
                    </div>
                    <input type="date" class="form-control pull-right" value="<?= $a->test30; ?>" id="test30" name="test30" maxlength="45">
                </div><!-- /.input group -->
            </div>

            <div class="col-lg-4">
                <label id="l_test60">Test 5*</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa   fa-dashboard  "></i>
                    </div>
                    <input type="date" class="form-control pull-right" value="<?= $a->test60; ?>" id="test60" name="test60" maxlength="45">
                </div><!-- /.input group -->
            </div>

           

            <div class="col-lg-4">
                <label id="l_clientes_id">Client*</label>
                <div class="input-group margin-bottom-20">
                    <span data-toggle="modal" data-target="#myModal" class="input-group-addon">
                        <i  class="fa fa-code-fork "></i>
                    </span>
                 
                    <select class='form-control' name="clientes_id" id="clientes_id">
                    <?php foreach($data["clientes"] as $cliente){?>
                        <option value="<?php echo $cliente["id"] ?>"><?php echo $cliente["nombre"] ?></option>
                    <?php } ?>
                    </select>
                </div><!-- /.input group -->
            </div>
            
            <div class="clearfix"></div>

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
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>

    $('#clientes_id').select2({})

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>tanks';
    });
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#serial').val(), $('#l_plate').html(), true);
 
     
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
           // alert($("#test30").val());
           $("#form1").submit();
        }
    })
</script>