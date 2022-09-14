<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meri���o Iriarte <carlos.merino.iriarte@gmail.com>
 */
class TanquesController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            
        }
    }

    public function index() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        $this->data['content'] = 'tanques/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function test() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;   
        $sql = "SELECT make_date,t.id,serial, test30,test60,
        DATE_ADD(test60, interval 60 MONTH) as next60,
        DATE_ADD(test30, interval 60 MONTH) as next30, 
        TIMESTAMPDIFF( month,date(now()),DATE_ADD(test60, interval 60 MONTH)) as falta60,
        TIMESTAMPDIFF( month,date(now()),DATE_ADD(test30, interval 60 MONTH)) as falta30,
        c.nombre as cliente   
        FROM tanques t 
         INNER JOIN clientes c ON c.id=t.clientes_id 
         WHERE t.deleted='1' order by t.id desc";
        $this->data['tanques'] = Doo::db()->query($sql)->fetchAll();   
        $this->data['content'] = 'tanques/test.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function indexClient() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $login=$_SESSION["login"];
        $sql = "SELECT  t.id,serial, test30 last_test30, date_add(test30, interval 30 month)as next_test30 ,test60 last_test60,date_add(test60, interval 60 month) as next_test60  FROM tanques t  INNER JOIN clientes c on c.id=t.clientes_id WHERE t.deleted='1' and t.clientes_id='$login->id_usuario'";
        $this->data['tanques'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'tanques/listClient.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Tanques");
        $login = $_SESSION['login'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tanques'] = new Tanques();
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
        $this->data['content'] = 'tanques/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function addClient() {
        Doo::loadModel("Tanques");
        $login = $_SESSION['login'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tanques'] = new Tanques();
        $this->data['content'] = 'tanques/formClient.php';
        $this->renderc('index', $this->data, true);
    }

    public function edit(){
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data["tanques"] = Doo::db()->find("Tanques",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
         $this->data['content'] = 'tanques/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function editClient(){
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data["tanques"] = Doo::db()->find("Tanques",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
         $this->data['content'] = 'tanques/formClient.php';
        $this->renderc('index', $this->data, true);
    }

    public function save() {
        Doo::loadModel("Tanques");
        $login = $_SESSION['login'];
        $Tanques = new Tanques($_POST);
        $fecha = new DateTime();
        if($Tanques->id==""){
            $Tanques->id=NULL;
            $Tanques->usuarios_id = $login->id;
            $Tanques->create_at =$fecha->format('Y-m-d H:i:s');
            $Tanques->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($Tanques);
        }else{
            $Tanques->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->update($Tanques);
        }
        return Doo::conf()->APP_URL . 'tanks'; 
    }

    public function saveClient() {
        Doo::loadModel("Tanques");
        $login = $_SESSION['login'];
        $Tanques = new Tanques($_POST);
        $fecha = new DateTime();
        if($Tanques->id==""){
            $Tanques->id=NULL;
            $Tanques->usuarios_id = $login->id;
            $Tanques->clientes_id = $login->id_usuario;
            $Tanques->create_at =$fecha->format('Y-m-d H:i:s');
            $Tanques->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($Tanques);
        }else{
            $Tanques->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->update($Tanques);
        }
        return Doo::conf()->APP_URL . 'tank'; 
    }

    public function getAll(){
        $sql = "SELECT  
        t.id,
        serial, test30,test60,
        DATE_ADD(test60, interval 60 MONTH) as next60,
        DATE_ADD(test30, interval 60 MONTH) as next30, 
        TIMESTAMPDIFF( month,date(now()),DATE_ADD(test60, interval 60 MONTH)) as falta60,
        TIMESTAMPDIFF( month,date(now()),DATE_ADD(test30, interval 60 MONTH)) as falta30,
        c.nombre as cliente   
        FROM tanques t 
         INNER JOIN clientes c ON c.id=t.clientes_id 
         WHERE t.deleted='1' order by t.id desc";
        echo json_encode(Doo::db()->query($sql)->fetchAll()) ;
    }

    public function desactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE tanques SET deleted='0' WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "tanks";
    }

    public function validateTanques(){
        $fecha30 = $_POST['fecha30']=="" ? "": new DateTime($_POST['fecha30']) ;
        $fecha60 =$_POST['fecha60']=="" ? "": new DateTime($_POST['fecha60']) ;
        $fechaActual = new DateTime(date("Y-m-d")); 
        $fechaManufactura=$_POST['fechaManufactura']=="" ? "": new  DateTime($_POST['fechaManufactura']);
        $diferencia = 0; 
        $ref=0;      
    
        if($fecha30 != "" && $fecha60 != "" ){
            if($fecha60 > $fecha30 ){
                $diferencia = $fechaActual->diff($fecha60);
                $diferencia= $diferencia->days / 31;

                if(26 <= $diferencia  and $diferencia <=34){                    //Realizar teste de 2.5
                    echo 'caso 1 , test 2.5 ,diferencia '.$diferencia;
                    $ref=1;
                }
            
                if($diferencia > 34){
                    //Realizar teste de 5
                    echo 'caso 1 , test 5, diferencia '.$diferencia;
                    $ref=1;
                }
                echo $diferencia;
            }
            
            if ($fecha60 < $fecha30){
                $diferencia = $fechaActual->diff($fecha30);
                
                $diferencia= $diferencia->days / 31;
                If ($diferencia >= 26){
                    //Realizar teste de 5
                    echo 'caso 1 , test 5,diferencia '.$diferencia;
                    $ref=1;
                }
            }
        }else if( $fecha60 == "" && $fecha30 != ""){
            $diferencia = $fechaActual->diff($fecha30);
            $diferencia= $diferencia->days / 31;            
            if ($diferencia >= 26){
                    //Realizar teste de 5
                    echo 'caso 2 , test 5,diferencia '.$diferencia;
                    $ref=1;
            }
        }else if($fecha30 == "" && $fecha60 != ""){
            $diferencia = $fechaActual->diff($fecha60);
            $diferencia= $diferencia->days / 31; 
            
            if(26 <= $diferencia  && $diferencia <= 34){
                //Realizar teste de 2.5
                echo 'caso 3 , test 2.5,diferencia '.$diferencia;
                $ref=1;
            }else if($diferencia >= 34){
                //Realizar teste de 5
                echo 'caso 3 , test 5,diferencia '.$diferencia;
                $ref=1;
            }
        }else if($fecha30 == "" && $fecha60 == "" &&  $fechaManufactura != "" ){
            $diferencia = $fechaActual->diff($fechaManufactura);
            $diferencia= $diferencia->days / 31;             
            If (26 <= $diferencia && $diferencia <= 34){
                //Realizar teste de 2.5
                echo 'caso 4 , test 2.5,diferencia '.$diferencia;
                $ref=1;
            }
            if ($diferencia > 34){
                //Realizar teste de 5
                echo 'caso 4 , test 5,diferencia '.$diferencia;
                $ref=1;
            }
        }
        if($ref==0){
            echo 'No fue posible calcular el test o no necesita realizar test, Diferencia:'.$diferencia;
        }
    }


}