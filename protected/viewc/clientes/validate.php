<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />


<section class="content-header">
    <h1>
        LIST OF CLIENTS WITH CURRENCY
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">LIST OF CLIENTS</li>
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
                        </div><!-- /.btn-group -->
                    </div>
                    
                    <div class="clearfix"></div>
                        <div >
                            <table id="tabledatas" class="table responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Tel</th>
                                        <th>Email</th>
                                        <th>Currency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data["clientes"] as $r) {
                                        ?>
                                        <tr>
                                            <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                            <td><?= $r['identificacion']; ?></td>
                                            <td><?= $r['nombre']; ?></td>
                                            <td><?= $r['celular']; ?></td>
                                            <td><?= $r['email']; ?></td>
                                            <td><?= $r['moneda']  ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Tel</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">

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

    $('#btn-edit').click(function (e) {
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
     $('#btn-email').click(function (e) {
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
    
    $('#btn-edit-contrato').click(function (e) {
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
    
    $('#btn-delete').click(function (e) {
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

    $('#btn-find').click(function () {
        $('#form1').submit();
    });
</script>
