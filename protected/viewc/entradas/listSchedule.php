<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>

     <?= "Tank: ".$data["entradas"]["serial"] ?>  Process Programming

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">Process Programming</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="mailbox-controls" style="float:right;">
                        <!-- Check all button -->
                        <?php if($data["role"] != "13"){?>
                        <div class="btn-group">  
                            <a href="<?= $patch; ?>entrys/schedule/add/<?= $data["entradas"]["id"];   ?>" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-calendar "></i><br/><span class='hidden-xs' >Schedule</span></a>  
                            <a href="<?= $patch; ?>entrys/schedule/edit/<?= $data["entradas"]["id"];   ?>" id="btn-edit" class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span class='hidden-xs' >Edit</span></a> 
                            <a href="<?= $patch; ?>entrys/schedule/close/<?= $data["entradas"]["id"];   ?>" id="btn-close" class=" btn btn-default btn-md"><i class="fa fa-anchor"></i><br/><span class='hidden-xs' >Work closure</span></a> 
                            <a href="<?= $patch; ?>entrys/schedule/assing" id="btn-assing" class=" btn btn-default btn-md"><i class="fa  fa-indent"></i><br/><span class='hidden-xs' >Assign work</span></a>  
                            <a href="<?= $patch; ?>entrys/schedule/print" id="btn-print" class=" btn btn-default btn-md"><i class="fa fa-print"></i><br/><span class='hidden-xs' >Print</span></a> 
                           
                        </div><!-- /.btn-group -->
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Activity start at</th>  
                                <th>Activity end at</th>  
                                <th>Proccess</th>   
                                <th>Request Number</th> 
                                <th>Description</th> 
                                <th>Employee</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["schedule"] as $r) {
                                $color='';
                                $text='';
                                $close='false';
                                $assing='false';
                                if($r['operario']==""){
                                    $assing='true';
                                }else{
                                    $assing='false';
                                }
                                if($r["status"]==""){
                                    $color="#fbf71c59;";
                                    $text='Not started';
                                    $close='false';
                                }else if($r["status"] != "" and $r["status1"] == ""){
                                    $color="#fb9f1c59;";
                                    $text='Started';
                                    $close='false';
                                }else if($r["status"] != "" and $r["status1"] != "" and $r["cerrado"]=='S'){
                                    $color="rgba(25, 134, 209, 0.62);";
                                    $text='Finished and revise';
                                    $close='false';
                                }else{
                                    $color="rgba(36, 209, 25, 0.3);";
                                    $text='Finish';
                                    $close='true';
                                }
                                
                                
                                
                                ?>
                                <tr style="background:<?= $color ?>">
                                    <td><input class="minimal" name="item" assing='<?= $assing ?>' no-close='<?= $close ?>'
                                   
                                    type="radio" data-request="<?= $r["request"] ?>" value="<?= $r['id']; ?>" /></td>
                                    <td ><?= $r['fecha_inicio']; ?></td>
                                    <td><?= $r['fecha_fin']; ?></td>
                                    <td ><?= $r['nombre']; ?></td>
                                    <td><?= $r['request']; ?></td>
                                    <td><?= $r['descripcion']; ?></td>
                                    <td><?= $r['operario']; ?></td>
                                 

                                    
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>&nbsp;</th>
                            <th>Activity start at</th>  
                                <th>Activity end at</th>  
                                <th>Proccess</th>   
                           
                                <th>Request Number</th> 
                                <th>Description</th> 
                                <th>Employee</th> 
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


$('#btn-close').click(function (e) {
    console.log();
        item = $('input[name=item]:checked').attr('value');
        datarequest = $('input[name=item]:checked').attr('data-request')
        close = $('input[name=item]:checked').attr('no-close')
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
            if(close=="true"){
                var action = $(this).attr("href") + "/" + item+"/"+datarequest;
                $(this).attr("href", action);
            }else{
                e.preventDefault();
                alert("This work order is not ready to be closed");
            }
            
        }
    });
    $('#btn-assing').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        close = $('input[name=item]:checked').attr('assing')
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }else {
        
            if(close=="true"){
                var action = $(this).attr("href") + "/" + item;
                $(this).attr("href", action);
            }else{
                e.preventDefault();
                alert("This work has been asigned");
            }
            
        }
    });
    $('#btn-edit').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        close = $('input[name=item]:checked').attr('assing')
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }else {
        
           // if(close=="true"){
                var action = $(this).attr("href") + "/" + item;
                $(this).attr("href", action);
        /*    }else{
                e.preventDefault();
                alert("This work has been asigned");
            }*/
            
        }
    });
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


    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $(function () {
        $("#tabledatas").DataTable({
            rowReorder: {
            selector: 'td:nth-child(1)'
        },
        responsive: true
        });
    });

    

    


</script>