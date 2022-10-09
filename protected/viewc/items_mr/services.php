<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Services  
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>item/mr">Items</a></li>
        <li class="active">Services</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>items/mr/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>                       
          
                <div class="col-lg-6">
                    <label id="l_guideline">Guide Line*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="" id="guideline" name="guideline">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-6">
                    <label id="l_mr">Description*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="" id="mr" name="mr">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-6">
                    <label id="l_code">Code*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="" id="code" name="code">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-6">
                    <label id="l_request_code">Request Code*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="" id="request_code" name="request_code">
                    </div><!-- /.input group -->
                </div> 

                

                <div class="col-lg-12">
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">
                        <i class="fa fa-save "></i> Save
                    </button>
                </div>
                <div class="clearfix"></div><br>
                <table id='databables' class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Guideline</th>                            
                            <th>Code</th>
                            <th>Description</th>
                            <th>code Request</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
                <div class="box-footer col-md-4 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                        <i class="fa  fa-arrow-left"></i> Cancel
                    </button>
                    
                    
                </div>
            </fieldset>
        </div>
    </form>
</div>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>

    var table = $('#databables').DataTable({
        ajax:{
            url:"<?php echo $patch ?>items/mr/getServices",
            dataSrc:'data',
            data:{
                id_cliente: $("#id").val()
            }
        },
        columns:[ 
            { data: "id"} ,
            { data: "guideline"} ,
            { data: "code"} ,
            { data: "mr"} ,
            { data: "request_code"} ,

            {
                "data": null,
                "defaultContent": `
                <button class='btn btn-danger delete' type='button' name='iteme'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button>
                `
            }

        ]
    });
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#guideline').val(), $('#l_guideline').html(), true);
        sErrMsg += validateText($('#code').val(), $('#l_code').html(), true);
        sErrMsg += validateText($('#request_code').val(), $('#l_request_code').html(), true);
        sErrMsg += validateText($('#mr').val(), $('#l_mr').html(), true);
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
            $.post("<?= $patch ?>items/mr/saveServices",{
                guideline:$("#guideline").val(),
                code:$("#code").val(),
                request_code:$("#request_code").val(),
                mr:$("#mr").val(),
                deleted:1,             
            },function(data){
                table.ajax.reload();
                $("#guideline").val("")
                $("#code").val("")
                $("#request_code").val("")
                $("#mr").val("")
            })
        }
    })
    $('#databables tbody').on( 'click', 'button.delete', function () {
        
        if(confirm("Are you sure that you want to delete this item?")){
            var data = table.row( $(this).parents('tr') );
            $.post("<?php echo $patch ?>items/mr/deleteServices",{id:data.data()["id"]},function(response){
                table.ajax.reload();
            },'Json')
        }
        
    })

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>items/mr';
    });
</script>
