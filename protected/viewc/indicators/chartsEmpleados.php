<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3> <?= number_format($data["counttanquelavados"]/$data["countEntrysByMonth"]*100,2) ?> =  <?= $data["counttanquelavados"] ?>/<?= $data["countEntrysByMonth"]  ?>
              <sup style="font-size: 20px">Tanques lavados</sup>
            </h3>        
            <p>Porcentaje de tanques lavados</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/TanquesPorEmpleado/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>