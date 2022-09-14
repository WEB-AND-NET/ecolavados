<div class="row">
<?php foreach($data["evidence"]  as $evidences){ ?>

  <div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
      <img src="<?= $data["rootUrl"] ?>img_evidences/<?= $evidences["image"] ?>" alt="...">
    </a>
  </div><?php } ?>
</div>
