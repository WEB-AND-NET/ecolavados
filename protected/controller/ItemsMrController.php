<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ItemsMrController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["201"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }
    public function getGuideLineDamage(){
        return  Doo::db()->query("SELECT gui.id,da.id as id_damage,guideline,code,da.damage FROM mr_guideline gui 
        INNER JOIN mr_damages da on (gui.damage=da.id) where gui.deleted=1 and da.deleted=1;")->fetchAll();
    }
    public function index(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;        
        $this->data['items'] = $this->getGuideLineDamage();
        $this->data['content'] = 'items_mr/list.php';
        $this->renderc('index', $this->data, true);
    }



    public function add() {
        Doo::loadModel("MrGuideline");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['items'] = new MrGuideline();
        $this->data['damages'] = Doo::db()->find("MrDamages",array("where"=>"deleted=1"));
        $this->data['content'] = 'items_mr/form.php';
        $this->renderc('index', $this->data, true);
    }


    public function edit(){
        $id = $this->params["id"];
        Doo::loadModel("MrGuideline");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['items'] = Doo::db()->find("MrGuideline",array("where"=>"id = ? and deleted=1","limit"=>1,"param"=>array($id)));
        $this->data['damages'] = Doo::db()->find("MrDamages",array("where"=>"deleted=1"));
        $this->data['content'] = 'items_mr/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function save() {        
        Doo::loadModel("MrGuideline");
        Doo::loadModel("MrGuidelineItems");
        $Items = new MrGuideline($_POST);        
        if($Items->id==""){
            $Items->id=NULL;
            $Items->id=Doo::db()->insert($Items);         
        }else{
            Doo::db()->query("UPDATE mr_guideline_items SET deleted='0' where guideline='$Items->id' ");
            Doo::db()->update($Items);
        }        
        if(isset($_POST["services"])){
            if($_POST["services"]){
                foreach($_POST["services"] as $id_service){
                    $mrGuidelineItems = new MrGuidelineItems();
                    $mrGuidelineItems->guideline = $Items->id;
                    $mrGuidelineItems->items = $id_service;
                    Doo::db()->insert($mrGuidelineItems);
                }
            }
        } 
        return Doo::conf()->APP_URL . 'items/mr/'; 
    }

    public function getCode(){
        if(isset($_POST["code"])){
            $code = $_POST["code"];
            $item = Doo::db()->find("MrGuideline",array("where"=>"code = ? and deleted=1","limit"=>1,"param"=>array($code)));
            
            echo json_encode($item);
        }
    }  

    public function getGuidelineItems(){
        if(isset($_POST["id"])){
            $id = $_POST["id"];
            $item = Doo::db()->query("SELECT id,mr from mr_items where id in(select items from mr_guideline_items where guideline='$id' and deleted='1' ) and deleted='1'")->fetchAll();
            echo json_encode($item);
        }
    }


    
  

    public function  damageIndex(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;        
        $this->data['content'] = 'items_mr/damages.php';
        $this->renderc('index', $this->data, true);
    }

    public function getDamages(){
        $items = Doo::db()->find("MrDamages",array("where"=>"deleted=1"));
        echo json_encode(array("data"=>$items));
    }

    public function saveDamages() {        
        Doo::loadModel("MrDamages");
        $damages = new MrDamages($_POST);        
        if($damages->id==""){
            $damages->id=NULL;
            $damages->id=Doo::db()->insert($damages);         
        }else{
            Doo::db()->update($damages);
        }
        echo json_encode($damages->id);
    }

    public function deleteDamages() {   
        $id = $_POST["id"];
        Doo::db()->query("delete from mr_damages where id = '$id'");
        echo json_encode(array("success"=>true));
    }
    public function  servicesIndex(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;        
        $this->data['content'] = 'items_mr/services.php';
        $this->renderc('index', $this->data, true);
    }

    public function saveServices() {        
        Doo::loadModel("MrItems");
        $services = new MrItems($_POST);        
        if($services->id==""){
            $services->id=NULL;
            $services->id=Doo::db()->insert($services);                       
        }else{
            
            Doo::db()->damages($services);
        }
        
        echo json_encode($damages->id);
    }

    public function getServices(){
        $items = Doo::db()->find("MrItems",array("where"=>"deleted=1"));
        echo json_encode(array("data"=>$items));
    }
    public function getService (){
        if(isset($_REQUEST["search"])){
            $param=$_REQUEST["search"];
            $json["item"] = Doo::db()->query("SELECT id,mr  FROM mr_items WHERE code  LIKE '%$param%'  ")->fetchAll();
            echo json_encode($json);
        }
    }
    





}

?>