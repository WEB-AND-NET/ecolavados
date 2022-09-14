<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
    List of certificates for hot work
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">List of certificates for hot work</li>
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
                            <a href="<?= $patch; ?>hot/add" id="btn-add" class=" btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >New</span></a>  
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>#</th>
                                <th>status</th>
                                <th>Authorized by</th>
                                <th>Operator</th>
                                <th>Work</th>
                                <th>Initial date</th>
                                <th>Final Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php foreach ($data["height"] as $r) {
                                $label="";
                                $text="";
                                if($r["status"]=='N'){
                                    $label="label-danger";
                                    $text="Rejected";
                                }else if($r["status"]=='S'){
                                    $label="label-success";
                                    $text="Valid";
                                }else if($r["status"]=='A'){
                                    $label="label-success";
                                    $text="Assigned";
                                }else{
                                    $label="label-warning";
                                    $text="defeated";
                                }
                                ?>        
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r["id"]; ?>" /></td>
                                    <td><?= $r["consecutivo"]; ?></td>
                                    <td><span class="label  <?= $label ?>"><?= $text ; ?></span></td>
                                    <td><?= $r["autoriza"]; ?></td>
                                    <td><?= $r["operador"]; ?></td>
                                    <td><?= $r["trabajo"]; ?></td>
                                    <td><?= $r["hora_inicio"]; ?></td>
                                    <td><?= $r["hora_final"]; ?></td>
                                    

                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>#</th>
                                <th>status</th>
                                <th>Authorized by</th>
                                <th>Operator</th>
                                <th>Work</th>
                                <th>Initial date</th>
                                <th>Final Date</th>
                                
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