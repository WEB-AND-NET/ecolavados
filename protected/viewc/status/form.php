<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["status"]; 
 ?>


<section class="content-header">
    <h1>
        <?= ($a->id == "" ? 'Register Status' : 'Register Status'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> <?= ($a->id == "" ? 'Register Status' : 'Register Status'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>status/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_descripcion">Status Name*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->status_name; ?>" id="status_name" name="status_name">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_clientes_id">Color*</label>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon" >
                            <i  class="fa fa-code-fork "></i>
                        </span>
                    
                        <select class='form-control' name="color" id="color">
                            <option <?= $a->color=='label-primary' ? 'selected' : ''; ?> value="label-primary">Primary</option>
                            <option <?= $a->color=='label-secondary' ? 'selected' : ''; ?>  value="label-secondary">Secondary</option>
                            <option <?= $a->color=='label-success' ? 'selected' : ''; ?>  value="label-success">Success</option>
                            <option <?= $a->color=='label-danger' ? 'selected' : ''; ?> value="label-danger">Danger</option>
                            <option <?= $a->color=='label-warning' ? 'selected' : ''; ?>  value="label-warning">Warning</option>
                            <option <?= $a->color=='label-info' ? 'selected' : ''; ?>  value="label-info">Info</option>
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
        sErrMsg += validateText($('#status_name').val(), $('#l_status_name').html(), true);
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
