
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
  position: absolute;
  left: 0;
  top: 0;
  width:600px;
  height:300px;
  background-color: white;
}
</style>
<div class="col-md-12">
    
    <fieldset>
        <legend>Authorization signature</legend>
        <div class="wrappe">
            <canvas id="signature-submitBtnEco" class="signature-pad" width=400 height=200></canvas>
        </div>
        <br>
        <input type='hidden' id='base64eco'>
        <button class="btn btn-success" id="sig-submitBtnEco">Submit Signature</button>
        <button class="btn btn-primary" id="clear">Clear Signature</button>
    </fieldset>
</div>
<div class="col-md-12">
    <fieldset>
        <legend>Driver Signature</legend>
       
        <div class="wrappe">
            <canvas id="sig-driver" class="signature-pad" width=400 height=200></canvas>
        </div>
        
        <br>
        <input type='hidden' id='base64drive'>
        <button class="btn btn-success" id="sig-submitBtnDriver">Submit Signature</button>
        <button class="btn btn-primary" id="sig-clearBtnDriver">Clear Signature</button>
    </fieldset>
</div>
<div class="clearfix"></div>
     <div class=" col-md-4 pull-left">
         <button type="button" id="btn-save" class="btn  bg-green pull-right">
             <i class="fa fa-save "></i> Finish
         </button>
     </div>
 <div>
<div class="clearfix"></div>
<script type="text/javascript" src="<?= $data['rootUrl']; ?>global/js/newSing.js"></script>
<script>
  var canvas = document.getElementById('signature-submitBtnEco');
    var canvas2 = document.getElementById('sig-driver');
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
    resizeCanvas(canvas2);
        
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    });
    var signaturePad2 = new SignaturePad(canvas2, {
        backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    });

    document.getElementById('sig-submitBtnEco').addEventListener('click', function () {
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/png');
        $.post("<?= $patch ?>spaces/singSave/<?= $data["id"] ?>",{base:data,type:"eco"},function(data){

        })
        console.log(data);
        
    });
    
     document.getElementById('sig-submitBtnDriver').addEventListener('click', function () {
        if (signaturePad2.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad2.toDataURL('image/png');
        $.post("<?= $patch ?>spaces/singSave/<?= $data["id"] ?>",{base:data,type:"operator"},function(data){

        })
        console.log(data);        
    });
    
   
    $("#btn-save").click(function(){
        if(signaturePad.isEmpty() || signaturePad2.isEmpty()){
            alert("to finish you must sign all the fields");
        }else{
            window.location = '<?= $patch; ?>spaces';
        }
    })   
    
    document.getElementById('sig-clearBtnDriver').addEventListener('click', function () {
        signaturePad2.clear();
    })
     document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
    })
/*    
*/

</script>
