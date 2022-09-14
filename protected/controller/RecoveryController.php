<?php 

class RecoveryController extends DooController {
    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
          
        }
    }


    public function index(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;      
        $initialdate='2019';
        $actualdate=date("o");
        $years=array();
        foreach(range($initialdate,$actualdate,1) as $numero){
            $years[]=$numero;
        }
        $this->data['years']= $years;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'recovery/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function allSalidas($initialdate,$finaldate){
        return  Doo::db()->query("SELECT e.fecha,s.fecha_salida,e.id id_entrada,c.nombre, s.id,e.id as entrada,ai.id as autorizacion,placa_salida,nombre_conductor_salida,e.fecha as fecha_ingreso, s.fecha_salida, s.observacion,t.serial
        from salida s
        INNER join tanques t on (t.id=s.id_tanque) 
        INNER join entrada e on (e.id=s.id_entrada)
        INNER join autorizacion_ingreso ai on (ai.id=s.id_autorizacion)
        INNER JOIN clientes  c on (c.id=ai.clientes_id) where s.fecha_salida between '$initialdate' and '$finaldate' ")->fetchAll();
    }

    public function salidas(){
        $year =  $_POST["year"];
        $month = $_POST["month"];
        $initialdate = $year."-". $month."-01";
        $finaldate = $year."-". $month."-31";
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['salidas'] = $this->allSalidas($initialdate,$finaldate);
        $this->renderc('recovery/items', $this->data, true);
    }
    
       
    public function damages($id){//imagenes de la IER
        return Doo::db()->query("SELECT ie.id,img,valor,concat(i.descripcion,'-',ie.valor) as damage FROM entrada e
        INNER JOIN items_entrada ie on(ie.id_entrada=e.id)
        INNER JOIN items i ON (i.id = ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        inner JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'B' AND ca.causes_log='S')
        where  e.id='$id'")->fetchAll();
    }

    public function evidencias($id){
        return Doo::db()->query("SELECT ie.id,img,valor,concat(i.descripcion,'-',ie.valor) as damage FROM entrada e
        INNER JOIN items_entrada ie on(ie.id_entrada=e.id)
        INNER JOIN items i ON (i.id = ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        inner JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'G' AND ca.causes_log='S')
        where  e.id='$id'")->fetchAll();
    }

    public function Allrequest($id){
        return Doo::db()->query("SELECT e.id as entrada,r.id,r.descripcion,r.state,c.nombre,t.serial
        FROM request r
        INNER JOIN entrada e  on (e.id=r.id_entrada) 
        inner join autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        inner join tanques t on (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=r.cliente_id)
        WHERE r.deleted='1' and e.id='$id' and r.state='A'")->fetchAll();
    }

    public function seals($id){
        return Doo::db()->query("SELECT id, entry, image, observation  FROM entry_seals WHERE entry='$id'")->fetchAll();
    }

    public function calidad($id){
        return Doo::db()->query("SELECT id,imagen as image  from calidad_evidence where id_entrada='$id'")->fetchAll();
    }

    

    public function details(){
        $id = $_POST["id"];
        $damages = $this->damages($id);
        $evidencias = $this->evidencias($id);
        $request = $this->Allrequest($id);        
        $imagenes= $this->seals($id);
        $this->data["calidad"]= $this->calidad($id);
        $this->data['id'] = $id;
        $this->data['seals'] = $imagenes;
        $this->data['request'] = $request;
        $this->data['evidencias'] = $evidencias;
        $this->data['damages'] = $damages;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('recovery/details', $this->data, true);
    }

    public function deleteall(){
        $year =  $_POST["year"];
        $month = $_POST["month"];
        $initialdate = $year."-". $month."-01";
        $finaldate = $year."-". $month."-31";      
        $allSalidas = $this->allSalidas($initialdate,$finaldate);
        $space=0;
        foreach($allSalidas as $salidas){
            $damages = $this->damages($salidas["id_entrada"]);
            foreach($damages as $damage){
                if($damage["img"]!=""){
                    if(file_exists("img_causes_logs/".$damage["img"])){
                        unlink("img_causes_logs/".$damage['img']);
                        $space = file_exists('img_causes_logs/'.$damage["img"]);
                    }
                }
            }

            $evidencias = $this->evidencias($salidas["id_entrada"]);
            foreach($evidencias as $damage){
                if($damage["img"]!=""){
                    if(file_exists("img_causes_logs/".$damage["img"])){
                        unlink("img_causes_logs/".$damage['img']);
                        $space = file_exists('img_causes_logs/'.$damage["img"]);
                    }
                }
                
                
            }


            $calidad = $this->calidad($salidas["id_entrada"]);
            foreach($calidad as $damage){
                if($damage["image"]!=""){
                    if(file_exists("img_quality/".$damage["image"])){
                        unlink("img_quality/".$damage['image']);
                        $space = file_exists("img_quality/".$damage['image']);
                    }   
                }
                
            }

            $seals= $this->seals($salidas["id_entrada"]);
            foreach($seals as $damage){
                if($damage["image"]!=""){
                   if(file_exists("img_seals/".$damage["image"])){
                        unlink("img_seals/".$damage['image']);
                        $space = file_exists("img_seals/".$damage['image']);
                    } 
                }
                
            }
        }
        echo $this->formatSizeUnits($space);
    }

    function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }


}

?>