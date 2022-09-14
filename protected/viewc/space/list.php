<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
    LIST CERTIFICATES OF CONFINED SPACES
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">HOME</a></li>
        <li class="active">LIST CERTIFICATES OF CONFINED SPACES</li>
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
                            <a href="<?= $patch; ?>spaces/add" id="btn-add" class=" btn btn-default btn-md"><i class="fa fa-plus-circle"></i><br/><span class='hidden-xs' >New</span></a>  
                            <a href="<?= $patch; ?>spaces/print" id="btn-print" class="btn btn-default btn-md"><i class="fa fa-print "></i><br/><span class='hidden-xs' >Print</span></a> 
                            <a href="<?= $patch; ?>spaces/delete" id="btn-delete" class="btn btn-default btn-md"><i class="fa fa-minus-circle"></i><br/><span class='hidden-xs' >Desactive</span></a>
                        </div><!-- /.btn-group -->
                    </div>
                    <div class="clearfix"></div>
                    <table id="tabledatas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>#</th>
                                <th>status</th>
                                <th>Authorized by</th>
                                <th>Operator</th>
                                <th>Work</th>
                                <th>Initial date</th>
                                <th>Final Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>#</th>
                                <th>status</th>
                                <th>Authorized by</th>
                                <th>Operator</th>
                                <th>Work</th>
                                <th>Initial date</th>
                                <th>Final Date</th>
                                
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
    var url = "<?= $patch ?>spaces/getAllSpace";
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
            {data:"consecutivo"},
            {   
                data:"status",
                render: function(data,type,row){
                    var label="";
                    var text="";
                    if(data=='N'){
                            label="label-danger";
                            text="Rejected";
                        }else if(data=='S'){
                            label="label-success";
                            text="Valid";
                        }else if(data=='A'){
                            label="label-success";
                            text="Assigned";
                        }else{
                            label="label-warning";
                            text="defeated";
                        }
                    return "<span class='label "+label+" '>"+text+"</span>";
                }
            },
            {data:"autoriza"},
            {data:"operador"},
            {data:"trabajo"},
            {data:"hora_inicio"},
            {data:"hora_final"},
        
        ]
    } );
                   
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
    $('#btn-print').click(function (e) {
        e.preventDefault();
        item = $('input[name=item]:checked').attr('value');
        if (!item) {
            alert('Debe seleccionar un item');
           
        }
        else {
            var action = $(this).attr("href");
            window.open(action + "/" + item);
        }
    });

    $('#btn-delete').click(function (e) {

            e.preventDefault();
            item = $('input[name=item]:checked').attr('value');
            if (!item) {
                alert('Debe seleccionar un item');            
            }
            else {
               $.post("<?= $patch ?>spaces/delete",{id:item},(data)=>{
                          
               })
               table.ajax.reload()    
            }
        });
    $(document).ready(function () {
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-purple',
            radioClass: 'iradio_minimal-green'
        });
    });

    

    
    ////
    


</script>