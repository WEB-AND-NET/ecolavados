<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
    Damage and services

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">Damage and services</li>
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
                            <a href="<?= $patch; ?>items/mr/add" id="btn-add" class=" btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >New</span></a>  
                            <a href="<?= $patch; ?>items/mr/edit" id="btn-edit" class="action btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span class='hidden-xs' >Edit</span></a> 
                            <a href="<?= $patch; ?>items/mr/delete" id="btn-delete" class=" action btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span class='hidden-xs'>Delete</span></a>
                            <a href="<?= $patch; ?>items/mr/damages" id="btn-damages" class=" btn btn-default btn-md"><i class="fa fa-chain-broken"></i><br/><span class='hidden-xs'>Damages</span></a>
                            <a href="<?= $patch; ?>items/mr/services" id="btn-damages" class=" btn btn-default btn-md"><i class="fa fa fa-thumbs-up"></i><br/><span class='hidden-xs'>Services</span></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Guide Line</th>
                                <th>Code</th>
                                <th>Damage</th>                                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data["items"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r->id; ?>" /></td>
                                    <td><?= $r->guideline; ?></td>
                                    <td><?= $r->code; ?></td>
                                    <td><?= $r->damage; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Guide Line</th>
                                <th>Code</th>
                                <th>Damage</th>    
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