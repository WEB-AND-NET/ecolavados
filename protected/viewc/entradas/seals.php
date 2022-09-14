<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>
        Send evidence
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Packs</a></li>
        <li class="active"> Send Evidence </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>entrys/schedule/close/seals" method="post" name="form1">
    <input type="hidden" value="<?//php echo $data["entry"] ?>" name="id_entrada">

        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>
                <div class="col-lg-12">
                    <label id="l_conductor">observation </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-group "></i>
                        </div>
                        <textarea class='form-control' name="observacion" id="observacion"  ></textarea>
                    </div><!-- /.input group -->
                    <div class="clearfix"></div><br>
                    <div class="col-lg-10">
                        <label class="btn btn-block btn-primary">
                            Browse&hellip;  <input class='imagen' name='dataimagen' type="file" style="display: none;" accept="image/*" multiple="multiple" capture="camera">
                        </label>
                    </div>
                    <div class="col-md-2 pull-right">
                    

                        <button type="button" id="btn-insert" class="btn  bg-green ">
                            <i class="fa fa-save "></i> Insert
                        </button>
                        <a type="button" target='_blank' href='<?= $data["rootUrl"] ?>entrys/print/seals/<?= $data["entry"] ?>' id="btn-print" class="btn  bg-green pull-right">
                            <i class="fa fa-print "></i> Print
                        </a>
                       
                    </div> 

                </div>

                
            </fieldset>
            <fieldset style="width:97%;">
                <legend>Evidence Details</legend>
                
            </fieldset>
        </div>
        <div class="img container"></div>
        <div class="box-footer col-md-4 pull-right">
        <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
        <i class="fa  fa-arrow-left"></i> Cancel
    </button>
    <button type="button" id="btn-save" class="btn  bg-green pull-right">
        <i class="fa fa-save "></i> Save
    </button>
    <input type='hidden' id='entry' name='entry' value='<?= $data["entry"] ?>'>
</div> 
<div class="clearfix"></div>
    </form>
</div>

 
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>    
    $(document).ready(function(){
        render()
    })

    function render(){
        $.post("<?= $data["rootUrl"] ?>entrys/schedule/seals/renderSeals",{"entry":$("#entry").val()},function(e){
            $(".img").html(e);
        })
    }
   
    $("#btn-insert").click(function(){
        //e.preventDefault();
        var formData = new FormData(document.getElementById("form1"));     
        formData.append("entry",$("#entry").val());  
        formData.append("observation",$("#observacion").val());            
        $.ajax({
            url: "<?= $data["rootUrl"] ?>entrys/schedule/seals/image",
            type: "post",
            dataType: "html",
            data:formData,
            cache: false,
            contentType: false,
            processData: false
        }).success(function (data) { 
            render()
            $("#observacion").val()
        });
    })

    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>packs';
    });
    
    $("#btn-save").click(function(){
       
           $("#form1").submit();
        
    })
</script>