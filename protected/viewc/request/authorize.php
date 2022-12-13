<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="<?= $data["rootUrl"] ?>global/admin/css/bootstrap.min.css"/>
    <link
      rel="stylesheet"
      href="<?= $data["rootUrl"] ?>global/css/request/authorize.css"
    />
    <link rel="stylesheet" href="<?= $data["rootUrl"] ?>global/admin/font-awesome/css/font-awesome.min.css"/>
  </head>
  <body>
    <div class="container">
      <section class="content-header">
        <h1 class="title">TANK EQUIPMENT INTERCHANGE TEST / REPAIRESTIMATE</h1>
        <div class="col-md-1">Client: </div>
        <div class="col-md-11 "><?= $data["request"]["nombre"] ?></div>
        <div class="col-md-1">Serial: </div>
        <div class="col-md-11"><?= $data["request"]["serial"] ?></div>        
        <div class="col-md-1">Date: </div>
        <div class="col-md-11"><?= $data["request"]["expedicion"] ?></div>
        <div class="col-md-1">In Date</div>
        <div class="col-md-11"><?= $data["request"]["fecha"] ?></div>
        <div class="col-md-1">Type</div>
        <div class="col-md-11"><?= $data["request"]["type"] ?></div>
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
        <div class="col-md-12">
        <table id='databables' class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Area</th>
                            <th>Item Area</th>
                            <th>Damage Code</th>
                            <th>REP Code</th>
                            <th>Remarks</th>
                            <th>Hours</th>
                            <th>Material</th>
                            <th>Total</th>
                            <th>authorize</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $totalMaterial = 0;
                        $totalHours = 0;
                     ?> 
                        <?php 
                            foreach ($data["items"] as $r) { 
                            $totalHours = $totalHours + $r["hours"];
                            $totalMaterial = $totalMaterial + $r["material"];

                        ?> 
                            <tr>
                               <td><?= $r["area_name"] ?></td>
                               <td><?= $r["area_item_name"] ?></td>
                               <td><?= $r["damage_code"] ?></td>
                               <td><?= $r["services_code"] ?></td>
                               <td><?= $r["remarks"] ?></td>
                               <td><?= $r["hours"] ?></td>
                               <td><?= $r["material"] ?></td>
                               <td><?= $r["total"] ?></td>
                               <td>
                                                                   
                                </td> 
                            </tr>
                            
                        <?php } ?>
                        <tr>
                            <td colspan="4"></td>
                            <td>Material Total</td>
                            <td></td>
                            <td></td>
                            <td><?= $totalMaterial ?></td>
                            <td rowspan='4'>
                                <button class='btn btn-success btn-block'>Authorize</button><br>
                                <button class='btn btn-warning btn-block'>Change Request</button><br>
                                <button class='btn btn-danger btn-block'>Decline</button> 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td>Total Labour</td>
                            <td><?= $totalHours ?></td>
                            <td></td>
                            <td><?= $totalHours * $data["request"]["labour_rate"]  ?></td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td>Labour Rate</td>
                            <td><?= $data["request"]["labour_rate"] ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td>Total costs</td>
                            <td></td>
                            <td></td>
                            <td><?= ($totalHours * $data["request"]["labour_rate"]) + $totalMaterial ?></td>
                        </tr>
                    </tbody>
                </table>
        </div>
      </section>
    </div>
  </body>
</html>
