<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $a = $data["request"]; 

 ?>

<section class="content-header">
    <h1>
    Word Order Approved <span id='changes' class='text text-success' id=''>No changes</span>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"> Approved </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>mrequest/saveApprove" method="post" name="form1">
    <input type='hidden' name='id' value='<?php echo $data["id"] ?>'>
    <input type='hidden' name='url' value='<?php echo $data["url"] ?>'>

        <div class="box-body">
            <fieldset style="width:97%;">
            
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_descripcion">#Word Order*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a["id"]; ?>" id="number" name="number">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_descripcion">Total*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a["total"]; ?>" id="number" name="number">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-4">
                    <label id="l_descripcion">Expedition date*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a["expedicion"]; ?>" id="number" name="number">
                    </div><!-- /.input group -->
                </div>
                <table class='table table-responsive'>
                <thead>  
                    <tr>
                        <th>Services</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>#Work Order</th>
                    </tr>
                </thead>

                <?php foreach($data["productos"] as $producto){ ?>
                    <tr>
                        <td><?=  ("Service: ". $producto["proceso"]."\n"."Damage: ". $producto["descripcion"]) ?></td>
                      <td><?=$producto["nombre"] ?></td>
                        <td><?= $producto["cantidad"] ?></td>
                        <td><?= $producto["precio"] ?></td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-hashtag"></i>
                                </div>
                                <input type="text" data-id='<?= $producto["id"] ?>' class="number form-control pull-right" value="<?= $producto["work_order"] ?>" >
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                <?php foreach($data["paquetes"] as $paquete){ ?>
                        <tr>
                             <td><?= $paquete["nombre"] ?></td>
                        <td><?= $paquete["nombre"] ?></td>
                        <td><?= $paquete["cantidad"] ?></td>
                        <td><?= $paquete["precio"] ?></td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-hashtag"></i>
                                    </div>
                                    <input type="text" data-id='<?= $paquete["id"] ?>' class="number form-control pull-right" value="<?= $paquete["work_order"] ?>" >
                                </div>
                            </td>
                    </tr>
                <?php } ?>
            </table>
                
          
                <div class="clearfix"></div><br>

                <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save and Approve
                </button>
              
            </div>



            </fieldset>
        </div>
    </form>
</div>






<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script>
   $(document).bind("contextmenu",function(e){
        return false;
    });
    $("#btn-save").click(function(){
        $("#form1").submit();
    })
    $(".number").keyup(function(data){       
        $.post("<?php echo $patch  ?>mrequest/mrequest/workorder",{id:$(this).attr("data-id"),val:$(this).val() },function(){
            $("#changes").text("Saving changes")
        })
        $("#changes").text("saved data")
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

    $("#btn-save").click(function(){
        if(validateForm()){
            $("#form1").submit();
        }
    })
    
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>request';
    });
</script>
