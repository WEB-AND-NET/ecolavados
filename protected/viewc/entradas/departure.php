<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
    list of departure

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active"> list of departure</li>
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
                                <a href="<?= $patch; ?>entrys/invoice/L" id="btn-invoice" class="btn btn-default btn-md"><i class="fa fa-clone"></i><br/><span class='hidden-xs' >Invoice</span></a>
                                <a href="<?= $patch; ?>entrys/invoice/all/associate" id="btn-invoice-aso" class="action btn btn-default btn-md"><i class="fa fa-file-archive-o"></i><br/><span class='hidden-xs' >Associate invoices  </span></a>
                             <a href="<?= $patch; ?>entrys/print/clean" id="btn-print-clean" class=" btn btn-default btn-md"><i class="fa fa-tags "></i><br/><span class='hidden-xs' >C. Certificate</span></a>  
                            <a href="<?= $patch; ?>entrys/print/seals" id="btn-print-seals" class=" btn btn-default btn-md"><i class="fa fa-tags "></i><br/><span class='hidden-xs' >View Seals</span></a>
                              <a href="<?= $patch; ?>entrys/timeline" id="btn-time" class="action btn btn-default btn-md"><i class="fa fa-film" aria-hidden="true"></i><br/><span class='hidden-xs' >Timeline</span></a>

                            <?php }else{ ?>
                                <a href="<?= $patch; ?>entrys/print/clean" id="btn-print-clean" class="btn btn-default btn-md"><i class="fa fa-print "></i><br/><span class='hidden-xs' >Clean Cert</span></a>
                                <a href="<?= $patch; ?>entrys/print/seals" id="btn-print-seals" class=" btn btn-default btn-md"><i class="fa fa-tags "></i><br/><span class='hidden-xs' >View Seals</span></a>  
                            <?php } ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                     <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Serial</th>
                                <th>Client</th>
                                <th>Entry date</th>
                                <th>Departure date</th>
                                <th>Plate of departure</th>
                                <th>Driver</th>
                                <th>Observacion</th>
                            </tr>
                        </thead>
                        <tbody>                           
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>&nbsp;</th>
                            <th>Serial</th>
                            <th>Client</th>
                            <th>Entry date</th>
                            <th>Departure date</th>
                            <th>Plate of departure</th>
                            <th>Driver</th>
                             <th>Observacion</th>
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

        $(document).ready(function() {
            var url = "<?= $patch ?>departures/getAllDepartures";
            $('#tabledatas').DataTable( {
                "ajax": {
                    url:url,
                    dataSrc:""
                }, rowReorder: {
                    selector: 'td:nth-child(1)'
                },                    
                responsive: true,
                columns: [
                    {   
                        data:"id_entrada",
                        render: function(data, type, row){
                            return "<input class='minimal' name='item'  value='"+data+"' type='radio'>";
                        }},
                    
                    {data:"serial"},
                    {data:"nombre"},
                    {data:"fecha_ingreso"},
                    {data:"fecha_salida"},
                    {data:"placa_salida"},
                    
                    {data:"nombre_conductor_salida"},
                     {data:"observacion"},
                  
                ]
            } );
        } );

        
       

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
            var action ="<?= $patch; ?>entrys/print/clean";
            window.open(action + "/" + item);
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
                   
                }
                
            },'Json')

        }
    });



    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    

    

    


</script>