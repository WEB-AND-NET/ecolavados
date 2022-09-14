<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link  href="<?= $data['rootUrl'] ?>global/css/switcher.css" type="text/css" rel="stylesheet"/>
<script src="<?= $data['rootUrl']; ?>global/js/jquery.switcher.js"></script>
<style>
canvas {
  border: 2px solid #CCCCCC;

  cursor: crosshair;
}

</style>
<section class="content-header">
    <h1>INVOICES  CERTIFICATE</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"></li>
    </ol>
</section>
<br>
<br/>


<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>entry/entry/clean/save" enctype="multipart/form-data" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:100%;">
                    <legend>General information</legend>

                    <div class="col-lg-4">
                        <label id="l_serial">CLIENT:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-code-fork "></i>
                            </div>
                            <select class='elements form-control' name="cliente" id="cliente">
                                <?php foreach($data["clientes"] as $clientes){ ?>
                                    <option   value='<?= $clientes["id"] ?>'><?= $clientes["nombre"] ?></option>
                                <?php } ?>
                            </select>  
                        </div><!-- /.input group -->
                    </div>


                    <div class="col-lg-4">
                        <label id="l_fecha">DATE:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa   fa-clock-o  "></i>
                            </div>
                            <input type="date" class="form-control pull-right" value="" id="fecha_m" name="fecha_m">
                        </div><!-- /.input group -->
                    </div> 

                    <div class="col-lg-4">
                        <label id="l_type">Type:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-code-fork "></i>
                            </div>
                            <select class='elements form-control' name="type" id="type">
                                    <option   value='C'>Current Inventory</option>
                                    <option   value='L'>List Departure</option>
                            </select>  
                        </div><!-- /.input group -->
                    </div>



                <div class="clearfix"></div><br>
                                    <button id='btn-send' class='btn btn-primary'>Enviar</button>

                </div>
            </fieldset>
        </div>
    <form>
<div>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

    <script>
        $.switcher('input[type=radio]');
    </script>
<script>
    $("#btn-send").click(function(e){
        e.preventDefault();
        var date = $("#fecha_m").val()
        var cliente = $("#cliente").val()
        var type = $("#type").val()
        if(date != ""){
            window.open("<?= $data["rootUrl"] ?>"+`associate/${date}/${cliente}/${type}`)
        }else{
            alert('SELECT DATE');
        }
    })


    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#transportadora').val(), $('#l_transportadora').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }  
    
</script>
