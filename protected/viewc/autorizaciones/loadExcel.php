<section class="content-header">
    <h1>
        Load Tanks
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>authorization">Authorization</a></li>
        <li class="active">Load </li>
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
            <div class="col-lg-4">
                <label id="l_clientes_id">Subir Archivo*</label>
                <input id="upload" type=file  name="files[]">
            </div>
            <div class="clearfix"></div>

            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>                    
            </div>              
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl'] ?>global/js/zip.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl'] ?>global/js/xlsx.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>


    document.getElementById('upload').addEventListener('change', handleFileSelect, false);
    
    function handleFileSelect(evt) {        
        var files = evt.target.files; // FileList object
        var xl2json = new ExcelToJSON();
        xl2json.parseExcel(files[0]);
    }

    var ExcelToJSON = function() {
        this.parseExcel = function(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            workbook.SheetNames.forEach(function(sheetName) {
            // Here is your object
            var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
            var json_object = JSON.stringify(XL_row_object);
            json_object=JSON.parse(json_object)        
            $.post('<?= $data['rootUrl']; ?>autorizaciones/sendLoad',{data:json_object,id_c:$("#clientes_id").val()},
            function (data) {
                $("#items").html(data);
                $("#form1").unmask();
            });
                jQuery('#xlx_json').val( json_object );
            })
        };

        reader.onerror = function(ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
        };
    };

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