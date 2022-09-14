<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<section class="content-header">
    <h1>
    <?= $data["entrada"]["id"]."-".$data["entrada"]["serial"] ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>items">Entry - Request</a></li>
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
            <?php foreach($data["list"] as $listitem){ ?>
                <table class='table table-responsive'>
                <caption><?= $listitem["califica"] ?></caption>
                    <thead>
                        <tr>
                        
                            <th>Request Number</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    <?php   if(isset($listitem["sub_item"])){
                                foreach($listitem["sub_item"] as $listitem){ ?>
                                        <tr>
                                            <td> <?= $listitem["id"] ?></td>
                                            <td>  <?= $listitem["precio"] ?></td>
                                            <td> <?php 
                                                if($listitem["state"]=="P" ){
                                                    echo '<span class="label label-warning">Waiting for approval</span>';
                                                }else if($listitem["state"]=="A" ){
                                                    echo '<span class="label label-success">Approved</span>';
                                                }else{
                                                    echo '<span class="label label-danger">Not Approved</span>';
                                                }
                                            ?></td>
                                        </tr>
                        <?php   } ?>
                    <?php  }else{  ?>
                                <tr>
                                    <td style='background: rgba(250, 77, 77, 0.3)'> No request send for this damages</td>
                                </tr>
                    <?php   } ?>
                  
                    </tbody>
                </table>
                <?php } ?>

        
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
        window.location = '<?= $patch; ?>entrys';
    });
</script>
