<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Request status

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">LIST REQUEST</li>
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
                            <a href="<?= $patch; ?>mrequest/approve" id="action btn-add" class="action btn btn-default btn-md"><i class="fa fa-check"></i><br/><span class='hidden-xs' >Approve</span></a>  
                            <a href="<?= $patch; ?>mrequest/not/mrequest" id="btn-edit" class="action btn btn-default btn-md"><i class="fa fa-times"></i><br/><span class='hidden-xs' >Disapprove</span></a> 
                            <a  href="<?= $patch; ?>request/print" id="btn-print" class=" btn btn-default btn-md"><i class="fa fa-clipboard"></i><br/><span class='hidden-xs' >Print</span></a>                              
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th># Request</th>
                                <th># Entry</th>
                                <th>Serial Tank</th>
                                <th> Client</th>
                                <th> Request Description</th>
                                <th> State</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["request"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r["id"]; ?>" /></td>
                                    <td><?= $r["id"]; ?> </td>
                                    <td ><?= $r["entrada"]; ?></td>
                                    <td ><?= $r["serial"]; ?></td>
                                    <td ><?= $r["nombre"]; ?></td>
                                    <td><?= $r["descripcion"]; ?> </td>
                                    <td><?php 
                                    if($r["state"]=="P" ){
                                        echo '<span class="label label-warning">Waiting for approval</span>';
                                    }else if($r["state"]=="A" ){
                                        echo '<span class="label label-success">Approved</span>';
                                    }else{
                                        echo '<span class="label label-danger">Not Approved</span>';
                                    }

                                    
                                    ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>&nbsp;</th>
                                <th># Request</th>
                                <th># Entry</th>
                                <th>Serial Tank</th>
                                <th>Client</th>
                                <th>Request Description</th>
                                <th>State</th>
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

    $('#btn-print').click(function (e) {
        e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
        }
        else {
            var action =$(this).attr("href")
            window.open( action + "/" + item)
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