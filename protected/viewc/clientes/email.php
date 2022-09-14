<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>
    
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>items">Email</a></li>
        <li class="active"> <?//= ($a->id == "" ? 'Authorization Register' : 'Authorization update'); ?>Ratings </li>
    </ol>
</section>

<br>
<br/>


<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>clientes/email/save/all" method="post" name="form1">
        <div class="box-body">
        <fieldset style="width:97%;">
            <legend>General information</legend>


                <table class='table'>
             
                <tbody>
                <?php foreach($data["action"] as $action){ ?>
                    <tr>
                        <td>
                            <?php echo $action["action"] ?>
                        </td>
                         <td>
                             <input data-role="tagsinput" value='<?php echo $action["email"] ?>' name='<?php echo $action["idaec"] ?>'  data='<?php echo $action["idaec"] ?>' class='int form-control' />
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
         <button type="button" id="btn-save" class="btn bg-success btn-success">
            <i class="fa  fa-arrow-left"></i> Save
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
       
       
    })
   $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>clientes';
    });
    
    $('#btn-save').click(function () {
        $('#form1').submit();
    });
    
    
   

</script>
