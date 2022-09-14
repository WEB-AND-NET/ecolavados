<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class StatusController extends DooController {

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
        $this->data['status'] = Doo::db()->find("Status",array("deleted"=>"id = 1")); 
        $this->data['content'] = 'status/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add(){
        Doo::loadModel("Status");
        $status = new Status();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['status'] = $status;
        $this->data['content'] = 'status/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function edit(){  
        
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['status'] = Doo::db()->find("Status",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['content'] = 'status/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function save(){
        Doo::loadModel("Status");
        $status = new Status($_POST);
        $fecha = new DateTime();
        if($status->id==""){
            $status->id=null;
            $status->create_at =$fecha->format('Y-m-d H:i:s');
            $status->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($status);
        }else{
            $status->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->update($status);
        }
        return Doo::conf()->APP_URL . 'status'; 
    }
}

?>