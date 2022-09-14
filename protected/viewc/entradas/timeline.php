<?php $all = $data["authoEntry"]; ?>
<?php $allstatus = $data["status"]; ?>
<ul class="timeline">

    <!-- timeline time label -->
    <li class="time-label">
        <span class="bg-red">
           Creación de la autorización de ingreso.
        </span>
    </li>
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-external-link bg-blue"></i>
        <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i>   <?= $all["create_ai"]== null ? "No se proporcionó información" :$all["create_ai"]  ?></span>

            <h3 class="timeline-header">Detalles de la autorización</h3>

            <div class="timeline-body">
                El día <?= $all["create_ai"] ?> se creó la autorización de ingreso para el tanque <?= $all["serial"] ?>, perteneciente al cliente <?= $all["nombre_cliente"] ?>, La fecha estimada de llegada <?= $all["fecha_estimada"] ?>
                <hr>
                <h4>Información de tanque</h4>
                    <p><b>Fecha de fabricación: </b><?= $all["make_date"]==null ? "Fecha no ingresada": $all["make_date"] ?></p>
                    <p><b>Test 2.5:</b> <?= $all["test30"] ?></p>
                    <p><b>Test 5:</b> <?= $all["test60"] ?></p>
                    <p><b>Last Cargo:</b> <?= $all["last_cargo"] ?></p>
                    <p><b>Tipo:</b> <?= $all["type"] =="" ? "Información no provista ": $all["type"] ?></p>
                   
            <hr>
                <h4>Datos de envío</h4>
                <p><b>Empresa Transportadora:</b> <?= $all["transportista"]=="" ? "Información no provista ": $all["transportista"] ?></p>
                <p><b>Placa de vehículo: </b><?= $all["placa"] =="" ? "Información no provista ": $all["placa"] ?></p>
                <p><b>Conductor: </b><?= $all["conductor"] =="" ? "Información no provista ": $all["conductor"] ?></p>
            </div>

            <div class="timeline-footer">
            
            </div>
        </div>
    </li>
    <!-- END timeline item -->
    <li class="time-label">
        <span class="bg-red">
            Llegada del isotanque.
        </span>
    </li>

    <li>
        <i class="fa fa-external-link bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> <?= $all["arrival"]== null ? "No se proporcionó información" :$all["arrival"]  ?> </span>
            <h3 class="timeline-header">Detalles de la llegada</h3>
            <div class="timeline-body">
                El tanque llegó a ecolavados el día <?= $all["fecha_entrada"] ?>, la hora de llegada a portería es <?= $all["arrival"]== null ? "(No se proporcionó información)" :$all["arrival"]  ?>, el estado en el cuál este llego fue <?= $allstatus ?>
                <hr>
                <h4>Daños</h4>
                <?php if($data["damages"]){ ?>
                    <div class="panel-group" id="accordion">
                        <?php foreach($data["damages"] as $damage){ ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#<?= $damage["id"]  ?>"><?= $damage["damage"]  ?></a>
                                    </h4>
                                </div>
                                <div id="<?= $damage["id"]  ?>" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <div class='col-md-6'>
                                            <img src="<?= $data["rootUrl"] ?>img_causes_logs/<?= $damage["img"]  ?>" alt="<?= $damage["img"]  ?>" class="img-thumbnail">
                                        </div>
                                        
                                   
                                    </div>
                                </div>
                            </div>
                           
                        <?php } ?>
                    </div>
                <?php }else{ ?>
                    <p>No se registron daños para este tanque </p>
                <?php } ?>
                <hr>
                <h4>Evidencias</h4>
                <?php if($data["evidencias"]){ ?>
                    <div class="panel-group" id="accordion2">
                        <?php foreach($data["evidencias"] as $evidencia){ ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion2" href="#<?= $evidencia["id"]  ?>"><?= $evidencia["damage"]  ?></a>
                                    </h4>
                                </div>
                                <div id="<?= $evidencia["id"]  ?>" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <div class='col-md-6'>
                                            <img src="<?= $data["rootUrl"] ?>img_causes_logs/<?= $evidencia["img"]  ?>" alt="<?= $evidencia["img"]  ?>" class="img-thumbnail">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                           
                        <?php } ?>
                    </div>
                <?php }else{ ?>
                    <p>No se registron daños para este tanque </p>
                <?php } ?>
                <h4>I.E.R</h4>
                <a target="_blank"href="<?php echo $data["rootUrl"] ?>entrys/print/<?php echo $all["id"] ?>" id="btn-print" class="btn btn-default btn-md">
                    <i class="fa fa-print "></i><br><span class="hidden-xs">I.E.R.</span>
                </a>
            </div>
            <div class="timeline-footer">
            </div>
        </div>
    </li>

      <!-- END timeline item -->
      <li class="time-label">
        <span class="bg-red">
            Request.
        </span>
    </li>

    <li>
    <i class="fa fa-external-link bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i>Request</span>
            <h3 class="timeline-header">Approved Request</h3>
            <div class="timeline-body">
                <table class='table table-bordered'>
                    <tr>
                        <th>ID</th>
                        <th>Serial</th>
                        <th>Description</th>
                        <th>View</th>
                    </tr>                            
                    <?php foreach($data["request"] as $r){ ?>
                        <tr>
                            <td><?= $r["id"] ?></td>
                            <td><?= $r["serial"] ?></td>
                            <td><?= $r["descripcion"] ?></td>
                            <td><a  target='_blank' href='<?= $patch ?>request/print/<?= $r["id"] ?>'> <i class="fa fa-external-link "></i></a> </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </li>

 <!-- END timeline item -->
 <li class="time-label">
        <span class="bg-red">
        Seals and Certificate.
        </span>
    </li>

    <li>
    <i class="fa fa-external-link bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i>Certificates</span>
            <h3 class="timeline-header">Certificates</h3>
            <div class="timeline-body">
                <a target="_blank"href="<?php echo $data["rootUrl"] ?>entrys/print/seals/<?php echo $all["id"] ?>" id="btn-print" class="btn btn-default btn-md">
                    <i class="fa fa-print "></i><br><span class="hidden-xs">Seals</span>
                </a>
                <a target="_blank"href="<?php echo $data["rootUrl"] ?>entrys/print/clean/<?php echo $all["id"] ?>" id="btn-print" class="btn btn-default btn-md">
                    <i class="fa fa-print "></i><br><span class="hidden-xs">Clean Certificate.</span>
                </a>
                <?php if($data["schedule"]){ ?>
                    <a target="_blank"href="<?php echo $data["rootUrl"] ?>entrys/schedule/print/<?php echo $data["schedule"]["id"] ?>" id="btn-print" class="btn btn-default btn-md">
                        <i class="fa fa-print "></i><br><span class="hidden-xs">Quality inspection.</span>
                    </a>
                   <?php } ?>
            </div>
        </div>
    </li>




    
</ul>