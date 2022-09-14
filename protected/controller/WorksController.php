<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class WorksController extends DooController {

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
        $this->data['works'] = Doo::db()->query("SELECT t.id,t.nombre as trabajo,c.nombre as certificado FROM trabajos t inner join certificados c on (c.id=t.id_certificado) where  c.deleted='1' order by trabajo ;"); 
        $this->data['content'] = 'works/list.php';
        $this->renderc('index', $this->data, true);
    }
  
    public function add(){
        Doo::loadModel("Trabajos");
        $Trabajos = new Trabajos();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['works'] = $Trabajos;
        $this->data['certificados'] = Doo::db()->find("Certificados",array("where"=>"deleted = 1")); 
        $this->data['content'] = 'works/form.php';
        $this->renderc('index', $this->data, true);
    } 
    public function save(){
        Doo::loadModel("Trabajos");
        $Trabajos = new Trabajos($_POST);
        $fecha = new DateTime();
        if($Trabajos->id==""){
            $Trabajos->id=null;
            $Trabajos->created_at =$fecha->format('Y-m-d H:i:s');
            $Trabajos->updated_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($Trabajos);
        }else{
            $Trabajos->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->update($Trabajos);
        }
        return Doo::conf()->APP_URL . 'works'; 
    }
    public function edit(){  
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['works'] = Doo::db()->find("Trabajos",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['certificados'] = Doo::db()->find("Certificados",array("where"=>"deleted = 1")); 
        $this->data['content'] = 'works/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function associateAdd(){
        $id=$this->params["id"];
        $this->data['work'] = Doo::db()->find("Trabajos",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));  
        
        if($this->data['work']->id_certificado=='1'){
            $this->data['task'] = Doo::db()->find("Tareas",array("where"=>"deleted = '1' and principal='N' and id not in (select id_tarea from trabajos_tareas);")); 
            $this->data['task_P'] = Doo::db()->find("Tareas",array("where"=>"deleted = 1 and principal='S'"));      
            $this->data['content'] = 'works/associate.php';
        }
        else if($this->data['work']->id_certificado=='2'){
            $this->data['task'] = Doo::db()->find("TareasHeight",array("where"=>" principal='N' and id not in (select id_tarea from trabajos_tarea_height);")); 
            $this->data['task_P'] = Doo::db()->find("TareasHeight",array("where"=>"principal='S'"));      
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['content'] = 'works/associateHeight.php';
        }else if($this->data['work']->id_certificado=='3'){
            $this->data['task'] = Doo::db()->find("TareasSpace",array("where"=>" principal='N' and id not in (select id_tarea from trabajos_tarea_space);")); 
            $this->data['task_P'] = Doo::db()->find("TareasSpace",array("where"=>"principal='S'"));      
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['content'] = 'works/associateSpace.php';
        }
        else if($this->data['work']->id_certificado=='4'){
            $this->data['task'] = Doo::db()->find("TareasHot",array("where"=>" principal='N' and id not in (select id_tarea from trabajos_tarea_hot);")); 
            $this->data['task_P'] = Doo::db()->find("TareasHot",array("where"=>"principal='S'"));      
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['content'] = 'works/associateHot.php';
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('index', $this->data, true);
    }
    
    public function associateSave(){
        Doo::loadModel("TrabajosTareas");
        $TrabajosTareas = new TrabajosTareas($_POST);
        $fecha = new DateTime();
        $TrabajosTareas->created_at =$fecha->format('Y-m-d H:i:s');
        $TrabajosTareas->updated_at = $fecha->format('Y-m-d H:i:s');
        Doo::db()->insert($TrabajosTareas);
    }
    
    public function associateSaveHeight(){
        Doo::loadModel("TrabajosTareaHeight");
        $TrabajosTareaHeight = new TrabajosTareaHeight($_POST);
        $fecha = new DateTime();
        $TrabajosTareaHeight->create_at =$fecha->format('Y-m-d H:i:s');
        $TrabajosTareaHeight->update_at = $fecha->format('Y-m-d H:i:s');
        Doo::db()->insert($TrabajosTareaHeight);
    }

    public function associateSaveSpace(){
        Doo::loadModel("TrabajosTareaSpace");
        $TrabajosTareaSpace = new TrabajosTareaSpace($_POST);
        $fecha = new DateTime();
        $TrabajosTareaSpace->create_at =$fecha->format('Y-m-d H:i:s');
        $TrabajosTareaSpace->update_at = $fecha->format('Y-m-d H:i:s');
        Doo::db()->insert($TrabajosTareaSpace);
    }
    public function associateSaveHot(){
        Doo::loadModel("TrabajosTareaHot");
        $TrabajosTareaHot = new TrabajosTareaHot($_POST);
        $fecha = new DateTime();
        $TrabajosTareaHot->create_at =$fecha->format('Y-m-d H:i:s');
        $TrabajosTareaHot->update_at = $fecha->format('Y-m-d H:i:s');
        Doo::db()->insert($TrabajosTareaHot);
    }

    public function getAssociate(){
        $id_trabajo=$_POST["id"];
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas where principal='S' AND deleted='1';")->fetchAll();
        $list=[];
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT tt.id ,t.nombre,t.numero FROM trabajos_tareas tt
            inner join tareas t on (t.id=tt.id_tarea)
            inner join tareas tp on (tt.id_tarea_princial=tp.id) where tt. id_trabajo='$id_trabajo' and id_tarea_princial='$principal[id]';
            ")->fetchAll();
             $principal["tareas"]=$tarea;
             $list[]=$principal;
        }$this->data["list"]=$list;
        $this->renderc("works/items", $this->data, true);
    }
    public function getAssociateHeight(){
        $id_trabajo=$_POST["id"];
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas_height where principal='S' ")->fetchAll();
        $list=[];
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT tt.id ,t.nombre,t.numero FROM trabajos_tarea_height tt
            inner join tareas_height t on (t.id=tt.id_tarea)
            inner join tareas_height tp on (tt.id_tarea_principal=tp.id) where tt. id_trabajo='$id_trabajo' and id_tarea_principal='$principal[id]';
            ")->fetchAll();
             $principal["tareas"]=$tarea;
             $list[]=$principal;
        }$this->data["list"]=$list;
        $this->renderc("works/items", $this->data, true);
    }
    public function getAssociateSpace(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $id_trabajo=$_POST["id"];
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas_space where principal='S' ")->fetchAll();
        $list=[];
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT tt.id ,t.nombre,t.numero,t.defaul FROM trabajos_tarea_space tt
            inner join tareas_space t on (t.id=tt.id_tarea)
            inner join tareas_space tp on (tt.id_tarea_principal=tp.id) where tt. id_trabajo='$id_trabajo' and id_tarea_principal='$principal[id]';
            ")->fetchAll();
             $principal["tareas"]=$tarea;
             $list[]=$principal;
        }
        $this->data["list"]=$list;
        $this->renderc("space/items", $this->data, true);
    }
    public function getAssociateHot(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $id_trabajo=$_POST["id"];
        $principales= Doo::db()->query("SELECT id,nombre,numero FROM tareas_hot where principal='S' ")->fetchAll();
        $list=[];
        foreach($principales as $principal){
            $tarea=Doo::db()->query("SELECT tt.id ,t.nombre,t.numero,t.defaul FROM trabajos_tarea_hot tt
            inner join tareas_hot t on (t.id=tt.id_tarea)
            inner join tareas_hot tp on (tt.id_tarea_principal=tp.id) where tt. id_trabajo='$id_trabajo' and id_tarea_principal='$principal[id]';
            ")->fetchAll();
             $principal["tareas"]=$tarea;
             $list[]=$principal;
        }
        $this->data["list"]=$list;
        $this->renderc("hot/items", $this->data, true);
    }

  

}
