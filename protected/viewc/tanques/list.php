<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        List of Tanks

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">LIST OF TANKS</li>
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
                            <a href="<?= $patch; ?>tanks/add" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >New</span></a>  
                            <a href="<?= $patch; ?>tanks/edit" id="btn-edit" class="btn btn-default btn-md"><i class="fa fa-edit"></i><br/><span class='hidden-xs' >Edit</span></a> 
                            <a href="<?= $patch; ?>tanks/delete" id="btn-delete" class="action btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span class='hidden-xs'>Delete</span></a>
                            <a href="<?= $patch; ?>tanks/test" id="btn-add" class="btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >Test</span></a>  
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>PLATE</th>
                                <th>TEST 2.5</th>
                                <th>EXPIRATION TEST 2.5</th>
                                <th>MONTH </th>
                                <th>TEST 5</th>
                                <th>EXPIRATION TEST 5</th>
                                <th>MONTH </th>
                                <th>CLIENT</th>
                            </tr>
                        </thead>
                        <tbody>    
                                             
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>&nbsp;</th>
                                <th>PLATE</th>
                                <th>TEST 2.5</th>
                                <th>EXPIRATION TEST 2.5</th>
                                <th>MONTH </th>
                                <th>TEST 5</th>
                                <th>EXPIRATION TEST 5</th>
                                <th>MONTH </th>
                                <th>CLIENT</th>
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


    $('#btn-edit').click(function (e) {
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


    $(document).ready(function () {
        var url = "<?= $patch ?>tanks/getAll";
        var table=$('#tabledatas').DataTable( {
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
                {data:"serial"},
                {data:"test30"},                    
                {data:"next30"},
                {data:"falta30"},
                {data:"test60"},
                {data:"next60"},
                {data:"falta60"},
                {data:"cliente"},
            
            ]
        });





        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    $('#btn-movements').click(function (e) {
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

   

    
    ////
    


</script>