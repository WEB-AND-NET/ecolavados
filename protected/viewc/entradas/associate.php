<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link  href="<?= $patch; ?>global/plugins/plugins/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet"/>

<section class="content-header">
    <h1>
    Associate Invoice
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>entrys">Associate Invoice</a></li>
        <li class="active"> Associate Invoice </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>entrys/save/assing" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information </legend>
                    <?php foreach($data["items"] as $item){?> 
                <div class="col-lg-2">
                    <label id="l_fecha">Services:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $item["service"]  ?>" data-id='<?php echo $item["id"] ?>' data-attr='service<?php echo $item["id"] ?>' id="service" name="fecha">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-2">
                    <label id="l_fecha">Description:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $item["description"] ?>" data-id='<?php echo $item["id"] ?>' data-attr='description<?php echo $item["id"] ?>' id="description" name="fecha">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-1">
                    <label id="l_fecha">Quantity:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $item["quantity"] ?>" data-id='<?php echo $item["id"] ?>' data-attr='quantity<?php echo $item["id"] ?>' id="quantity" name="quantity">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-1">
                    <label id="l_fecha">Price:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $item["price"] ?>" data-id='<?php echo $item["id"] ?>' data-attr='price<?php echo $item["id"] ?>'  id="price" name="price">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-2">
                    <label id="l_fecha">Total:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $item["total"] ?>" data-id='<?php echo $item["id"] ?>' data-attr='total<?php echo $item["id"] ?>' disabled  id="total" name="fecha">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-2">
                    <label id="l_fecha">Nº Invoice Eco:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $item["n_facture"] ?>" data-id='<?php echo $item["id"] ?>' data-attr='n_facture<?php echo $item["id"] ?>'   id="n_facture" name="fecha">
                    </div><!-- /.input group -->
                </div>
                <div class="col-lg-2">
                    <label id="l_fecha">Disccount:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa   fa-clock-o  "></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $item["amortizacion"] ?>" data-id='<?php echo $item["id"] ?>' data-attr='amortizacion<?php echo $item["id"] ?>'   id="amortizacion" name="fecha">
                    </div><!-- /.input group -->
                </div>

                <?php } ?>

            <div class="box-footer col-md-4 pull-right">
                <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                    <i class="fa  fa-arrow-left"></i> Cancel
                </button>
                <button type="button"   id="btn-save" class="btn  bg-green pull-right">
                    <i class="fa fa-save "></i> Save
                </button>

           
            </div>
        </div>
       
        
    </form>
</div>

<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>

<script>
    $("input.form-control").keyup(function(e){
        
        //linea de codigo que borra los datos no numericos...
        //this.value = (this.value + '').replace(/[^0-9]/g, '');

       campo= e.target.id;
       id=$(this).attr("data-id")
 
       if(campo=="price" || campo=="quantity" || campo=="amortizacion" || campo=="n_facture"){

           if(!validate(e)){
                var l = $(this).val().length
                $(this).val($(this).val().substring(0,l-1))
               // alert("dato incorrepto");
                return false;
           }else{
            var cantidad=$(`input[data-attr=quantity${id}]`).val();
            var amortizacion=$(`input[data-attr=amortizacion${id}]`).val(); 
            var valor=$(`input[data-attr=price${id}]`).val(); 
            var n_facture=$(`input[data-attr=n_facture${id}]`).val(); 
            

            

            console.log("cantidad: "+ cantidad );
            console.log("amortizacion: "+  amortizacion);
            console.log("valor: "+  valor);
            var total = (cantidad*valor-amortizacion) 
                if(!isNaN(total)){
                    $.post("<?= $patch; ?>entrys/associate/update",{cantidad,n_facture,total,valor,id,amortizacion},function(data){
                        $(`input[data-attr=total${id}]`).val(data["total"])
                    },'Json');
                }
            }
       
       }

       //$.post("<?//= $patch; ?>entrys/associate/update",{campo,valor,id},function(data){ });

    });

function validate(e){
    var tecla = window.event ? window.event.keyCode: e.which;
    var keycode = [8,48,49,50,51,52,53,54,55,56,57,190,96,97,98,99,100,101,102,103,104,105];
    if(keycode.includes(tecla)){
        return true;
    }
}

  

</script>