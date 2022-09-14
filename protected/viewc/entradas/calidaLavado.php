<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<style type="text/css">
area {
   background-color:transparent;
   }
area:hover {
   background-color:rgba(173,255,47,0.5);
   }
   .con{

   }
   #one{
    
    }
</style>  
<section class="content-header">
    <h1>
    Quality inspection
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>entrys">Entrys</a></li>
        <li class="active"> 
Quality inspection </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>entrys/schedule/close/calidad" method="post" name="form1">
        <div class="box-body">
        <input type="hidden" value="<?php echo $data["entry"] ?>" id='id_entrada' name="id_entrada">
        <input type="hidden" value="<?= $data["pindex"] ?>" name="id_programacion">
        <input type="hidden" value="<?= $data["request"] ?> " name="request"> 
            <fieldset style="width:97%;">
                <legend>General information</legend>

                <div class="col-lg-4">
                    <label id="l_id_empleado_autorizado">EXTERIOR - Frame, Tank Walkway, Markings clean of contaminations Clean:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="exterior" id="exterior">
                            <option value="NA">N/A</option>
                            <option value="S">YES</option>
                            <option value="N">NO</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_id_empleado_autorizado">INTERIOR Clean of contamination & Odour:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="interior" id="interior">
                        <option value="NA">N/A</option>
                            <option value="S">YES</option>
                            <option value="N">NO</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_id_empleado_autorizado">Valves, Man-Way, Fittings Clean of contamination & Odour:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="valves" id="valves">
                        <option value="NA">N/A</option>
                            <option value="S">YES</option>
                            <option value="N">NO</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_id_empleado_autorizado">TRANSFERABLE STAINS:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="stains" id="stains">
                        <option value="NA">N/A</option>
                            <option value="S">YES</option>
                            <option value="N">NO</option>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_id_empleado_autorizado">>SURFACE CONDITION: </label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="surfaces" id="surfaces">
                            <option value="NA">N/A</option>
                            <option value="S">OK</option>
                            <option value="STAINING">STAINING</option>
                            <option value="RUST">SURFACE RUST</option>
                            <option value="SCORING">SURFACE SCORING</option>
                            <option value="PITTING"> PITTING</option>
                            
                         
                           
                        </select>
                    </div><!-- /.input group -->
                </div>


                <div class="col-lg-4">
                    <label id="l_id_empleado_autorizado">PITTING DESCRIPTION:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="pitting" id="pitting">
                        <option value="NA">N/A</option>
                            <option value="A">Type A</option>
                            <option value="B">Type B</option>
                            <option value="C">Type C</option>
                        </select>
                    </div><!-- /.input group -->
                </div>
                
                  <div class="col-lg-4">
                    <label id="cause">CAUSA DEL RE-LAVADO:</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal"  class="input-group-addon">
                            <i  class="fa fa-code-fork "></i>
                        </span>
                        <select class='form-control' name="cause" id="id_cause">
                            <option value="N/A">N/A</option>
                            <option value="Clean up again ST">Causa aislada</option>
                            <option value="Clean up again WP">Fallos en el procediminto </option>
                         
                        </select>
                    </div><!-- /.input group -->
                </div>



            <fieldset style="width:97%;">
                <legend>Evidence Details</legend>
                <div class="col-lg-12">
                    <label class="btn btn-block btn-primary">
                        Browse&hellip;  <input class='imagen' name='dataimagen' type="file" style="display: none;" accept="image/*" multiple="multiple" capture="camera">
                    </label>
                </div>
            </fieldset>
            <br>
            <div class="img container"></div>
            </fieldset>
                <legend>SELECT THE PITTING ZONE</legend>

                <map name="tank">
                <?php $x1=22;$x2=48;$y1=17;$y2=64; ?>
                <?php   foreach (range('A', 'H') as $letra) { ?>

                    <?php foreach (range(12, 1) as $numero) { ?>
                    <area shape=rect href='#' class='tank' data='<?= $letra.$numero ?>' coords="<?= $x1 ?>,<?= $y1 ?>,<?= $x2 ?>,<?= $y2 ?>">
                    <?php $x1+=26; $x2+=26;   ?>
                    <?php } $x1=23; $x2=49;  ?>
                    <?php  $y1+=46; $y2+=46;  ?>
                <?php } ?>
                </map>
                <div id='one' class="col-md-4 one">
                    <center >
                        <img src="<?= $patch ?>global/img/tank.png" class='img-tank' usemap="#tank" alt="">
                    </center>
                    
           <!--         <input class="text tankl">-->
                </div>
                <div class="col-md-4 two">
                <center >
                    <img src="<?= $patch ?>global/img/rear.png" class='img-rear' usemap="#image-rear">
                <!--    <input class="text l-rear">-->
                </center>
                </div>
                <div class="col-md-4 three">
                <center >
                    <img src="<?= $patch ?>global/img/front.png" class='img-front' usemap="#image-front">
                   <!-- <input class="text l-front"> -->
                    </center>
                </div>
                
                <map name="image-front">
                    <area class='front' target="" alt="12-1" title="12-1" href="#" coords="151,32,150,109,186,42,170,35" shape="poly">
                    <area class='front'target="#" alt="1-2" title="1-2" href="#" coords="151,107,187,42,200,51,210,63,215,73" shape="poly">
                    <area class='front'target="#" alt="2-3" title="2-3" href="#" coords="151,108,215,74,220,86,222,98,223,109" shape="poly">
                    <area class='front'target="#" alt="3-4" title="3-4" href="#" coords="151,109,223,109,223,124,219,135,215,145,210,153" shape="poly">
                    <area class='front'target="#" alt="4-5" title="4-5" href="#" coords="150,108,210,153,200,165,185,176" shape="poly">
                    <area class='front'target="#" alt="5-6" title="5-6" href="#" coords="151,108,185,177,173,182,162,184,150,184" shape="poly">
                    <area class='front'target="#" alt="6-7" title="6-7" href="#" coords="151,108,150,183,139,181,122,177,111,172" shape="poly">
                    <area class='front'target="#" alt="7-8" title="7-8" href="#" coords="150,108,111,171,96,159,89,148" shape="poly">
                    <area class='front'arget="#" alt="8-9" title="8-9" href="#" coords="150,107,89,147,82,131,80,117,79,106" shape="poly">
                    <area class='front'target="#" alt="9-10" title="9-10" href="#" coords="151,107,77,105,80,91,82,79,89,70" shape="poly">
                    <area class='front'target="#" alt="10-11" title="10-11" href="#" coords="150,106,89,69,98,54,108,47,120,40" shape="poly">
                    <area class='front'target="#" alt="11-12" title="11-12" href="#" coords="121,40,150,105,150,32,136,32,126,36" shape="poly">
                </map>
                <map name="image-rear">
                    <area class='rear' target="" alt="9-10" title="9-10" href="#" coords="85,107,164,107,94,65,88,79,86,90,85,100,84,102" shape="poly">
                    <area class='rear' target="" alt="10-11" title="10-11" href="#" coords="94,64,165,108,123,34,111,44,101,54,97,59" shape="poly">
                    <area class='rear' target="" alt="11-12" title="11-12" href="#" coords="165,106,164,22,148,24,133,29,123,34" shape="poly">
                    <area class='rear' target="" alt="12-1" title="12-1" href="#" coords="164,106,163,22,184,27,208,37" shape="poly">
                    <area class='rear' target="" alt="1-2" title="1-2" href="#" coords="164,107,236,72,227,54,213,43,208,37" shape="poly">
                    <area class='rear' target="" alt="2-3" title="2-3" href="#" coords="166,107,235,70,240,80,243,91,244,108" shape="poly">
                    <area class='rear' target="" alt="3-4" title="3-4" href="#" coords="163,108,244,109,245,124,239,139,227,161" shape="poly">
                    <area class='rear' target="" alt="4-5" title="4-5" href="#" coords="164,109,226,161,215,175,201,183" shape="poly">
                    <area class='rear' target="" alt="5-6" title="5-6" href="#" coords="163,108,200,182,186,189,175,192,163,192" shape="poly">
                    <area class='rear' target="" alt="6-7" title="6-7" href="#" coords="163,107,162,192,148,188,130,183,120,178" shape="poly">
                    <area class='rear' target="" alt="7-8" title="7-8" href="#" coords="163,107,120,177,107,165,98,154" shape="poly">
                    <area class='rear' target="" alt="8-9" title="8-9" href="#" coords="162,107,98,154,91,137,86,123,85,108" shape="poly">
                </map>
                        <div class="clearfix"></div>
             <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>
             
            </div>   
            <fieldset>
           
            <input type="hidden" name='area' id='area'>
            <input type="hidden" name='rear' id='rear'>
            <input type="hidden" name='front' id='front'>
            <input type="hidden" value='N' name='recleaning' id='recleaning'>
          
        </div>
    </form>

