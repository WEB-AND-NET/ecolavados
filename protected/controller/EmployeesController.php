

<?php

/**
 * Description of EmployeesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class EmployeesController extends DooController {

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
        $this->data['empleados'] = Doo::db()->find("Empleados",array("deleted"=>" 1")); 
        $this->data['content'] = 'empleados/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add(){
        
        
        Doo::loadModel("Empleados");
        $Empleados = new Empleados();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        //$roles = 
        $this->data['cargos'] = Doo::db()->find("Roles", array("select" => "id,role as cargo", "desc" => "id"));
        //Doo::db()->find("Cargos",array("deleted"=>" 1")); 
        $this->data['empleados'] = $Empleados;
        $this->data['content'] = 'empleados/form.php';
        $this->renderc('index', $this->data, true);
    } 
    public function edit(){
        Doo::loadModel("Empleados");
        $Empleados = new Empleados();
        $id=$this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['cargos'] = Doo::db()->find("Cargos",array("deleted"=>" 1")); 
        $this->data['empleados'] = Doo::db()->find("Empleados",
        array('where' => 'id = ?','limit' => 1,
               'param' => array($id)));
        $this->data['content'] = 'empleados/form.php';
        $this->renderc('index', $this->data, true);
    } 

    public function save(){
        Doo::loadModel("Empleados");
        $Empleados = new Empleados($_POST);
        $fecha = new DateTime();
        $Empleados->update_at = $fecha->format('Y-m-d H:i:s');
        if($Empleados->id==""){
            $Empleados->id=NULL;
            $Empleados->created_at =$fecha->format('Y-m-d H:i:s'); 
            Doo::db()->insert($Empleados);
        }else{
            Doo::db()->update($Empleados);
        }
        return Doo::conf()->APP_URL."entrys";
    }
    public function validateId(){
        $id = $_POST["id"];
        $val = $_POST["val"];
        $exist=Doo::db()->query("SELECT id FROM empleados where identificacion='' and id != '';")->fetch();
        if($exist){
            echo 'TRUE';
        }else{
            echo 'FALSE';
        }
    }
}