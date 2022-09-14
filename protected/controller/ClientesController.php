<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ClientesController extends DooController {

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
        $login = $_SESSION['login'];
        $rol = $login->role;

        if ($rol != "12" || $rol != "21") {
            $render = 'index_propietarios';
            $id_usuario = "AND id_usuario=$login->id_usuario";
            $tipo = "";
        } else {
            $render = 'index';
            $id_usuario = "";
            $tipo = "AND tipo != 'P'";
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT id,identificacion,nombre,celular,email,tipo FROM clientes WHERE deleted=1 ORDER BY nombre ASC";
        $this->data['clientes'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'clientes/list.php';
        $this->renderc($render, $this->data, true);
    }
    public function check() {
         $render = 'index';
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT c.id,identificacion,celular,email,tipo ,nombre,precio,moneda,c.deleted FROM clientes_productos cp INNER JOIN clientes c ON (c.id=cp.clientes_id and cp.deleted=1) WHERE cp.deleted='1' GROUP BY clientes_id,moneda";
        $this->data['clientes'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'clientes/validate.php';
        $this->renderc($render, $this->data, true);
    }

    public function add() {
        Doo::loadModel("Clientes");
        $login = $_SESSION['login'];
        $rol = $login->role;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['procesos'] = Doo::db()->find("Procesos", array('where' => 'deleted = 1'));
        $this->data['productos'] = Doo::db()->find("Productos",array("where"=>"deleted=1 and tipo = 9 "));
        $this->data['clientes'] = new Clientes();
        $this->data['content'] = 'clientes/from.php';
        $this->renderc('index', $this->data, true);
    }

    
    public function getId() {
        $consecutivo = Doo::db()->query("SELECT cons_cliente FROM parametros")->fetch();
        $consecutivo=$consecutivo["cons_cliente"];
        Doo::db()->query("UPDATE parametros SET cons_cliente=$consecutivo+1 ");
        echo $consecutivo;
    }

    public function edit() {
        $id = $this->params["pindex"];
        $login = $_SESSION['login'];
        $rol = $login->role;
        $this->data['procesos'] = Doo::db()->find("Procesos", array('estado' => 'id = 1', 'param' => array(1)));
        $Clientes = Doo::db()->find("Clientes", array('where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $this->data['productos'] = Doo::db()->find("Productos",array("where"=>"deleted=1 and tipo = 9"));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['clientes'] = $Clientes;
        $this->data['content'] = 'clientes/from.php';
        $this->renderc('index', $this->data, true);
    }

    
    
    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE clientes SET deleted=0 WHERE id=?", array($id));        
        Doo::db()->query("UPDATE usuarios SET deleted=0 WHERE tipo = 'C' AND id_usuario=?", array($id));
        return Doo::conf()->APP_URL . "clientes";
    }

    public function process(){
        $this->data['works'] = Doo::db()->find("Trabajos");
        $this->data["procesos"] = Doo::db()->query("SELECT * FROM procesos where deleted='1';")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'clientes/procesos.php';
        $this->renderc('index', $this->data, true);
    }

    public function save() {
        Doo::loadModel("Clientes");
        $clientes = new Clientes($_POST);
        if ($clientes->id == "") {
            $clientes->id = Null;
        }
        $clientes->deleted = "1";
        $login = $_SESSION['login'];
        $id_usuario = $login->id_usuario;
        $rol = $login->role;
        if ($clientes->id == Null) {
            $clientes->tipo='C';
            $clientes->created_at = date('Y-m-d H:i:s');
            $clientes->updated_at = date('Y-m-d H:i:s');           
            $clientes->password = md5($clientes->identificacion);
            $clientes->id = Doo::db()->Insert($clientes);
        } else {
            $clientes->updated_at = date('Y-m-d H:i:s');
            Doo::db()->Update($clientes);
        }       
        return Doo::conf()->APP_URL . "clientes";
    }

    public function saveProcess(){
        Doo::loadModel("TrabajosProcesos");
        $TrabajosProcesos = new TrabajosProcesos($_POST);
        Doo::db()->insert($TrabajosProcesos);
    }
    public function deleteProcess(){
        $id_trabajo=$_POST["id_trabajo"];
        $id_proceso=$_POST["id_proceso"];
        Doo::db()->query("DELETE FROM trabajos_procesos WHERE id_trabajo='$id_trabajo' and id_proceso='$id_proceso'");
    }
    public function trabajosprocesos(){
        $json = Doo::db()->query("SELECT * FROM trabajos_procesos")->fetchAll();
        echo json_encode($json);
    }

    public function getContents(){
        if(isset($_REQUEST["search"])){
            $param=$_REQUEST["search"];
            $json["item"] = Doo::db()->query("SELECT id,nombre  FROM productos WHERE nombre  LIKE '%$param%'  and deleted=1 and tipo = 9  or tipo =11 or tipo =12 or tipo =7  ")->fetchAll();
            echo json_encode($json);
        }
    }

    public function addProductos(){
        Doo::loadModel("Productos");
        $productos = new Productos($_POST);
        $productos->create_at = date('Y-m-d H:i:s');
        $productos->update_at = date('Y-m-d H:i:s');   
        $productos->tipo='9';
        $productos->cantidad='0';
        $productos->precio_compra='0';
        Doo::db()->insert($productos);
    }

    public function getProductos(){  
        $id_cliente = $_GET["id_cliente"];
        $datos = Doo::db()->query("SELECT  g.name,ps.description,cp.id,p.nombre as service,ps.nombre as content,precio,dias_libre,moneda,cp.invoice_always from clientes_productos cp
        inner join clientes c on (c.id=cp.clientes_id)
        inner join procesos p on (p.id=cp.servicio_id) 
        
        inner join productos ps on(ps.id=cp.productos_id)
        left join grupos g on (g.id=ps.grupo) 
        where cp.deleted='1' and clientes_id='$id_cliente' order by cp.id asc")->fetchAll();
        $data=array("data"=>$datos);
        echo json_encode($data);
    }

    public function getItem(){
        $id = $_POST["id"];
        $datos = Doo::db()->query("SELECT cp.id,p.id as id_proceso,p.nombre as service,ps.nombre as content,precio,dias_libre,moneda,cp.invoice_always from clientes_productos cp
        inner join clientes c on (c.id=cp.clientes_id)
        inner join procesos p on (p.id=cp.servicio_id) 
        inner join productos ps on(ps.id=cp.productos_id)
        where cp.deleted='1' and cp.id='$id'")->fetch();
        echo json_encode($datos);
    }

    public function saveClientsProducts(){
        Doo::loadModel("ClientesProductos");
        $ClientesProductos = new ClientesProductos($_POST);
        Doo::db()->insert($ClientesProductos);
    }

    public function updateClientsProducts(){
        Doo::loadModel("ClientesProductos");
        $ClientesProductos = new ClientesProductos($_POST);
        Doo::db()->update($ClientesProductos);
        echo 'update';
    }

    public function deleteItem(){
        $id=$_POST["id"];
        Doo::db()->query("UPDATE clientes_productos set deleted='0' WHERE id='$id'");
    }

    public function validar(){
        $tipo=$_POST["tipo"];
        $ced=$_POST["ced"];
        $id=$_POST["id"];
        $exist= Doo::db()->query("SELECT * FROM clientes WHERE identificacion='$ced';")->fetch();
        if($exist){
            echo "true";
        }else{  
            echo "false";
        }        
    }
    
    public function emailSave(){
        foreach($_POST as $key => $value){
            Doo::db()->query("update action_email_clients set email='$value' where id='$key'");
        }
        return Doo::conf()->APP_URL . "clientes";
    }
    
    public function emailIndex(){
        Doo::loadModel("ActionEmailClients");
        $id_client = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'clientes/email.php';
        $verify=Doo::db()->query("SELECT ae.id,ae.action,email,aec.id as idaec  FROM action_email ae LEFT JOIN action_email_clients aec on (ae.id=aec.id_action_email and aec.id_client='$id_client')")->fetchAll();
        foreach($verify as $very){
            if($very["idaec"]==""){
                $ActionEmailClients = new ActionEmailClients();
                $ActionEmailClients->id_action_email=$very["id"];
                $ActionEmailClients->id_client= $id_client;
                Doo::db()->insert($ActionEmailClients);
            }
            
        }
        $this->data["action"]=Doo::db()->query("SELECT ae.id,ae.action,email,aec.id as idaec  FROM action_email ae LEFT JOIN action_email_clients aec on (ae.id=aec.id_action_email and aec.id_client='$id_client')")->fetchAll();
        
        $this->renderc('index', $this->data, true);
    }
   public function invoices(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT id,identificacion,nombre,celular,email,tipo FROM clientes WHERE deleted=1 ORDER BY nombre ASC";
        $this->data['clientes'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'entradas/associate_clients.php';
        $this->renderc('index', $this->data, true);
    }

        public function invoicesAssociate(){
            Doo::loadClass("pdf/fpdf");
            Doo::loadClass("reportes/InvoiceClient");
            $pdf = new InvoiceClient();
            Doo::loadController("EntrysController");
            Doo::loadModel("ItemsFacturas");
            $entrys =  new EntrysController();
            $list;
            $id_cliente=$this->params["pindex"];
            $date=$this->params["date"];
            $type = $this->params["type"];
            $request=Doo::db()->query("SELECT  t.serial,date( r.created_at) as expedicion,e.id as entrada,r.id,r.descripcion,r.state,c.nombre,sum(rie.precio) as total,c.identificacion
            FROM request r
            INNER JOIN entrada e  on (e.id=r.id_entrada) 
            INNER JOIN autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
            INNER JOIN tanques t ON (t.id=ai.tanques_id)
            INNER JOIN clientes c ON (c.id=r.cliente_id)
            INNER JOIN request_item_entrada  rie on (rie.id_request=r.id)
            WHERE r.deleted='1'  and c.id='$id_cliente'")->fetch();
            $productos=null;
            $invoice_always=null;
            $paquetes=null;

            if($type=='C'){
                $sql="SELECT e.id,t.serial,date(now()) as fecha FROM entrada e
                INNER  JOIN status s ON (s.id=e.status)
                INNER JOIN autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id)
                INNER JOIN tanques  t on (t.id=ai.tanques_id)
                INNER JOIN clientes  c on (c.id=ai.clientes_id)
                LEFT  JOIN items_entrada ie  on (ie.id_entrada=e.id  and ie.causes_log='S')
                left JOIN  items it ON (ie.items_id = it.id) where  ai.clientes_id='$id_cliente' and
                e.estado='A' group by e.id order by e.fecha ; ";
                
            }else{
                 $sql="SELECT e.id, t.serial,DATE_SUB(s.fecha_salida , INTERVAL 1 DAY) as fecha
                    from salida s
                    INNER join tanques t on (t.id=s.id_tanque) 
                    INNER join entrada e on (e.id=s.id_entrada)
                    INNER join autorizacion_ingreso ai on (ai.id=s.id_autorizacion)
                    INNER JOIN clientes  c on (c.id=ai.clientes_id) where  ai.clientes_id='$id_cliente'
                    AND month(s.fecha_salida)=month('$date') AND  year(s.fecha_salida)=year('$date')";
            }
            
            

           


/**/

            $entradas= Doo::db()->query($sql)->fetchAll();
            foreach($entradas as $entrada){
               $entrys->registerStorage($entrys->storage($entrada["id"],$entrada["fecha"]),$entrada["id"]);

                $r = $entrys->productos($entrada["id"]);
                if($r){
                    $entrys->registerProducto($r,$entrada["id"]);
                }
                $r = $entrys->invoice_always($entrada["id"]);
    
                if($r){
                    $entrys->registerAlways($r,$entrada["id"]);
                }
                $r = $entrys->paquetes($entrada["id"]);
                if($r){
                    $entrys->registerPaquete($r,$entrada["id"]);
                }
            }
            $list=array();
           foreach($entradas as $entrada){
              $entrada["items"]=Doo::db()->query("SELECT * FROM items_facturas where id_entrada='$entrada[id]'
              and month(minimo)=month('$date') and  year(minimo)=year('$date') or   n_facture<=>null and   id_entrada='$entrada[id]' or n_facture='' and id_entrada='$entrada[id]' ")->fetchAll();  
              $list[]=$entrada;
            }
            
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->body($request,$list);
            $pdf->Output();
        }
   
   
}
