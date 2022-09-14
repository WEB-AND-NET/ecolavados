<?php

/**
 * Description of TaskController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class TaskController extends DooController {

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
        $this->data['tareas'] = Doo::db()->find("Tareas",array("deleted"=>"id = 1")); 
        $this->data['content'] = 'task/list.php';
        $this->renderc('index', $this->data, true);
    }

    public  function indexHeight(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tareas'] = Doo::db()->find("TareasHeight",array("deleted"=>"id = 1")); 
        $this->data['content'] = 'task_height/list.php';
        $this->renderc('index', $this->data, true);
    }
    
    public  function indexSpace(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tareas'] = Doo::db()->find("TareasSpace",array("deleted"=>"id = 1")); 
        $this->data['content'] = 'task_space/list.php';
        $this->renderc('index', $this->data, true);
    }
    public  function indexHot(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tareas'] = Doo::db()->find("TareasHot",array("deleted"=>"id = 1")); 
        $this->data['content'] = 'task_hot/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add(){
        Doo::loadModel("Tareas");
        $Tareas = new Tareas();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['task'] = $Tareas;
        $this->data['content'] = 'task/form.php';
        $this->renderc('index', $this->data, true);
    } 
 

    public function addHeight(){
        Doo::loadModel("TareasHeight");
        $TareasHeight = new TareasHeight();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['task'] = $TareasHeight;
        $this->data['content'] = 'task_height/form.php';
        $this->renderc('index', $this->data, true);
    } 

    public function addSpace(){
        Doo::loadModel("TareasSpace");
        $TareasSpace = new TareasSpace();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['task'] = $TareasSpace;
        $this->data['content'] = 'task_space/form.php';
        $this->renderc('index', $this->data, true);
    } 
    public function addHot(){
        Doo::loadModel("TareasHot");
        $TareasHot = new TareasHot();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['task'] = $TareasHot;
        $this->data['content'] = 'task_hot/form.php';
        $this->renderc('index', $this->data, true);
    } 

    public function save(){
        Doo::loadModel("Tareas");
        $Tareas = new Tareas($_POST);
        $fecha = new DateTime();
        if($Tareas->id==""){
            $Tareas->id=null;
            $Tareas->created_at =$fecha->format('Y-m-d H:i:s');
            $Tareas->updated_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($Tareas);
        }else{
            $Tareas->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->update($Tareas);
        }
        return Doo::conf()->APP_URL . 'task'; 
    }

    public function saveHeight(){
        Doo::loadModel("TareasHeight");
        $TareasHeight = new TareasHeight($_POST);
        $fecha = new DateTime();
        if($TareasHeight->id==""){
            $TareasHeight->id=null;
            $TareasHeight->create_at =$fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($TareasHeight);
        }else{
            Doo::db()->update($TareasHeight);
        }
        return Doo::conf()->APP_URL . 'task/height'; 
    }

    public function saveSpace(){
        Doo::loadModel("TareasSpace");
        $TareasSpace = new TareasSpace($_POST);
        $fecha = new DateTime();
        if($TareasSpace->id==""){
            $TareasSpace->id=null;
            $TareasSpace->create_at =$fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($TareasSpace);
        }else{
            Doo::db()->update($TareasSpace);
        }
        return Doo::conf()->APP_URL . 'task/spaces'; 
    }
    public function saveHot(){
        Doo::loadModel("TareasHot");
        $TareasHot = new TareasHot($_POST);
        $fecha = new DateTime();
        if($TareasHot->id==""){
            $TareasHot->id=null;
            $TareasHot->create_at =$fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($TareasHot);
        }else{
            Doo::db()->update($TareasHot);
        }
        return Doo::conf()->APP_URL . 'task/hot'; 
    }

    public function edit(){  
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['task'] = Doo::db()->find("Tareas",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['content'] = 'task/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function editHeight(){  
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['task'] = Doo::db()->find("TareasHeight",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['content'] =  'task_height/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function editSpace(){  
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['task'] = Doo::db()->find("TareasSpace",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['content'] =  'task_space/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function editHot(){  
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['task'] = Doo::db()->find("TareasHot",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['content'] =  'task_hot/form.php';
        $this->renderc('index', $this->data, true);
    }

}
