<script>
    $.post("<?= $data['rootUrl'] ?>downloadExcel/1012",{},function(data){
        console.log(data);
    })
</script>