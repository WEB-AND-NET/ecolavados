
<?php

/**
 * Description of EmployeesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ciudadesController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["503"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL;
            }
        }
    }

    public function index(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['municipios'] = Doo::db()->find("municipios",array('where' => 'estado = 1')); 
        $this->data['content'] = 'ciudades/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add(){
    
        Doo::loadModel("Municipios");
        $municipios = new municipios();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        //$roles = 
        $this->data['cargos'] = Doo::db()->find("Roles", array("select" => "id,role as cargo", "desc" => "id"));
        //Doo::db()->find("Cargos",array("deleted"=>" 1")); 
        $this->data['municipios'] = $municipios;
        $this->data['content'] = 'ciudades/form.php';
        $this->renderc('index', $this->data, true);

    }

    public function save(){
        Doo::loadModel("Municipios");
        $municipios = new Municipios($_POST);
        if($municipios->id==""){
            $municipios->id=NULL;
            $municipios->estado = 1;
            Doo::db()->insert($municipios);
        }else{
            Doo::db()->update($municipios);
        }
        return Doo::conf()->APP_URL."ciudades";
    }

    public function validateId(){
        $id = $_POST["id"];
        $val = $_POST["val"];
        
        $exist=Doo::db()->query("SELECT id FROM municipios where municipio='$val' and id != '$id';")->fetch();
        if($exist){
            echo 'TRUE';
        }else{
            echo 'FALSE';
        }
    }

}