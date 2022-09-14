<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
    Measurement units

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">Measurement units</li>
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
                            <a href="#"  id="btn-add" class=" btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >New</span></a>  

                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Unity</th>
                                <th>Acronym</th>
                                <th></th>
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Unity</th>
                                <th>Acronym</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Measurement units</h4>
      </div>
      <div class="modal-body">
            <div class="col-lg-12">
                <label id="l_identificacion">Unit</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </div>
                    <input type="text" class="form-control pull-right" value=""  id="nombre" name="nombre">
                </div><!-- /.input group -->
            </div>
            <div class="col-lg-12">
                <label id="l_identificacion">Acronym</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </div>
                    <input type="text" class="form-control pull-right" value=""  id="acronimo" name="acronimo">
                </div><!-- /.input group -->
            </div>
            <input type='hidden' id='id'>

      </div>
      <div class="clearfix"><br></div>
      <div class="modal-footer">
      <br/>
        <button type="button" class="btn btn-success" id='btn-save'>Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">


var table=$("#tabledatas").DataTable({
            ajax:{
            url:"<?php echo $patch ?>units/getUnits",
            dataSrc:'data'
        },
        columns:[ 
            { data: "id"} ,
            { data: "nombre"} ,
            { data: "acronimo" },
            {
                "data": null,
                "defaultContent": `
                <button class='btn btn-warning edit' type='button' name='iteme'><i class='fa fa-pencil' aria-hidden='true'></i> Edit</button>
                <button class='btn btn-danger delete' type='button' name='itemd'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button>`
            }

        ],
            rowReorder: {
            selector: 'td:nth-child(1)'
        },
        responsive: true
    });

    function clean(){
        $("#id").val("")
        $("#nombre").val("")
        $("#acronimo").val("")
    }

    $('#tabledatas tbody').on( 'click', 'button.edit', function () {
        var data = table.row( $(this).parents('tr') );
        console.log(data.data());
        $("#id").val(data.data()["id"])
        $("#nombre").val(data.data()["nombre"])
        $("#acronimo").val(data.data()["acronimo"])
        $("#myModal").modal("show");
      //  console.log(data.data());
    })

    $("#btn-add").click(function(){
        clean()
        $("#myModal").modal("show");
    })

    $('#btn-edit').click(function (e) {
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            e.preventDefault();
        }
        else {
           $("#id").val(item);
           $("#myModal").modal("show");
        }
    });

    $('#tabledatas tbody').on( 'click', 'button.delete', function () {
            var data = table.row( $(this).parents('tr') );
            $.post("<?php echo $patch ?>units/deleteItem",{id:data.data()["id"]},function(response){},'Json');table.ajax.reload();
        });

    $("#btn-save").click(function(){
        var nombre = $("#nombre").val();
        var acronimo = $("#acronimo").val();
        var id= $("#id").val();
        var data={
            id:id,
            nombre:nombre,
            acronimo:acronimo
        }
        if(nombre.trim() != ""){
            if(acronimo.trim() != ""){
                saveUnidad(data)
                clean()
                $("#myModal").modal("hide");
            }else{

            }
        }else{

        }
    })

    function saveUnidad(data){
        $.post("<?php echo $patch ?>units/saveUnidad",data,function(data){
           
        })
         table.ajax.reload();
    }


   

    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $("#myModal").on('show.bs.modal', function(){
        
    });

   
       
    

    


</script>