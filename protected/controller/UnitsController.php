<?php

/**
 * Description of TaskController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class UnitsController extends DooController {
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
        $this->data['tareas'] = Doo::db()->find("UnidadesMedida",array("deleted"=>"id = 1")); 
        $this->data['content'] = 'unidades/list.php';
        $this->renderc('index', $this->data, true);
    }


    public function getUnits(){
        $datos=Doo::db()->find("UnidadesMedida",array("where"=>"deleted = 1")); 
        $data=array("data"=>$datos);
        echo json_encode($data);
    }

    public function save(){
        Doo::loadModel("UnidadesMedida");
        $UnidadesMedida = new UnidadesMedida($_POST);
        if($UnidadesMedida->id==""){
            $UnidadesMedida->id=null;
            return Doo::db()->insert($UnidadesMedida);
        }else{
            Doo::db()->update($UnidadesMedida);
        }
    }

    public function deleteItem(){
        $id=$_POST["id"];
        Doo::db()->query("UPDATE unidades_medida set deleted='0' WHERE id='$id'");        
    }
}