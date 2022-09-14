<?php if(file_exists("global/docs/ier/ier_".$data['id'].".pdf")==true){ ?>
        <a target="_blank"href="<?php echo $data["rootUrl"] ?>entrys/print/seals/<?php echo $data['id'] ?>" id="btn-print" class="btn btn-default btn-md">
          <i class="fa fa-print "></i><br><span class="hidden-xs"> <?= $data['id'].".pdf" ?></span>
        </a> 
    <?php }else{ ?>
        <?= "El pdf ier_". $data['id'].".pdf Ya se encuentra eliminado" ?>
    <?php  } ?>
    <h4>Daños</h4>
    <?php if($data["damages"]){ ?>
        <div class="panel-group" id="accordion">
            <?php foreach($data["damages"] as $damage){ ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#<?= $damage["id"]  ?>"><?= $damage["damage"]  ?> /<?= file_exists('img_causes_logs/'.$damage["img"])==true ? 'Espacio en disco: '.number_format(filesize ( 'img_causes_logs/'.$damage["img"] )  / 1048576, 2) . ' MB' : 'Archivo Eliminado/No existe' ?></a>
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

    <h4>Evidencias</h4>
    <?php if($data["evidencias"]){ ?>
        <div class="panel-group" id="accordion">
            <?php foreach($data["evidencias"] as $damage){ ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#<?= $damage["id"]  ?>"><?= $damage["damage"]  ?> / <?= file_exists('img_causes_logs/'.$damage["img"])==true ? 'Espacio en disco: '.number_format(filesize ( 'img_causes_logs/'.$damage["img"] )  / 1048576, 2) . ' MB' : 'Archivo Eliminado/No existe' ?> </a>
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
        <p>No se registron evidencias para este tanque </p>
    <?php } ?>
    
    <h4>Sellos</h4>
    <?php if($data["seals"]){ ?>
        <div class="panel-group" id="accordion">
            <?php foreach($data["seals"] as $damage){  ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#<?= $damage["id"]  ?>"><?= file_exists('img_seals/'.$damage["image"])==true ? $damage["image"].'/Espacio en disco: '.number_format(filesize ( 'img_seals/'.$damage["image"] )  / 1048576, 2) . ' MB' : 'Archivo Eliminado/No existe' ?></a>
                        </h4>
                    </div>
                    <div id="<?= $damage["id"]  ?>" class="panel-collapse collapse ">
                        <div class="panel-body">
                            <div class='col-md-6'>
                                <img src="<?= $data["rootUrl"] ?>img_seals/<?= $damage["image"]  ?>" alt="<?= $damage["image"]  ?>" class="img-thumbnail">
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
                
            <?php } ?>
        </div>
    <?php }else{ ?>
        <p>No se registron sellos para este tanque </p>
    <?php } ?>
    
    <h4>Calidad</h4>
    <?php if($data["seals"]){ ?>
        <div class="panel-group" id="accordion">
            <?php foreach($data["calidad"] as $damage){  ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#<?= $damage["id"]  ?>"><?= file_exists('img_seals/'.$damage["image"])==true ? $damage["image"].'/Espacio en disco: '.number_format(filesize ( 'img_seals/'.$damage["image"] )  / 1048576, 2) . ' MB' : 'Archivo Eliminado/No existe' ?></a>
                        </h4>
                    </div>
                    <div id="<?= $damage["id"]  ?>" class="panel-collapse collapse ">
                        <div class="panel-body">
                            <div class='col-md-6'>
                                <img src="<?= $data["rootUrl"] ?>img_quality/<?= $damage["image"]  ?>" alt="<?= $damage["image"]  ?>" class="img-thumbnail">
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
                
            <?php } ?>
        </div>
    <?php }else{ ?>
        <p>No se registron sellos para este tanque </p>
    <?php } ?>


    

<!-- END timeline item -->
<hr>
    <h4>Request</h4>   
    <div class="timeline-item">
        <h3 class="timeline-header">Approved Request</h3>
        <div class="timeline-body">
            <table class='table table-bordered'>
                <tr>
                <th>ID</th>
                    <th>ID</th>
                    <th>Serial</th>
                    <th>Description</th>
                    <th>View</th>
                </tr>                            
                <?php foreach($data["request"] as $r){ ?>
                    <tr>
                        <td><?= $r["entrada"] ?></td>
                        <td><?= $r["id"] ?></td>
                        <td><?= $r["serial"] ?></td>
                        <td><?= $r["descripcion"] ?></td>
                        <td><a  target='_blank' href='<?= $data["rootUrl"] ?>request/print/<?= $r["id"] ?>'> <i class="fa fa-external-link "></i></a> </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>


   