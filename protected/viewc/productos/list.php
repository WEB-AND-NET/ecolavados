<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<style>
.select2-container{
    width: 400px!important;
}
</style>
<section class="content-header">
    <h1>
        List of Products and Supplies

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">LIST OF PRODUCTS</li>
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
                            <a href="<?= $patch; ?>products/add" id="btn-add" class=" btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >New</span></a>  
                            <a href="<?= $patch; ?>products/movements" id="btn-movements" class="action btn btn-default btn-md"><i class="fa fa-database"></i><br/><span class='hidden-xs' >Movements</span></a> 
                            <a href="<?= $patch; ?>products/history" id="btn-movements" class="action btn btn-default btn-md"><i class="fa fa-folder-o" aria-hidden="true"></i><br/><span class='hidden-xs' >History</span></a>
                            <a href="<?= $patch; ?>products/categorys" id="btn-movements" class=" btn btn-default btn-md"><i class="fa fa-list"></i><br/><span class='hidden-xs' >Categorys</span></a> 
                            <a href="<?= $patch; ?>products/procedures" id="btn-movements" class="action btn btn-default btn-md"><i class="fa fa-caret-square-o-right"></i><br/><span class='hidden-xs' >Procedures</span></a> 
                            <a href="<?= $patch; ?>products/delete" id="btn-delete" class="action btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span class='hidden-xs'>Delete</span></a>
                            <a data-toggle="modal" data-target="#myModal" id="btn-report" class=" btn btn-default btn-md"><i class="fa fa-envelope-o"></i><br/><span class='hidden-xs'>Print Report</span></a>
                            
                            
                        
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Name of product</th>
                                <th>quantity</th>
                                <th>unit of measurement</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach ($data["productos"] as $r) { ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r['id']; ?>" /></td>
                                    <td><?= $r['nombre']; ?></td>
                                    <td><?= $r['cantidad']; ?></td>
                                    <td><?= $r['unidad_medida']; ?></td>
                                    <td><?= $r['tipo']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Name of product</th>
                                <th>Quantity</th>
                                <th>Unit of measurement</th>
                                <th>Category</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>




<div id="myModal" class="modal"  tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Impeimir productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
            <label id="l_tipo">Category*</label>
            <div class="input-group margin-bottom-20">
                <span data-toggle="modal" data-target="#myModal" class="input-group-addon">
                    <i  class="fa fa-plus"></i>
                </span>
                <select class='form-control' name="tipo" id="tipo">
                <option class="X">[Seleccione]</option>
                <?php  foreach ($data["item"] as $r) {  ?>
                    <option value="<?php echo  $r["id"] ?>"><?php echo $r['tipo'] ?></option>
                <?php } ?>
                </select>
            </div><!-- /.input group -->
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" id="btn_print_report" class="btn btn-primary ">Print</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $("#btn_print_report").click(function(){
        let categoria = $("#tipo option:selected").val()
        if(categoria!='X'){
            window.open(`<?= $patch ?>products/printer/${categoria}`)
        }        
    })

    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $('.action').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Select item');
            e.preventDefault();
        }
        else {
            var action = $(this).attr("href") + "/" + item;
            $(this).attr("href", action);
        }
    });
    

    $(function () {
        $("#tabledatas").DataTable({
            rowReorder: {
            selector: 'td:nth-child(1)'
        },
        responsive: true
        });
    });

    $(document).ready(function(){
         //Searc a category
      
    })

    
    ////
    
    


</script>