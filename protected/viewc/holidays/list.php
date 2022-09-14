<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
    Holidays/Dias Festivos

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">Holidays</li>
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
                            <a href="<?= $patch; ?>holidays/add" id="btn-add" class="action btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >New</span></a>  
                            <a href="<?= $patch; ?>holidays/edit" id="btn-edit" class="action btn btn-default btn-md"><i class="fa fa-edit "></i><br/><span class='hidden-xs' >Edit</span></a>  
                            <a href="<?= $patch; ?>holidays/delete" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span class='hidden-xs' >Delete</span></a>
                    </div>
                    </div><!-- /.btn-group -->
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Fecha</th>
                                <th>Descripcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['festivos'] as $f){ ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $f->id ?>" /></td>
                                    <td><?= $f->fecha ?></td>
                                    <td><?= $f->descripcion ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Fecha</th>
                                <th>Descripcion</th>
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
<script>
    $(function () {
            $("#tabledatas").DataTable({responsive: true});
        });

    $('#btn-edit').click(function (e) {
        e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
        }
        else {
            var action = $(this).attr("href");
            location.href = action +"/"+item;
            //window.open(action + "/" + item);
            //console.log(item)
        }
    });

    $('#btn-delete').click(function (e) {
        e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
        }
        else {
            var action = $(this).attr("href");
            if(confirm("¿Esta seguro de Eliminar esta Fecha?")){
                location.href = action +"/"+item;
                //window.open(action + "/" + item);
            }
        }
    });

</script>