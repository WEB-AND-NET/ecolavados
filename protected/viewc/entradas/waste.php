<?php $a = $data["residuos"]; 
 ?>


<section class="content-header">
    <h1>
        Waste <span id='changes' class='text text-success' id=''>No saved data</span>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>entrys">Current Inventory</a></li>
        <li class="active"> Waste </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>status/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_volumen">Volumen</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $a->volumen; ?>" id="volumen" name="volumen">
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

        $("#volumen").keyup(function (data){
            $.post("<?php echo $patch;?>entrys/waste/volumen", { id:$("#id").val(),val:$(this).val() }, function(){
            $("#changes").text("Saving data")
        })
        $("#changes").text("saved data")
    })
</script>
