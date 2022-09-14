
 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["avgTiempoDescarga"] ?><sup style="font-size: 20px">Minutos</sup></h3>
              <p>Tiempo atención/Descarga</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/detailsTime/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>


<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["countEntrysByMonth"] ?><sup style="font-size: 20px">/Tanques</sup></h3>
              <p>N. de isotanques que ingresan por mes </p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/allEntrys/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>



<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["countDeparturesByMonth"] ?><sup style="font-size: 20px">/Tanques</sup></h3>
              <p> Salidas de isotanques por mes </p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/departures/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["avgTiempoLavado"] ?><sup style="font-size: 20px">/Horas</sup></h3>
              <p>Tiempo en atención lavado </p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/timeClean/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["promAptencionServicios"] ?><sup style="font-size: 20px">/Minutos</sup></h3>
              <p>Promedio de duración de los servicios </p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/promedioAtencionService/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>


<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["totalInvocedd"] ?><sup style="font-size: 20px">/USD</sup></h3>
              <p>Total valor facturado en dólares</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/totalFacturado/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?= $data["totalInvocedp"] ?><sup style="font-size: 20px">/COP</sup></h3>
              <p>Total valor facturado en pesos</p>
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/totalFacturado/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><p>Total valor facturado hasta el día de hoy</p></h3>
              
            </div>
            <a target='_blank' href="<?= $data["rootUrl"] ?>indicators/currenInvoiced/<?=$data["initialdate"] ?>/<?= $data["finaldate"] ?>" class="small-box-footer">
              view details <i class="fa fa-arrow-circle-right"></i>
            </a>
    </div>
</div>



<div class="clearfix"></div>
<div class="col-lg-3 col-xs-6">
  <canvas id="myChart" width="400" height="400"></canvas>
</div>
<div class="col-lg-3 col-xs-6">
  <canvas id="myMonth" width="400" height="400"></canvas>
</div>

<div class="col-lg-3 col-xs-6">
  <canvas id="invocedMonth" width="400" height="400"></canvas>
</div>


<script src="<?= $data["rootUrl"] ?>global/js/charts.js"></script>
<script>
$(document).ready(function(){
  
  var ctx = $('#myChart');
  var ctMonth = $('#myMonth');
  var invocedMonth = $('#invocedMonth');

/**Factured by monyh 
$.post("<?//= $data["rootUrl"] ?>indicators/invoicedByYear",{year:"<?//=$data["initialdate"] ?>"},function(data){
    var labeles = [];
    var datales= []
    data.map((indicator)=>{
      labeles.push(indicator.mes)
      datales.push(indicator.total)
    })
    chartRender('Invoiced by month of year',datales,labeles,invocedMonth);
  },'Json')*/

/** Entrys by year */
  $.post("<?= $data["rootUrl"] ?>indicators/entrysByYear",{year:"<?=$data["initialdate"] ?>"},function(data){
    var labeles = [];
    var datales= []
    data.map((indicator)=>{
      labeles.push(indicator.mes)
      datales.push(indicator.cantidad)
    })
    chartRender('Entrys by month',datales,labeles,ctx);
  },'Json')

  /**Entradas y sus respectivos estados*/
  $.post("<?= $data["rootUrl"] ?>indicators/numberStateByMonth",{year:"<?=$data["initialdate"] ?>"},function(data){
    var labeles = [];
    var datales= []
    data.map((indicator)=>{
      labeles.push(indicator.status_name)
      datales.push(indicator.cantidad)
    })
    chartRender('Status of entrys',datales ,labeles,ctMonth)
  },'Json')

  function chartRender(title,dataa,labels,instance){
    var myChart = new Chart(instance, {
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
              label: title,
              data: dataa,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
  }






})
</script>

