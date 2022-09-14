<div class="col-md-4">
    <div class="list-group">
        <?php foreach($data["salidas"] as $da){?>
            <a  href="#" data-id='<?= $da['id_entrada'] ?>' class="list-group-item item"><?= $da["serial"] ?></a>   
            <a class='float-right'>Eliminar</a>
        <?php  } ?>
    </div>
</div>
<div class="col-md-6 details">

</div>
<script>
    $(".item").click(function(e){
        var id = $(this).attr("data-id");
       
        $.post("<?php echo $data["rootUrl"]  ?>recovery/details",{
            id:id
        },function(e){
            $(".details").html(e)
        }) 
    })
</script>
