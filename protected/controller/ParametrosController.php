<?php

/**
 * Description of ParametrosController
 *
 * @author Maykel Rhenals 
 */
class ParametrosController extends DooController {
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
        $this->data['parametros'] = Doo::db()->find("Parametros",array("where"=>"id = ?","limit"=>1,"param"=>array(1)));
        
        if($this->data['parametros'] == false)
        {
            
            Doo::loadModel("Parametros");
            $parametros= new Parametros();

            $this->data['parametros']=$parametros;
        }
        $this->data['content'] = 'parametros/form.php';
        $this->renderc('index', $this->data, true);
    }


    public function save(){
        Doo::loadModel("Parametros");
        $Parametros =new Parametros($_POST);
        
        if($Parametros->id==""){
            $Parametros->id=null;
            Doo::db()->insert($Parametros);
            
        }else{
            Doo::db()->update($Parametros);
           
        }
        return Doo::conf()->APP_URL . "parametros";
    }


}



?>