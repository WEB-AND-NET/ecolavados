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
                    <?php foreach($data["works"] as $works){ ?>  
                        <th><?= $works->nombre ?> </th>
                    <?php } ?>
                    
                </thead>
                <tbody>
                <?php foreach($data["procesos"] as $proceso){ ?>
                    <tr>
                        <td>
                            <?php echo $proceso["nombre"] ?>
                        </td>
                        <?php foreach($data["works"] as $works){ ?>  
                            <td>
                                <label id='la<?= $proceso["id"] ?>'>
                                    <input work-id='<?= $works->id ?>' proccess-id='<?= $proceso["id"] ?>'  class="minimal"  type="checkbox" value="<?php echo $proceso["id"] ?>" />
                                </label>
                            </td>
                        <?php } ?>
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

    $(document).ready(function(){
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green'
        });
        $.post("<?= $patch; ?>clientes/trabajosprocesos",{},function(data){
            data.forEach(function(element){
                 $(`[work-id='${element.id_trabajo}'][proccess-id='${element.id_proceso}']`).iCheck('check');
            })                       
        },"Json")

       
       
    })
   $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>clientes';
    });
    
 

    $('.minimal').on('ifClicked', function(event){
        $.post("<?= $patch; ?>clientes/saveProcess",{"id_trabajo":$(this).attr("work-id"),"id_proceso":$(this).attr("proccess-id")},function(data){
            
        })
    })
    
    $('.minimal').on('ifUnchecked', function(event){
         $.post("<?= $patch; ?>clientes/deleteProcess",{"id_trabajo":$(this).attr("work-id"),"id_proceso":$(this).attr("proccess-id")},function(data){
                
        })
    })
   

</script>
