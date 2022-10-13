<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meri単o Iriarte <carlos.merino.iriarte@gmail.com>
 */
class AuthorizationController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } 
    }


    public function index(){
        $this->authorizaciones();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'autorizaciones/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function loadIndex(){        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
    
        $this->data['content'] = 'autorizaciones/loadExcel.php';
        $this->renderc('index', $this->data, true);
    }
    public function  sendLoad(){
        Doo::loadModel("Tanques");
        Doo::loadModel("AutorizacionIngreso");
        $login = $_SESSION['login'];
        $fecha = new DateTime();
        $id_c = $_POST['id_c'];
        $data =$_POST["data"];        
          
        foreach($data as $d){
            $last_cargo = Doo::db()->query("SELECT p.id,p.nombre FROM clientes_productos cp
            INNER JOIN productos p on (cp.productos_id=p.id) INNER JOIN clientes c ON  (c.id=clientes_id)
            WHERE cp.clientes_id='$id_c' and invoice_always='N' and cp.servicio_id='3' and p.nombre='$d[product]'")->fetch(); 
           
            $tanque=Doo::db()->find("Tanques",array("where"=>"serial = ?","limit"=>1,"param"=>array($d['tank'])));
            if(!$tanque){
                $tanque = new Tanques();
                $tanque->clientes_id=$id_c;
                $tanque->usuarios_id = $login->id;
                $tanque->serial = $d['tank'];
                $tanque->create_at =$fecha->format('Y-m-d H:i:s');
                $tanque->update_at = $fecha->format('Y-m-d H:i:s');
                $tanque->id=Doo::db()->insert($tanque);
            }
            if($last_cargo){
                $tanque->last_cargo=$last_cargo['id'];
                Doo::db()->update($tanque);
            }
            $AutorizacionIngreso =new AutorizacionIngreso();
            $AutorizacionIngreso->fecha_salida=null;   
            $AutorizacionIngreso->tanques_id=$tanque->id;   
            $AutorizacionIngreso->clientes_id=$id_c;      
            $AutorizacionIngreso->create_at =$fecha->format('Y-m-d H:i:s');
            $AutorizacionIngreso->update_at = $fecha->format('Y-m-d H:i:s');
            $AutorizacionIngreso->last_cargo_suggest = $d['product'];
            $AutorizacionIngreso->id=null;
            Doo::db()->insert($AutorizacionIngreso);
        }
    }

    public function authorizaciones(){
        $sql = " SELECT last_cargo_suggest,e.estado,ai.state,e.id as entrada,ai.id,transportista,placa,conductor,fecha_estimada,t.serial,c.nombre as nombre_cliente
        FROM autorizacion_ingreso ai 
        left join entrada e on (e.autorizacion_ingreso_id=ai.id)
        inner join tanques t on (t.id=ai.tanques_id) 
        inner join clientes c on (c.id=ai.clientes_id) 
        where ai.deleted=1 and ai.state != 'T' order by ai.id desc";
        $this->data['autorizaciones'] = Doo::db()->query($sql)->fetchAll();        
    }

    public function indexAuthorized(){
        $this->authorizaciones();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'autorizaciones/listEntry.php';
        $this->renderc('index', $this->data, true);
    }

    public function indexAuthorizedUpdate(){
        $id=$this->params["pindex"]; 
        Doo::db()->query("update autorizacion_ingreso set arrival=now() where id='$id'");
        return Doo::conf()->APP_URL . "authorized";
    }

    public function indexEntry(){
        $login = $_SESSION['login'];
        $rol = $login->role;
        $sql="SELECT c.id,e.estado,ai.state,e.id as entrada,ai.id,transportista,placa,conductor,fecha_estimada,t.serial,c.nombre as nombre_cliente
        FROM autorizacion_ingreso ai 
        left join entrada e on (e.autorizacion_ingreso_id=ai.id)
        inner join tanques t on (t.id=ai.tanques_id) 
        inner join clientes c on (c.id=ai.clientes_id) 
        where c.id=$login->id_usuario and ai.deleted=1 and ai.state != 'T' order by ai.id desc";
        $this->data['autorizaciones'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'autorizaciones/listClient.php'; 
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('index', $this->data);  
    }

    public function add(){
        Doo::loadModel("AutorizacionIngreso");
        $this->data['to'] = "authorization";
        $login = $_SESSION['login'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['autorizaciones'] = new AutorizacionIngreso();
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
        $this->data['content'] = 'autorizaciones/form.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function addEntry(){
        $login = $_SESSION['login'];
        $id_cliente=$login->id_usuario;
        Doo::loadModel("AutorizacionIngreso");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['autorizaciones'] = new AutorizacionIngreso();
        $tanques=Doo::db()->query("SELECT  serial,id,DATE_ADD(test60, interval 60 MONTH) as next60,DATE_ADD(test30, interval 30 MONTH) as next30, TIMESTAMPDIFF( month,date(now()),DATE_ADD(test60, interval 60 MONTH)) as falta60,TIMESTAMPDIFF( month,date(now()),DATE_ADD(test30, interval 30 MONTH)) as falta30 from 
        tanques  where clientes_id='$id_cliente' AND id not in(select tanques_id from autorizacion_ingreso where clientes_id='$id_cliente' and state!='T')and deleted='1'")->fetchAll();
        $this->data["tanques"]=$tanques;
        $this->data['content'] = 'autorizaciones/formClient.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function edit() {
        $pindex=$this->params["id"];
        $this->data['to'] = $this->params["to"];
        Doo::loadModel("AutorizacionIngreso");
        $login = $_SESSION['login'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['autorizaciones'] = Doo::db()->find("AutorizacionIngreso",array("where"=>"id = ?","limit"=>1,"param"=>array($pindex)));
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
        $this->data['content'] = 'autorizaciones/form.php';
        $this->renderc('index', $this->data, true);
    }
    public function editEntry() {
        $login = $_SESSION['login'];
        $id_cliente=$login->id_usuario;
        $pindex=$this->params["id"];
        Doo::loadModel("AutorizacionIngreso");
        $login = $_SESSION['login'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['autorizaciones'] = Doo::db()->find("AutorizacionIngreso",array("where"=>"id = ?","limit"=>1,"param"=>array($pindex)));
        $this->data["clientes"] = Doo::db()->query("select nombre,id from clientes where deleted='1';")->fetchAll();
        $tanques=Doo::db()->query("SELECT serial,id,DATE_ADD(test60, interval 60 MONTH) as next60,DATE_ADD(test30, interval 30 MONTH) as next30, TIMESTAMPDIFF( month,date(now()),DATE_ADD(test60, interval 60 MONTH)) as falta60,TIMESTAMPDIFF( month,date(now()),DATE_ADD(test30, interval 30 MONTH)) as falta30 from 
        tanques where clientes_id='$id_cliente' AND deleted='1'")->fetchAll();
        $this->data["tanques"]=$tanques;
        $this->data['content'] = 'autorizaciones/formClient.php';
        $this->renderc('index', $this->data, true);
    }

    public function getTanque($id,$cliente){
        return Doo::db()->query("SELECT serial,id,DATE_ADD(test60, interval 60 MONTH) as next60,
        DATE_ADD(test30, interval 60 MONTH) as next30, 
        TIMESTAMPDIFF( month,date(now()),DATE_ADD(test60, interval 60 MONTH)) as falta60,
        TIMESTAMPDIFF( month,date(now()),DATE_ADD(test30, interval 60 MONTH)) as falta30,
        test30,test60,make_date
        from 
        tanques where clientes_id='$cliente' AND id='$id'")->fetch();
    }


    public function validateTanques(){
        $fecha30 = $_POST['fecha30'];
        $fecha60 = $_POST['fecha60'];        
        $fechaManufactura= $_POST['fechaManufactura'];
        $this->validate($fecha30,$fecha60,$fechaManufactura);
    }

    public function validate($fecha30,$fecha60,$fechaManufactura){
        $fecha30 = $fecha30=="" ? "": new DateTime($fecha30) ;
        $fecha60 =$fecha60=="" ? "": new DateTime($fecha60) ;
        $fechaActual = new DateTime(date("Y-m-d")); 
        $fechaManufactura=$fechaManufactura=="" ? "": new  DateTime($fechaManufactura);
        $diferencia = 0;
        $response="";
        $ref=0;      
    
        if($fecha30 != "" && $fecha60 != "" ){
            if($fecha60 > $fecha30 ){
                $diferencia = $fechaActual->diff($fecha60);
                $diferencia= $diferencia->days / 31;

                if(26 <= $diferencia  and $diferencia <=34){                    //Realizar teste de 2.5
                    $response= 2;
                    $ref=1;
                }
            
                if($diferencia > 34){
                    //Realizar teste de 5
                    $response= 5;
                    $ref=1;
                }                
            }
            
            if ($fecha60 < $fecha30){
                $diferencia = $fechaActual->diff($fecha30);
                $diferencia= $diferencia->days / 31;
                If ($diferencia >= 26){
                    //Realizar teste de 5
                    $response= 5;
                    $ref=1;
                }
            }
        }else if( $fecha60 == "" && $fecha30 != ""){
            $diferencia = $fechaActual->diff($fecha30);
            $diferencia= $diferencia->days / 31;            
            if ($diferencia >= 26){
                    //Realizar teste de 5
                    $response= 5;
                    $ref=1;
            }
        }else if($fecha30 == "" && $fecha60 != ""){
            $diferencia = $fechaActual->diff($fecha60);
            $diferencia= $diferencia->days / 31; 
            
            if(26 <= $diferencia  && $diferencia <= 34){
                //Realizar teste de 2.5
                $response= 2;
                $ref=1;
            }else if($diferencia >= 34){
                //Realizar teste de 5
                $response= 5;
                $ref=1;
            }
        }else if($fecha30 == "" && $fecha60 == "" &&  $fechaManufactura != "" ){
            $diferencia = $fechaActual->diff($fechaManufactura);
            $diferencia= $diferencia->days / 31;             
            If (26 <= $diferencia && $diferencia <= 34){
                //Realizar teste de 2.5
                $response= 2;
                $ref=1;
            }
            if ($diferencia > 34){
                //Realizar teste de 5
                $response= 5;
                $ref=1;
            }
        }
        if($ref==0){
            $response= 10;
        }
        return $response;
    }

       
    

    public function getTanques(){
        $cliente = $_POST["cliente"];
        if(isset($_POST["idtanque"])){
            $idtanque= $_POST["idtanque"];
            if($_POST["idtanque"]==""){
                $tanques=Doo::db()->query("SELECT serial,id,DATE_ADD(test60, interval 60 MONTH) as next60,
                DATE_ADD(test30, interval 60 MONTH) as next30, 
                TIMESTAMPDIFF( month,date(now()),DATE_ADD(test60, interval 60 MONTH)) as falta60,
                TIMESTAMPDIFF( month,date(now()),DATE_ADD(test30, interval 60 MONTH)) as falta30 from 
                tanques 
                where clientes_id='$cliente' AND id not in(SELECT tanques_id from autorizacion_ingreso ai
                inner join entrada e on (e.autorizacion_ingreso_id=ai.id)
                where clientes_id='$cliente' and state = 'T' and e.estado != 'M') and deleted='1' order by id desc")->fetchAll();
            }else{
                $tanques=Doo::db()->query("select serial,id,DATE_ADD(test60, interval 60 MONTH) as next60,
                DATE_ADD(test30, interval 60 MONTH) as next30, 
                TIMESTAMPDIFF( month,date(now()),DATE_ADD(test60, interval 60 MONTH)) as falta60,
                TIMESTAMPDIFF( month,date(now()),DATE_ADD(test30, interval 60 MONTH)) as falta30 
                from tanques where id='$idtanque' and clientes_id='$cliente' and deleted='1'")->fetchAll();
            }
        }
        
        echo json_encode($tanques);
    }


    public function save(){
        Doo::loadModel("AutorizacionIngreso");
        $AutorizacionIngreso =new AutorizacionIngreso($_POST);
        $fecha = new DateTime();
        if($AutorizacionIngreso->fecha_salida==""){
            $AutorizacionIngreso->fecha_salida=null;
        }
        if($AutorizacionIngreso->id==""){
            $AutorizacionIngreso->create_at =$fecha->format('Y-m-d H:i:s');
            $AutorizacionIngreso->update_at = $fecha->format('Y-m-d H:i:s');
            $AutorizacionIngreso->id=null;
            Doo::db()->insert($AutorizacionIngreso);
            
        }else{
            $AutorizacionIngreso->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->update($AutorizacionIngreso);
           
        }
        return Doo::conf()->APP_URL . "$_POST[to]";
    }
    
    public function saveEntry(){
        Doo::loadModel("AutorizacionIngreso");
        $AutorizacionIngreso =new AutorizacionIngreso($_POST);
        $fecha = new DateTime();
        $login = $_SESSION["login"];

        if($AutorizacionIngreso->id==""){
            $AutorizacionIngreso->create_at =$fecha->format('Y-m-d H:i:s');
            $AutorizacionIngreso->update_at = $fecha->format('Y-m-d H:i:s');
            $AutorizacionIngreso->clientes_id=$login->id_usuario;
            $AutorizacionIngreso->id=null;
            $AutorizacionIngreso->id=Doo::db()->insert($AutorizacionIngreso);
            $data=Doo::db()->query("SELECT c.id,e.estado,ai.state,e.id as entrada,ai.id,transportista,placa,conductor,fecha_estimada,t.serial,c.nombre as nombre_cliente
            FROM autorizacion_ingreso ai 
            left join entrada e on (e.autorizacion_ingreso_id=ai.id)
            inner join tanques t on (t.id=ai.tanques_id) 
            inner join clientes c on (c.id=ai.clientes_id) 
            where ai.id='$AutorizacionIngreso->id'")->fetch();
            $this->sendEmailEntry($data);
        }else{
            $AutorizacionIngreso->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->update($AutorizacionIngreso);
        }
        return Doo::conf()->APP_URL . "entry";
    }

    public function EntrySave(){
        Doo::loadModel("Tanques");
        Doo::loadModel("Entrada");
        Doo::loadModel("Request");
        Doo::loadModel("RequestItemEntrada");
        Doo::loadModel("LogsStatus");
        $placa=$_POST["placa"];
        $transportista=$_POST["transportista"];
        $conductor=$_POST["conductor"];
 
        $RequestItemEntrada = new RequestItemEntrada();
        $entrada =  new Entrada($_POST);
        $tanques = new Tanques($_POST);
        $Request = new Request();
        $LogsStatus = new LogsStatus();
        $entrada->estado='A';
        $tanques->id=$_POST["id_tanque"];
        Doo::db()->update($tanques);
        Doo::db()->update($entrada);
        $conductor = addslashes($conductor);
        Doo::db()->query("update autorizacion_ingreso set placa='$placa',transportista='$transportista',conductor='', state='T' WHERE id='$entrada->autorizacion_ingreso_id'");
        $LogsStatus->id_entrada=$entrada->id;
        $LogsStatus->status=$entrada->status;
        $LogsStatus->cause="Entrada del tanque a ecolavados";
        Doo::db()->insert($LogsStatus);
        $cliente=$_POST['clientes_id'];
        $last = $_POST['last_cargo'];
        $dataInsert= Doo::db()->query("SELECT cp.id as item_repair,precio,c.nombre,p.nombre as producto,pr.nombre,pr.id from clientes_productos cp
        INNER JOIN clientes c on (c.id=cp.clientes_id)
        INNER join productos p on (p.id=cp.productos_id)
        INNER join procesos pr on (pr.id=cp.servicio_id)
        where clientes_id='$cliente' and cp.productos_id='$last';")->fetch();

        
 
        $tanque = $this->getTanque($tanques->id,$_POST["clientes_id"]);
        $autorizaciones= Doo::db()->query("SELECT * FROM autorizacion_ingreso  WHERE id='$entrada->autorizacion_ingreso_id'")->fetch();
        $response = $this->validate($tanque['test30'],$tanque['test60'],$tanque['make_date']);
        $id_entrada = $_POST["id"];
        if($response=="5"){
            $dataInsert60= Doo::db()->query("SELECT * FROM clientes_productos WHERE clientes_id='$_POST[clientes_id]' AND servicio_id='8'")->fetch();
            $test = Doo::db()->query("SELECT * FROM request where id_entrada='$id_entrada' and descripcion='TEST 5';")->fetch();
            if(!$test){            
                $Request60 = new Request();
                $Request60->descripcion='TEST 5';
                $Request60->cliente_id=$_POST["clientes_id"];
                $Request60->id_entrada=$_POST["id"];
                $Request60->created_at = date('Y-m-d H:i:s');
                $Request60->updated_at = date('Y-m-d H:i:s'); 
                $Request60->state='P';
                $Request60->id=Doo::db()->insert($Request60);
                $RequestItemEntrada60 = new RequestItemEntrada();
                $RequestItemEntrada60->id_request=$Request60->id;
                $RequestItemEntrada60->id_item_entrada=0;
                $RequestItemEntrada60->id_item_repair=$dataInsert60["id"];
                $RequestItemEntrada60->precio=$dataInsert60["precio"];
                $RequestItemEntrada60->type="PRO";
                Doo::db()->insert($RequestItemEntrada60);
            }
        }else if($response=="2"){
            $test = Doo::db()->query("SELECT * FROM request where id_entrada='$id_entrada' and descripcion='TEST 2,5';")->fetch();
            if(!$test){ 
                $dataInsert30= Doo::db()->query("SELECT * FROM clientes_productos WHERE clientes_id='$_POST[clientes_id]' AND servicio_id='7'")->fetch();
                $Request30 = new Request();
                $Request30->descripcion='TEST 2,5';
                $Request30->cliente_id=$_POST["clientes_id"];
                $Request30->id_entrada=$_POST["id"];
                $Request30->created_at = date('Y-m-d H:i:s');
                $Request30->updated_at = date('Y-m-d H:i:s'); 
                $Request30->state='P';          
                $Request30->id=Doo::db()->insert($Request30);
                $RequestItemEntrada30 = new RequestItemEntrada();
                $RequestItemEntrada30->id_request=$Request30->id;
                $RequestItemEntrada30->id_item_entrada=0;
                $RequestItemEntrada30->id_item_repair=$dataInsert30["id"];
                $RequestItemEntrada30->precio=$dataInsert30["precio"];
                $RequestItemEntrada30->type="PRO";
                Doo::db()->insert($RequestItemEntrada30);
            }
        }

        $exits = Doo::db()->query("SELECT * FROM request where descripcion = 'CLEANING' and id_entrada='$_POST[id]' ;")->fetch();
        if(!$exits){
            $Request->descripcion='CLEANING';
            $Request->cliente_id=$_POST["clientes_id"];
            $Request->id_entrada=$_POST["id"];
            $Request->state='P';
            $Request->created_at = date('Y-m-d H:i:s');
            $Request->updated_at = date('Y-m-d H:i:s'); 
            $Request->id=Doo::db()->insert($Request);
            $RequestItemEntrada->id_request=$Request->id;
            $RequestItemEntrada->id_item_entrada=0;
            $RequestItemEntrada->id_item_repair=$dataInsert["item_repair"];
            $RequestItemEntrada->precio=$dataInsert["precio"];
            $RequestItemEntrada->type="PRO";
            Doo::db()->insert($RequestItemEntrada);    
        }
            
        return Doo::conf()->APP_URL . "authorization/sing/$entrada->autorizacion_ingreso_id";
    }

    public function sendIER(){
        $id=$this->params["id"];
        $entrada = Doo::db()->query("SELECT * FROM entrada where autorizacion_ingreso_id='$id'")->fetch();
        
        Doo::loadController("EntrysController");
        $EntrysController = new EntrysController();
        $list=$EntrysController->getDataIer($entrada["id"],"items_entrada");
        $entrada = $EntrysController->entrada($entrada["id"]);
        $id=$entrada["id"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/IER");
        $imagenes=Doo::db()->query("SELECT img,descripcion,valor FROM items_entrada  ie
        INNER JOIN items i on (i.id=ie.items_id)
        where id_entrada='$id' and causes_log='S';")->fetchAll();
        $pdf = new IER($entrada);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($list,$imagenes,$fotos=false);
        
        Doo::loadModel("Notificaciones");
        $Notificaciones = new Notificaciones();
        $html = "";
        foreach($imagenes as $imagene){
            if($imagene["img"]!= ""){               
                $html.=$imagene["descripcion"]."-".$imagene["valor"]."-".$imagene["img"]." ";                
            }
        }
        $Notificaciones->notificacion="El IER $entrada[id], '$id' DEL TANQUE $entrada[serial] FUE CREADO CON LAS IMAGENES ADJUNTAS $html";
        $Notificaciones->id_entrada=$entrada["id"];
        Doo::db()->insert($Notificaciones);
        
        
        $pdf->Output('global/docs/ier/ier_' .$entrada["id"].'.pdf', 'F');
        

        
        $this->sendEmailIER($entrada["id"],$entrada);
        return Doo::conf()->APP_URL . "authorization";
    }


    public function singIndex(){
        $this->data['id'] = $this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'autorizaciones/signs.php';
        $this->renderc('index', $this->data, true);
    }
    public function singSave(){
        $id = $this->params["id"];
        $base = $_POST["base"];
        $type = $_POST["type"];
        if($type=='eco'){
            $sing = Doo::db()->query("UPDATE  autorizacion_ingreso SET singeco='$base'  WHERE id='$id' ");
        }else{
             Doo::db()->query("UPDATE  autorizacion_ingreso SET singdrive='$base',final_arrival=now()  WHERE id='$id' ");
        }
        
    }



    public function getItemsCalificacionesByItem(){
        $id=$_POST["id"]; 
        $calificaciones=Doo::db()->query("SELECT c.id,c.causes_log,c.descripcion FROM items_calificaciones  ic
        inner join calificaciones c on (c.id=id_calificacion)
        where ic.id_item='$id' and ic.deleted='1';")->fetchAll();
        echo json_encode($calificaciones);
    }

    public function itemsEntradaSaveCauses(){
        var_dump($_POST);
        exit();
    }

    public function check(){
        $id=$this->params["id"];
        $autorizacion = Doo::db()->query("SELECT ai.state FROM  autorizacion_ingreso ai where id='$id' ")->fetch();
        if($autorizacion["state"]=='P' ){
            Doo::db()->query("update autorizacion_ingreso set state='A' WHERE id='$id'");
        }
        return Doo::conf()->APP_URL . "authorization";
    }

    public function itemsEntradaSave(){
        Doo::loadHelper('DooGdImage');
        Doo::loadModel("ItemsEntrada");
        $ItemsEntrada = new ItemsEntrada();
        $entrada=$_POST["id_entrada"];
        $items=$_POST["id_item"];
        $valor = $_POST["valor"];
        $exits = Doo::db()->query("SELECT id FROM items_entrada WHERE items_id='$items' AND id_entrada='$entrada';")->fetch();
        $ItemsEntrada->items_id=$items;
        $ItemsEntrada->valor=$valor;
        $ItemsEntrada->id_entrada=$entrada;
        if($exits){
            Doo::db()->query("DELETE FROM items_entrada  WHERE items_id='$items' AND id_entrada='$entrada';");
            $ItemsEntrada->id=Doo::db()->insert($ItemsEntrada);
        }else{
            $ItemsEntrada->id=Doo::db()->insert($ItemsEntrada);
        }
        if(isset($_POST["causes_log"])){
            $causes_log=$_POST["causes_log"]; 
            if($causes_log=='S'){
                $gd   = new DooGdImage(Doo::conf()->IMG_LOGS);
                $file = $gd->uploadImage('dataimagen', "imagen_".$ItemsEntrada->id);
                if($file == Null){
                    $ItemsEntrada->img = "";
                } else {
                    $ItemsEntrada->img = $file; 
                }
                $ItemsEntrada->causes_log='S';
                Doo::db()->update($ItemsEntrada);
            }
        }
       
    }

    public function entry(){
        Doo::loadModel("Entrada");
        $Entrada = new Entrada();
        $id_autorizacion =$this->params["id"];
        $list=[];
        $entrada = Doo::db()->query(" SELECT id FROM entrada WHERE autorizacion_ingreso_id='$id_autorizacion'; ")->fetchAll();
        $items = Doo::db()->query("SELECT id,descripcion from items where principal ='S' and deleted='1'")->fetchAll();
        if($entrada){
            $Entrada = Doo::db()->find("Entrada",array("where"=>"autorizacion_ingreso_id = ?","limit"=>1,"param"=>array($id_autorizacion)));   
          
             Doo::db()->query("update entrada set update_at=date(now()) where id='$Entrada->id'");
            foreach($items as $key => $item){
                $subitem=Doo::db()->query("SELECT i.id,descripcion,ie.valor,i.editable from items i LEFT  JOIN items_entrada ie on(ie.items_id=i.id and ie.id_entrada='$Entrada->id') WHERE principal ='N' and deleted='1'  AND depende='$item[id]'")->fetchAll();
                if($subitem){
                    $item["sub_item"]=$subitem;
                    $list[]=$item;
                }    
            }
        }else{
            $Entrada->autorizacion_ingreso_id=$id_autorizacion;
            $Entrada->entrada=$id_autorizacion;
            $Entrada->fecha = date('Y-m-d H:i:s');
            $Entrada->create_at = date('Y-m-d H:i:s');
            $Entrada->update_at = date('Y-m-d H:i:s'); 
            $Entrada->id = Doo::db()->insert($Entrada);
            foreach($items as $key => $item){
                $subitem=Doo::db()->query("SELECT editable,id,descripcion,' ' as valor from items where principal ='N' and deleted='1'  AND depende='$item[id]'")->fetchAll();
                foreach($subitem as  $sub){
                    Doo::loadModel("ItemsEntrada");
                    $ItemsEntrada = new ItemsEntrada();
                    $ItemsEntrada->items_id=$sub["id"];
                    $ItemsEntrada->valor="OK";
                    $ItemsEntrada->id_entrada=$Entrada->id;
                    Doo::db()->insert($ItemsEntrada);
                }
                $subitem=Doo::db()->query("SELECT i.id,descripcion,ie.valor,i.editable from items i LEFT  JOIN items_entrada ie on(ie.items_id=i.id and ie.id_entrada='$Entrada->id') WHERE principal ='N' and deleted='1'  AND depende='$item[id]'")->fetchAll();
                if($subitem){
                    $item["sub_item"]=$subitem;
                    $list[]=$item;
                }    
            }
        }
     
        $entryHeader = Doo::db()->query("SELECT ai.placa,e.id,c.id as  id_cliente,ai.id,e.fecha,c.nombre as cliente,t.serial,t.id as id_tanque,t.last_cargo,ai.transportista,ai.conductor,t.test30,t.test60,t.make_date 
        FROM autorizacion_ingreso ai
        INNER JOIN clientes c on (c.id=ai.clientes_id) INNER JOIN tanques t on(t.id=ai.tanques_id) LEFT  JOIN entrada e on (e.autorizacion_ingreso_id=ai.id) 
        WHERE ai.id='$id_autorizacion' ")->fetch(); 

        $lastCargo=Doo::db()->query("SELECT p.id,p.nombre FROM clientes_productos cp
        INNER JOIN productos p on (cp.productos_id=p.id)
        INNER JOIN clientes c ON  (c.id=clientes_id)
        WHERE cp.clientes_id='$entryHeader[id_cliente]' and invoice_always='N' and cp.servicio_id='3'")->fetchAll();
        $this->data['status'] = Doo::db()->find("Status",array("deleted"=>"id = 1"));
        
        $this->data["ciudades"] = Doo::db()->query("SELECT * from municipios where estado='1' ")->fetchAll(); 
        $this->data["lastcargo"]=$lastCargo;
        $this->data["entrada"]=$Entrada;
        $this->data["items"] =$list;
        $this->data['posiciones']=Doo::db()->query("SELECT * FROM posiciones")->fetchAll();
        $this->data["entry"]=$entryHeader;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'autorizaciones/entry.php';
        $this->renderc('index', $this->data, true);
    }

    public function sendEmailIER($id,$entrada){
        
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
        
        $mail->SetFrom('operaciones@ecolavados.com.co', "$entrada[serial] EIR");
        $mail->AddReplyTo("operaciones@ecolavados.com.co","Operaciones ecolavados");
        
       
        $ent=$entrada["id_cliente"];
        $mensaje="";
        $emails=Doo::db()->query("SELECT email FROM action_email_clients WHERE id_client='$ent' AND id_action_email='1'")->fetch();
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
        where e.id='$id'")->fetchAll();
        
        if($items){
            $mensaje="<a href='https://ecolavados.com.co/app/entrys/timeline/$id'>This tank container has a damage please verify the EIR and the images in ECOLAVADOS web platform</a>";
        }
        $emails = explode(",", $emails["email"]);
        foreach($emails as $emal){
            $mail->AddAddress($emal);
        }
         
       
        $mail->Subject='Equipment Interchange Receipt';
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
                     <p style='font-family:arial; font-size:20px; margin-top:20px'>The following isotank arrived at Ecolavados – Grupo Carmona</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Date:$entrada[fecha]</p> 
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Tank:$entrada[serial]</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Tank´s company:$entrada[nombre]</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Last Cargo:$entrada[last_cargo]</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Vehicle´s registration plate:$entrada[placa]</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>$mensaje</p>                   
                </div>
                <center>
            </body>
        </html>
EOT;
    $mail->MsgHTML($template);
    //$mail->setFrom('operaciones@ecolavados.com.co', "$entrada[serial] EIR");
    $to = sprintf("%010d", $id);
    $mail->addAttachment('global/docs/ier/ier_'.$to.'.pdf');
    $mail->send();   
    }

    public function desactivate(){
        $id=$this->params["pindex"];
        $autorizaciones = Doo::db()->find("AutorizacionIngreso",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        if($autorizaciones->arrival==null){
            Doo::db()->query("update autorizacion_ingreso set deleted=0, state='T' where id='$id'");
        }
        
        return Doo::conf()->APP_URL . "authorization";
    }


    public function sendEmailEntry($asunto){
        Doo::loadHelper('DooMailer');
        $mail = new DooMailer();
        $mail->addTo("operaciones@ecolavados.com.co");
        $mail->setSubject('Entry Autorization');
        $template =  <<<EOT
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        
        <title>Demystifying Email Design</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        </head>
        <body style="margin: 0; padding: 0;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">	
                <tr >
                    <td style="text-align:center; padding: 10px 0 30px 0;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                            <tr style="border-bottom: 25px solid #ccc;">
                                <td align="center" bgcolor="white" style="padding: 0 0 0 110px; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                <img src="Doo::conf()->APP_URL/global/img/logo.png;">
                                     
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                    El cliente $asunto[nombre_cliente] tiene una autorizacion de entrada pendiente por ser aprobada. 

                                    serial: $asunto[serial]
                                    Llegada aproximada: $asunto[fecha_estimada]
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" style="padding: 30px 30px 30px 30px;    border-top: 15px solid #ccc;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="color: black; font-family: Arial, sans-serif; font-size: 14px;" width="100%">
                                                Ecolavados 2019. 
                                            </td>
                                            <td align="right" width="25%">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                               
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
EOT;
    $mail->setBodyHtml($template);
    $mail->setFrom('operaciones@ecolavados.com.co', 'Service order authorization');
    $mail->send();      

    }

}

?>
