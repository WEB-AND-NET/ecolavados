<!--/*
tes642
egq843
mun705
*/-->

<?php $a = $data["categorys"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Category Registration' : 'Category update'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Category Registration' : 'Update of Category'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>products/categorys/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-6">
                    <label id="l_tipo">Name*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->tipo; ?>" id="tipo" name="tipo" >
                    </div><!-- /.input group -->
                </div>


                <div class="col-lg-4">
                    <label id="l_para_clientes">For clients*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon"><i  class="fa fa-text-width"></i></span>
                        <select class='form-control' name="para_clientes" id="para_clientes">
                           <option <?= $a->para_clientes=='S'  ? 'selected': ''; ?> value="S">YES</option>
                           <option <?= $a->para_clientes=='N'  ? 'selected': ''; ?> value="N">NO</option>
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

<!-- end of mdal-->
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript">
    
  

    
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>products/categorys';
    });
    
    $("#btn-save").click(function(){
        if(validateForm()){
           $("#form1").submit();
        }
    })
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#tipo').val(), $('#l_tipo').html(), true);
      
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }
  

</script>