<div class="container">
  <img width="75%" class="screen">
</div>
</div>
<script src="<?= $patch ?>global/js/snapshop.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/js/jquery.maphilight.min.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>

    function tapas(clas) {
        var img;
        let region = document.querySelector(clas); // whole screen
        html2canvas(region,{allowTaint: true,
                                        width: window.innerWidth,
                                        height: window.innerHeight,
                                        scrollX: window.pageXOffset,
                                        scrollY: window.pageYOffset,
                                        x: window.pageXOffset,
                                        y: window.pageYOffset} )
        .then(canvas => {
            console.log(canvas.toDataURL("image/png"));
             img  = canvas.toDataURL("image/png")
             if(clas==".two"){
                $("#front").val(img)
             }else{
                $("#rear").val(img);
             }
             
          
        });
        return img
    }
    function tank() {
        var img;
        let region = document.querySelector("#one"); // whole screen
        html2canvas(region,{allowTaint: true,
                                        width: window.innerWidth,
                                        height: window.innerHeight,
                                        scrollX: window.pageXOffset,
                                        scrollY: window.pageYOffset,
                                        x: window.pageXOffset,
                                        y: window.pageYOffset} )
        .then(canvas => {
            console.log(canvas.toDataURL("image/png"));
            img = canvas.toDataURL("image/png")
            $("#area").val(img)
        });
       
    }

