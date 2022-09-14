<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class PaquetesController extends DooController {

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


    public function index() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT  p.id,p.nombre,p.precio,c.nombre as cliente   
        FROM paquetes p  INNER JOIN clientes c on c.id=p.clientes_id WHERE p.deleted='1'";
        $this->data['paquetes'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'paquetes/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        if (isset($_SESSION["items_pack"])) {
            $_SESSION["items_pack"]=null;
        } 
        Doo::loadModel("Paquetes");
        $login = $_SESSION['login'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['paquetes'] = new Paquetes();
        $this->data["ClientesProductosPaquetes"] = "N";   
        $sql = "SELECT p.id,p.nombre,p.cantidad,tp.tipo as tipo, um.nombre unidad_medida FROM productos p
        INNER JOIN tipos_productos tp on (tp.id=p.tipo)
        INNER JOIN unidades_medida um on(um.id=p.unidad_medida)
        WHERE p.deleted=1 and p.tipo != 9 ORDER BY nombre ASC";
        $this->data['productos'] = Doo::db()->query($sql)->fetchAll();
        //$this->data['productos'] = Doo::db()->find("Productos",array("where"=>"deleted=1 and tipo != 9"));

        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
        $this->data['content'] = 'paquetes/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function edit() {
        if (isset($_SESSION["items_pack"]) || isset($_SESSION["eliminar"]) ) {
            $_SESSION["items_pack"]=null;
            $_SESSION['eliminar']=null;
        } 
        $id = $this->params["id"];
        $ClientesProductosPaquetes = Doo::db()->query("SELECT id_paquete FROM clientes_productos_paquetes  where id_paquete='$id';")->fetch();
        if($ClientesProductosPaquetes){
            $this->data["ClientesProductosPaquetes"] = $ClientesProductosPaquetes["id_paquete"];
        }else{
            $this->data["ClientesProductosPaquetes"] = "N";
        }
        Doo::loadModel("Paquetes");
        $login = $_SESSION['login'];
        $_SESSION["items_pack"]=serialize(Doo::db()->query("select dp.id, p.nombre as productos_name, p.id as productos_id,  dp.cantidad,dp.precio,format(dp.cantidad * dp.precio,2)as total,dp.delete from detalle_paquetes dp inner join productos p on (dp.productos_id=p.id) where  dp.delete='1' and dp.paquetes_id='$id' ")->fetchAll());
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['paquetes'] = Doo::db()->find("Paquetes",array("where"=>"id = ? and deleted=1","limit"=>1,"param"=>array($id)));
        $this->data['productos'] = $sql = "SELECT p.id,p.nombre,p.cantidad,tp.tipo as tipo, um.nombre unidad_medida FROM productos p
        INNER JOIN tipos_productos tp on (tp.id=p.tipo)
        INNER JOIN unidades_medida um on(um.id=p.unidad_medida)
        WHERE p.deleted=1 and p.tipo != 9 ORDER BY nombre ASC";
        $this->data['productos'] = Doo::db()->query($sql)->fetchAll();
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
        $this->data['content'] = 'paquetes/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function productosItem(){
        $id = $_POST["id_paquete"];
        $ClientesProductosPaquetes = Doo::db()->query("SELECT id_clientes_productos FROM clientes_productos_paquetes  where id_paquete='$id';")->fetch();
        echo $ClientesProductosPaquetes["id_clientes_productos"];
    }

    

    public function insert(){ 
        if (isset($_SESSION["items_pack"])) {
            $datos = unserialize($_SESSION["items_pack"]);
        } else {
            $datos = array();
        }
        if(isset($_POST["pindex"])){
            if($_POST["pindex"]){
                $datos[$_POST["pindex"]-1]=$_POST;
            }
        }else{
            $datos[] = $_POST;
        }
        $_SESSION["items_pack"] = serialize($datos);
    }


    public function getItems(){
        if (isset($_SESSION["items_pack"])) {
            $datos = unserialize($_SESSION["items_pack"]);
        } else {
            $datos = array();
        }
        $data=array("data"=>$datos);
        echo json_encode($data);
    }

    public function deleteItem(){
        $index = $_POST["index"];
        if (isset($_SESSION["items_pack"])) {
            $datos = unserialize($_SESSION["items_pack"]);
        } else {
            $datos = array();
        }
        $fila = array_slice($datos, $index , 1);
        $_SESSION['eliminar'][] = $fila;
        array_splice($datos, $index , 1);
        $_SESSION["items_pack"] = serialize($datos);
    }

    public function save(){
        if (isset($_SESSION["items_pack"])) {
            $datos = unserialize($_SESSION["items_pack"]);
        } else {
            $datos = array();
        }
        Doo::loadModel("Paquetes");
        Doo::loadModel("DetallePaquetes");
        Doo::loadModel("ClientesProductosPaquetes");
        $fecha = new DateTime();
        $Paquetes = new Paquetes($_POST);
        if($Paquetes->id==""){
            $Paquetes->id=NULL; 
            $Paquetes->create_at =$fecha->format('Y-m-d H:i:s');
            $Paquetes->update_at = $fecha->format('Y-m-d H:i:s');
            $Paquetes->id=Doo::db()->insert($Paquetes);
            foreach($datos as $PaquetesCliente){
                $DetallePaquetes = new DetallePaquetes();
                $DetallePaquetes->paquetes_id=$Paquetes->id;
                $DetallePaquetes->cantidad=$PaquetesCliente["cantidad"];
                $DetallePaquetes->productos_id=$PaquetesCliente["productos_id"];
                $DetallePaquetes->precio=$PaquetesCliente["precio"];
                $DetallePaquetes->paquetes_id=$Paquetes->id;
                $DetallePaquetes->created_at =$fecha->format('Y-m-d H:i:s');
                $DetallePaquetes->updated_at = $fecha->format('Y-m-d H:i:s');
                Doo::db()->insert($DetallePaquetes);
            }
        }else{
            Doo::db()->update($Paquetes);
            foreach($datos as $PaquetesCliente){
                $DetallePaquetes = new DetallePaquetes();
                $DetallePaquetes->id=$PaquetesCliente['id'];
                $DetallePaquetes->cantidad=$PaquetesCliente["cantidad"];
                $DetallePaquetes->productos_id=$PaquetesCliente["productos_id"];
                $DetallePaquetes->precio=$PaquetesCliente["precio"];
                $DetallePaquetes->paquetes_id=$Paquetes->id;
                $DetallePaquetes->create_at =$fecha->format('Y-m-d H:i:s');
                $DetallePaquetes->update_at = $fecha->format('Y-m-d H:i:s');
                if($DetallePaquetes->id==0){
                    Doo::db()->insert($DetallePaquetes);
                }else{
                    Doo::db()->update($DetallePaquetes);
                }
                
            }
            
            if(isset($_SESSION['eliminar'])){
                foreach($_SESSION['eliminar'] as $detalles){
                    $idproducto= $detalles[0]["productos_id"];
                    Doo::db()->query("update detalle_paquetes dp set dp.delete = '0' where paquetes_id='$Paquetes->id' and productos_id='$idproducto'; ");
                }
            }
        }
        if($_POST["clientes_productos"]){
            if($_POST["clientes_productos"] != "0"){
                $ClientesProductosPaquetes = new ClientesProductosPaquetes();
                $ClientesProductosPaquetes->id_clientes_productos=$_POST["clientes_productos"];
                $ClientesProductosPaquetes->id_paquete=$Paquetes->id;
                $ClientesProductosPaquetes->deleted="1";
                Doo::db()->insert($ClientesProductosPaquetes);
            }
        }



        return Doo::conf()->APP_URL . 'packs'; 
    }

    public function desactivate(){
        $index = $this->params["pindex"];
        Doo::db()->query("update paquetes set deleted='0' where id ='$index';");
        Doo::db()->query("update detalle_paquetes dp set dp.delete='0' where paquetes_id ='$index';");
        return Doo::conf()->APP_URL . 'packs'; 
    }

}