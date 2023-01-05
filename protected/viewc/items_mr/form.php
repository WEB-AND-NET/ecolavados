<link href="<?= $patch ?>global/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php $itemsGuide = $data["items"];  ?>


<section class="content-header">
    <h1>
        <?= ($itemsGuide->id == "" ? 'Register Guide Line' : 'Update Guide Line'); ?> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Home</a></li>
        <li><a href="<?= $patch ?>items/mr">Items Guide line</a></li>
        <li class="active"> <?= ($itemsGuide->id == "" ? 'Register Guide Line' : 'Update Guide Line'); ?> </li>
    </ol>
</section>
<br/>
<div class="box ">
    <form id="form1" class="form" action="<?= $patch; ?>items/mr/save" method="post" name="form1">
        <div class="box-body">
            <fieldset style="width:97%;">
                <legend>General information</legend>                       

                <div class="col-lg-4">
                    <label id="l_guideline">Guide Line*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $itemsGuide->guideline; ?>" id="guideline" name="guideline">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_code">Code*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?= $itemsGuide->code; ?>" id="code" name="code">
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_damage">Damage*</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-text-width"></i>
                        </div>
                        <select class="form-control select2"  id="damage" name="damage">
                            <?php foreach($data["damages"] as $damage){ ?>
                                <option  <?php echo  $damage->id==$itemsGuide->id ? 'selected' : '' ?> value='<?echo $damage->id ?>'> <?echo $damage->damage ?> </option>
                            <?php } ?>
                        </select>
                    </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label id="l_tipo">Servies*</label>
                    <div class="input-group margin-bottom-20">
                        <span data-toggle="modal" data-target="#myModal" class="input-group-addon">
                            <i  class="fa fa-plus"></i>
                        </span>
                        <select multiple class='form-control blocks' name="services[]" id="services">
                        </select>
                    </div><!-- /.input group -->
                </div>
                
                <div class="box-footer col-md-4 pull-right">
                    <button type="button" id="btn-cancel" class="btn bg-grey btn-default">
                        <i class="fa  fa-arrow-left"></i> Cancel
                    </button>
                    <button type="button" id="btn-save" class="btn  bg-green pull-right">
                        <i class="fa fa-save "></i> Save
                    </button>
                    <input name="id" type="hidden" id="id" value="<?= $itemsGuide->id; ?>" />
                    <input name="deleted" type="hidden" id="deleted" value="<?= $itemsGuide->deleted == null ? 1 : $itemsGuide->deleted; ?>" />
                </div>
            </fieldset>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= $patch; ?>global/js/form.js"></script>
<script>

    $(document).ready(function(){;
        if($("#id").val()){
            $.post("<?= $data["rootUrl"] ?>items/mr/getGuidelineItems",{id:$("#id").val()},function(data){                
                data.forEach(function(item){
                    var option = new Option(item.mr,item.id, true, true);
                    $("#services").append(option).trigger('change');
                })
            },'Json')
        }
    })

    $('#services').select2({        
        ajax:{
            url:'<?php echo $data["rootUrl"] ?>items/mr/getService',
            dataType: 'json',
            data:function(params){
                var query={
                    search:params.term,
                }
                return  query;
            },
            processResults:function(data){
                if(data){
                    return{
                        results: $.map(data.item,function(item){

                            return{
                                text:item.mr,
                                id:item.id,
                            }
                        })
                    }
                }else{
                    return{
                        results:null
                    }
                }
            }
        },tags: true
    });
    function validateForm() {
        var sErrMsg = "";
        var flag = true;
        sErrMsg += validateText($('#code').val(), $('#l_code').html(), true);
        sErrMsg += validateText($('#guideline').val(), $('#l_guideline').html(), true);
        //sErrMsg += validateEmail($('#email').val(), $('#l_email').html(), true);
        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }
        return flag;
    }  

    $("#btn-save").click(function(){
        if(validateForm()){
            $("#form1").submit();
        }
    })
    
    $('#btn-cancel').click(function () {
        window.location = '<?= $patch; ?>items/mr';
    });
</script>
