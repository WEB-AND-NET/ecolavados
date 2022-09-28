<?php

/**
 * Description of ClientesController
 *
 * 
 */
class ScheduleController extends DooController {

    public function scheduleIndex(){
        Doo::loadClass("services/EntrysServices");
        Doo::loadModel("Programacion");
        $entrysServicios = new EntrysServicios();        
        $id=$this->params["pindex"];
        $login = $_SESSION['login'];
        $this->data["entradas"] = $entrysServicios->getEntry($id);
        $this->data["role"]=$login->role;
        $this->data["schedule"] = Doo::db()->query("select p.proceso,pe.cerrado,r.descripcion,pe.fecha_inicio as status,pe.fecha_fin as status1,if(DATE(p.fecha_inicio)>DATE(NOW()),'B','F') AS block ,r.id as request, p.fecha_inicio,p.fecha_fin,p.id,pr.nombre,concat(e.nombre,' ',e.apellido) as operario
        from programacion p 
        inner join request r on (r.id=p.request_activity)
        LEFT JOIN programacion_empleados pe on(pe.id_programacion=p.id)
        LEFT JOIN empleados e on (e.id=pe.id_empleado)
        inner join procesos pr on (pr.id=p.proceso) where  p.id_entrada='$id' ")->fetchAll();
        $s = $this->data["schedule"];
        $e = $this->data["entradas"];
        foreach($s as $sc){
            if($sc['status1'] != '' && $sc['status'] != '' ){
                $status = Doo::db()->query("SELECT id_status,id_next_status from procesos_status where id_proceso='$sc[proceso]'")->fetch();
                if($e['status'] == $status['id_status']){
                    Doo::db()->query("update entrada set status='$status[id_next_status]' where id='$id'");
                }
            }
        }       
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/listSchedule.php';
        $this->renderc('index', $this->data, true);
    }

    public function getSchedule(){
        $id=$_POST["id"];
        $schedule  = Doo::db()->query("SELECT pe.cerrado,r.descripcion,pe.fecha_inicio as status,pe.fecha_fin as status1,if(DATE(p.fecha_inicio)>DATE(NOW()),'B','F') AS block ,r.id as request, p.fecha_inicio,p.fecha_fin,p.id,pr.nombre,concat(e.nombre,' ',e.apellido) as operario
        from programacion p 
        inner join request r on (r.id=p.request_activity)
        LEFT JOIN programacion_empleados pe on(pe.id_programacion=p.id)
        LEFT JOIN empleados e on (e.id=pe.id_empleado)
        inner join procesos pr on (pr.id=p.proceso) where  p.id_entrada='$id' and pe.cerrado='N'")->fetchAll();
        
        echo json_encode($schedule);
    }

    public function addSchedule(){
        Doo::loadClass("services/EntrysServices");
        Doo::loadModel("Programacion");
        $schedule = new Programacion();
        $entrysServicios = new EntrysServicios();  
        $id=$this->params["entry"];
        $this->data["entradas"] = $entrysServicios->getEntry($id);
        $this->data['procesos'] = Doo::db()->find("Procesos", array('where' => 'deleted = 1'));
        $this->data["requests"]=Doo::db()->query("SELECT * FROM request where state NOT IN('N','P') AND id_entrada='$id'; ")->fetchAll();
        $this->data["schedule"] = $schedule;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/schedule.php';
        $this->renderc('index', $this->data, true);
    }

    public function editSchedule(){
        $id=$this->params["entry"];
        $pindex=$this->params["pindex"];
        $schedule = Doo::db()->find("Programacion",array('where' => 'id = ?',"limit"=>1,"param"=>array($pindex)));
        $this->data["entradas"] = $entrysServicios->getEntry($pindex);
        $this->data['procesos'] = Doo::db()->find("Procesos", array('where' => 'deleted = 1'));
        $this->data["requests"]=Doo::db()->query("SELECT * FROM request where state != 'N' AND id_entrada='$id'; ")->fetchAll();
        $this->data["schedule"] = $schedule;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/schedule.php';
        $this->renderc('index', $this->data, true);
    }

    public function assingSchedule(){
        $id=$this->params["pindex"];
        $this->data['consecutivo'] =Doo::db()->query("SELECT cons_planilla+1 as consecutivo FROM parametros;")->fetch();
        $this->data['empleados'] = Doo::db()->find("Empleados",array("deleted"=>" 1")); 
        $this->data["schedule"] =Doo::db()->find("Programacion", array('where' => "id = ? ","limit"=>1,"param" => array($id)));
        $this->data['procesos'] = Doo::db()->find("Procesos", array('where' => 'deleted = 1'));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $proceso=$this->data["schedule"]->proceso;
        $this->data["requeridos"] = Doo::db()->query("SELECT t.id,concat(c.nombre,'-',t.nombre) as nombre FROM trabajos_procesos tp
        inner join trabajos t on (t.id=tp.id_trabajo) 
        INNER JOIN certificados c on (c.id=t.id_certificado)
        where tp.id_proceso='$proceso';")->fetchAll();
        $this->data['content'] = 'entradas/assing.php';
        $this->renderc('index', $this->data, true);
    }

    

    public function closeScheduleIndex(){
        $pindex = $this->params["pindex"];
        $entry = $this->params["entry"];
        $request = $this->params["request"];
        $programacion = Doo::db()->query("SELECT id_entrada,proceso from programacion  p where id='$pindex' ")->fetch();
       
        if($programacion["proceso"]=="3" || $programacion["proceso"]=="10"){
            $this->data['content'] = 'entradas/calidaLavado.php';
        }else{            
            $evidence=Doo::db()->query("SELECT * FROM request_evidence where id_entrada='$entry' and id_request='$request' and id_programacion='$pindex';")->fetch();
            if($evidence){
                $evidence=Doo::db()->find("RequestEvidence",array("where"=>"id = ?","limit"=>1,"param"=>array($evidence["id"])));
            }else{
                Doo::loadModel("RequestEvidence");
                $RequestEvidence = new RequestEvidence();
                $RequestEvidence->id_entrada=$entry;
                $RequestEvidence->id_request=$request;
                $RequestEvidence->id_programacion=$pindex;
                $RequestEvidence->created_at = date('Y-m-d H:i:s');
                $RequestEvidence->updated_at = date('Y-m-d H:i:s'); 
                $RequestEvidence->id = Doo::db()->insert($RequestEvidence);
                $evidence=$RequestEvidence;
            }
            $this->data['content'] = 'entradas/evidence.php';
            $this->data["evidence"]=$evidence;
        }
        
        $this->data['pindex']=$pindex;
        $this->data['entry']=$entry;
        $this->data['request']=$request;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('index', $this->data, true);
    }

    public function closeSchedule(){        
        $pindex = $_POST["id_programacion"];        
        $proceso=Doo::db()->query("select proceso,id_entrada from programacion where id='$pindex'")->fetch();
        $autorizacion=Doo::db()->query("SELECT tanques_id FROM autorizacion_ingreso ai inner join entrada e on ai.id = e.autorizacion_ingreso_id  where e.id='$proceso[id_entrada]';")->fetch();
        Doo::db()->query("UPDATE programacion_empleados set cerrado='S' WHERE id_programacion='$pindex'");
        Doo::db()->query("UPDATE request_evidence set observacion='$_POST[observacion]' WHERE id='$_POST[request_evidence]'");
        return Doo::conf()->APP_URL."entrys/schedule/".$_POST["id_entrada"];
    }

    public function saveCloseSchedule(){
        Doo::loadModel("Calidad");
        $Calidad = new Calidad($_POST);
        Doo::db()->insert($Calidad);
        Doo::loadModel("Request");
        Doo::loadModel("RequestItemEntrada");
        $RequestItemEntrada = new RequestItemEntrada();
        $Request = new Request();
        $entrada = $this->entrada($Calidad->id_entrada); 
        $pindex = $_POST["id_programacion"];
        Doo::db()->query("UPDATE programacion_empleados set cerrado='S' WHERE id_programacion='$pindex'");
        $dataInsert= Doo::db()->query("SELECT * FROM clientes_productos WHERE clientes_id='$entrada[id_cliente]' and productos_id='$entrada[id_last_cargo]' AND servicio_id='9'")->fetch();
        if($_POST["recleaning"]=='S'){
            Doo::loadModel("LogsStatus");
            $LogsStatus= new  LogsStatus();
            $LogsStatus->id_entrada=$Calidad->id_entrada;
            $LogsStatus->status="20";
            $LogsStatus->cause=$_POST["cause"];
            Doo::db()->insert($LogsStatus);
            $Request->descripcion='CLEANING UP AGAIN';
            Doo::db()->query("update entrada set status='20' where id='$Calidad->id_entrada'");
        }else{
            $Request->descripcion='TEST-AIRE';
            Doo::db()->query("update entrada set status='2' where id='$Calidad->id_entrada'");
        }
        $Request->cliente_id=$entrada["id_cliente"];
        $Request->id_entrada=$Calidad->id_entrada;
        $Request->state='A';
        $Request->created_at = date('Y-m-d H:i:s');
        $Request->updated_at = date('Y-m-d H:i:s'); 
        $Request->id=Doo::db()->insert($Request);
        $RequestItemEntrada->id_request=$Request->id;
        $RequestItemEntrada->id_item_entrada=0;
        $RequestItemEntrada->id_item_repair=$dataInsert["id"];
        $RequestItemEntrada->precio="0";
        $RequestItemEntrada->type="PRO";
        Doo::db()->insert($RequestItemEntrada);  
        //+return Doo::conf()->APP_URL."entrys";
        return Doo::conf()->APP_URL."entrys/schedule/".$_POST["id_entrada"];
    }

    public function closeSeals(){
        $entry = $_POST["entry"];
        Doo::db()->query("update entrada set status='6' where id='$entry'");
        Doo::loadModel("LogsStatus");
        $LogsStatus= new  LogsStatus();
        $LogsStatus->id_entrada=$entry;
        $LogsStatus->status='6';
        $LogsStatus->cause="";
        Doo::db()->insert($LogsStatus);
        return Doo::conf()->APP_URL."entrys";
    }

    public function sealsImage(){
        Doo::loadModel("EntrySeals");
        $EntrySeals= new EntrySeals();
        $id=$_POST["entry"];
        $cantidad=Doo::db()->query("SELECT count('') as cantidad from entry_seals where entry='$id'")->fetch();
        Doo::loadHelper('DooGdImage');
        $gd   = new DooGdImage(Doo::conf()->IMG_SEALS);
        $file = $gd->uploadImage('dataimagen', "imagen_".$id."_".$cantidad["cantidad"]);
        $EntrySeals->entry=$id;
        $EntrySeals->image=$file;
        $EntrySeals->observation=$_POST["observation"];
        Doo::db()->insert($EntrySeals);
    }

    public function  renderSeals(){
        $id=$_POST["entry"];
        $this->data["evidence"]=Doo::db()->query("SELECT *  from entry_seals where entry='$id'")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('entradas/seals_photo', $this->data, true);
    }

    public function renderEvidences(){
        $id=$_POST["request_evidence"];
        $this->data["evidence"]=Doo::db()->query("SELECT *  from request_evidence_detail where id_request_evidence='$id' and id_request_evidence!=0 ")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('entradas/evidence_photo', $this->data, true);
    }

    public function printEvidenceSchedule(){
        Doo::loadClass("pdf/fpdf");      
        $id = $this->params["pindex"];
        $proceso = Doo::db()->query("SELECT * FROM programacion where id='$id' ")->fetch();
        $entrada = $this->entrada($proceso["id_entrada"]);
        $calidad = Doo::db()->query("SELECT * FROM calidad WHERE id_programacion='$id' and id_entrada='$entrada[id]';")->fetch();
        $evidence= Doo::db()->query("SELECT imagen as image  from calidad_evidence where id_entrada='$entrada[id]'")->fetchAll();
        if($proceso["proceso"]=="3" || $proceso["proceso"]=="10"){
            Doo::loadClass("reportes/Quality");
            $pdf = new Quality($entrada);
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->body($calidad,$evidence);
            $pdf->Output( );
            ob_end_clean();
        }else{
            Doo::loadClass("reportes/Evidences");
            $pdf = new Evidences();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->body();
            $pdf->Output( );
            ob_end_clean();
        }
    }

    public function saveEvidenceSchedule(){
        Doo::loadModel("RequestEvidenceDetail");
        $RequestEvidenceDetail= new RequestEvidenceDetail();
        $id=$_POST["request_evidence"];
        $cantidad=Doo::db()->query("SELECT count('') as cantidad from request_evidence_detail where id_request_evidence='$id'")->fetch();
        Doo::loadHelper('DooGdImage');
        $gd   = new DooGdImage(Doo::conf()->IMG_EVIDENCE);
        $file = $gd->uploadImage('dataimagen', "imagen_".$id."_".$cantidad["cantidad"]);
        $RequestEvidenceDetail->id_request_evidence=$id;
        $RequestEvidenceDetail->image=$file;
        Doo::db()->insert($RequestEvidenceDetail);
    }

    public function saveEvidenceScheduleQ(){
        Doo::loadModel("CalidadEvidence");
        $CalidadEvidence= new CalidadEvidence();
        $id=$_POST["id_entrada"];
        $cantidad=Doo::db()->query("SELECT count('') as cantidad from calidad_evidence where id_entrada='$id'")->fetch();
        Doo::loadHelper('DooGdImage');
        $gd   = new DooGdImage(Doo::conf()->IMG_EVIDENCE_QUALITY);
        $file = $gd->uploadImage('dataimagen', "imagen_".$id."_".$cantidad["cantidad"]);
        $CalidadEvidence->id_entrada=$id;
        $CalidadEvidence->imagen=$file;
        Doo::db()->insert($CalidadEvidence);
    }

    public function renderEvidencesQuality(){
        $id=$_POST["id_entrada"];
        $this->data["evidence"]=Doo::db()->query("SELECT imagen as image  from calidad_evidence where id_entrada='$id'")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('entradas/evidence_quality', $this->data, true);
    }

    public function permisosEmpleados(){
        $id = $_POST["empleado"];
        $proceso = $_POST["proceso"];
        $trabajos= Doo::db()->query("SELECT 'ats' as typ,a.id,concat(c.nombre,'-',t.nombre) as nombre FROM trabajos_procesos tp
        INNER join ats a on (a.id_trabajo=tp.id_trabajo) 
        inner join trabajos t on (t.id=tp.id_trabajo and a.status='S')
        INNER JOIN certificados c on (c.id=t.id_certificado)
        where tp.id_proceso='$proceso'   and id_empleado_autorizado='$id' 
        UNION ALL
        SELECT 'height' as typ,a.id,concat(c.nombre,'-',t.nombre) as nombre FROM trabajos_procesos tp
        INNER join height a on (a.id_trabajo=tp.id_trabajo) 
        inner join trabajos t on (t.id=tp.id_trabajo and a.status='S')
        INNER JOIN certificados c on (c.id=t.id_certificado)
        where tp.id_proceso='$proceso'   and id_empleado_autorizado='$id' UNION ALL
        SELECT 'space' as typ,a.id,concat(c.nombre,'-',t.nombre) as nombre FROM trabajos_procesos tp
        INNER join space a on (a.id_trabajo=tp.id_trabajo) 
        inner join trabajos t on (t.id=tp.id_trabajo and a.status='S')
        INNER JOIN certificados c on (c.id=t.id_certificado)
        where tp.id_proceso='$proceso'   and id_empleado_autorizado='$id' UNION ALL
        SELECT 'hot' as typ,a.id,concat(c.nombre,'-',t.nombre) as nombre FROM trabajos_procesos tp
        INNER join hot a on (a.id_trabajo=tp.id_trabajo) 
        inner join trabajos t on (t.id=tp.id_trabajo and a.status='S')
        INNER JOIN certificados c on (c.id=t.id_certificado)
        where tp.id_proceso='$proceso'   and id_empleado_autorizado='$id'")->fetchAll();
        echo json_encode($trabajos);
    }

    public function updatePermission(){
        $consecutivo=$_POST['consecutivo'];
        $typ=$_POST['typ'];
        $id=$_POST['id'];

        Doo::db()->query("update $typ set status='A',consecutivo='$consecutivo' where id='$id'");
    }
}