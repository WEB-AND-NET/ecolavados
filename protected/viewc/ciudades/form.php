<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["municipios"]; ?>
<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Employees Register' : 'Employees update'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">City</a></li>
        <li class="active"> <?= ($a->id == "" ? 'City Register' : 'City update'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>ciudades/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_nombre">Name </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa-bars  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->municipio; ?>" id="municipio" name="municipio" >
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
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>
        
   
    $("#municipio").focusout(function(){
        $("#form1").mask();
        $.post("<?= $patch ?>ciudades/validateId",{id:$("#id").val(),val:$(this).val() },function(data){
            if (data  == "TRUE"){
                alert("This City is already registered");
            }        
            $("#form1").unmask();
        })
    })

    $("#btn-save").click(function(data){
        if(validateForm()){
            $("#form1").submit()
        }
    })

    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#municipio').val(), $('#l_nombre').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }

   

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>ciudades';
    });




   



    
</script>