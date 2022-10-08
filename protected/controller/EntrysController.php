<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meri単o Iriarte <carlos.merino.iriarte@gmail.com>
 */
class EntrysController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }
    public function sabe(){
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
        return Doo::conf()->APP_URL."empleados";
    }

    public function index(){
        Doo::db()->query("update ats set status='V' where date(created_at) < date(now()) and status='S' OR date(created_at) < date(now()) and status='A';");
        Doo::db()->query("delete from programacion_empleados where date(created_at) < date(now()) AND fecha_inicio=''"); 
        $this->data["entradas"] = $this->dataList();        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/list.php';
        $this->renderc('index', $this->data, true);
    }

    

   public function dataList(){
        $login = $_SESSION['login'];
        $this->data["role"]=$login->role;
        $where='';
        if($login->role=='13'){
            $where=" c.id='$login->id_usuario' AND ";
        }
        $sql="SELECT municipio,ai.assing, ai.observation , concat(ai.placa_salida,'-',ai.nombre_conductor_salida) as salida,fecha_salida, ai.id as id_autorizacion,ai.type,ai.color_client_send,ai.numer_client_sed,ai.name_client_send,s.color,DATEDIFF(NOW(),e.fecha) AS dayson,e.fecha ,t.serial,c.nombre,e.id,s.status_name ,
        group_concat(concat(it.descripcion,'-',ie.valor)) as damage ,   test30,test60,
	    DATE_ADD(test60, interval 60 MONTH) as next60,
	    DATE_ADD(test30, interval 30 MONTH) as next30, 
	    TIMESTAMPDIFF( month,date(now()),DATE_ADD(test60, interval 60 MONTH)) as falta60,
	    TIMESTAMPDIFF( month,date(now()),DATE_ADD(test30, interval 30 MONTH)) as falta30,make_date
        FROM entrada e
        INNER  JOIN status s ON (s.id=e.status)
        INNER JOIN autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id)
    	INNER JOIN tanques  t on (t.id=ai.tanques_id)
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
        
        LEFT  JOIN municipios mu  on (mu.id=e.ciudad  )
    	LEFT  JOIN items_entrada ie  on (ie.id_entrada=e.id  and ie.causes_log='S')
        left JOIN  items it ON (ie.items_id = it.id) where

    	$where e.estado='A' group by e.id order by e.fecha ; ";	
        return Doo::db()->query($sql)->fetchAll();
    }

    public function currentCsv(){
        Doo::loadClass("reportes/current_inventory/currentInventoryExcel");
        $csv = new currentInventoryExcel();
        $csv->getCurrentInventoryCsv($this->dataList());        
    }
    
    public function saveEdit(){
        Doo::loadModel("Entrada");
        $Entrada = new Entrada($_POST);
        $res=Doo::db()->update($Entrada);
        //var_dump($_POST);
        $ai = Doo::db()->query("SELECT * FROM entrada where id='$Entrada->id';")->fetch();
        
        $ai= Doo::db()->query("SELECT * FROM autorizacion_ingreso where id='$ai[autorizacion_ingreso_id]';")->fetch();
       
        $dataInsert= Doo::db()->query("SELECT cp.id as item_repair,precio,c.nombre,p.nombre as producto,pr.nombre,pr.id from clientes_productos cp
        INNER JOIN clientes c on (c.id=cp.clientes_id)
        INNER join productos p on (p.id=cp.productos_id)
        INNER join procesos pr on (pr.id=cp.servicio_id)
        where clientes_id='$ai[clientes_id]' and cp.productos_id='$Entrada->last_cargo';")->fetch();
        $request = Doo::db()->query("SELECT * FROM request_item_entrada WHERE id_request=(SELECT id FROM request where descripcion = 'CLEANING' and id_entrada='$Entrada->id' LIMIT 1 );")->fetch();
        Doo::db()->query("update request_item_entrada set id_item_repair='$dataInsert[item_repair]',precio='$dataInsert[precio]' where id='$request[id]'");
        return Doo::conf()->APP_URL."entrys";
    }
    
    public function edit(){
        $id=$this->params["pindex"];
        $cliente = Doo::db()->query("select ai.reference_out,ai.clientes_id  as cliente from entrada e inner join autorizacion_ingreso ai on ai.id=e.autorizacion_ingreso_id where e.id='$id'")->fetch();
        $entrada = Doo::db()->find("Entrada",array('where' => 'id = ?',"limit"=>1,"param"=>array($id)));
        $lastCargo=Doo::db()->query("SELECT p.id,p.nombre FROM clientes_productos cp
        INNER JOIN productos p on (cp.productos_id=p.id)
        INNER JOIN clientes c ON  (c.id=clientes_id)
        WHERE cp.clientes_id='$cliente[cliente]' and invoice_always='N' and cp.servicio_id='3'")->fetchAll();
        $this->data['posiciones']=Doo::db()->query(" SELECT * FROM posiciones")->fetchAll();
        $this->data["cliente"]=$cliente;
        $this->data['status'] = Doo::db()->find("Status",array("deleted"=>"id = 1"));
        $this->data["lastcargo"]=$lastCargo;
        $this->data["entrada"]=$entrada;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/form.php';
        $this->renderc('index', $this->data, true);
    }

   
    

    public function registerAlways($always,$id){       
        foreach($always as $alway){
            $ItemsFacturas = new ItemsFacturas();
            $ItemsFacturas->id_entrada=$id;
            $ItemsFacturas->service=$alway["proceso"];
            $ItemsFacturas->description=$alway["proceso"];
            if($alway["servicio_id"]=="1"){
                $ItemsFacturas->wo=$alway["reference"];
            }else if($alway["servicio_id"]=="2"){
                $ItemsFacturas->wo=$alway["reference_out"];
            }else{
                $ItemsFacturas->wo='';
            }            
            $ItemsFacturas->quantity=1;
            $ItemsFacturas->price=$alway["precio"];
            $ItemsFacturas->total=$alway["precio"];
            $ItemsFacturas->minimo =$alway["fecha_entrada"]; 
            $ItemsFacturas->tipo = 'ALW';
            $ItemsFacturas->closed = 'N';
            $this->validateAndInsertA($ItemsFacturas);
        }
    }

    public function registerStorage($storage,$id){
        foreach($storage as $stora){
            $ItemsFacturas = new ItemsFacturas();
            $ItemsFacturas->id_entrada=$id;
            $ItemsFacturas->service="Service: "."Stotage"."\n"."Periodo: ". $stora["periodo"];
            $ItemsFacturas->description="Total days: ".$stora["dias"]."\nBilled days: ".$stora["dias_cobrados"]."\n Discounted days: ".$stora["dias_descontados"];
            $ItemsFacturas->wo='';
            $ItemsFacturas->quantity=$stora["dias_cobrados"];
            $ItemsFacturas->price=$stora["valor_dias"];
            $ItemsFacturas->total=$stora["valor"];
            $ItemsFacturas->minimo = $stora["min"];
            $ItemsFacturas->tipo = 'STO';
            if($stora["update"]=="S"){
                $ItemsFacturas->closed = 'S';
            }else{
                $ItemsFacturas->closed = 'N';
            }
            $this->validateAndInsert($ItemsFacturas);
        }
    }


    public function registerProducto($productos,$id){
        foreach($productos as $producto){
            $ItemsFacturas = new ItemsFacturas();
            $object=$producto["descripcion"]== "" ? " General" : $producto["descripcion"];
            $ItemsFacturas->id_entrada=$id;
            $ItemsFacturas->service="Service: $producto[proceso]\nObject:".  $object;
            $ItemsFacturas->description=$producto["nombre"];
            $ItemsFacturas->wo=$producto["work_order"];
            $ItemsFacturas->quantity=$producto["cantidad"];
            $ItemsFacturas->price=$producto["precio"];
            $ItemsFacturas->total=$producto["cantidad"]*$producto["precio"];
            $ItemsFacturas->minimo = $producto["expedicion"];
            $ItemsFacturas->id_item_request = $producto["id"];
            
            $ItemsFacturas->tipo = 'PRO';
            $ItemsFacturas->closed = 'N';
            $this->validateAndInsertA($ItemsFacturas);
        }
    }
    public function registerPaquete($paquetes,$id){
        foreach($paquetes as $paquete){
            $ItemsFacturas = new ItemsFacturas();
            $ItemsFacturas->id_entrada=$id;
            $ItemsFacturas->service="Service: ". $paquete["nombre"]."\n"."Daño: ". $paquete["descripcion"];
            $ItemsFacturas->description=$paquete["nombre"];
            $ItemsFacturas->wo= $paquete["work_order"];
              $ItemsFacturas->quantity=$paquete["cantidad"];
            $ItemsFacturas->price=$paquete["precio"];
            $ItemsFacturas->total=$paquete["cantidad"]*$paquete["precio"];
            $ItemsFacturas->minimo = date('Y-m-d');
            $ItemsFacturas->id_item_request = $paquete["id"];
            $ItemsFacturas->tipo = 'PAQ';
            $ItemsFacturas->closed = 'N';
            $this->validateAndInsertA($ItemsFacturas);
            
        }
    }

 
   public function invoice(){
        $tdays=0;
        $items=null;
        $id=$this->params["pindex"];
        $type = $this->params["type"];
        Doo::loadModel("ItemsFacturas");
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/InvoicePDF");
        $pdf = new InvoicePDF();
        $entrada = $this->entrada($id);

   
        
     $request=Doo::db()->query("SELECT  date(now()) as fecha,t.serial,date( r.created_at) as expedicion,e.id as entrada,r.id,r.descripcion,r.state,c.nombre,sum(rie.precio) as total,c.identificacion
            FROM request r
            INNER JOIN entrada e  on (e.id=r.id_entrada) 
            INNER JOIN autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
            INNER JOIN tanques t ON (t.id=ai.tanques_id)
            INNER JOIN clientes c ON (c.id=r.cliente_id)
            left JOIN request_item_entrada  rie on (rie.id_request=r.id)
            WHERE r.deleted='1' and r.state='A'  and e.id='$id' group by r.id")->fetch();

        if($type=='C'){
            $sql="SELECT e.id,t.serial,DATE_SUB(date(now()),INTERVAL 1 DAY) as fecha,date(now()) as fecha_salida  FROM entrada e
            INNER  JOIN status s ON (s.id=e.status)
            INNER JOIN autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id)
            INNER JOIN tanques  t on (t.id=ai.tanques_id)
            INNER JOIN clientes  c on (c.id=ai.clientes_id)
            LEFT  JOIN items_entrada ie  on (ie.id_entrada=e.id  and ie.causes_log='S')
            left JOIN  items it ON (ie.items_id = it.id) where  e.id='$id' and
            e.estado='A' order by e.fecha ; ";
        }else{
            $sql="SELECT e.id, t.serial,DATE_SUB(s.fecha_salida,INTERVAL 1 DAY) as fecha,s.fecha_salida
                from salida s
                INNER join tanques t on (t.id=s.id_tanque) 
                INNER join entrada e on (e.id=s.id_entrada)
                INNER join autorizacion_ingreso ai on (ai.id=s.id_autorizacion)
                INNER JOIN clientes  c on (c.id=ai.clientes_id) where  e.id='$id'";
        }

        
       // $tdays=$totaldaysfree;

        $fecha=Doo::db()->query($sql)->fetch();



        $storage=$this->storage($id, $fecha["fecha"]);
        $productos = $this->productos($id);
        $paquetes = $this->paquetes($id);
        $always = $this->invoice_always($id);
        $this->registerAlways($always,$id);
        $this->registerStorage($storage,$id);
        $this->registerProducto($productos,$id);
        $this->registerPaquete($paquetes,$id);


        $items=Doo::db()->query("SELECT * FROM items_facturas where id_entrada='$id'")->fetchAll();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($entrada,$items,$fecha["fecha_salida"],$type);
        $pdf->Output();
    }

    public function validateAndInsertA($item){
        $items=Doo::db()->query("SELECT * FROM items_facturas where description='$item->description' and id_entrada='$item->id_entrada' and service='$item->service' ")->fetch();
        
        if(!$items){
            if($items['id_item_request'] != 0  ){
                $items=Doo::db()->query("SELECT * FROM items_facturas where description='$item->description' and id_entrada='$item->id_entrada' and service='$item->service' and id_item_request='$item->id_item_request' ")->fetch();
                if(!$items){
                    return Doo::db()->insert($item);
                }
            }else{
                 return Doo::db()->insert($item);
            }
            
        }else{
            $this->updateItem($item,$items);
        }
    
    }   
    public function updateItem($item,$items){
        Doo::db()->query("update items_facturas set 
                service='$item->service',
                wo='$item->wo',
                description='$item->description',
                quantity='$item->quantity',
                price='$item->price',
                total='$item->total',
                closed='$item->closed' where id='$items[id]'");
    }

    public function validateAndInsert($item){   
        $items =Doo::db()->query("SELECT * FROM items_facturas where id_entrada='$item->id_entrada' and minimo='$item->minimo' and tipo='STO' ")->fetch();
        if(!$items){
            return Doo::db()->insert($item);
        }else{
            if($items["closed"]=='S'){
                Doo::db()->query("update items_facturas set 
                service='$item->service',
                description='$item->description',
                quantity='$item->quantity',
                price='$item->price',
                total='$item->total',
                closed='$item->closed' where id='$items[id]'");
            }
        } 
 

    }

    public function associteInvoice(){
        $id=$this->params["pindex"];
        $this->data["items"]=Doo::db()->query("SELECT * FROM items_facturas where id_entrada='$id'")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/associate.php';
        $this->renderc('index', $this->data, true);
    }

    public function updateInvoice(){
        $id = $_POST["id"];
        $valor=$_POST["valor"];
        $cantidad=$_POST["cantidad"];
        $total=$_POST["total"];
        $amortizacion=$_POST["amortizacion"];
        $n_facture=$_POST["n_facture"];
        Doo::db()->query("update items_facturas set n_facture='$n_facture', amortizacion='$amortizacion', price='$valor', quantity = '$cantidad',total='$total' where id='$id'");
        $item = Doo::db()->query("select * from items_facturas where id='$id'")->fetch();
        echo json_encode($item);
    }
    public function rangos($fecha,$creacion){
        return Doo::db()->query("SELECT if('$fecha' between  min(selected_date) and max(selected_date) ,'S','N' ) AS updated, 
            min(selected_date)as min,max(selected_date) as max,count(selected_date) dias,selected_date
            FROM  
            (select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
            (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
            (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
            (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
            (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
            (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v 
            WHERE  selected_date between '$creacion' and '$fecha'  GROUP BY MONTH(selected_date) ;")->fetchAll();
    }
    public function totalDays($rangos){
        $totaldays=0;
        foreach($rangos as $rango){
            $totaldays+=$rango["dias"];
        }
        return $totaldays;
    }

    public function storage($id,$fecha){
        $tdd=0;
        $last_cargo="";
        $totaldays=0;
        $totaldaysfree=0;
        $newArray=[];

        
        $last_cargo =Doo::db()->query("SELECT  e.id,cp.precio,p.nombre,dias_libre from entrada e 
        INNER join autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id)
        INNER JOIN clientes c ON (c.id=ai.clientes_id)
        INNER JOIN clientes_productos cp on (cp.productos_id=e.last_cargo and c.id=cp.clientes_id and cp.deleted='1')
        INNER JOIN productos p on p.id=cp.productos_id where e.id='$id'")->fetch();  
        
        /*var_dump($last_cargo['dias_libre']);
        exit();*/
        
        $diasLibres = $last_cargo['dias_libre'] > 0 ? $last_cargo['dias_libre'] : 0;

        $create = Doo::db()->query("SELECT date(now()) as  factual, clientes_id,date(e.fecha) as creacion,DATE_ADD(date(e.fecha), interval ($diasLibres) day) as cobrardesde  
        from entrada e 
        INNER join autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id) where e.id='$id'")->fetch();
       
        $clean = Doo::db()->query("SELECT * from calidad where id_entrada='$id';")->fetch();
        $storageval=Doo::db()->query("SELECT precio FROM clientes_productos 
        where servicio_id='4' and clientes_id='$create[clientes_id]';")->fetch();

        $rangos=$this->rangos($fecha,$create["creacion"]);
     
        $totaldaysfree=$last_cargo["dias_libre"];

        $salida= Doo::db()->query("SELECT * FROM salida where id_entrada='$id';")->fetch();
        
        $totaldays=$this->totalDays($rangos);
        
        
        
        if($clean){
            if($totaldays > $totaldaysfree){
                if($create["cobrardesde"]>$create["factual"] || $salida ){

                    $tdd=$totaldaysfree;
                    $rangos=$this->rangos($fecha,$create["cobrardesde"]);
                }else{
                    $rangos=[];
                }
            }else{
                if($salida){
                    $tdd=$totaldays;
                }
                $rangos=[];
            }
        }else{
            if($salida){
                $rangos=$this->rangos($fecha,$create["creacion"]);
            }else{
                $rangos=[];
            }
        }
       $_SESSION["tdd"]=$tdd;
       
        foreach($rangos as $rango){    
                $valor=($rango["dias"])*$storageval["precio"];
                $newArray[]=array("periodo"=>"$rango[min]/$rango[max]",
                    "min"=>$rango["min"],
                    "dias"=>$rango["dias"],
                    "dias_descontados"=>0, 
                    "dias_cobrados"=>$rango["dias"],
                    "días restantes"=>0,
                    "valor_dias"=>$storageval["precio"],
                    "valor"=>$valor,
                    "update"=>$rango["updated"]);
                
            }
        
         return $newArray;
    }
    public function request($id){
        $query=Doo::db()->query("SELECT  t.serial,date( r.created_at) as expedicion,e.id as entrada,r.id,r.descripcion,r.state,c.nombre,sum(rie.precio) as total,c.identificacion
        FROM request r
        INNER JOIN entrada e  on (e.id=r.id_entrada) 
        INNER JOIN autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
		INNER JOIN tanques t ON (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=r.cliente_id)
        INNER JOIN request_item_entrada  rie on (rie.id_request=r.id)
        WHERE r.deleted='1' and r.state='A'  and e.id='$id'")->fetch();
       
        return $query;
    }
    public function productos($id){
        return Doo::db()->query("SELECT rie.cantidad,date( r.created_at) as expedicion, rie.work_order,rie.id,it.descripcion,i.descripcion,ie.valor,p.nombre,cp.precio,work_order,pr.nombre  as proceso
        FROM request_item_entrada rie
        LEFT JOIN  items_entrada ie ON(ie.id=rie.id_item_entrada)
        LEFT JOIN items i ON (i.id=ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        INNER JOIN clientes_productos cp on (cp.id=rie.id_item_repair and rie.type='PRO')
        INNER JOIN productos p on(p.id=cp.productos_id )
        INNER JOIN procesos pr on (pr.id=cp.servicio_id)
        INNER JOIN request r ON (r.id=rie.id_request) and r.id_entrada='$id' and r.state='A' ")->fetchAll();
    }

    public function invoice_always($id){
        $cliente = Doo::db()->query("SELECT ai.reference_out,ai.reference,clientes_id,e.fecha  FROM autorizacion_ingreso ai
        inner join entrada e on ai.id=e.autorizacion_ingreso_id where e.id='$id';")->fetch();

        return Doo::db()->query("select '$cliente[reference_out]' as reference_out,  '$cliente[reference]' as reference,  cp.servicio_id,'$cliente[fecha]' as fecha_entrada, pr.nombre  as proceso,p.nombre,precio from clientes_productos cp
                                INNER JOIN productos p on(p.id=cp.productos_id )
                                INNER JOIN procesos pr on (pr.id=cp.servicio_id) 
                                where cp.invoice_always='S' and cp.clientes_id='$cliente[clientes_id]'")->fetchAll();

    }
    public function paquetes($id){
        return  Doo::db()->query("SELECT rie.cantidad,rie.work_order,rie.id, it.descripcion,i.descripcion,ie.valor,rie.precio,work_order,cp.nombre
        FROM request_item_entrada rie
        LEFT JOIN  items_entrada ie ON(ie.id=rie.id_item_entrada)
        LEFT JOIN items i ON (i.id=ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        LEFT JOIN paquetes cp on (cp.id=rie.id_item_repair and rie.type='PAC')
        INNER JOIN detalle_paquetes dp ON(cp.id=dp.paquetes_id) 
        INNER JOIN productos  pro ON (pro.id=dp.productos_id)
        INNER JOIN request r ON (r.id=rie.id_request) AND  r.id_entrada='$id' and r.state='A' group by rie.id ")->fetchAll();
    }

    public function seals(){
        $this->data["entry"]=$this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/seals.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function departureIndex(){
        $login = $_SESSION['login'];
        $where='';
        if($login->role=='13'){
            $where="where ai.clientes_id='$login->id_usuario'  ";
        }

        $this->data["list"]=Doo::db()->query("SELECT e.id id_entrada,c.nombre, s.id,e.id as entrada,ai.id as autorizacion,placa_salida,nombre_conductor_salida,e.fecha as fecha_ingreso, s.fecha_salida, s.observacion,t.serial
        from salida s
        INNER join tanques t on (t.id=s.id_tanque) 
        INNER join entrada e on (e.id=s.id_entrada)
        INNER join autorizacion_ingreso ai on (ai.id=s.id_autorizacion)
        INNER JOIN clientes  c on (c.id=ai.clientes_id) $where")->fetchAll();
        $this->data["role"]=$login->role;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/departure.php';
        $this->renderc('index', $this->data, true);
    }
    
     public function getAllDepartures(){
        $login = $_SESSION['login'];
        $where='';
        if($login->role=='13'){
            $where="where ai.clientes_id='$login->id_usuario'  ";
        }
        $data=Doo::db()->query("SELECT e.id id_entrada,c.nombre, s.id,e.id as entrada,ai.id as autorizacion,placa_salida,nombre_conductor_salida,e.fecha as fecha_ingreso, s.fecha_salida, s.observacion,t.serial
        from salida s
        INNER join tanques t on (t.id=s.id_tanque) 
        INNER join entrada e on (e.id=s.id_entrada)
        INNER join autorizacion_ingreso ai on (ai.id=s.id_autorizacion)
        INNER JOIN clientes  c on (c.id=ai.clientes_id) $where")->fetchAll();
        echo json_encode($data);
    }
    
    
    public function limpieza(){
        Doo::loadModel("Limpieza");
        $Limpieza = new Limpieza($_POST);
        Doo::db()->update($Limpieza);
    }

    public function cleanValidate(){
        $id = $_POST["id"];
        $limpieza = Doo::db()->query("SELECT id FROM limpieza WHERE id_entrada='$id'")->fetch();
        if($limpieza){
            echo 'true';
        }else{
            echo  'false';
        }
    }

    public function printClean(){
        $id=$this->params["id"];
        //$this->getDataIer($id);
        $entrada = $this->entrada($id);
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/Clean");
        $imagenes=Doo::db()->query("SELECT img,descripcion,valor FROM items_limpieza  ie
        INNER JOIN items i on (i.id=ie.items_id)
        where id_entrada='$id' and causes_log='S';")->fetchAll();
        $pdf = new Clean($entrada);
        $list=$this->getDataIer($id,"items_limpieza");
        $seals = Doo::db()->query("SELECT * FROM limpieza where id_entrada='$id';")->fetch();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($list,$imagenes,$seals);
        $pdf->Output();
    }

    public function printSeals(){
        $id=$this->params["id"];
        //$this->getDataIer($id);
        $entrada = $this->entrada($id);
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/Seals");
        $imagenes=Doo::db()->query("SELECT id, entry, image, observation  FROM entry_seals WHERE entry='$id'")->fetchAll();
        $pdf = new Seals($entrada);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($imagenes);
        $pdf->Output();
    }
    
    public function saveClean(){
        $test30=$_POST["test30"];
        $test60=$_POST["test60"];
        $id_limpieza = $_POST["id_limpieza"];
        $list;
        $id=$_POST["id"];
        //$this->getDataIer($id);
        $entrada = $this->entrada($id);
        $tanque_id=$entrada["id_tanque"];
        Doo::db()->query("update tanques set test30='$test30',test60='$test60' where id='$tanque_id' ");
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/Clean");
        $imagenes=Doo::db()->query("SELECT img,descripcion,valor FROM items_limpieza  ie
        INNER JOIN items i on (i.id=ie.items_id)
        where id_entrada='$id' and causes_log='S';")->fetchAll();
        $pdf = new Clean($entrada);
        $list=$this->getDataIer($id,"items_limpieza");
        $seals = Doo::db()->query("SELECT * FROM limpieza where id_entrada='$id';")->fetch();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($list,$imagenes,$seals);
        $pdf->Output('global/docs/limpieza/clean_' .$entrada["id"].'.pdf', 'F');
        $this->sendEmailCleaning($id,$entrada);
        return Doo::conf()->APP_URL."entrys";
    }
    public function gateout(){
        Doo::loadModel("Salida");
        $Salida = new Salida();
        $id = $_POST["id"];
         $status=$_POST["status"];
        $entrada = $this->entrada($id);
        $Salida->observacion=$_POST["observacion"];
        $Salida->reference=$_POST["reference"];
        $Salida->id_tanque=$entrada["id_tanque"];
        $Salida->id_entrada=$entrada["id"];
        $Salida->id_cliente=$entrada["id_cliente"];
        $Salida->id_autorizacion=$entrada["id_autorizacion"];
        $Salida->fecha_salida=$_POST["fecha_m"]; 
        Doo::db()->query("UPDATE entrada set estado ='M', status='$status' where id='$id'");
        Doo::db()->insert($Salida); 
        Doo::loadModel("LogsStatus");
        $LogsStatus= new  LogsStatus();
        $LogsStatus->id_entrada= $id;
        $LogsStatus->status="$status";
        $LogsStatus->cause="El tanque esta de salida y disponible";
        Doo::db()->insert($LogsStatus);
            
    }
    
    public function sendEmailCleaning($id,$entrada){
        Doo::loadClass("mail/PHPMailer");
        
        $mail = new PHPMailer();
        $mail->isSMTP(); 
        $mail->SMTPAuth = true;
        $mail->Host = 'mail4.correopremium.com';
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->Username = "operaciones@ecolavados.com.co";
        $mail->Password = "Martin2011*";
        
        $mail->SetFrom('operaciones@ecolavados.com.co', 'Operaciones ecolavados-Certificate of Cleaning Ecolavados');
        $mail->AddReplyTo("operaciones@ecolavados.com.co","Operaciones ecolavados");
        $ent=$entrada["id_cliente"];
        $emails=Doo::db()->query("SELECT email FROM action_email_clients WHERE id_client='$ent' AND id_action_email='3'")->fetch();
        $emails = explode(",", $emails["email"]);
        foreach($emails as $emal){
            $mail->AddAddress($emal);
        }
        //$mail->addTo($em["email"]);
        $mail->Subject="Certificate of Cleaning  $entrada[serial]";
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
                     <p style='font-family:arial; font-size:20px; margin-top:20px'>Certificate of Cleaning Ecolavados – Grupo Carmona</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Date:$entrada[fecha]</p> 
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Tank:$entrada[serial]</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Tank's company:$entrada[nombre]</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Last Cargo:$entrada[last_cargo]</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Vehicle's registration plate:$entrada[placa]</p>
                   
                </div>
                <center>
            </body>
        </html>
EOT;
    $mail->MsgHTML($template);
    //$mail->setFrom('operaciones@ecolavados.com.co', "$entrada[serial]");
    $to = sprintf("%010d", $id);
    $mail->addAttachment('global/docs/limpieza/clean_'.$to.'.pdf');
    $mail->send();   
    }
    
    public function clean(){
        $id=$this->params["pindex"];
        $list=[];
        $items_limpieza=Doo::db()->query("select * from items_limpieza where id_entrada='$id'")->fetchAll();
        if(!$items_limpieza){
            Doo::loadModel("Limpieza");
            $Limpieza =  new Limpieza();
            $Limpieza->id_entrada=$id;
            $items_limpieza=Doo::db()->query("INSERT INTO `items_limpieza`(`items_id`,`valor`,`id_entrada`,`causes_log`,`img`) SELECT i.id,ie.valor, ie.id_entrada,'N','' from items i LEFT  JOIN items_entrada ie on(ie.items_id=i.id and ie.id_entrada='$id') WHERE principal ='N' and deleted='1'");
            $Limpieza->id=Doo::db()->insert($Limpieza);
            
        }else{
            $Limpieza=Doo::db()->find("Limpieza",array("where"=>"id_entrada = ?","limit"=>1,"param"=>array($id)));

        }
        $items = Doo::db()->query("SELECT id,descripcion from items where principal ='S' and deleted='1'")->fetchAll();
        //Doo::db()->query("update entrada set update_at='$Entrada->update_at' where id='$Entrada->id'");
        foreach($items as $key => $item){
            $subitem=Doo::db()->query("SELECT i.id,descripcion,ie.valor,i.editable from items i 
            LEFT  JOIN items_limpieza ie on(ie.items_id=i.id and ie.id_entrada='$id') WHERE principal ='N' and deleted='1'  AND depende='$item[id]'")->fetchAll();
            if($subitem){
                $item["sub_item"]=$subitem;
                $list[]=$item;
            }    
        }
        $this->data["entrada"] = $this->entrada($id);
        $this->data["limpieza"]= $Limpieza; 
        $this->data["entrada_id"]=$id;
        $this->data["items"] =$list;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/clean.php';
        $this->renderc('index', $this->data, true);
    }
  
    public function itemsLimpiezaSave(){
        Doo::loadHelper('DooGdImage');
        Doo::loadModel("ItemsLimpieza");
        $ItemsLimpieza = new ItemsLimpieza();
        $entrada=$_POST["id_entrada"];
        $items=$_POST["id_item"];
        $valor = $_POST["valor"];
        $exits = Doo::db()->query("SELECT id FROM items_limpieza WHERE items_id='$items' AND id_entrada='$entrada';")->fetch();
        $ItemsLimpieza->items_id=$items;
        $ItemsLimpieza->valor=$valor;
        $ItemsLimpieza->id_entrada=$entrada;
        if($exits){
            Doo::db()->query("DELETE FROM items_limpieza  WHERE items_id='$items' AND id_entrada='$entrada';");
            $ItemsLimpieza->id=Doo::db()->insert($ItemsLimpieza);
        }else{
            $ItemsLimpieza->id=Doo::db()->insert($ItemsLimpieza);
        }
        if(isset($_POST["causes_log"])){
            $causes_log=$_POST["causes_log"]; 
            if($causes_log=='S'){
                $gd   = new DooGdImage(Doo::conf()->IMG_LOGS);
                $file = $gd->uploadImage('dataimagen', "imagen_".$ItemsLimpieza->id);
                if($file == Null){
                    $ItemsLimpieza->img = "";
                } else {
                    $ItemsLimpieza->img = $file; 
                }
                $ItemsLimpieza->causes_log='S';
                Doo::db()->update($ItemsLimpieza);
            }
        }
       
    }

    public function entrysRequest(){
        $id=$this->params["pindex"];
        $entrada = $this->entrada($id);
        $list=[];
        $damages = Doo::db()->query("SELECT 
        concat(i.descripcion,'-',ie.valor) as califica,goodorbad,ie.id
        FROM items_entrada ie
        INNER JOIN items i ON (i.id = ie.items_id)
        INNER JOIN  items it ON (it.id = i.depende) 
        INNER JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'B' AND ca.causes_log='S') where ie.id_entrada='$id'")->fetchAll();
   
        foreach($damages as $key => $item){
           $subitems = Doo::db()->query("SELECT
           concat(i.descripcion,'-',ie.valor)as val,goodorbad,ie.id,r.id,sum(precio) precio,state
           FROM items_entrada ie
           INNER JOIN items i ON (i.id = ie.items_id)
           INNER JOIN  items it ON (it.id = i.depende) 
           INNER JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'B' AND ca.causes_log='S') 
           INNER JOIN request_item_entrada rie ON (rie.id_item_entrada=ie.id)
           INNER JOIN request r ON (r.id=rie.id_request) 
           where  rie.id_item_entrada='$item[id]' group by r.id")->fetchAll();
           
           if($subitems){
                $item["sub_item"]=$subitems;
           }
           $list[]=$item;
        }
        $this->data['list']=$list; 
        $this->data['entrada'] = $entrada;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/request.php';
        $this->renderc('index', $this->data, true);
    }
    public function saveassing(){
        Doo::loadModel("ProgramacionEmpleados");
        $ProgramacionEmpleados = new ProgramacionEmpleados($_POST);
        Doo::db()->query("delete from programacion_empleados where id_programacion='$ProgramacionEmpleados->id_programacion'"); 
        $ProgramacionEmpleados->fecha_inicio=NULL;
        Doo::db()->insert($ProgramacionEmpleados);

        $id = $_POST["id_empleado"];
        $proceso = $_POST["proceso"];
        $trabajos= Doo::db()->query("SELECT a.id,t.nombre FROM trabajos_procesos tp
        INNER join ats a on (a.id_trabajo=tp.id_trabajo) 
        inner join trabajos t on (t.id=tp.id_trabajo and a.status='S')
        where tp.id_proceso='$proceso'   and id_empleado_autorizado='$id'")->fetchAll();
        Doo::db()->query("update parametros set cons_planilla=cons_planilla+1");
        return Doo::conf()->APP_URL."entrys";
    }

    public function execute(){
        $login = $_SESSION['login'];
        $this->data['trabajos'] = Doo::db()->query("SELECT t.serial,pe.fecha_inicio as status,pe.fecha_fin as status1,pe.fecha_fin as status1,if(DATE(p.fecha_inicio)>DATE(NOW()),'B','F') AS block ,r.id as request, p.fecha_inicio,p.fecha_fin,p.id,pr.nombre,concat(e.nombre,' ',e.apellido) as operario
        from programacion p 
        inner join request r on (r.id=p.request_activity)
        INNER join entrada en on (en.id=r.id_entrada)  
        inner join autorizacion_ingreso ai on(ai.id =en.autorizacion_ingreso_id )
        inner join tanques t on (t.id=ai.tanques_id)
        LEFT JOIN programacion_empleados pe on(pe.id_programacion=p.id)
        LEFT JOIN empleados e on (e.id=pe.id_empleado)
        inner join procesos pr on (pr.id=p.proceso)  where  now() between p.fecha_inicio and date_add(p.fecha_fin, INTERVAL 12 HOUR) AND pe.id_empleado='$login->id_usuario'")->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'entradas/listWorks.php';
        $this->renderc('index', $this->data, true);
    }

    public function executeChange(){
        $work = $this->params["work"];
        $pindex = $this->params["pindex"];
        $hora = date('Y-m-d H:i:s');
         Doo::loadModel("LogsStatus");
        $programacion=Doo::db()->query("SELECT pe.fecha_inicio,id_entrada,proceso,pe.id_empleado from programacion  p
        INNER JOIN programacion_empleados pe on(pe.id_programacion=p.id) where p.id='$pindex';")->fetch();
        $status = Doo::db()->query("SELECT id_status,id_next_status from procesos_status where id_proceso='$programacion[proceso]'")->fetch();
        
        if($work=="1"){
            $ats=Doo::db()->query("SELECT id FROM ats where id_empleado_autorizado ='$programacion[id_empleado]' and status='A' ;")->fetchAll();
            foreach($ats as $at){
                Doo::db()->query("update ats set status='U' where id='$at[id]'");
            }
            Doo::db()->query("update entrada set status='$status[id_status]' where id='$programacion[id_entrada]'");
            $LogsStatus= new  LogsStatus();
            $LogsStatus->id_entrada=$programacion["id_entrada"];
            $LogsStatus->status=$programacion["proceso"];
            $LogsStatus->cause="Start Proccess";
            Doo::db()->insert($LogsStatus);
            Doo::db()->query("update programacion_empleados set fecha_inicio='$hora' where id_programacion='$pindex'");
        }else{ 
            if($programacion['fecha_inicio']!=''){
                
                $LogsStatus= new  LogsStatus();
                $LogsStatus->id_entrada=$programacion["id_entrada"];
                $LogsStatus->status=$status["id_next_status"];;
                $LogsStatus->cause="End Proccess";
                Doo::db()->insert($LogsStatus);
                Doo::db()->query("update entrada set status='$status[id_next_status]' where id='$programacion[id_entrada]'");
                Doo::db()->query("update programacion_empleados set fecha_fin='$hora' where id_programacion='$pindex'");
                $entradas=$this->entrada($programacion['id_entrada']);
                if($programacion['proceso']==7){
                    Doo::db()->query("UPDATE tanques set test30=date(now()) WHERE id='$entradas[id_tanque]'");
                }
                
                if($programacion['proceso']==8){
                    Doo::db()->query("UPDATE tanques set test60=date(now()) WHERE id='$entradas[id_tanque]'");
                }
            }
            
        }
       
        return Doo::conf()->APP_URL."entrys/execute";
    }
    
    

    

    public function save(){
        Doo::loadModel("Programacion");
        $Programacion = new Programacion($_POST);
        $Programacion->update_at = date('Y-m-d H:i:s'); 
        if($Programacion->id==""){
            $Programacion->id=NULL;
            $Programacion->created_at = date('Y-m-d H:i:s');
            Doo::db()->insert($Programacion);

        }else{
            Doo::db()->update($Programacion);
        }
        
        return Doo::conf()->APP_URL."entrys";
    }
    
    public function certificateClean(){
        $list;
        $id=$this->params["pindex"];
        //$this->getDataIer($id);
        $entrada = $this->entrada($id);
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/Clean");
        $imagenes=Doo::db()->query("SELECT img,descripcion,valor FROM items_limpieza  ie
        INNER JOIN items i on (i.id=ie.items_id)
        where id_entrada='$id' and causes_log='S';")->fetchAll();
        $pdf = new Clean($entrada);
        $list=$this->getDataIer($id,"items_limpieza");
        $seals = Doo::db()->query("SELECT * FROM limpieza where id_entrada='$id';")->fetch();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($list,$imagenes,$seals);
        $pdf->Output();
    }
    
     public function certificateCleanSing(){
        $id = $this->params['pindex'];
        $firma = $_POST['base'];
        Doo::db()->query("UPDATE limpieza SET sing = '$firma' WHERE id_entrada = '$id' ");
        //var_dump($firma);
        echo "Sing Registered";
    }
     
    public function printIER(){
        $list;
        $id=$this->params["pindex"];
        //$this->getDataIer($id);
        $entrada = $this->entrada($id);
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/IER");
        $imagenes=Doo::db()->query("SELECT img,descripcion,valor FROM items_entrada  ie
        INNER JOIN items i on (i.id=ie.items_id)
        where id_entrada='$id' and causes_log='S';")->fetchAll();
        $pdf = new IER($entrada);
        $list=$this->getDataIer($id,"items_entrada");
    
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($list,$imagenes);

        $pdf->Output();
    }

    public function getDataIer($id,$table){
        $list=[];
        $Entrada = Doo::db()->find("Entrada",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $items = Doo::db()->query("SELECT id,descripcion from items where principal ='S' and deleted='1'")->fetchAll();
        //Doo::db()->query("update entrada set update_at='$Entrada->update_at' where id='$Entrada->id'");
        foreach($items as $key => $item){
            $subitem=Doo::db()->query("SELECT i.id,descripcion,ie.valor,i.editable from items i LEFT  JOIN $table ie on(ie.items_id=i.id and ie.id_entrada='$Entrada->id') WHERE principal ='N' and deleted='1'  AND depende='$item[id]'")->fetchAll();
            if($subitem){
                $item["sub_item"]=$subitem;
                $list[]=$item;
            }    
        }
        return $list;
    }

    public function entrada($id){
        return  Doo::db()->query("SELECT e.last_cargo as id_last_cargo,sal.fecha_salida,ai.id as id_autorizacion,t.id as id_tanque,c.id as id_cliente, ai.conductor,ai.transportista,ai.placa,c.id as id_cliente,pro.nombre as  last_cargo,p.fecha_inicio,p.fecha_fin,e.fecha, t.serial,c.nombre,e.id,s.status_name,
        test30,test60,group_concat(concat(i.descripcion,'-',ie.valor)) as damage,ai.singdrive,ai.singeco FROM entrada e 
        INNER  JOIN status s on (s.id=e.status)
        INNER  JOIN items_entrada ie  on (ie.id_entrada=e.id)
        INNER JOIN autorizacion_ingreso ai on  (ai.id=e.autorizacion_ingreso_id)
        INNER JOIN tanques  t on (t.id=ai.tanques_id)
        inner join clientes_productos cp on (cp.productos_id=e.last_cargo)
        inner join productos  pro on(pro.id=cp.productos_id) 
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
        LEFT JOIN programacion  p on (p.id_entrada=e.id)
        INNER JOIN items i ON (i.id = ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        LEFT JOIN salida sal on (sal.id_entrada=e.id)
        LEFT JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'B' AND ca.causes_log='S')
        where e.id='$id' group by e.id;")->fetch();
    }

    public function calendar(){
        $this->data['content'] = 'entradas/calendar.php';
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('index', $this->data, true);
    }
    public function getCalendar(){
        $consulta = Doo::db()->query("select p.id,concat('Cliente: ',c.nombre,', Tanque: ',t.serial,', Servicio:',pr.nombre,', Empleado: ',if(em.nombre<=>null,'No asignado',em.nombre),'Estado: ',IF(pe.fecha_inicio<=>NULL,'No iniciado',IF(pe.fecha_fin<=>NULL,'Iniciado','Finalizado'))) as title,em.nombre,p.fecha_inicio as start,p.fecha_fin as end from 
        programacion p
        inner join entrada e on (e.id=p.id_entrada)
        inner join autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        inner join tanques t on (t.id=ai.tanques_id)
        inner join clientes c on (c.id=ai.clientes_id)
        inner join procesos pr on (pr.id=p.proceso)
        left join programacion_empleados pe on (pe.id_programacion=p.id)
        left join empleados em on (em.id=pe.id_empleado)")->fetchAll();
        echo json_encode($consulta);
    }
    
    
    public function positionvalidate(){
        $position = $_POST["position"];
        $consulta =Doo::db()->query(" SELECT * FROM posiciones WHERE posicion='$position'")->fetch();
        echo json_encode($consulta);
    }
    
    public function positionvalidateget(){
        $position = $_POST["id"];
        $consulta =Doo::db()->query("SELECT e.id,p.posicion, ai.assing, ai.observation , CONCAT(ai.placa_salida,'-',ai.nombre_conductor_salida) AS salida,
            fecha_salida, ai.id AS id_autorizacion,ai.type,ai.color_client_send,ai.numer_client_sed,ai.name_client_send,s.color,
            DATEDIFF(NOW(),e.fecha) AS dayson,e.fecha ,t.serial,c.nombre,e.id,s.status_name, test30,test60,
            DATE_ADD(test60, INTERVAL 60 MONTH) AS next60,
            DATE_ADD(test30, INTERVAL 30 MONTH) AS next30
            FROM entrada e
            INNER  JOIN status s ON (s.id=e.status)
            INNER JOIN autorizacion_ingreso ai ON(ai.id=e.autorizacion_ingreso_id)
            INNER JOIN tanques  t ON (t.id=ai.tanques_id)
            INNER JOIN clientes  c ON (c.id=ai.clientes_id)
            LEFT  JOIN items_entrada ie  ON (ie.id_entrada=e.id  AND ie.causes_log='S')
            LEFT JOIN  items it ON (ie.items_id = it.id) 
            INNER JOIN posiciones p ON (p.id=e.posicion)
            WHERE e.estado='A' AND e.posicion='$position' GROUP BY e.id ORDER BY e.fecha;")->fetchAll();
        echo json_encode($consulta);
    }

    public function waste()
    {
        $id_entrada = $this->params["pindex"];
        $valida = Doo::db()->query("SELECT id FROM residuos WHERE id_entrada='$id_entrada'")->fetch();

        Doo::loadModel("Residuos");
        $residuos = new Residuos();

        if($valida)
        {
            $residuos = Doo::db()->find("Residuos",array("where"=>"id_entrada = ?","limit"=>1,"param"=>array($id_entrada)));
        }
        else
        {
            
            $residuos->id_entrada = $id_entrada;
            $residuos->updated_at = date('Y-m-d H:i:s');
            $residuos->created_at = date('Y-m-d H:i:s');
            $residuos->id = Doo::db()->insert($residuos);
        }

        $this->data['residuos'] = $residuos;
        $this->data['content'] = 'entradas/waste.php';
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('index', $this->data, true);
    }

    public function editVolumen() {
        $valor=$_POST["val"];
        $id = $_POST["id"];
        Doo::db()->query("UPDATE residuos set volumen='$valor' where id='$id'");
    }

    public function editBill() {
        $valor=$_POST["val"];
        $id = $_POST["id"];
        Doo::db()->query("UPDATE residuos set facturar='$valor' where id='$id'");
    }
    
      public function info_procedure(){
        $id = $this->params['pindex'];
        $data = Doo::db()->query("SELECT rie.cantidad,rie.img, r.id as id_request, rie.type,rie.id_item_entrada,rie.id_item_repair, p.tipo, p.id as id_producto,  rie.work_order,rie.id,it.descripcion,i.descripcion,ie.valor,p.nombre,rie.precio,work_order,pr.nombre  as proceso
        FROM request_item_entrada rie
        LEFT JOIN  items_entrada ie ON(ie.id=rie.id_item_entrada)
        LEFT JOIN items i ON (i.id=ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        INNER JOIN clientes_productos cp on (cp.id=rie.id_item_repair and rie.type='PRO')
        INNER JOIN productos p on(p.id=cp.productos_id )
        INNER JOIN procesos pr on (pr.id=cp.servicio_id)        
        INNER JOIN request r ON (r.id=rie.id_request) 
        INNER JOIN programacion pro on  (pro.request_activity=r.id)
        where pro.id ='$id'")->fetch();
        return Doo::conf()->APP_URL."productos/procedures/view/activities/$data[id_producto]";
    }
    
     public function timeLineInit(){
        $id = $this->params["pindex"];

        $authoEntry = Doo::db()->query("SELECT e.id,t.test30,t.test60,t.make_date,e.fecha as fecha_entrada,  pro.nombre as last_cargo,ai.type,c.nombre as nombre_cliente,time(ai.arrival) as arrival,ai.create_at as create_ai,t.serial,ai.fecha_estimada,ai.transportista,ai.placa,ai.conductor
        FROM autorizacion_ingreso ai
        inner join entrada e on (e.autorizacion_ingreso_id=ai.id)
        inner join clientes c on (c.id=ai.clientes_id)
        inner join tanques t on (t.id=ai.tanques_id)
        inner join clientes_productos cp on (cp.productos_id=e.last_cargo and cp.clientes_id=c.id)
        inner join productos  pro on(pro.id=cp.productos_id) 
        where e.id='$id';")->fetch();

        $status =  Doo::db()->query("SELECT s.status_name FROM logs_status ls
        inner join status s on s.id=ls.status
        where id_entrada='$id' and ls.cause='Entrada del tanque a ecolavados';")->fetch();

        $damages = Doo::db()->query("SELECT ie.id,img,valor,concat(i.descripcion,'-',ie.valor) as damage FROM entrada e
        INNER JOIN items_entrada ie on(ie.id_entrada=e.id)
        INNER JOIN items i ON (i.id = ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        inner JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'B' AND ca.causes_log='S')
        where  e.id='$id'")->fetchAll();

        $evidencias = Doo::db()->query("SELECT ie.id,img,valor,concat(i.descripcion,'-',ie.valor) as damage FROM entrada e
        INNER JOIN items_entrada ie on(ie.id_entrada=e.id)
        INNER JOIN items i ON (i.id = ie.items_id)
        LEFT JOIN  items it ON (it.id = i.depende)
        inner JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'G' AND ca.causes_log='S')
        where  e.id='$id'")->fetchAll();

        $request = Doo::db()->query("SELECT e.id as entrada,r.id,r.descripcion,r.state,c.nombre,t.serial
        FROM request r
        INNER JOIN entrada e  on (e.id=r.id_entrada) 
        inner join autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        inner join tanques t on (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=r.cliente_id)
        WHERE r.deleted='1' and e.id='$id' and r.state='A'")->fetchAll();
        
        $this->data["schedule"] = Doo::db()->query("select pe.cerrado,r.descripcion,pe.fecha_inicio as status,pe.fecha_fin as status1,if(DATE(p.fecha_inicio)>DATE(NOW()),'B','F') AS block ,r.id as request, p.fecha_inicio,p.fecha_fin,p.id,pr.nombre,concat(e.nombre,' ',e.apellido) as operario
        from programacion p 
        inner join request r on (r.id=p.request_activity)
        LEFT JOIN programacion_empleados pe on(pe.id_programacion=p.id)
        LEFT JOIN empleados e on (e.id=pe.id_empleado)
        inner join procesos pr on (pr.id=p.proceso) where  p.id_entrada='$id' and pr.id='3' ")->fetch();

        $this->data['request'] = $request;
        $this->data['evidencias'] = $evidencias;
        $this->data['damages'] = $damages;
        $this->data['status'] = $status["status_name"];
        $this->data['authoEntry'] = $authoEntry;
        $this->data['content'] = 'entradas/timeline.php';
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('index', $this->data, true);
    }
}