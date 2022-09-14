<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["work"]; 

 ?>


<section class="content-header">
    <h1>
        <?= $a->nombre ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Associate</a></li>
        <li class="active"> <?= $a->nombre ?>  </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>status/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

         

                <div class="col-lg-4">
                    <label id="l_clientes_id">Principal*</label>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon" >
                            <i  class="fa fa-code-fork "></i>
                        </span>
                    
                        <select class='form-control' name="taskp" id="taskp">
                        <?php foreach($data["task_P"] as $taskp){ ?>
                            <option  value="<?php echo $taskp->id; ?>"><?php echo $taskp->numero; ?>. <?php echo $taskp->nombre; ?></option>
                        <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_clientes_id">Task*</label>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon" >
                            <i  class="fa fa-code-fork "></i>
                        </span>
                    
                        <select class='form-control' name="task" id="task">
                        <?php foreach($data["task"] as $taskp){ ?>
                            <option  value="<?php echo $taskp->id; ?>"><?php echo $taskp->numero; ?>. <?php echo $taskp->nombre; ?></option>
                        <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>
              <div class="col-md-4"> <br>
              <button type="button" id="btn-Insert" class="btn  bg-green ">
                    <i class="fa fa-plus "></i> Insert
                </button>
              </div>
              <br><br>
              <div class="html col-md-12">

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
    $(document).ready(function(){
        getAssociate()
    })
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
    $("#btn-Insert").click(function(){
        $.post("<?php echo $patch ?>works/associate/space/save",{id_trabajo:$("#id").val(),id_tarea:$("#task").val(),id_tarea_principal:$("#taskp").val()},function(data){
            getAssociate();
        })
    })

    $("#btn-save").click(function(){
        if(validateForm()){
            $("#form1").submit();
        }
    })

    function getAssociate(){
        $.post("<?= $patch ?>works/getassociate/space",{id:$("#id").val()},function(data){
            $(".html").html(data)
            console.log(data)
        })
    }
    
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>works';
    });
</script>
