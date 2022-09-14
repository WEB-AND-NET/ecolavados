<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Request status

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">LIST REQUEST</li>
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
                            <a href="<?= $patch; ?>request/add" id="btn-add" class=" btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >New</span></a>  
                            <a href="<?= $patch; ?>request/edit" id="btn-edit" class="action btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span class='hidden-xs' >Edit</span></a> 
                            <a href="<?= $patch; ?>request/change" id="btn-change" class="action btn btn-default btn-md"><i class="fa fa-random"></i><br/><span class='hidden-xs' >Change</span></a> 
                           
                            <a  href="<?= $patch; ?>request/enviar" id="btn-edit" class="action btn btn-default btn-md"><i class="fa  fa-envelope"></i><br/><span class='hidden-xs' >Send</span></a>  
                            <a href="<?= $patch; ?>mrequest/approve/request" id="action btn-add" class="action btn btn-default btn-md"><i class="fa fa-check"></i><br/><span class='hidden-xs' >Approve</span></a>  
                            <a href="<?//= $patch; ?>mrequest/not/request" id="btn-edit" class="action btn btn-default btn-md"><i class="fa fa-times"></i><br/><span class='hidden-xs' >Disapprove</span></a>   
                            <a  href="<?= $patch; ?>request/print" id="btn-edit" class="print btn btn-default btn-md"><i class="fa fa-clipboard"></i><br/><span class='hidden-xs' >Print</span></a>                         
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th># Request</th>
                                <th># Entry</th>
                                <th>Serial Tank</th>
                                <th> Client</th>
                                <th> Request Description</th>
                                <th> State</th>
                            </tr>
                        </thead>
                        <tbody>
                           <!-- <?php
                            foreach ($data["request"] as $r) {
                                ?>
                                <tr>
                                    <td><input class="minimal" name="item" type="radio" value="<?= $r["id"]; ?>" /></td>
                                    <td><?= $r["id"]; ?> </td>
                                    <td ><?= $r["entrada"]; ?></td>
                                    <td ><?= $r["serial"]; ?></td>
                                    <td ><?= $r["nombre"]; ?></td>
                                    <td><?= $r["descripcion"]; ?> </td>
                                    <td><?php 
                                    if($r["state"]=="P" ){
                                        echo '<span class="label label-warning">Waiting for approval</span>';
                                    }else if($r["state"]=="A" ){
                                        echo '<span class="label label-success">Approved</span>';
                                    }else{
                                        echo '<span class="label label-danger">Not Approved</span>';
                                    }

                                    ?> </td>
                                </tr>
                            <?php } ?> -->
                        </tbody>
                        <tfoot>
                            <tr>
                    
                           <th>&nbsp;</th>
                                <th># Request</th>
                                <th># Entry</th>
                                <th>Serial Tank</th>
                                <th> Client</th>
                                <th> Request Description</th>
                                <th> State</th>
                              
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
<script type="text/javascript">

    $('.action').click(function (e) {
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

    $('.print').click(function (e) {
        e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
            
        }
        else {
            var opens = $(this).attr("href") 
            var action = opens + "/" + item;
            window.open(action);
         //   $(this).attr("href", action);
        }
    });

    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    /*$(function () {
        $("#tabledatas").DataTable({
            rowReorder: {
            selector: 'td:nth-child(1)'
        },
        responsive: true
        });
    });*/

    $(document).ready(function() {
            var url = "<?= $patch ?>request/getrequestall";
            $('#tabledatas').DataTable( {
                "ajax": {
                    url:url,
                    dataSrc:""
                },                
                responsive: true,
                columns: [
                    {   
                        data:"id",
                        render: function(data, type, row){
                            return "<input class='minimal' name='item'  value='"+data+"' type='radio'>";
                        }},
                    {data:"id"},
                    {data:"entrada"},
                    {data:"serial"},
                    {data:"nombre"},
                    {data:"descripcion"},
                    {   
                        data:"state",
                        render: function(data,type,row){
                            var clase = "";
                            var texto = "";
                            if(data == "P"){
                                clase = "label-warning";
                                texto = "Waiting for approval"
                            }else if(data == "A"){
                                clase = "label-success";
                                texto = "Approved";
                            }else{
                                clase = "label-danger";
                                texto = "Not Approved";
                            }
                            return "<span class='label "+clase+" '>"+texto+"</span>";
                        }
                    }
                ]
            } );
        } );


    


</script>