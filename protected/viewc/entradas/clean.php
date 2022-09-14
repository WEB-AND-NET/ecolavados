<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link  href="<?= $data['rootUrl'] ?>global/css/switcher.css" type="text/css" rel="stylesheet"/>
<script src="<?= $data['rootUrl']; ?>global/js/jquery.switcher.js"></script>

<style>

<style>
.wrappe {
  position: relative;
  width: 600px;
  height: 300px;
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.signature-pad {
  position: relative;
  left: 0;
  top: 0;
  width:600px;
  height:300px;
  background-color: white;
  border: 1px solid #ccc;
}
</style>
</style>
<section class="content-header">
    <h1>CLEANING  CERTIFICATE</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>clientes">Clients</a></li>
        <li class="active"></li>
    </ol>
</section>
<br>
<br/>


<div class="box">
    <form id="form1" class="form" action="<?= $patch; ?>entry/entry/clean/save" enctype="multipart/form-data" method="post" name="form1">
        <input type='hidden' value='<?php echo $data["entrada_id"] ?>' name='id' id='id' >
        <div class="box-body">
        <fieldset style="width:97%;">
                <legend>General information</legend>
                <div class="col-lg-4">
                <label id="l_test30">Test 2,5*</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa   fa-clock-o  "></i>
                    </div>
                    <input type="date" class="form-control pull-right" value="<?= $data["entrada"]["test30"]; ?>" id="test30" name="test30" maxlength="45">
                </div><!-- /.input group -->
            </div>

            <div class="col-lg-4">
                <label id="l_test60">Test 5*</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa   fa-dashboard  "></i>
                    </div>
                    <input type="date" class="form-control pull-right" value="<?= $data["entrada"]["test60"]; ?>" id="test60" name="test60" maxlength="45">
                </div><!-- /.input group -->
            </div>

            <div class="col-lg-4">
                    <label id="l_invoice_description">Certificate image*</label>
                    <div class="input-group margin-bottom-20">
                        <span   class="input-group-addon">
                            <i  class="fa fa-archive"></i>
                        </span>
                        <input crossorigin="anonymous" class='form-control' id='img' name='img' capture="camera" accept="image/*" type='file'>
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-12">
                    <label id="l_serial">SECURITY SEALS:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-code-fork "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $data["limpieza"]->sellos ?>" id="limpieza" name="limpieza" >
                        <input type="hidden" class="form-control pull-right" value="<?= $data["limpieza"]->id ?>" id="id_limpieza" name="id_limpieza" >
                    </div><!-- /.input group -->
                </div>
        </fieldset>
        <div class="clearfix"></div>
        <br>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                <?php $cont=0; foreach($data["items"] as $item){ ?>
                    <li class="<?php echo  $cont==0 ? "active"  : '';$cont++;  ?>"><a href="#tab_<?= $item["id"] ?>" data-toggle="tab" aria-expanded="true"><?= $item["descripcion"] ?></a></li>
                <?php  } ?>

                </ul>
            <div class="tab-content">
                <?php $cont=0; foreach($data["items"] as $item){ ?>
                    <div class="tab-pane <?php echo  $cont==0 ? "active"  : '';$cont++;  ?>" id="tab_<?= $item["id"] ?>">
                       <table>    
                           <thead>
                                <tr>
                                    <th>&nbsp</th>
                                    <th>&nbsp</th> 
                                    <th>&nbsp</th> 
                                </tr> 
                            </thead>
                             <tbody>                  
                                <?php  foreach($item["sub_item"] as $sub ){?>
                                    <tr>
                                        <?php if($sub["editable"]=="N"){ ?>
                                            <td>
                                                <label id='la<?=$sub["id"] ?>'>
                                                    <?php echo $sub["descripcion"] ?><span class='area-replace<?=$sub["id"] ?>'><?php echo  $sub["valor"] ? '-'.$sub["valor"] : '' ?></span>
                                                </label>
                                            </td>
                                            <th>
                                                <input name='item<?php echo $sub["id"] ?>'  class="minimal"  <?=  $sub["valor"]=='OK' ? 'checked'  :''  ?> type="radio" value="<?php echo $sub["id"] ?>" />
                                            </td>
                                            <th>
                                                <input name='item<?php echo $sub["id"] ?>'  class="minimal"  <?=  $sub["valor"]!='OK' ? 'checked'  :''  ?> data-acept='N'  type="radio" value="<?php echo $sub["id"] ?>" />
                                            </td>
                                        <?php }else{ ?>
                                            <td>
                                                <label id='la<?=$sub["id"] ?>'>
                                                    <?php echo $sub["descripcion"] ?>
                                                </label>
                                            </td>
                                            <td>    
                                                <input class='input-item' data-id='<?php echo $sub["id"] ?>' type="text" id='item<?php echo $sub["id"] ?>' value="<?php echo  $sub["valor"]  ?>" />
                                            </td> 
                                            <td></td>
                                    <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>      

         
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            <div class="col-md-12">
            <fieldset>
                <legend>Ecolavados Signature</legend>
            
                <div class="wrappe">
                    <canvas id="signature-submitBtnEco" class="signature-pad" width=400 height=200></canvas>
                    <div class="clearfix"></div>
                </div>
                
                <br>
                <input type='hidden' id='base64drive'>
                <button class="btn btn-success" id="sig-submitBtnDriver">Submit Signature</button>
                <button class="btn btn-primary" id="sig-clearBtnDriver">Clear Signature</button>
            </fieldset>

            
</div><div class="clearfix"></div>
          </div>
                <!-- Hasta acá-->
        <div class="clearfix"></div>
   
            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button" id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>
                
            </div>
        <div>



    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Ratings</h4>
                </div>
                <div class="modal-body"><!-- Modal Body-->
                <div id='take' class="content">
                    
                </div>

                </div><!--end of Modal Body-->
                <div class="clearflix"></div><br>

                <div class="modal-footer">

                    <div class="mailbox-controls" style="float:right;">
                            <!-- Check all button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


        <div id="modalcamara" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Take Photo</h4>
                    </div>
                    <div class="modal-body"><!-- Modal Body-->
                    <div  class="content">
                        <input name='dataimagen' type="file"  accept="image/*" multiple="multiple" capture="camera"> <br>
                        <div >
                            <button   class='btn bg-navy btn-flat  photo'>Save Photo</button>
                        </div> 
                    </div>

                    </div><!--end of Modal Body-->
                <div class="clearflix"></div><br>
                    <div class="modal-footer">
                        <div class="mailbox-controls" style="float:right;">
                                <!-- Check all button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    <form>
<div>
<script type="text/javascript" src="<?= $patch; ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?= $data['rootUrl']; ?>global/js/newSing.js"></script>

<script>
$(document).ready(function(){
    var canvas = document.getElementById('signature-submitBtnEco');
    
    // Adjust canvas coordinate space taking into account pixel ratio,
    // to make it look crisp on mobile devices.
    // This also causes canvas to be cleared.
    function resizeCanvas(canvas) {
        // When zoomed out to less than 100%, for some very strange reason,
        // some browsers report devicePixelRatio as less than 1
        // and only part of the canvas is cleared then.
        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }
    
    window.onresize = resizeCanvas;
    resizeCanvas(canvas);
    
        
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    });
    
    $.switcher('input[type=radio]');

   




    $(".input-item").keyup(function(e){
        var option = $(this).attr("data-id");
        $.post("<?= $data["rootUrl"] ?>entry/entry/itemslimpieza",{id_item:option,valor:$(this).val(),id_entrada:$("#id").val()},function(data){
        })
    })
    
       $("#limpieza").keyup(function(e){
            $.post("<?= $data["rootUrl"] ?>entry/entry/limpieza",{id:$("#id_limpieza").val() ,sellos:$(this).val(),id_entrada:$("#id").val()},function(data){
        })
    })

    $(document).ready(function () {
      
    });

        
    function readFile() {
        if (this.files && this.files[0]) {
        var FR= new FileReader();
        FR.addEventListener("load", function(e) {
            console.log( e.target.result);
            //document.getElementById("img").src       = e.target.result;
            //document.getElementById("imgnext").value = e.target.result;
            $.post("<?= $patch ?>entrys/cleanImg/<?= $data["entrada_id"] ?>",{base:e.target.result},function(data){
            })
        }); 
        FR.readAsDataURL( this.files[0] );
        }
    }

    document.getElementById("img").addEventListener("change", readFile);
    
    


    document.getElementById('sig-submitBtnDriver').addEventListener('click', function (evt) {
        evt.preventDefault();
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/png');
        $.post("<?= $patch ?>entrys/clean/singSave/<?= $data["entrada_id"] ?>",{base:data},function(data){

        })
        console.log(data);
        
    });

    document.getElementById('sig-clearBtnDriver').addEventListener('click', function (e) {
        e.preventDefault()
        signaturePad.clear();
    })

    $('input[type=radio]').on('click', function(event){
        $(this).attr("checked",true)
        var option = $(this).val();
        var html='';
        $.post("<?= $data["rootUrl"] ?>authorization/entry/getItemsCalificaciones",{id:$(this).val()},function(data){
            data.forEach(function(item){
                if(item.descripcion!="ESCRIBA"){
                    html+=`<div ><button causes-log='${item.causes_log}' data-id='${item.id}'  class='btn bg-navy btn-flat btn-block select'>${item.descripcion}</button></div> <br>`;
                }
            })
            $("#take").html(html);
            $("#myModal").modal();
            $(".select").click(function(e){
                var select = $(this).html();
                e.preventDefault();
                if($(this).attr("causes-log")=='S'){
                    if(confirm("This qualification generates an evidence you want to save it?")){
                        $("#modalcamara").modal("show");
                        $(".photo").click(function(e){
                            e.preventDefault();
                            var formData = new FormData(document.getElementById("form1"));
                          //  formData.append("data",
                            formData.append("id_item",option)
                            formData.append("valor",select)
                            formData.append("id_entrada",$("#id").val())
                            formData.append("causes_log","S")
                            $.ajax({
                                url: "<?= $data["rootUrl"] ?>entry/entry/itemslimpieza",
                                type: "post",
                                dataType: "html",
                                data:formData,
                                cache: false,
                                contentType: false,
                                processData: false
                            }).success(function (data) { 
                                $("#myModal").modal("hide");
                                $("#modalcamara").modal("hide");
                                calcJob()
                            });
                        })
                    }else{
                      
                        $(".area-replace"+option).html("-"+$(this).html())
                        $("#myModal").modal("hide");
                        $.post("<?= $data["rootUrl"] ?>entry/entry/itemslimpieza",{id_item:option,valor:$(this).html(),id_entrada:$("#id").val()},function(data){
                        })
                    }
                }else{
             
                    $(".area-replace"+option).html("-"+$(this).html())
                    $("#myModal").modal("hide");
                    $.post("<?= $data["rootUrl"] ?>entry/entry/itemslimpieza",{id_item:option,valor:$(this).html(),id_entrada:$("#id").val()},function(data){
                    })
                }
               
        
              
            })
            
        },'Json')
    });

    $("#btn-save").click(function(e){
        $("#form1").submit();
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
})
</script>
