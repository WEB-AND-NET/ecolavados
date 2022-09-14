<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />


<section class="content-header">
    <h1>
        LIST OF CLIENTS
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
                            <a href="<?= $patch; ?>clientes/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs'>new</span></a>
                            <a href="<?= $patch; ?>clientes/edit" id="btn-edit"class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span class='hidden-xs'>edit</span></a>
                            <a href="<?= $patch; ?>clientes/delete" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span class='hidden-xs'>delete</span></a>
                            <a href="<?= $patch; ?>clientes/email" id="btn-email" class="btn btn-default btn-md"><i class="fa  fa-envelope "></i><br/><span class='hidden-xs'>Email</span></a>
                            <a href="<?= $patch; ?>clientes/process" id="btn-process" class="btn btn-default btn-md"><i class="fa fa fa-list"></i><br/><span class='hidden-xs'>Processes</span></a>
                             <a href="<?= $patch; ?>clientes/check" id="btn-check" class="btn btn-default btn-md"><i class="fa fa fa-check"></i><br/><span class='hidden-xs'>Validate</span></a>
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
                                        <th>Type</th>
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
                                            <td><?= $r['tipo'] == "L" ? "Legal" : "Natural"; ?></td>
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
