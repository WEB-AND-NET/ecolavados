
<section class="content-header">
    <h1>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>tanks">Tanks</a></li>
        <li class="active"></li>
    </ol>
</section>
<br>
<br/>


<div class="box ">
    <form id="form1" class="form" action="#" enctype="multipart/form-data" method="post" name="form1">

        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>
                <div class="col-lg-6">
                    <label id="l_productos">Purpose of contract</label>
                    <div class="input-group">
                        <div class="input-group-addon"data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-bitbucket"></i>
                        </div>
                        <select class="form-control select2"  id="tanques" name="tanques">
                            <?php foreach($data["tanques"] as $tanque){ ?>
                                <option 
                                data-id="<?echo $tanque['id'] ?>"
                                data-make="<?echo $tanque['make_date'] ?>" 
                                data-test30="<?echo $tanque['test30'] ?>" 
                                data-test60="<?echo $tanque['test60'] ?>" 
                                value='<?echo $tanque['id'] ?>'> 
                                <?echo $tanque['serial'] ?> </option>
                            <?php } ?> 
                        </select>
                    </div>
                </div>


                <div class="col-lg-6">
                    <label id="l_free_days">Manufacture Date:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input  type="date" class="form-control pull-right" value="" id="fechaManufactura" name="fechaManufactura" >
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-6">
                    <label id="l_free_days">Test 2.5:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input  type="date" class="form-control pull-right" value="" id="fecha30" name="fecha30" >
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-6">
                    <label id="l_free_days">Test 5:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input  type="date" class="form-control pull-right" value="" id="fecha60" name="fecha60" >
                    </div><!-- /.input group -->
                </div>

                                <label for="" id='respuesta'></label>
            </fieldset>
        </div>
    </form>
</div>
<script>
    $("#tanques").select2()

    $("#tanques").change(function(){
        $("#fechaManufactura").val($("#tanques").find(":selected").data().make)
        $("#fecha30").val($("#tanques").find(":selected").data().test30)
        $("#fecha60").val($("#tanques").find(":selected").data().test60)
        console.log($("#tanques").find(":selected").data())
        
    
        let dataSend = {
            fechaManufactura: $("#fechaManufactura").val(),
            fecha30: $("#fecha30").val(),
            fecha60: $("#fecha60").val()
        }


        $.post("<?= $patch ?>tanks/test/validate",dataSend,function(data){
            console.log(data)
            $("#respuesta").html(data)
                
        })
    })
</script>