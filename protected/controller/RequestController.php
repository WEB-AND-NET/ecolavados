<?php 

class RequestController extends DooController {
    public function beforeRun($resource, $action) {
        if($action != "authorize"){
            if (!isset($_SESSION['login'])) {
                return Doo::conf()->APP_URL;
            }

            if (!isset($_SESSION['permisos'])) {
                return Doo::conf()->APP_URL;
            } else {
            
            }
        }
        
    }

    public function index(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['request'] = Doo::db()->query("SELECT e.id as entrada,r.id,r.descripcion,r.state,c.nombre,t.serial
        FROM request r
        INNER JOIN entrada e  on (e.id=r.id_entrada) 
        inner join autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        inner join tanques t on (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=r.cliente_id)
        WHERE r.deleted='1';")->fetchAll();
        $this->data['content'] = 'request/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function add(){
        Doo::loadModel("Request");
        Doo::loadController("ItemsMrController");
        $itemsMrController = new ItemsMrController();
        if (isset($_SESSION["DetailsRequest"])) {
            $_SESSION["DetailsRequest"]=null;
        }         
        $this->data['damages'] = $itemsMrController->getGuideLineDamage();
        $this->data["request"] = new Request();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
        $this->data["areas"] = Doo::db()->query("SELECT * FROM items WHERE principal = 'N'AND depende='N' 
        AND editable = 'N' AND is_item_area = 'N' AND is_area = 'S' AND deleted='1' order by item_order;")->fetchAll();
        $this->data['content'] = 'request/form.php';
        $this->renderc('index', $this->data, true);
    }


    public function getAllRequest() {
        $request = Doo::db()->query("SELECT e.id as entrada,r.id,r.descripcion,r.state,c.nombre,t.serial
        FROM request r
        INNER JOIN entrada e  on (e.id=r.id_entrada) 
        inner join autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        inner join tanques t on (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=r.cliente_id)
        WHERE r.deleted='1';")->fetchAll();
        echo json_encode($request);
    }

    public function indexRequest(){
        $login = $_SESSION['login'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['request'] = Doo::db()->query("SELECT e.id as entrada,r.id,r.descripcion,r.state,c.nombre,t.serial
        FROM request r
        INNER JOIN entrada e  on (e.id=r.id_entrada) 
        inner join autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        inner join tanques t on (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=r.cliente_id)
        WHERE r.deleted='1' and c.id='$login->id_usuario' ")->fetchAll();
        $this->data['content'] = 'request/listClient.php';
        $this->renderc('index', $this->data, true);
    }

    public function saveWorkOrder(){
        $valor=$_POST["val"];
        $id = $_POST["id"];
        Doo::db()->query("UPDATE request_item_entrada set work_order='$valor' where id='$id'");
    }

    public function approve(){
        $id  = $this->params["id"];
        $this->data["url"]  = $this->params["url"];
        $this->data["request"]=  $this->request($id);
        $this->data["id"]=$id;
        $this->data["productos"] = $this->productos($id);
        $this->data["paquetes"] = $this->paquetes($id);
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'request/aprobar.php';
        $this->renderc('index', $this->data, true); 
    }
    public function saveApprove(){
        Doo::loadModel("Movimientos");
        Doo::loadModel("Notificaciones");
        $Notificaciones = new Notificaciones();
        $id=$_POST["id"];
       
        $url=$_POST["url"];
        $paquetes = $this->paquetes($id);
        $productos=$this->productos($id);
        $request =   $this->request($id);
        foreach($productos as $producto){
            if($producto["tipo"] < 9){
                $Productos = Doo::db()->find("Productos",array("where"=>"id = ?","limit"=>1,"param"=>array($producto["id_producto"])));
                $Movimientos = new Movimientos();
                $Movimientos->update_at = date('Y-m-d H:i:s');
                $Movimientos->tipo = 'D';
                $Movimientos->cantidad =$producto["cantidad"];
                $Movimientos->precio = $producto["precio"];
                $Movimientos->productos_id = $producto["id_producto"];
                $Movimientos->details="Se ha utilizado $Productos->nombre en el tanque $request[serial], con la entrada #$request[entrada], y el request #$request[id]";
                Doo::db()->insert($Movimientos);
                $total = $Productos->cantidad - 1;
                $Productos->cantidad = $total;
                Doo::db()->update($Productos);
           }
            
        }

        foreach($paquetes as $paquete){
            $packDetails = $this->packDetails($paquete["id_paquete"]);
            foreach($packDetails as $pd){
                $Productos = Doo::db()->find("Productos",array("where"=>"id = ?","limit"=>1,"param"=>array($pd["id_producto"])));
                if($Productos->tipo < 9){
                    $Movimientos = new Movimientos();
                    $Movimientos->update_at = date('Y-m-d H:i:s');
                    $Movimientos->tipo = 'D';
                    $Movimientos->cantidad = $pd["cantidad"];
                    $Movimientos->precio = $pd["precio"];
                    $Movimientos->productos_id = $pd["id_producto"];
                    $Movimientos->details="Se ha utilizado $Productos->nombre en el paquete $paquete[nombre], utilizado el tanque $request[serial], con la entrada #$request[entrada], y el request #$request[id]";
                    Doo::db()->insert($Movimientos);
                    $total = $Productos->cantidad - $pd["cantidad"];
                    $Productos->cantidad = $total;
                    Doo::db()->update($Productos);
                }
            }
        }
        Doo::db()->query("UPDATE request SET state='A' WHERE id='$id'");
        return Doo::conf()->APP_URL . "$url";
    }

    public function packDetails($packId){
        return Doo::db()->query("SELECT pro.id as id_producto, dp.cantidad,dp.precio,p.id,p.nombre,pro.nombre as detail,dp.delete FROM paquetes p 
            INNER JOIN detalle_paquetes dp ON(p.id=dp.paquetes_id) 
            INNER JOIN productos  pro ON (pro.id=dp.productos_id)
            WHERE p.id='$packId' and dp.delete='1'")->fetchAll();
    }   
    public function not(){
        $id=$this->params["id"];
        $url=$this->params["url"];
        Doo::db()->query("UPDATE request SET state='N' WHERE id='$id'");
        return Doo::conf()->APP_URL . "$url";
    }

    public function save(){
        Doo::loadModel("Request");
        Doo::loadModel("RequestItems");
        Doo::loadModel("RequestItemEntrada");
        Doo::loadModel("RequestLog");
        $RequestLog = new RequestLog($_POST);
        $Request = new Request($_POST);
        $fecha = new DateTime();
        if (isset($_SESSION["DetailsRequest"])) {
            $datos = unserialize($_SESSION["DetailsRequest"]);
        } else {
            $datos = array();
        }
        $Request->updated_at = $fecha->format('Y-m-d H:i:s');
        if($Request->id==""){
            $Request->id=NULL;
            $Request->descripcion=$_POST["invoice_description"];
            $Request->cliente_id=$_POST["clientes_id"];
            $Request->state="P";
            $Request->created_at =$fecha->format('Y-m-d H:i:s'); 
            $Request->id = Doo::db()->insert($Request);

        }else{
            $Request->descripcion=$_POST["descripcion"];
            Doo::db()->update($Request);
        }
            $i=0;
        foreach($datos as $detailsRequest){
            $idr=$detailsRequest["id_request"];
            $RequestItem = new RequestItems($detailsRequest);
            if($detailsRequest["id_request"]==""){    
                $RequestItem->id_request = $Request->id;
                $RequestItem->id=Doo::db()->insert($RequestItem);
                $idr=$RequestItem->id;
            }
            if(isset($_FILES["img$i"])){
                Doo::loadHelper('DooGdImage');
                $gd   = new DooGdImage(Doo::conf()->IMG_REQUEST);
                $file = $gd->uploadImage("img$i", "img_".$idr);
                $RequestItem->id = $idr;
                $RequestItem->img=$file;
                Doo::db()->update($RequestItemEntrada);
            }
            $i++;
        }
        $RL = Doo::db()->find("RequestLog",array("where"=>"id_request = ?","limit"=>1,"param"=>array($Request->id)));
        if(!$RL){
            $RequestLog->id_request=$Request->id;
            $RequestLog->id=NULL;
            Doo::db()->insert($RequestLog);
        }else{
            $RequestLog->id=$RL->id;
            Doo::db()->update($RequestLog);
        }

        if(isset($_SESSION['eliminar'])){
            foreach($_SESSION['eliminar'] as $detalles){        
             $id_item_entrada= $detalles[0]["request_id"];    
             if($id_item_entrada!=""){
                Doo::db()->query("delete from request_items where id='$id_item_entrada'");
             }                
                
            }
        }
        if(isset($_FILES["img"])){
            Doo::loadHelper('DooGdImage');
            $gd   = new DooGdImage(Doo::conf()->IMG_REQUEST);
            $file = $gd->uploadImage('img', "img_".$Request->id);
             $Request->img=$file;
            Doo::db()->update($Request);
        }

       $this->generarPdf("$Request->id");
      // $this->sendEmailRequest($RequestLog,$Request);
       
       return Doo::conf()->APP_URL . "request";
    }

    public function generarPdf($id){
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/RequestPDF");
        $pdf = new RequestPDF();
        $request = $this->request($id);
        $productos = $this->productos($id);
        $paquete = $this->paquetes($id);
     
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($request,$productos,$paquete);
        $pdf->Output('global/docs/request/request_' . sprintf("%010d", $id) . '.pdf', 'F');
    }

    public function getRequest(){
        $id =$_POST["id_request"];
        echo json_encode($this->request($id));
    }
    public function request($id){
        return Doo::db()->query("SELECT e.fecha,ai.type,r.labour_rate,rie.cantidad,r.img, rl.invoice_description, rl.email_subject,rl.email_body, c.id as id_cliente, t.serial,date( r.created_at) as expedicion,e.id as entrada,r.id,r.descripcion,r.state,c.nombre,sum(rie.cantidad*rie.precio) as total,c.identificacion
        FROM request r
        INNER JOIN entrada e  on (e.id=r.id_entrada) 
        INNER JOIN autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
		INNER JOIN tanques t ON (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=r.cliente_id)
        INNER JOIN request_item_entrada  rie on (rie.id_request=r.id)
        INNER JOIN request_log rl on (r.id=rl.id_request)
        WHERE r.deleted='1' and  r.id='$id';")->fetch();
    }
    public function productos($id){
        return Doo::db()->query("SELECT rie.cantidad,rie.img, r.id as id_request, rie.type,rie.id_item_entrada,rie.id_item_repair, p.tipo, p.id as id_producto,  rie.work_order,rie.id,it.descripcion,i.descripcion,ie.valor,p.nombre,rie.precio,work_order,pr.nombre  as proceso
        FROM request_item_entrada rie
        LEFT JOIN  items_entrada ie ON(ie.id=rie.id_item_entrada)
        LEFT JOIN items i ON (i.id=ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        INNER JOIN clientes_productos cp on (cp.id=rie.id_item_repair and rie.type='PRO')
        INNER JOIN productos p on(p.id=cp.productos_id )
        INNER JOIN procesos pr on (pr.id=cp.servicio_id)
        INNER JOIN request r ON (r.id=rie.id_request) AND  rie.id_request='$id';")->fetchAll();
    }
    public function paquetes($id){
        return  Doo::db()->query("SELECT rie.cantidad,rie.img, r.id as id_request,rie.type,rie.id_item_entrada,rie.id_item_repair,cp.id as id_paquete,rie.work_order,rie.id, it.descripcion,i.descripcion,ie.valor,rie.precio,work_order,cp.nombre
        FROM request_item_entrada rie
        LEFT JOIN  items_entrada ie ON(ie.id=rie.id_item_entrada)
        LEFT JOIN items i ON (i.id=ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        LEFT JOIN paquetes cp on (cp.id=rie.id_item_repair and rie.type='PAC')
        INNER JOIN detalle_paquetes dp ON(cp.id=dp.paquetes_id) 
        INNER JOIN productos  pro ON (pro.id=dp.productos_id)
        INNER JOIN request r ON (r.id=rie.id_request) AND  rie.id_request='$id' group by rie.id ;")->fetchAll();
    }

    public function edit(){
        $id= $this->params["pindex"];
        Doo::loadModel("Request");
        if (isset($_SESSION["DetailsRequest"])) {
            $_SESSION["DetailsRequest"]=null;
        } 
        if (isset($_SESSION["eliminar"])) {
            $_SESSION["eliminar"]=null;
        }
      
        if (isset($_SESSION["DetailsRequest"])) {
            $datos = unserialize($_SESSION["DetailsRequest"]);
        } else {
            $datos = array();
        }
      
        $this->data["request"] = Doo::db()->find("Request",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $productos = $this->productos($id);
        foreach($productos as $producto){
            $object = Doo::db()->query("SELECT cp.id, concat('Services: ',pr.nombre ,', Purpose of contract: ',p.nombre)as nombre ,concat('Services: ',pr.nombre ,', Purpose of contract: ',p.nombre)as detail ,p.precio_compra,cp.precio  
            FROM clientes_productos cp
            INNER JOIN  productos p on(p.id=cp.productos_id)
            INNER JOIN procesos pr on (pr.id=cp.servicio_id) where cp.id='$producto[id_item_repair]';")->fetch();
            if($producto["id_item_entrada"]==0){
                 $array = array(
                    "request_id"=>$producto["id"],
                    "id_damage"=>0,
                    "sesion"=>"General",
                    "part"=>"General",
                    "calification"=>"General",
                    "id_item_repair"=>$object["id"],
                    "name_item_repair"=>$object["nombre"],
                    "precio_item_repair"=>$object["precio"],
                    "detail_item_repair"=>$object["detail"],
                    "type_item_repair"=>$producto["type"],
                    "cantidad"=>$producto["cantidad"]
                );
            }else{
                $damageDetail = Doo::db()->query("SELECT ie.id,it.descripcion as sesion,i.descripcion,ie.valor FROM items_entrada ie
                INNER JOIN items i on (i.id=ie.items_id)
                LEFT JOIN  items it ON (it.id = i.depende)
                where ie.id='$producto[id_item_entrada]';")->fetch();
                $array = array(
                    "request_id"=>$producto["id"],
                    "id_damage"=>$damageDetail["id"],
                    "sesion"=>$damageDetail["sesion"],
                    "part"=>$damageDetail["descripcion"],
                    "calification"=>$damageDetail["valor"],
                    "id_item_repair"=>$object["id"],
                    "name_item_repair"=>$object["nombre"],
                    "precio_item_repair"=>$object["precio"],
                    "detail_item_repair"=>$object["detail"],
                    "type_item_repair"=>$producto["type"],
                    "cantidad"=>$producto["cantidad"]
                );
            }
           
            $datos[] = $array;
        }
        $paquetes = $this->paquetes($id);
        foreach($paquetes as $paquete){
            $object= Doo::db()->query("SELECT p.id,p.nombre,p.precio,group_concat(pro.nombre) as detail FROM paquetes p 
            INNER JOIN detalle_paquetes dp ON(p.id=dp.paquetes_id) 
            INNER JOIN productos  pro ON (pro.id=dp.productos_id)
            WHERE p.id='$paquete[id_item_repair]' AND dp.delete='1'  GROUP BY p.id")->fetch();
            if($paquete["id_item_entrada"]==0){
                $array = array(
                    "request_id"=>$paquete["id"],
                    "id_damage"=>0,
                    "sesion"=>"General",
                    "part"=>$object["nombre"],
                    "calification"=>"General",
                    "id_item_repair"=>$object["id"],
                    "name_item_repair"=>$object["nombre"],
                    "precio_item_repair"=>$object["precio"],
                    "detail_item_repair"=>$object["detail"],
                    "type_item_repair"=>$paquete["type"],
                    "cantidad"=>$paquete["cantidad"]
                );
            }else{

            }    
            $datos[] = $array;
        }
        $_SESSION["DetailsRequest"] = serialize($datos);
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
        $this->data['content'] = 'request/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function deleteItem(){
        $index = $_POST["index"];
        if (isset($_SESSION["DetailsRequest"])) {
            $datos = unserialize($_SESSION["DetailsRequest"]);
        } else {
            $datos = array();
        }
        $fila = array_slice($datos, $index , 1);
        $_SESSION['eliminar'][] = $fila;
        array_splice($datos, $index , 1);
        $_SESSION["DetailsRequest"] = serialize($datos);
    }

    public function authorize(){       
        Doo::loadController("ItemsController");
        $itemsController = new ItemsController();
        $id = $this->params["id"];
        $current_request = $this->request($id);
        
        $items = array();
        $request_items = Doo::db()->query("select * from request_items where id_request='$id'")->fetchAll();
        foreach ($request_items as $key => $request) {
            $area_name = Doo::db()->query("SELECT descripcion FROM items 
                        WHERE principal = 'N' AND depende='N' AND editable = 'N' AND is_item_area = 'N' AND is_area = 'S' AND deleted='1' and id='$request[id_area]' 
                        order by item_order;")->fetch();

            $area_item_name =  Doo::db()->query("SELECT * FROM items WHERE principal = 'N' AND depende='N' AND editable = 'N' AND is_item_area = 'S' 
            AND is_area = 'N' AND deleted='1' AND id = '$request[id_item_area]'order by item_order;")->fetch(); 

            $services_name = Doo::db()->query("SELECT id,mr from mr_items where id= '$request[id_service]' and deleted='1'")->fetch();

            $damage_code = Doo::db()->find("MrGuideline",array("where"=>"damage = ? and deleted=1","limit"=>1,"param"=>array($request["id_damage"])));
            $items[] = array(                
                "hours"=>$request["hours"],
                "material"=>$request["material"],
                "remarks"=>$request["remarks"],
                "total" => (($request["hours"] * $current_request["labour_rate"]) + $request["material"]),
                "area_name"=>$area_name["descripcion"],
                "area_item_name"=>$area_item_name["descripcion"],
                "services_code"=>$services_name["mr"],
                "damage_code"=>$damage_code->code,
            );
        }
        $this->data['items'] = $items;
        $this->data['request'] = $current_request;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('request/authorize', $this->data, true);
    }
    public function printer(){
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/NewRequestPDF");
        Doo::loadController("ItemsController");
        $itemsController = new ItemsController();
        $pdf = new NewRequestPDF();
        $id = $this->params["id"];
        $request = $this->request($id);
        $productos = $this->productos($id);
        $paquete = $this->paquetes($id);
        $damages = Doo::db()->query("SELECT gui.id,guideline,code,da.damage FROM mr_guideline gui 
        INNER JOIN mr_damages da on (gui.damage=da.id) where gui.deleted=1 and da.deleted=1;")->fetchAll();
        $items = $itemsController->getAreasAndItems();
        
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($request,$productos,$paquete,$damages,$items,$id);
        $pdf->Output('global/docs/request/request_' . $id . '.pdf', 'I' );
    }

    public function insert(){ 
        $labour_rate = $_POST["labour_rate"]; 
        $id_area = $_POST["id_area"]; 
        $id_items_area = $_POST["id_items_area"]; 
        $id_damage = $_POST["id_damage"]; 
        $id_services = $_POST["id_services"]; 
        $hours = $_POST["hours"]; 
        $material  = $_POST["material"]; 
        $remark = $_POST["remark"]; 
    
        $area_name = Doo::db()->query("SELECT descripcion FROM items 
                        WHERE principal = 'N' AND depende='N' AND editable = 'N' AND is_item_area = 'N' AND is_area = 'S' AND deleted='1' and id='$id_area' 
                        order by item_order;")->fetch();
        $area_item_name =  Doo::db()->query("SELECT * FROM items WHERE principal = 'N' AND depende='N' AND editable = 'N' AND is_item_area = 'S' 
        AND is_area = 'N' AND deleted='1' AND id = '$id_items_area'order by item_order;")->fetch(); 
        $services_name = Doo::db()->query("SELECT id,mr from mr_items where id= '$id_services' and deleted='1'")->fetch();
        $damage_code = Doo::db()->find("MrGuideline",array("where"=>"damage = ? and deleted=1","limit"=>1,"param"=>array($id_damage)));
        $array = array(
            "id_request"=>"",
            "id_area"=>$id_area,
            "id_item_area"=>$id_items_area,
            "id_damage"=>$id_damage,
            "id_service"=>$id_services,
            "hours"=>$hours,
            "material"=>$material,
            "remarks"=>$remark,
            "total" => (($hours * $labour_rate) + $material),
            "area_name"=>$area_name["descripcion"],
            "area_item_name"=>$area_item_name["descripcion"],
            "services_code"=>$services_name["mr"],
            "damage_code"=>$damage_code->code,
        );

        if (isset($_SESSION["DetailsRequest"])) {
            $datos = unserialize($_SESSION["DetailsRequest"]);
        } else {
            $datos = array();
        }
        if(isset($_POST["pindex"])){
            if($_POST["pindex"]){
                $datos[$_POST["pindex"]-1]=$array;
            }
        }else{
            $datos[] = $array;
        }
        $_SESSION["DetailsRequest"] = serialize($datos);
        echo json_encode($datos);
    }

    public function getItemsArea(){
        $id=$_POST["id_area"];
        $items = Doo::db()->query("SELECT * FROM items 
            WHERE principal = 'N' AND depende='N' 
            AND editable = 'N' AND is_item_area = 'S' 
            AND is_area = 'N' AND deleted='1' 
            AND area_to_belong = '$id'order by item_order;")->fetchAll();
        echo json_encode($items);
    }

    public function getEntradas(){
        $id=$_POST["id_cliente"];
        $entradas = Doo::db()->query("SELECT e.id,t.serial FROM autorizacion_ingreso ai
        INNER JOIN entrada e on(ai.id=e.autorizacion_ingreso_id)
        INNER JOIN tanques t on (t.id=ai.tanques_id)  where ai.state='T' AND e.estado='A'  AND ai.clientes_id='$id'")->fetchAll();
        echo Json_encode($entradas);
    }

    public function getEmails(){
        $id=$_POST["id_cliente"];
        $clientes=Doo::db()->query("SELECT email FROM clientes WHERE id='$id';")->fetch();
        echo $clientes["email"];
    }

    public function getItems(){
        $entrada = $_POST["id_entrada"];
        $items= Doo::db()->query("SELECT ie.id,concat(i.descripcion,'-',ie.valor) as damage FROM entrada e 
        INNER  JOIN status s on (s.id=e.status)
        INNER  JOIN items_entrada ie  on (ie.id_entrada=e.id)
        INNER JOIN autorizacion_ingreso ai on  (ai.id=e.autorizacion_ingreso_id)
        INNER JOIN tanques  t on (t.id=ai.tanques_id)
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
        LEFT JOIN programacion  p on (p.id_entrada=e.id)
        INNER JOIN items i ON (i.id = ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        INNER JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'B' AND ca.causes_log='S')
        where e.id='$entrada' ")->fetchAll();
        echo Json_encode($items);
    }

    public function getPaquetes(){
        $id=$_POST["id_cliente"];
        $paquetes = Doo::db()->query("SELECT id,nombre,precio FROM paquetes where deleted='1' and clientes_id='$id';")->fetchAll();
        echo Json_encode($paquetes);
    }

    public function getClienteProductos(){
        $id=$_POST["id_cliente"];
        $getClienteProductos = Doo::db()->query("SELECT cp.id,concat('Services: ',pr.nombre ,', Purpose of contract: ',p.nombre)as nombre ,p.precio_compra,cp.precio  FROM clientes_productos cp
                                        INNER JOIN  productos p on(p.id=cp.productos_id)
                                        INNER JOIN procesos pr on (pr.id=cp.servicio_id) where cp.clientes_id='$id';")->fetchAll();
        echo Json_encode($getClienteProductos);
    }

    public function getDetailsRequest(){
        if (isset($_SESSION["DetailsRequest"])) {
            $datos = unserialize($_SESSION["DetailsRequest"]);
        } else {
            $datos = array();
        }
        $data=array("data"=>$datos);
        echo json_encode($data);
    }

    public function changeRequest(){
        $id= $this->params["pindex"]; 
        Doo::loadModel("Request");       
        $request = Doo::db()->find("Request",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));       
        $request->descripcion='TEST-AIRE';
        Doo::db()->update($request);
        Doo::db()->query("update entrada set status='2' where id='$request->id_entrada'");
        return Doo::conf()->APP_URL . "request";
    }

    public function enviar(){
        $id= $this->params["pindex"];
        $RL = Doo::db()->find("RequestLog",array("where"=>"id_request = ?","limit"=>1,"param"=>array($id)));
        if(!$RL){
            Doo::loadModel("RequestLog");  
            $RL= new RequestLog();
        }

        $R = Doo::db()->find("Request",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->sendEmailRequest($RL,$R);
        return Doo::conf()->APP_URL . "request";
    }



    public function sendEmailRequest($email,$body){
        Doo::loadClass("mail/PHPMailer");
        Doo::loadModel("Parametros");
        $param = new Parametros();
        $param=Doo::db()->Find($param,array('limit'=>1));
        
        $mail = new PHPMailer();
        $mail->isSMTP(); 
        $mail->SMTPAuth = true;
        $mail->Host = $param->host;
        $mail->Port = $param->port;
        $mail->SMTPSecure = $param->smtpsecure;
        $mail->Username = $param->username;
        $mail->Password = $param->password;
        
        $mail->SetFrom('operaciones@ecolavados.com.co', 'Operaciones ecolavados-Request');
        $mail->AddReplyTo("operaciones@ecolavados.com.co","Operaciones ecolavados");
        $ent=$body->cliente_id;
        $emails=Doo::db()->query("SELECT email FROM action_email_clients WHERE id_client='$ent' AND id_action_email='2'")->fetch();
        
        $emails = explode(",", $emails["email"]);
        foreach($emails as $emal){
            $mail->AddAddress($emal);
        }
         $mail->AddAddress("mmf19972010@hotmail.com");

        $mail->Subject = $email->email_subject =="" ?  "Information of request" :  $email->email_subject;
        $template =  <<<EOT
           <!DOCTYPE html>
            <html lang="en">
                <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Email</title>
                </head>
            <body style="margin: 0; padding: 0;">
                <center>
                    <div style='width:600px; height:400px; background:#e1efd8; border:solid 1px #000'>
                     <p style='font-family:arial; font-size:20px; margin-top:20px'>REQUEST DETAILS</p>
                   <p>$email->email_body</p>
                </div>
                <center>
            </body>
        </html>
EOT;
    $mail->MsgHTML($template);
    $to = sprintf("%010d",$body->id );
    if(!file_exists('global/docs/request/request_' .$to . '.pdf')){
        Doo::loadModel("Notificaciones");
        $Notificaciones = new Notificaciones();
        $Notificaciones->notificacion="El request '$email->email_body' no se ha enviado con un archivo adjunto por que este no existe. Se genero uno nuevo";
        $Notificaciones->id_entrada=$body->id_entrada;
        Doo::db()->insert($Notificaciones);
        $this->generarPdf($body->id);
    }
    $mail->addAttachment('global/docs/request/request_' .$to . '.pdf');
    //$mail->setFrom('apps@webandnet.us', 'Request');
    $mail->send();      

    }
    

    


}


?>