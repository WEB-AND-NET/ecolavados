<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>
    
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>items">Items</a></li>
        <li class="active"> <?//= ($a->id == "" ? 'Authorization Register' : 'Authorization update'); ?>Ratings </li>
    </ol>
</section>

<br>
<br/>


<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>authorization/items/ratings/save" method="post" name="form1">
        <div class="box-body">
        <fieldset style="width:50%;">
                <legend>General information</legend>


                <table class='table'>
                <thead>
                    
                    <th>Description</th>
                    <th>Causes Log</th>
                    <th>Good</th>
                    <th>Bad</th>
                </thead>
                <tbody>
                <?php foreach($data["calificaciones"] as $calificacion){ ?>
                    <tr>
                        <td>
                            <?php echo $calificacion["descripcion"] ?>
                        </td>
                        <td>
                            <label id='la<?=$calificacion["id"] ?>'>
                                <input  <?php echo  $calificacion["causes_log"]=='S'? 'checked' : '' ?> class="minimal"  type="checkbox" value="<?php echo $calificacion["id"] ?>" />
                            </label>
                        </td> 
                        <td>
                        <label id='la<?=$calificacion["id"] ?>'>
                                <input  <?php echo  $calificacion["goodorbad"]=='G'? 'checked' : '' ?> class="minimal radio" data-value='G'  name='input<?= $calificacion["id"] ?>' type="radio" value="<?php echo $calificacion["id"] ?>" />
                            </label>
                        </td>
                        <td>
                        <label id='la<?=$calificacion["id"] ?>'>
                                <input <?php echo  $calificacion["goodorbad"]=='B'? 'checked' : '' ?> class="minimal radio"   data-value='B'  name='input<?= $calificacion["id"] ?>'  type="radio" value="<?php echo $calificacion["id"] ?>" />
                            </label>
                        </td>
                    </tr>
                <?php }  ?>
                  
                     
                
                <tbody>
            </table>
                
        
            <fieldset>
        <div>
    <form>
    <div class="box-footer col-md-4 pull-right">
        <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
            <i class="fa  fa-arrow-left"></i> Return
        </button>
    </div>
<div>



  </div>
</div>

<script src="<?= $patch ?>global/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $patch ?>global/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


<script>
   $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>items';
    });

    $(".radio").click(function(e){
        $.post("<?= $patch; ?>items/rating/type",{type:$(this).attr("data-value"),id:$(this).val()},function(data){
            
        })
    })
    

    $(".minimal").click(function(){
        $.post("<?= $patch; ?>items/rating/save",{id:$(this).val()},function(data){
            
        })
    })

</script>
