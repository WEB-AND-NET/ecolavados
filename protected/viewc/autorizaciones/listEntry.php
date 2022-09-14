<style>
td{
    font-weight: bold;
}
</style>
<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>
        List of authorizations
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">LIST OF AUTHORIZATIONS</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-body">
                    <div class="mailbox-controls" style="float:right;">
                        <!-- Check all button -->   
                        <div class="btn-group">  
                        <a href="<?= $patch; ?>authorized/arrival" id="btn-arrival" class="action btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span class='hidden-xs' >Arrival</span></a> 
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Tank</th>
                                <th>Client</th>
                                <th>Tranport company</th>
                                <th>Plate</th>
                                <th>Driver</th>
                                <th>Estimated arrival date</th>
                                
                        
                                <th>Entry</th>
                                <th>State</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php foreach ($data["autorizaciones"] as $r) {?>        
                                    <tr style='background:<?php echo $r["entrada"]=="" ? 'rgba(250, 190, 77, 0.3)' : ($r["estado"]=="T" ? 'cian' : '#7adb7a82' ) ?>'  >
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r['serial']; ?></td>
                                    <td><?= $r['nombre_cliente']; ?></td>
                                    <td ><?= $r['transportista']; ?></td>
                                    <td><?= $r['placa']; ?></td>
                                    <td><?= $r['conductor']; ?></td>
                                    <td ><?= $r['fecha_estimada']; ?></td>
                                    
                                   
                                    <td><?= $r['entrada']; ?></td>
                                    <td>
                                        <?php
                                        if($r['state']=='P'){
                                            echo 'Pending to approve';
                                        }  if($r['state']=='R'){
                                            echo 'In Review';
                                        }
                                        if($r['state']=='A'){
                                            echo 'Approve';
                                        }
                                        ?></td>
                            

                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Tank</th>
                                 <th>Client</th>
                                <th>Tranport company</th>
                                <th>Plate</th>
                                <th>Driver</th>
                                <th>Estimated arrival date</th>
                                
                               
                                <th>Entry</th>
                                <th>State</th>
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

    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $(function () {
        $("#tabledatas").DataTable({
            rowReorder: {
            selector: 'td:nth-child(3)'
        },
        responsive: true
        });
    });

    
    ////
    


</script>