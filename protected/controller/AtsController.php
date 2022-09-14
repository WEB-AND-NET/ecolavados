<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class AtsController extends DooController {

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
        Doo::db()->query("UPDATE ats set status='V' where date(created_at) < date(now()) and status='S' OR date(created_at) < date(now()) and status='A';");
        
        Doo::db()->query("delete from programacion_empleados where date(created_at) < date(now()) AND fecha_inicio=''"); 


        $this->data['ats'] = Doo::db()->query("SELECT a.id,consecutivo,CONCAT(es.nombre,' ',es.apellido) as operador,CONCAT(e.nombre,' ',e.apellido) as autoriza,t.nombre as  trabajo,a.hora_inicio,a.hora_final,a.status 
        FROM ats a
        INNER JOIN empleados e ON(e.id=id_empleado_autoriza)
        INNER JOIN empleados es ON(es.id=id_empleado_autorizado)
        INNER JOIN trabajos t ON(t.id=a.id_trabajo)")->fetchAll();
        
        $this->data['content'] = 'ats/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add(){
        Doo::loadModel("Ats");
        $Ats = new Ats();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['empleados'] = Doo::db()->query("SELECT * FROM empleados where deleted=1")->fetchAll(); 
        $this->data['works'] = Doo::db()->find("Trabajos",array("where"=>"id_certificado='1' and deleted = 1")); 
        $this->data['ats'] = $Ats;
        $this->data['content'] = 'ats/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function singIndex(){
        $this->data['id'] = $this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'ats/signs.php';
        $this->renderc('index', $this->data, true);
    }
    public function singSave(){
        $id = $this->params["id"];
        $base = $_POST["base"];
        $type = $_POST["type"];
        if($type=='eco'){
            Doo::db()->query("UPDATE  ats SET firma_empleado_autoriza='$base'  WHERE id='$id' ");
        }else{
            Doo::db()->query("UPDATE  ats SET firma_empleado_autorizado='$base'  WHERE id='$id' ");
        }
    }

    public function printer(){
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/atsPdf");
        $id=$this->params["id"];
        $pdf = new atsPdf();
        $list=[];
        $ats= Doo::db()->query("SELECT t.id as id_trabajo,firma_empleado_autoriza,firma_empleado_autorizado,a.id,consecutivo,
        CONCAT(es.nombre,' ',es.apellido,'-',es.identificacion) as operador,CONCAT(e.nombre,' ',e.apellido,'-',e.identificacion) as autoriza,t.nombre as  trabajo,date(a.hora_inicio )as fecha , time(a.hora_inicio) as inicio,time(a.hora_final) as final,a.status 
        FROM ats a
        INNER JOIN empleados e ON(e.id=id_empleado_autoriza)
        INNER JOIN empleados es ON(es.id=id_empleado_autorizado)
        INNER JOIN trabajos t ON(t.id=a.id_trabajo)  where a.id='$id'")->fetch();
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas where principal='S' AND deleted='1';")->fetchAll();
        
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT t.id ,t.nombre,t.numero FROM trabajos_tareas tt
            inner join tareas t on (t.id=tt.id_tarea)
            inner join tareas tp on (tt.id_tarea_princial=tp.id) where tt. id_trabajo='$ats[id_trabajo]' and id_tarea_princial='$principal[id]';
            ")->fetchAll();
            $principal["tareas"]=$tarea;
            $list[]=$principal;
        }
        $this->data["list"]=$list;
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->Body($ats,$list);
        $pdf->Output();
    }

    public function setBadAssociate(){
        Doo::loadModel("Ats");
        $Ats = new Ats($_POST);
        $login =$_SESSION["login"];
        
        $Ats->id_empleado_autoriza = $login->id_usuario;
        $Ats->consecutivo =  $this->getConsecutivo();
        $Ats->id=Doo::db()->insert($Ats);
        foreach($_POST["ids"] as $key => $post ){
            Doo::loadModel("AtsReject");
            $AtsReject = new AtsReject();
            $AtsReject->id_ats=$Ats->id;
            $AtsReject->id_tarra=$post;
            Doo::db()->insert($AtsReject);
           // $tarea[] = Doo::db()->query("select nombre from tareas where id='$post'")->fetch();
        }
        echo ($Ats->id);
    }
    public function setAssociate(){
        Doo::loadModel("Ats");
        $Ats = new Ats($_POST);
        $login =$_SESSION["login"];
        $Ats->id_empleado_autoriza = $login->id_usuario;
        $Ats->consecutivo =  $this->getConsecutivo();
        $Ats->id=Doo::db()->insert($Ats);
        echo ($Ats->id);
    }
    public function getAssociate(){
        $id_trabajo=$_POST["id"];
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas where principal='S' AND deleted='1';")->fetchAll();
        $list=[];
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT t.id ,t.nombre,t.numero FROM trabajos_tareas tt
            inner join tareas t on (t.id=tt.id_tarea)
            inner join tareas tp on (tt.id_tarea_princial=tp.id) where tt. id_trabajo='$id_trabajo' and id_tarea_princial='$principal[id]';
            ")->fetchAll();
             $principal["tareas"]=$tarea;
             $list[]=$principal;
        }$this->data["list"]=$list;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc("ats/items", $this->data, true);
        
    }

    public function getConsecutivo(){
        $consecutivo = Doo::db()->query("select count('')+1 as consecutivo from ats;")->fetch();
        return $consecutivo["consecutivo"];
    }
    
     public function getAllAts(){
        $ats = Doo::db()->query("SELECT a.id,consecutivo,CONCAT(es.nombre,' ',es.apellido) as operador,CONCAT(e.nombre,' ',e.apellido) as autoriza,t.nombre as  trabajo,a.hora_inicio,a.hora_final,a.status 
        FROM ats a
        INNER JOIN empleados e ON(e.id=id_empleado_autoriza)
        INNER JOIN empleados es ON(es.id=id_empleado_autorizado)
        INNER JOIN trabajos t ON(t.id=a.id_trabajo) order by a.id desc")->fetchAll();        
        $this->data['content'] = 'ats/list.php';
        echo json_encode($ats);
    }
    
    public function desactivate(){
        $id = $_POST["id"];
        Doo::db()->query("update ats set status='V' where id='$id';");
    }
}