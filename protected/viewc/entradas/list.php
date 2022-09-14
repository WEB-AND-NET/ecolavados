<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
    Current Inventory

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">Current Inventory</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="mailbox-controls" style="float:right;">
                    <div class="btn-group">  
                        <!-- Check all button -->
                        <?php if($data["role"] != "13"){?>
                    
                            <a href="<?= $patch; ?>entrys/schedule" id="btn-add" class="action btn btn-default btn-md"><i class="fa fa-calendar "></i><br/><span class='hidden-xs' >Schedule</span></a>  
                            <a href="<?= $patch; ?>entrys/edit" id="btn-add" class="action btn btn-default btn-md"><i class="fa fa-edit "></i><br/><span class='hidden-xs' >edit</span></a>  
                            <a href="<?= $patch; ?>entrys/print" id="btn-print" class="btn btn-default btn-md"><i class="fa fa-print "></i><br/><span class='hidden-xs' >I.E.R.</span></a>
                            <a href="<?= $patch; ?>entrys/timeline" id="btn-time" class="action btn btn-default btn-md"><i class="fa fa-film" aria-hidden="true"></i><br/><span class='hidden-xs' >Timeline</span></a>

                            <a href="<?= $patch; ?>entrys/invoice/C" id="btn-invoice" class="btn btn-default btn-md"><i class="fa fa-clone"></i><br/><span class='hidden-xs' >Invoice.</span></a>
                            <a href="<?= $patch; ?>entrys/invoice/all/associate" id="btn-invoice-aso" class="action btn btn-default btn-md"><i class="fa fa-file-archive-o"></i><br/><span class='hidden-xs' >Associate invoices  </span></a>

                            <a href="<?= $patch; ?>entrys/waste" id="btn-waste" class="action btn btn-default btn-md"><i class="fa fa-trash-o"></i><br/><span class='hidden-xs' >Waste</span></a>
                            <a href="<?= $patch; ?>authorization/edit/entrys" id="btn-chain" class=" btn btn-default btn-md"><i class="fa  fa-chain-broken  "></i><br/><span class='hidden-xs' >Authorization</span></a>  
                            <a href="<?= $patch; ?>entrys/requests" id="btn-requests" class="action btn btn-default btn-md"><i class="fa   fa-object-group"></i><br/><span class='hidden-xs' >Request</span></a>
                            <a href="<?= $patch; ?>entrys/calendar" id="btn-add" class=" btn btn-default btn-md"><i class="fa fa-calendar "></i><br/><span class='hidden-xs' >Calendar</span></a>  
                            <a href="<?= $patch; ?>entrys/clean" id="btn-clean" class="action btn btn-default btn-md"><i class="fa  fa-file-text-o  "></i><br/><span class='hidden-xs' >C. Certificate</span></a>  
                            <a href="<?= $patch; ?>entrys/seals" id="btn-seals" class=" btn btn-default btn-md"><i class="fa fa-tags "></i><br/><span class='hidden-xs' >Seals</span></a>  
                            <a target='_blank' href="<?= $patch; ?>entrys/csv" id="btn-csv" class=" btn btn-default btn-md"><i class="fa fa-file-excel-o" aria-hidden="true"></i><br/><span class='hidden-xs' >Excel</span></a>  
                      
                        <?php }else{ ?>
                              <a href="<?= $patch; ?>entrys/timeline" id="btn-time" class="action btn btn-default btn-md"><i class="fa fa-film" aria-hidden="true"></i><br/><span class='hidden-xs' >Timeline</span></a>
                            <a href="<?= $patch; ?>entry/edit" id="btn-chain" class=" btn btn-default btn-md"><i class="fa  fa-chain-broken  "></i><br/><span class='hidden-xs' >Authorization</span></a>  
                            <a href="<?= $patch; ?>entrys/print" id="btn-print" class="btn btn-default btn-md"><i class="fa fa-print "></i><br/><span class='hidden-xs' >I.E.R.</span></a>
                            <a href="<?= $patch; ?>entrys/print/clean" id="btn-print-clean" class="btn btn-default btn-md"><i class="fa fa-print "></i><br/><span class='hidden-xs' >Clean Cert</span></a>
                            <a href="<?= $patch; ?>entrys/print/seals" id="btn-print-seals" class=" btn btn-default btn-md"><i class="fa fa-tags "></i><br/><span class='hidden-xs' >View Seals</span></a>  
                            <a target='_blank' href="<?= $patch; ?>entrys/csv" id="btn-csv" class=" btn btn-default btn-md"><i class="fa fa-file-excel-o" aria-hidden="true"></i><br/><span class='hidden-xs' >Excel</span></a>  
                        <?php } ?>
                    </div>
                    </div><!-- /.btn-group -->
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Tank</th>
                                <th>Type</th>
                                <th>Client-Assign</th>
                                <th>assigned</th>
                            
                                <th>Client</th>
                                <th>Status</th>
                                <th>Entry Date</th>
                                <th>Days On</th>
                                <th>Test 2.5</th>    
                                                    
                                <th>Test 5</th>   
                                <th>Gate out </th>   
                                <th>Departure </th> 
                                <th>municipio </th> 
                                
                                <th>Damage</th>  
                                <th>Observation</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["entradas"] as $r) {
                                $color30='';
                                $color60='';                               

                            /**
                             * 
                             * 
                             */

                        $fecha30 = $r['test30']=="" ? "": new DateTime($r['test30']) ;
                        $fecha60 =$r['test60']=="" ? "": new DateTime($r['test60']) ;
                        $fechaActual = new DateTime(date("Y-m-d")); 
                        $fechaManufactura=$r['make_date']=="" ? "": new  DateTime($r['make_date']);
                        $diferencia = 0; 
                        $ref=0;      

                        if($fecha30 != "" && $fecha60 != "" ){
                            if($fecha60 > $fecha30 ){
                                $diferencia = $fechaActual->diff($fecha60);
                                $diferencia= $diferencia->days / 31;

                                if(26 <= $diferencia  and $diferencia <=34){                    
                                    //Realizar teste de 2.5
                                    $color30='rgba(250, 190, 77, 0.3)';
                                    $ref=1;
                                }
                            
                                if($diferencia > 34){
                                    //Realizar teste de 5
                                    $color60 ='rgba(250, 190, 77, 0.3)';
                                    $ref=1;
                                }
                                //echo $diferencia;
                            }
                            
                            if ($fecha60 < $fecha30){
                                $diferencia = $fechaActual->diff($fecha30);
                                $diferencia= $diferencia->days / 31;
                                If ($diferencia >= 26){
                                    //Realizar teste de 5
                                    $color60 ='rgba(250, 190, 77, 0.3)';
                                    $ref=1;
                                }
                            }
                        }else if( $fecha60 == "" && $fecha30 != ""){
                            $diferencia = $fechaActual->diff($fecha30);
                            $diferencia= $diferencia->days / 31;            
                            if ($diferencia >= 26){
                                    //Realizar teste de 5
                                    $color60 ='rgba(250, 190, 77, 0.3)';
                                    $ref=1;
                            }
                        }else if($fecha30 == "" && $fecha60 != ""){
                            $diferencia = $fechaActual->diff($fecha60);
                            $diferencia= $diferencia->days / 31; 
                            
                            if(26 <= $diferencia  && $diferencia <= 34){
                                //Realizar teste de 2.5
                                $color30='rgba(250, 190, 77, 0.3)';
                                $ref=1;
                            }else if($diferencia >= 34){
                                //Realizar teste de 5
                                $color60 ='rgba(250, 190, 77, 0.3)';
                                $ref=1;
                            }
                        }else if($fecha30 == "" && $fecha60 == "" &&  $fechaManufactura != "" ){
                            $diferencia = $fechaActual->diff($fechaManufactura);
                            $diferencia= $diferencia->days / 31;             
                            If (26 <= $diferencia && $diferencia <= 34){
                                //Realizar teste de 2.5
                                $color30='rgba(250, 190, 77, 0.3)';
                                $ref=1;
                            }
                            if ($diferencia > 34){
                                //Realizar teste de 5
                                $color60 ='rgba(250, 190, 77, 0.3)';
                                $ref=1;
                            }
                        }
                        if($ref==0){
                           // echo 'No fue posible calcular el test o no necesita realizar test, Diferencia:'.$diferencia;
                        }
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" id_autorizacion='<?= $r['id_autorizacion']; ?>' value="<?= $r['id']; ?>" /></td>
                                    <td ><?= $r['serial']; ?></td>
                                    <td ><?= $r['type']; ?></td> 
                                    <td style='background: <?= $r["color_client_send"] ?>'><?= $r['numer_client_sed']; ?> <?= $r['name_client_send']; ?></td> 
                                    
                                    <td><?= $r['assing']=='N'?'NO' : 'YES' ; ?></td>
                                    <td><?= $r['nombre']; ?></td>
                                    <td> <span class='label <?= $r['color']; ?>''><?= $r['status_name']; ?></span></td>
                                    <td><?= $r['fecha']; ?></td>
                                    <td><?= $r['dayson']; ?></td>
                                    <td style='background: <?= $color30; ?>'><?= $r['test30'] ?></td>                                 
                                    <td style='background: <?= $color60; ?>'><?= $r['test60'] ?></td>
                                    <td><?= $r['salida'] ?></td>
                                  <td ><?= $r['fecha_salida'] ?></td>
                                  <td ><?= $r['municipio'] ?></td>
                                    <td><?= $r['damage'] ?></td>
                                    <td><?= $r['observation'] ?></td>

                                    
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>&nbsp;</th>
                            <th>Tank</th>
                                <th>Type</th>
                                <th>Client-Assign</th>
                                <th>assigned</th>

                                <th>Client</th>
                                <th>Status</th>
                                <th>Entry Date</th>
                                <th>Days On</th>
                                <th>Test 2.5</th>    
                         
                                <th>Test 5</th>  
                                <th>Gate out </th>    
                        
                                <th> Departure </th>   
                                <th>municipio </th> 
                                <th>Damage</th>  
                                <th>Observation</th> 
                                
                            </tr>
                        </tfoot>
                    </table>





                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">

$("#btn-print-seals").click(function(e){
        e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
               var action ="<?= $patch; ?>entrys/print/seals";
            window.open(action + "/" + item);
        }
                 
        
    })


    $("#btn-print-clean").click(function(e){
        e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            $.post("<?= $data["rootUrl"] ?>entrys/clean/validate",{id:item},function(data){
                if(data=="true"){
                   var action ="<?= $patch; ?>entrys/print/clean";
                   window.open(action + "/" + item);
                }else{
                    alert("the certificate not has been generated")
                }
                
            });
        }
        
    })

    $('.action').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });
    $('#btn-chain').click(function (e) {
        item = $('input[name=item]:checked').attr('id_autorizacion');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });

    $('#btn-print').click(function (e) {
         e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
          
        }
        else {
            var action = $(this).attr("href");
            window.open(action + "/" + item);
        }
    });
    
     $('#btn-invoice').click(function (e) {
         e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
          
        }
        else {
            var action = $(this).attr("href");
            window.open(action + "/" + item);
        }
    });
    $('#btn-seals').click(function (e) {
        e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
        }
        else {
            $.post("<?= $data["rootUrl"] ?>entrys/getSchedule",{"id":item},function(er){
                if(er.length=='0'){
                    var action = $('#btn-seals').attr("href");
                    $(this).attr("href", action+"/"+item);
                    window.location.assign($(this).attr("href"))
                  //  window.location
                }else{
                     var action = $('#btn-seals').attr("href");
                    $(this).attr("href", action+"/"+item);
                    window.location.assign($(this).attr("href"))
                }
                
            },'Json')

        }
    });



    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
        
         $(function () {
            $("#tabledatas").DataTable({
                rowReorder: {
                selector: 'td:nth-child(1)'
            },
            responsive: true
        });
    });

        
    });

   
    

    


</script>