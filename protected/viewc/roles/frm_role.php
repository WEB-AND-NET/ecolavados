<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $role = $data["role"]; ?>
<section class="content-header">
    <h1>
        <?php echo ($role->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Roles
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li><a href="<?= $patch ?>roles">Roles</a></li>
        <li class="active"><?php echo ($role->id == "" ? 'Registro' : 'Actualizaci&oacute;n'); ?> de Roles</li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>roles/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>Informaci&oacute;n General</legend>

                <div class="col-lg-4">
                    <label id="l_role">Role</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?php echo $role->role; ?>" id="role" name="role" size="30">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_role">Role</label>
                    <div class="input-group">
                        <textarea class="form-control pull-right" name="descripcion" rows="0" cols="45" id="descripcion"><?php echo $role->descripcion; ?></textarea>
                    </div><!-- /.input group -->
                </div>

                <div class="clearfix"></div>
                <table id="tabledatas" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Acceso</th>
                            <th>Opci&oacute;n de menu</th>
                            <th>Total</th>
                            <th>Parcial</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($data["opciones"] as $op):
                            ?>

                        <td><input class="minimal" name="opcion[]" type="checkbox" value="<?= $op['codigo']; ?>" <?= $op["codigo"] == $op["opcion"] ? 'checked' : '' ?>/></td>
                        <td><?= $op['menuitem']; ?></td>
                        <td><input class="minimal" name="<?=  $op['codigo']; ?>access" type="radio" value="T" <?php
                            if (isset($op["acceso"])) {
                                echo ($op["acceso"] == "T" ? 'checked' : '');
                            } else {
                                echo ($role->id == "" ? 'checked' : '');
                            }
                            ?> /></td>
                        <td><input class="minimal" name="<?= $op['codigo']; ?>access" type="radio" value="P" <?php
                            if (isset($op["acceso"])) {
                                echo ($op["acceso"] == "P" ? 'checked' : '');
                            } else {
                                echo ($role->id != "" ? '' : '');
                            }
                            ?> /></td>
                        </tr>
                        <?php
                        $i = 1 - $i;
                    endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Acceso</th>
                            <th>Opci&oacute;n de menu</th>
                            <th>Total</th>
                            <th>Parcial</th>
                        </tr>
                    </tfoot>

                </table>


                <div class="box-footer col-lg-2 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">Cancelar</button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">Guardar</button>
                    <input name="id" type="hidden" id="id" value="<?php echo $role->id; ?>" />
                </div>
            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green'
        });
    });

    $(function () {
        $("#tabledatas").DataTable({
            paging: false
        });
    });

    function validateForm() {

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#role').val(), $('#l_role').html(), true);
        sErrMsg += validateText($('#descripcion').val(), $('#l_descripcion').html(), true);

        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    var validar = function () {
        $.post('index.php?mod=roles&cmd=validar', {
            role: $('#role').val(),
            id: $("#id").val()
        },
        function (data) {
            if (data) {
                alert('El role ' + $('#role').val() + ' ya se encuentra registrado ..');
            } else {
                submitbutton('save');
            }
        }
        );
    };

    $('#btn-save').click(function () {
        if (validateForm()) {
            //validar();
            $('#form1').submit();
        }
    });

    $('#btn-cancel').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>roles';
    });

</script>


