<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class HeightController extends DooController {

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
        Doo::db()->query("update height set status='V' where date(created_at) < date(now()) and status='S' OR date(created_at) < date(now()) and status='A';");
        Doo::db()->query("delete from programacion_empleados where date(created_at) < date(now()) AND fecha_inicio=''"); 
        
        $this->data['height'] = Doo::db()->query("SELECT a.id,consecutivo,CONCAT(es.nombre,' ',es.apellido) as operador,CONCAT(e.nombre,' ',e.apellido) as autoriza,t.nombre as  trabajo,a.hora_inicio,a.hora_final,a.status 
        FROM height a
        INNER JOIN empleados e ON(e.id=id_empleado_autoriza)
        INNER JOIN empleados es ON(es.id=id_empleado_autorizado)
        INNER JOIN trabajos t ON(t.id=a.id_trabajo)")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'height/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function getAllHeight(){
        $height = Doo::db()->query("SELECT a.id,consecutivo,CONCAT(es.nombre,' ',es.apellido) as operador,CONCAT(e.nombre,' ',e.apellido) as autoriza,t.nombre as  trabajo,a.hora_inicio,a.hora_final,a.status 
        FROM height a
        INNER JOIN empleados e ON(e.id=id_empleado_autoriza)
        INNER JOIN empleados es ON(es.id=id_empleado_autorizado)
        INNER JOIN trabajos t ON(t.id=a.id_trabajo) order by a.id desc")->fetchAll();
        echo json_encode($height);
    }
    
    public function printer(){
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/heightPdf");
        $id=$this->params["id"];
        $pdf = new heightPdf();
        $list=[];
        $height= Doo::db()->query("SELECT t.id as id_trabajo,firma_empleado_autoriza,firma_empleado_autorizado,a.id,consecutivo,a.altura,
        CONCAT(es.nombre,' ',es.apellido,'-',es.identificacion) as operador,CONCAT(e.nombre,' ',e.apellido,'-',e.identificacion) as autoriza,t.nombre as  trabajo,date(a.hora_inicio )as fecha , time(a.hora_inicio) as inicio,time(a.hora_final) as final,a.status 
        FROM height a
        INNER JOIN empleados e ON(e.id=id_empleado_autoriza)
        INNER JOIN empleados es ON(es.id=id_empleado_autorizado)
        INNER JOIN trabajos t ON(t.id=a.id_trabajo)  where a.id='$id'")->fetch();
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas_height where principal='S' ;")->fetchAll();
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT t.id ,t.nombre,t.numero,t.defaul FROM trabajos_tarea_height tt
            inner join tareas_height t on (t.id=tt.id_tarea)
            inner join tareas_height tp on (tt.id_tarea_principal=tp.id) where tt. id_trabajo='$height[id_trabajo]' and id_tarea_principal='$principal[id]';")->fetchAll();
            $principal["tareas"]=$tarea;
            $list[]=$principal;
        }
        $this->data["list"]=$list;
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->Body($height,$list);
        $pdf->Output();
    }

    public function add(){
        Doo::loadModel("Height");
        $Height = new Height();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['empleados'] = Doo::db()->query("SELECT * FROM empleados where deleted = '1'")->fetchAll(); 
        $this->data['works'] = Doo::db()->find("Trabajos",array("where"=>"id_certificado='2' and deleted = 1")); 
        $this->data['ats'] = $Height;
        $this->data['content'] = 'height/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function singIndex(){
        $this->data['id'] = $this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'height/signs.php';
        $this->renderc('index', $this->data, true);
    }

    public function singSave(){
        $id = $this->params["id"];
        $base = $_POST["base"];
        $type = $_POST["type"];
        if($type=='eco'){
            Doo::db()->query("UPDATE  height SET firma_empleado_autoriza='$base'  WHERE id='$id' ");
        }else{
            Doo::db()->query("UPDATE  height SET firma_empleado_autorizado='$base'  WHERE id='$id' ");
        }
    }

    public function getAssociate(){
        $id_trabajo=$_POST["id"];
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas_height where principal='S' ")->fetchAll();
        $list=[];
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT t.id ,t.nombre,t.numero,t.defaul FROM trabajos_tarea_height tt
            inner join tareas_height t on (t.id=tt.id_tarea)
            inner join tareas_height tp on (tt.id_tarea_principal=tp.id) where tt. id_trabajo='$id_trabajo' and id_tarea_principal='$principal[id]';
            ")->fetchAll();
             $principal["tareas"]=$tarea;
             $list[]=$principal;
        }$this->data["list"]=$list;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc("height/items", $this->data, true);
    }

    public function getConsecutivo(){
        $consecutivo = Doo::db()->query("select count('')+1 as consecutivo from height;")->fetch();
        return $consecutivo["consecutivo"];
    }
    public function setBadAssociate(){
        Doo::loadModel("Height");
        $Height = new Height($_POST);
        $login =$_SESSION["login"];
        //$Height->id_empleado_autoriza = $login->id_usuario;
        $Height->consecutivo =  $this->getConsecutivo();
        $Height->id=Doo::db()->insert($Height);
        foreach($_POST["ids"] as $key => $post ){
            Doo::loadModel("AtsReject");
            $AtsReject = new AtsReject();
            $AtsReject->id_ats=$Ats->id;
            $AtsReject->id_tarra=$post;
            Doo::db()->insert($AtsReject);
           // $tarea[] = Doo::db()->query("select nombre from tareas where id='$post'")->fetch();
        }
        echo ($Height->id);
    }
    public function setAssociate(){
        Doo::loadModel("Height");
        $Height = new Height($_POST);
      
        $login =$_SESSION["login"];
        //$Height->id_empleado_autoriza = $login->id_usuario;
        $Height->consecutivo =  $this->getConsecutivo();
        $Height->id=Doo::db()->insert($Height);
        echo ($Height->id);
    }

public function desactivate(){
        $id = $_POST["id"];
        Doo::db()->query("update height set status='V' where id='$id';");
    }

}