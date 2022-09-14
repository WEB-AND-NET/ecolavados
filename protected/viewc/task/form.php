<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["task"]; 
 ?>


<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Register Taks' : 'Register Taks'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Task</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Register Task' : 'Register Task'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>task/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_nombre">Taks Name*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->nombre; ?>" id="nombre" name="nombre">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_numero">Number</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->numero; ?>" id="numero" name="numero">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_principal">Principal*</label>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon" >
                            <i  class="fa fa-code-fork "></i>
                        </span>
                    
                        <select class='form-control' name="principal" id="principal">
                            <option <?= $a->principal=='N' ? 'selected' : ''; ?> value="N">NO</option>
                            <option <?= $a->principal=='S' ? 'selected' : ''; ?> value="S">SI</option>
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

<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);
        sErrMsg += validateText($('#numero').val(), $('#l_numero').html(), true);
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
    
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>status';
    });
</script>
