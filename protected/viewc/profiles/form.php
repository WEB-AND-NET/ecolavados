<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<style>
.profile-user-img {
    margin: 0 auto;
    width: 100px;
    padding: 3px;
    border: 3px solid #d2d6de;
}
.img-circle {
    border-radius: 50%;
}

.esconder {
  display:none;
}
input[type="file"] {
    display: none;
}

</style>

<div class="container">
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">
            <i class="fa fa-cog"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TANKS REGISTED</span>
              <span class="info-box-number"><?= $data["tanques"]["cantidad"]?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red">
            <i class="fa fa-toggle-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ENTRYS</span>
              <span class="info-box-number"><?= $data["entrys"]["cantidad"] ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PRODUCTS</span>
              <span class="info-box-number"><?= $data['prods']['cant'] ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-cart-arrow-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">DEPARTURE</span>
              <span class="info-box-number"><?= $data['allTanks']['cantidad'] ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
</div>

<div class="container-fluid">
<div class="col-md-3" >
  <div>
        <div class="box box-primary">
            <div class="box-body box-profile">

              <img class="profile-user-img img-responsive img-circle" width="200px" src="<?php echo $data['rootUrl'] ?>global/img/users/<?echo $data['imagen']?>" alt="IMG PROFILE">

              <h2 class="profile-username text-center font-weight-bold"><?php echo $data['nombre'] ?></h2>

              <p class="text-muted text-center">Descripcion</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Correo: </b><br> <a><?php echo $data['email'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Identificacion: </b><br> <a><?php echo $data['identificacion'] ?></a>
                </li>
              </ul>

                  <label class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-camera"></i>
                    <b> Cambiar Imagen</b>
                  </label>
            </div>
        </div>
  </div>
</div>

<div class="col-md-9">
    <div class="box box-primary">
        <div class="container-fluid tabla" style="width:100%" hidden>
          <div class="box-body box-profile">
            <table id="tablaProd" style="width:100%" class="table table-bordered">
              <thead> 
                <tr>
                  <td>Nombre Producto</td>
                  <td>Precio</td>
                  <td>Descripcion</td>
                </tr>
              </thead>
            </table>
          </div>
        </div> 
    </div>
  </div>

</div>


<!--Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
         
         <form id="form1">
          <div class="form-group">
            <label for="imagen" class="btn btn-primary" >Examinar Imagen</label>
            <input style="width:45%" type="file" class="form-control" id="imagen" name="dataimagen" aria-describedby="emailHelp" placeholder="Enter url de imagen">
          </div>
          <p>Seleccione una imagen, personalice a su estilo.</p>
         </form>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="save-image" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<!--Fin modal-->


<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<?php if ($data['tipo'] == "C") {?> 
  <script>
  $(document).ready(function(){
    table = $('#tablaProd').DataTable({
        "processing": true,
        "ajax": "<?php echo $data['rootUrl']?>profile/get/<?php echo $_SESSION['login']->id_usuario ?>",
        "scrollX": true,
        "columns": [
            {"data": "nombre"},
            {"data": "precio"},
            {"data": "description"}
        ]
    });

    $(".tabla").removeAttr("hidden");
    $(this).attr("disabled","true");
  });
  </script>
<?php } ?>

<script>

$("#save-image").click(function(e){
  e.preventDefault();
  var formData = new FormData(document.getElementById("form1"));
  $.ajax({
    url: "<?= $data["rootUrl"] ?>profile/updateImg",
    type: "post",
    dataType: "html",
    data:formData,
    cache: false,
    contentType: false,
    processData: false
    }).success(function (data) { 
      location.reload();
    });
  });

</script>