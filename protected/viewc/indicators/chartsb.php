
 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= number_format($data["tiempoEnAtenderICalidad"],2)  ?><sup style="font-size: 20px">horas</sup></h3>
              <p>T. Promedio de lavado a Ispección</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/timetoquiality/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>



<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= number_format($data["tiempoParaPrueba"],2)  ?><sup style="font-size: 20px">horas</sup></h3>
              <p>T. Promedio para prueba de aire</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/timesToAirTest/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>


<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= number_format($data["tiempoEnPrueba"],2)  ?><sup style="font-size: 20px">horas</sup></h3>
              <p>T. Promedio en prueba de aire</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/timesInTest/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>

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

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3> <?= number_format($data["counttanqueRelavados"]/$data["counttanquelavados"]*100,2) ?> =  <?= $data["counttanqueRelavados"] ?>/<?= $data["counttanquelavados"]  ?>
              <sup style="font-size: 20px">Tanques re-lavados</sup>
            </h3>        
            <p>Porcentaje de tanques re-lavados</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/RelavadoTanquesPorEmpleado/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["totalFacturado"] ?><sup style="font-size: 20px">/USD</sup></h3>
              <p>Total valor facturado en dólares hasta hoy.</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/totalFacturado/<?=$data["initYear"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["totalrp"] ?><sup style="font-size: 20px">/USD</sup></h3>
              <p>Total valor facturado en reparaciones Dolares.</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/totalFacturado/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>







