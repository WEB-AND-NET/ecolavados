<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ItemsController extends DooController {

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

    public function index(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "select i.id,i.descripcion,i.principal,i.depende,it.descripcion as depen from items i 
        left join items it on(it.id=i.depende)
        where i.deleted='1'";
        $this->data['items'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'items/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Items");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['items'] = new Items();
        $sql = "SELECT id,descripcion,principal,depende from items i where i.deleted='1' and principal='S' ";
        $this->data["principales"] = Doo::db()->query($sql)->fetchAll();
        $this->data["areas"] = Doo::db()->query("SELECT * FROM items WHERE principal = 'N' AND depende = 'N' AND editable = 'N' AND is_item_area='N' and is_area='S' AND deleted='1';")->fetchAll();
        $this->data['content'] = 'items/form.php';
        $this->renderc('index', $this->data, true);
    }


    public function edit(){
        $id = $this->params["id"];
        Doo::loadModel("Items");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['items'] =Doo::db()->find("Items",array("where"=>"id = ? and deleted=1","limit"=>1,"param"=>array($id)));
        $sql = "SELECT id,descripcion,principal,depende from items i where i.deleted='1' and principal='S' ";
        $this->data["principales"] = Doo::db()->query($sql)->fetchAll();
        $this->data["areas"] = Doo::db()->query("SELECT * FROM items WHERE principal = 'N' AND depende = 'N' AND editable = 'N' AND is_item_area='N' and is_area='S' AND deleted='1';")->fetchAll();
        $this->data['content'] = 'items/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function save() {
        Doo::loadModel("ItemsCalificaciones");
        Doo::loadModel("Items");
        $Items = new Items($_POST);
        $fecha = new DateTime();
        if($Items->principal=='S' || $Items->is_item_area=='S'){
            $Items->depende='N';
        }
        if($Items->id==""){
            $Items->id=NULL;
            $Items->created_at =$fecha->format('Y-m-d H:i:s');
            $Items->updated_at = $fecha->format('Y-m-d H:i:s');
            $Items->id=Doo::db()->insert($Items);
            if(isset($_POST["tipo"])){
                if($_POST["tipo"]){
                    foreach($_POST["tipo"] as $calificacion){
                        $ItemsCalificaciones =  new ItemsCalificaciones();
                        $ItemsCalificaciones->id_item=$Items->id;
                        $ItemsCalificaciones->id_calificacion=$calificacion;
                        $ItemsCalificaciones->created_at =$fecha->format('Y-m-d H:i:s');
                        $ItemsCalificaciones->updated_at = $fecha->format('Y-m-d H:i:s');
                        Doo::db()->insert($ItemsCalificaciones);
                    }
                }
            }           
        }else{
            Doo::db()->query("UPDATE items_calificaciones SET deleted='0' where id_item='$Items->id' ");
            $Items->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->update($Items);
            if(isset($_POST["tipo"]) ){
                foreach($_POST["tipo"] as $calificacion){
                    $ItemsCalificaciones =  new ItemsCalificaciones();
                    $ItemsCalificaciones->id_item=$Items->id;
                    $ItemsCalificaciones->id_calificacion=$calificacion;
                    $ItemsCalificaciones->created_at =$fecha->format('Y-m-d H:i:s');
                    $ItemsCalificaciones->deleted_at = $fecha->format('Y-m-d H:i:s');
                    Doo::db()->insert($ItemsCalificaciones);
                }
            }
        }
        return Doo::conf()->APP_URL . 'items'; 
    }

    public function getItemsCalificaciones(){
        if(isset($_POST["id"])){
            $id = $_POST["id"];
            $item = Doo::db()->query("SELECT id,descripcion from calificaciones where id in(select id_calificacion from items_calificaciones where id_item='$id' and deleted='1' ) and deleted='1'")->fetchAll();
            echo json_encode($item);
        }
    }

    public function getTipo (){
        if(isset($_REQUEST["search"])){
            $param=$_REQUEST["search"];
            $json["item"] = Doo::db()->query("SELECT id,descripcion  FROM calificaciones WHERE descripcion  LIKE '%$param%'  ")->fetchAll();
            echo json_encode($json);
        }
    }
    public function saveType(){
        $type=$_POST["type"];
        $id=$_POST["id"];
        Doo::db()->query("update calificaciones set goodorbad='$type' where id='$id'");
    }

    public function saveTipo (){
        Doo::loadModel("Calificaciones");
        $Calificaciones = new Calificaciones($_POST);
        $fecha = new DateTime();
        $Calificaciones->created_at =$fecha->format('Y-m-d H:i:s');
        $Calificaciones->update_at = $fecha->format('Y-m-d H:i:s');;
       echo  Doo::db()->insert($Calificaciones);     
    }

    public function ratings(){
        $this->data["calificaciones"] = Doo::db()->query("SELECT * FROM calificaciones where deleted='1';")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'items/ratings.php';
        $this->renderc('index', $this->data, true);
    }

    public function saveRatings(){
        $id =$_POST["id"];
        $calificacio = Doo::db()->query("select * from calificaciones where id='$id'")->fetch();
        if($calificacio["causes_log"]=='S'){
            Doo::db()->query("UPDATE calificaciones SET causes_log='N' where id='$id'");
        }else{
            Doo::db()->query("UPDATE calificaciones SET causes_log='S' where id='$id'");
        }
    }
  

    public function desactivate(){
        $index = $this->params["pindex"];
        Doo::db()->query("update items set deleted='0' where id ='$index';");
        Doo::db()->query("update items_calificaciones dp set dp.deleted='0' where id_item ='$index';");
        return Doo::conf()->APP_URL . 'items'; 
    }

    public function getAreasAndItems(){
        $list = array();
        $areas = Doo::db()->query("SELECT * FROM items 
        WHERE principal = 'N'
        AND depende='N' 
        AND editable = 'N' 
        AND is_item_area = 'N' 
        AND is_area = 'S' 
        AND deleted='1' order by item_order;")->fetchAll();
        foreach($areas as $key => $area){
            $items = Doo::db()->query("SELECT * FROM items 
            WHERE principal = 'N'
            AND depende='N' 
            AND editable = 'N' 
            AND is_item_area = 'S' 
            AND is_area = 'N' 
            AND deleted='1' 
            AND area_to_belong = '$area[id]'order by item_order;")->fetchAll();       
            
                $area["items"] = $items;
                $list[]=$area;
            
        }
        return $list;
    }
}

?>