//report();
$('.img-tank').mapster({
        fillColor: 'ff0000',
        fillOpacity: 0.3
    });
$('.img-rear').mapster({
        fillColor: 'ff0000',
        fillOpacity: 0.3
    });
    $('.img-front').mapster({
        fillColor: 'ff0000',
        fillOpacity: 0.3
    });

    $(".tank").click(function(e){
        e.preventDefault()
        tank()
    
       
      //  $(".l-rear").val($(".l-rear").val()+$(this).attr("title")+" ")
    })

    $(".rear").click(function(e){
        e.preventDefault()
      tapas(".three")
    
       
      //  $(".l-rear").val($(".l-rear").val()+$(this).attr("title")+" ")
    })
    $(".front").click(function(e){
        e.preventDefault()
        tapas(".two")
       
    //    $(".l-front").val($(".l-front").val()+$(this).attr("title")+" ")
    })
    render()
    function render(){
        $.post("<?= $data["rootUrl"] ?>entrys/schedule/close/renderEvidencesQuality",{"id_entrada":$("#id_entrada").val()},function(e){
            $(".img").html(e);
        })
    }

    $(".imagen").change(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("form1"));          
     
        $.ajax({
            url: "<?= $data["rootUrl"] ?>entrys/schedule/close/quality",
            type: "post",
            dataType: "html",
            data:formData,
            cache: false,
            contentType: false,
            processData: false
        }).success(function (data) { 
            console.log(data);
            render()
        });
    })
    function validateReCleaning(){
        exterior = $("#exterior").val();
        interior = $("#interior").val();
        valves =$("#valves").val();
        stains =$("#stains").val();
        if(exterior == 'N' || interior == 'N' || valves == 'N' || stains == 'S') {
            $("#recleaning").val("S")
        }
        $("#form1").submit();
    }


    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>entrys';
    });
    
    $("#btn-save").click(function(){

        validateReCleaning();
           
        
    })

</script>