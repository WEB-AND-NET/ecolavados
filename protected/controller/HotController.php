<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class HotController extends DooController {

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
        Doo::db()->query("update hot set status='V' where date(created_at) < date(now()) and status='S' OR date(created_at) < date(now()) and status='A';");
        Doo::db()->query("delete from programacion_empleados where date(created_at) < date(now()) AND fecha_inicio=''"); 
        
        $this->data['height'] = Doo::db()->query("SELECT a.id,consecutivo,CONCAT(es.nombre,' ',es.apellido) as operador,CONCAT(e.nombre,' ',e.apellido) as autoriza,t.nombre as  trabajo,a.hora_inicio,a.hora_final,a.status 
        FROM hot a
        INNER JOIN empleados e ON(e.id=id_empleado_autoriza)
        INNER JOIN empleados es ON(es.id=id_empleado_autorizado)
        INNER JOIN trabajos t ON(t.id=a.id_trabajo)")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'hot/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add(){
        Doo::loadModel("Hot");
        $Hot = new Hot();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['empleados'] = Doo::db()->query("SELECT * FROM empleados where deleted=1")->fetchAll(); 
        $this->data['works'] = Doo::db()->find("Trabajos",array("where"=>"id_certificado='4' and deleted = 1")); 
        $this->data['ats'] = $Hot;
        $this->data['content'] = 'hot/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function singIndex(){
        $this->data['id'] = $this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'hot/signs.php';
        $this->renderc('index', $this->data, true);
    }

    public function singSave(){
        $id = $this->params["id"];
        $base = $_POST["base"];
        $type = $_POST["type"];
        if($type=='eco'){
            Doo::db()->query("UPDATE  hot SET firma_empleado_autoriza='$base'  WHERE id='$id' ");
        }else{
            Doo::db()->query("UPDATE  hot SET firma_empleado_autorizado='$base'  WHERE id='$id' ");
        }
    }

    public function getAssociate(){
        $id_trabajo=$_POST["id"];
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas_hot where principal='S' ")->fetchAll();
        $list=[];
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT t.id ,t.nombre,t.numero,t.defaul FROM trabajos_tarea_hot tt
            inner join tareas_hot t on (t.id=tt.id_tarea)
            inner join tareas_hot tp on (tt.id_tarea_principal=tp.id) where tt. id_trabajo='$id_trabajo' and id_tarea_principal='$principal[id]';
            ")->fetchAll();
             $principal["tareas"]=$tarea;
             $list[]=$principal;
        }$this->data["list"]=$list;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc("hot/items", $this->data, true);
    }

    public function getConsecutivo(){
        $consecutivo = Doo::db()->query("select count('')+1 as consecutivo from hot;")->fetch();
        return $consecutivo["consecutivo"];
    }
    public function setBadAssociate(){
        Doo::loadModel("Hot");
        $Hot = new Hot($_POST);
        $login =$_SESSION["login"];
        $Hot->id_empleado_autoriza = $login->id_usuario;
        $Hot->consecutivo =  $this->getConsecutivo();
        $Hot->id=Doo::db()->insert($Hot);
        foreach($_POST["ids"] as $key => $post ){
            Doo::loadModel("AtsReject");
            $AtsReject = new AtsReject();
            $AtsReject->id_ats=$Ats->id;
            $AtsReject->id_tarra=$post;
            Doo::db()->insert($AtsReject);
           // $tarea[] = Doo::db()->query("select nombre from tareas where id='$post'")->fetch();
        }
        echo ($Hot->id);
    }
    public function setAssociate(){
        Doo::loadModel("Hot");
        $Hot = new Hot($_POST);
        $login =$_SESSION["login"];
        $Hot->id_empleado_autoriza = $login->id_usuario;
        $Hot->consecutivo =  $this->getConsecutivo();
        $Hot->id=Doo::db()->insert($Hot);
        echo ($Hot->id);
    }


}