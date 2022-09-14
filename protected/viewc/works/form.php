<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["works"]; 
 ?>


<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Register Works' : 'Register Works'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Works</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Register Works' : 'Register Works'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>works/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

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
                    <label id="l_id_empleado_autorizado">Certificate:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="id_certificado" id="id_certificado">
                   
                            <?php foreach($data["certificados"] as $certificados){?>
                                <option <?php echo  $a->id_certificado==$certificados->id ? 'selected' : '' ?> value="<?php echo $certificados->id ?>"><?php echo $certificados->nombre ?></option>
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






<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script>
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#nombre').val(), $('#l_nombre').html(), true);

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
        window.location = '<?= $patch; ?>works';
    });
</script>
