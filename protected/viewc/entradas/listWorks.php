<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
    
Scheduled works

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">
Scheduled works</li>
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
                            <a href="<?= $patch; ?>entrys/execute/1" id="btn-add" class="action btn btn-default btn-md"><i class="fa fa-hand-o-up"></i><br/><span class='hidden-xs' >Start Work</span></a>  
                            <a href="<?= $patch; ?>entrys/execute/2" id="btn-print" class="action btn btn-default btn-md"><i class="fa   fa-hand-o-down"></i><br/><span class='hidden-xs' >End Work</span></a>
                        </div><!-- /.btn-group -->
                   
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>  
                                <th>Serial</th>
                                <th>Status</th>
                                <th>Activity start at</th>  
                                <th>Activity end at</th>  
                                <th>Proccess</th>   
                                <th>Request Number</th> 
                                <th>Employee</th>         
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["trabajos"] as $r) { 
                                $color='';
                                $text='';
                                if($r["status"]==""){
                                    $color="#fbf71c59;";
                                    $text='Not started';
                                }else if($r["status"] != "" and $r["status1"] == ""){
                                    $color="#fb9f1c59;";
                                    $text='Started';
                                }else{
                                    $color="rgba(36, 209, 25, 0.3);";
                                    $text='Finish';
                                }
                                ?>
                                <tr style="background:<?= $color ?>">
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r['serial'];?></td>
                                    <td><?= $text; ?></td>
                                    <td ><?= $r['fecha_inicio']; ?></td>
                                    <td><?= $r['fecha_fin']; ?></td>
                                    <td ><?= $r['nombre']; ?></td>
                                    <td><?= $r['request']; ?></td>
                                    <td><?= $r['operario']; ?></td>
                                    <td> <?php if($r['nombre']=='CLEANING'){   ?> 
                                        <a target="_blank" class='btn btn-success' href="<?= $patch ?>entrys/info_procedure/<?= $r['id']; ?>">Ficha Técnica</a>  
                                        <?php     }  ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Serial</th>
                                <th>Status</th>
                                <th>Activity start at</th>  
                                <th>Activity end at</th>  
                                <th>Proccess</th>   
                                <th>Request Number</th> 
                                <th>Employee</th> 
                                <th></th> 
                             
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
            selector: 'td:nth-child(1)'
        },
        responsive: true
        });
    });

    

    


</script>