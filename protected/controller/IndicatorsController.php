<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meri�0�9o Iriarte <carlos.merino.iriarte@gmail.com>
 */
class IndicatorsController extends DooController {

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
        $initialdate='2019';
        $actualdate=date("o");
        $years=array();
        foreach(range($initialdate,$actualdate,1) as $numero){
            $years[]=$numero;
        }
        $this->data['years']= $years;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'indicators/index.php';
        $this->renderc('index', $this->data, true);
    }
    
     public function indexEmpleados(){
        $initialdate='2019';
        $actualdate=date("o");
        $years=array();
        foreach(range($initialdate,$actualdate,1) as $numero){
            $years[]=$numero;
        }
        $this->data['years']= $years;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'indicators/indexEmpelados.php';
        $this->renderc('index', $this->data, true);
    }

    public function tiempoDescarga(){
        $year =  $_POST["year"];
        $month = $_POST["month"];
        $initialdate = $year."-". $month."-01";
        $finaldate = $year."-". $month."-31";
        $tiempo=Doo::db()->query("SELECT c.nombre,t.serial, ai.arrival,e.create_at,TIMESTAMPDIFF(MINUTE,ai.arrival,e.create_at) tiempo
         FROM entrada  e
        INNER  JOIN autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        INNER JOIN tanques t ON (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=ai.clientes_id)
        where created_at between '$initialdate' and '$finaldate' 
        ")->fetchAll();
    }

    public function salidasPDF(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/departuresPDF");
        $pdf = new departuresPDF();
        
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($this->clientsAndSalidas($initialdate,$finaldate));
        $pdf->Output();
    }
    
     public function currenInvoice(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadController("EntrysController");
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/allEntrysInvoicePDF");
        $clientsandEntry = $this->clientsAndEntrys($initialdate,$finaldate);
        $EntrysController = new EntrysController();
               
        $pdf = new allEntrysInvoicePDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($clientsandEntry);
        $pdf->Output();

    }

    public function totalInvoiceReport(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/totalInvoicePDF");
        $pdf = new totalInvoicePDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($this->clientsAndSalidas($initialdate,$finaldate));
        $pdf->Output();
    }

   public function clientsAndSalidas($initialdate,$finaldate){
        $clientes=$this->clientes();
        $allclientes=array();
        foreach($clientes as $cliente){
            $where = "and  ai.clientes_id='$cliente[id]'";
            $salidas=$this->salidas($initialdate,$finaldate,$where);
            if($salidas){
                $cliente["salidas"]=$salidas;
                $allclientes[]=$cliente;
            }
        }
     
        return $allclientes;
    }



    public function salidas($initialdate,$finaldate,$where=''){
        return Doo::db()->query("SELECT e.fecha,s.fecha_salida,e.id id_entrada,c.nombre, s.id,e.id as entrada,ai.id as autorizacion,placa_salida,nombre_conductor_salida,e.fecha as fecha_ingreso, s.fecha_salida, s.observacion,t.serial
        from salida s
        INNER join tanques t on (t.id=s.id_tanque) 
        INNER join entrada e on (e.id=s.id_entrada)
        INNER join autorizacion_ingreso ai on (ai.id=s.id_autorizacion)
        INNER JOIN clientes  c on (c.id=ai.clientes_id) where s.fecha_salida between '$initialdate' and '$finaldate' $where")->fetchAll();
    }

    public function entrysYear(){
        $year  = $_POST["year"];
        $entrys=Doo::db()->query("SELECT DATE_FORMAT(fecha, '%M') as  mes, year(fecha) as yea,month(fecha),count('') as cantidad 
                                    FROM entrada where estado != 'P'  AND year(fecha)=YEAR('$year') group by month(fecha) order by fecha;")->fetchAll();
        echo json_encode($entrys);
    }

    public function invoicedByYear(){
        $year  = $_POST["year"];
        $entrys=Doo::db()->query("SELECT DATE_FORMAT(minimo,'%M')as  mes,sum(total) as total FROM items_facturas where year(minimo)=YEAR('$year') group by month(minimo) ; ")->fetchAll();
        echo json_encode($entrys);
    }


    public function numberStateByMonth(){
        $year  = $_POST["year"];
        $state = Doo::db()->query("SELECT count(distinct e.id) as cantidad,DATE_FORMAT(e.fecha, '%M') as  mes, year(e.fecha) as yea,month(e.fecha),s.status_name FROM entrada e
        INNER JOIN logs_status ls on     e.id=ls.id_entrada
        INNER JOIN status s on s.id=ls.status
        where cause='Entrada del tanque a ecolavados' and estado != 'P'  AND year(e.fecha)=YEAR('$year')and month(e.fecha)=month('$year') 
        group by s.id order by e.fecha;")->fetchAll();
        echo json_encode($state);
    }


   

    public function timeCleanReport(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/timeCleanPDF");
        $pdf = new timeCleanPDF();
        $clientes=$this->clientes();
        $allclientes=array();
        foreach($clientes as $cliente){
            $where ="and ai.clientes_id='$cliente[id]'";
            $entradas=$this->entrysUntilClean($initialdate,$finaldate,$where);
            if($entradas){
                $cliente["entradas"]=$entradas;
                $allclientes[]=$cliente;
            }
        }
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($allclientes);
        $pdf->Output();
    }
     public function clientes(){
        $sql = "SELECT c.id,identificacion,celular,email,tipo ,nombre,precio,moneda,c.deleted FROM clientes_productos cp        
        INNER JOIN clientes c ON (c.id=cp.clientes_id)
        WHERE cp.deleted='1' 
        GROUP BY clientes_id,moneda";
        return Doo::db()->query($sql)->fetchAll();
    }
  
    public function allEntrysReport(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/allEntrysPDF");
        $pdf = new allEntrysPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($this->clientsAndEntrys($initialdate,$finaldate));
        $pdf->Output();
    }
 

    public function clientsAndEntrys($initialdate,$finaldate){
        $clientes=$this->clientes();
        $allclientes=array();
        foreach($clientes as $cliente){
            $where ="and ai.clientes_id='$cliente[id]'";
            $entradas=$this->entrada($initialdate,$finaldate,$where);
            if($entradas){
                $cliente["entradas"]=$entradas;
                $allclientes[]=$cliente;
            }
        }
        return $allclientes;
    }
    
    public function detailsTime(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
         Doo::loadClass("reportes/detailsTimePDF");
        
        $data = Doo::db()->query("SELECT c.nombre,t.serial,ai.arrival,ai.final_arrival update_at,
        TIMESTAMPDIFF(MINUTE,ai.arrival,ai.final_arrival) tiempo FROM entrada  e
        INNER  JOIN autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        INNER JOIN tanques t ON (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=ai.clientes_id)
        where  ai.final_arrival between '$initialdate' and  '$finaldate' order by ai.final_arrival")->fetchAll();
        $pdf = new detailsTimePDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($data);
        $pdf->Output();
        
    }

    public function atencionServiceReport(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/atencionServicePDF");
        $empleados=Doo::db()->query("SELECT * FROM empleados")->fetchAll();
        $allempleados=array();
        foreach($empleados as $empleado){
            $where ="and e.id='$empleado[id]'";
            $atenciones=$this->atencionService($initialdate,$finaldate,$where);
            if($atenciones){
                $empleado["atenciones"]=$atenciones;
                $allempleados[]=$empleado;
            }
        }
        
        $pdf = new atencionServicePDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($allempleados);
        $pdf->Output();
    }
    public function  atencionService($initialdate,$finaldate,$where='',$inner='',$select=''){
        return Doo::db()->query("SELECT $select en.id,c.nombre as cliente,t.serial,  
        concat(e.nombre,' ',e.apellido)as empleado,
        prod.nombre as last_catgo,
        pro.nombre as proceso,
        pe.fecha_inicio,
        pe.fecha_fin,
        p.fecha_inicio as fecha_i_p,
        p.fecha_fin as fecha_f_p,
        en.fecha,
         TIMESTAMPDIFF(day,date(pe.fecha_inicio) ,date(pe.fecha_fin)) Dias,
        (if(TIMESTAMPDIFF(day,date(pe.fecha_inicio),date(pe.fecha_fin))>1 ,TIMESTAMPDIFF(day,date(pe.fecha_inicio),date_sub(date(pe.fecha_fin), interval 1 day) )*480,0)  +      
        
        if(date(pe.fecha_inicio)=date(pe.fecha_fin),TIMESTAMPDIFF(minute, pe.fecha_inicio , pe.fecha_fin) ,
        TIMESTAMPDIFF(minute, pe.fecha_inicio , concat(date(pe.fecha_inicio),' 18:00:00') )
        + TIMESTAMPDIFF(minute, concat(date(pe.fecha_fin),' 08:00:00')  , pe.fecha_fin)))/60 duracion,
        
        if(date(pe.fecha_inicio)=date(pe.fecha_fin),TIMESTAMPDIFF(minute, pe.fecha_inicio , pe.fecha_fin) ,0)/60 sameDay,
        if(date(pe.fecha_inicio)=date(pe.fecha_fin),0,
        TIMESTAMPDIFF(minute, pe.fecha_inicio , concat(date(pe.fecha_inicio),' 18:00:00')  ) )/60 diaApertura,
        if(date(pe.fecha_inicio)=date(pe.fecha_fin),0,      
         TIMESTAMPDIFF(minute, concat(date(pe.fecha_fin),' 08:00:00')  , pe.fecha_fin))/60 diaCierre
        
        FROM programacion p                                                  
        INNER JOIN programacion_empleados pe on(pe.id_programacion=p.id)
        INNER JOIN empleados e ON(e.id=pe.id_empleado)
        INNER JOIN procesos pro on(pro.id=p.proceso)
        INNER JOIN entrada en on (en.id=p.id_entrada)
        inner join clientes_productos cp on (cp.productos_id=en.last_cargo)
        inner join productos  prod on(prod.id=cp.productos_id) 
        INNER JOIN autorizacion_ingreso ai on  (ai.id=en.autorizacion_ingreso_id)
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
        INNER JOIN tanques  t on (t.id=ai.tanques_id)
        $inner
        where p.fecha_inicio between '$initialdate' and  '$finaldate' $where
        group by en.id ")->fetchAll();
    }

    public function entrada($initialdate,$finaldate,$where=''){
       return Doo::db()->query("SELECT sa.fecha_salida as real_sa,date(proe.fecha_inicio) fecha_lavado, e.fecha ,ai.assing, ai.observation , concat(ai.placa_salida,'-',ai.nombre_conductor_salida) as salida,ai.fecha_salida, ai.id as id_autorizacion,ai.type,ai.color_client_send,ai.numer_client_sed,ai.name_client_send,s.color,t.serial,c.nombre,e.id,s.status_name ,
        group_concat(concat(it.descripcion,'-',ie.valor)) as damage ,   test30,test60,p.nombre as last_cargo,'' as timelapse
        FROM entrada e
        INNER  JOIN status s ON (s.id=e.status)
        INNER JOIN autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id)
    	INNER JOIN tanques  t on (t.id=ai.tanques_id)
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
        INNER JOIN clientes_productos cp on (cp.productos_id=e.last_cargo and c.id=cp.clientes_id and cp.deleted='1')
        INNER JOIN productos p on p.id=cp.productos_id
    	LEFT  JOIN items_entrada ie  on (ie.id_entrada=e.id  and ie.causes_log='S')
        left JOIN  items it ON (ie.items_id = it.id) 
        left join programacion pro on(pro.id_entrada=e.id and pro.proceso=3)   
        left join programacion_empleados proe on(proe.id_programacion=pro.id)
        left join salida sa on(sa.id_entrada=e.id)
        where e.estado != 'P' and  e.fecha between '$initialdate' and '$finaldate'  $where  group by e.id order by e.fecha;")->fetchAll();
    }

    public function entrysUntilClean($initialdate,$finaldate,$where=''){
       
        $entradas = $this->entrada($initialdate,$finaldate,$where);
        $allEntradas=array();
        foreach($entradas as $entrada){
            if($entrada["fecha_lavado"]!=""){
                $timelap=Doo::db()->query("SELECT count(a.Date)*8 as timelap from (
                    select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a) + (1000 * d.a) ) DAY as Date
                    from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
                    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
                    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
                    cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as d
                ) a
                where a.Date between '$entrada[fecha]' and '$entrada[fecha_lavado]' and  DAYOFWEEK(a.Date) != 1 and a.Date not in (select fecha from festivos where fecha between '$entrada[fecha]' and '$entrada[fecha_lavado]')")->fetch();
                $entrada["timelapse"]=$timelap["timelap"];
                $allEntradas[]=$entrada;
            }
        }
        return $allEntradas;
    }

    public function renderIndicators() {
        $year =  $_POST["year"];
        $month = $_POST["month"];
        $initialdate = $year."-". $month."-01";
        $finaldate = $year."-". $month."-31";
        
        
        
        $clientsAndSalidas = $this->clientsAndSalidas($initialdate,$finaldate);
        $totalp=0;
        $totald=0;
        
        foreach($clientsAndSalidas as $clientsAndEntry){
            foreach($clientsAndEntry["salidas"] as $alway){
                $items = Doo::db()->query("SELECT * from items_facturas where id_entrada='$alway[entrada]'")->fetchAll();
                foreach($items as $always){
                
                    if($clientsAndEntry["moneda"]=="P"){
                        $totalp+=$always["total"];
                    }else{
                        $totald+=$always["total"];
                    }
                }               
                    
            }
        }

        
        /**ENTRADAS POR MES */
        $entrysByMonth=$this->entrada($initialdate,$finaldate);
        /**SALIDAS POR MES */
        $departuresByMonth=$this->salidas($initialdate,$finaldate);


        /**Tiempo de atenci��n de lavado */
        $promAtencionLavado=0;
        $sum=0;
        $count=0;
        $entrysUntilClean=$this->entrysUntilClean($initialdate,$finaldate);
        foreach($entrysUntilClean as $entrys){
            if($entrys["fecha_lavado"]!=""){
                $count++;
                $sum=$sum+$entrys["timelapse"];
            }
        }if($count!=0 || $sum!=0){
            $promAtencionLavado=$sum/$count;
        }else{
            $promAtencionLavado=0;
        }
        /**Tiempo de atencion de los servicios */
        $promAptencionServicios=0;
        $sum=0;
        $count=0;
        $atencionService=$this->atencionService($initialdate,$finaldate);
        foreach($atencionService as $time){
           
                $count++;
                $sum=$sum+$time["duracion"];
            
        }
        if($count!=0 || $sum!=0){
            $promAptencionServicios=$sum/$count;
        }else{
            $promAptencionServicios=0;
        }
        /**PROMEDIO DEL tIEMPO QUE DEMORA UN TANQUE DESDE QUE LLEGA A PORTERIA HASTA QUE SE REALICE EL IER */
        $avgTiempoDescarga= Doo::db()->query("SELECT avg(TIMESTAMPDIFF(MINUTE,ai.arrival,ai.final_arrival)) tiempo FROM entrada  e
        INNER  JOIN autorizacion_ingreso ai on (ai.id=e.autorizacion_ingreso_id)
        INNER JOIN tanques t ON (t.id=ai.tanques_id)
        INNER JOIN clientes c ON (c.id=ai.clientes_id)
        where  ai.final_arrival between '$initialdate' and '$finaldate' order by ai.final_arrival ")->fetch();
         //var_dump($finaldate);
        $this->data["totalInvocedp"]=$totalp;
        $this->data["totalInvocedd"]=$totald;
        $this->data["initialdate"]=$initialdate;
        $this->data["finaldate"]=$finaldate;
        $this->data["avgTiempoDescarga"]= $avgTiempoDescarga['tiempo'];
        $this->data["avgTiempoLavado"]=number_format($promAtencionLavado,2) ;
        $this->data["promAptencionServicios"]=number_format($promAptencionServicios,2) ;
        
        $this->data["entrysByMonth"]= $entrysByMonth;
        $this->data["countEntrysByMonth"]= COUNT($entrysByMonth);
        $this->data["countDeparturesByMonth"]= COUNT($departuresByMonth);
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('indicators/charts', $this->data, true);
    }
    public function renderIndicatorsB() {
        $year =  $_POST["year"];
        $month = $_POST["month"];
        $initialdate = $year."-". $month."-01";
        $finaldate = $year."-". $month."-31";

        /** */
        $initYear = $year."-01-01";
        
        
        $clientsAndSalidas = $this->clientsAndSalidas($initYear,$finaldate);
        $totalp=0;
        $totald=0;
        
        foreach($clientsAndSalidas as $clientsAndEntry){
            foreach($clientsAndEntry["salidas"] as $alway){
                $items = Doo::db()->query("SELECT * from items_facturas where id_entrada='$alway[entrada]'")->fetchAll();
                foreach($items as $always){                
                    if($clientsAndEntry["moneda"]=="P"){
                        $totalp+=$always["total"];
                    }else{
                        $totald+=$always["total"];
                    }
                }               
                    
            }
        }

        $clientsAndSalidas = $this->clientsAndSalidas($initialdate,$finaldate);
        $totalrp=0;
        $totalrd=0;
        foreach($clientsAndSalidas as $clientsAndEntry){
            foreach($clientsAndEntry["salidas"] as $alway){
                $items = Doo::db()->query("SELECT * from items_facturas where service='Service: REPARATION Object: General' and id_entrada='$alway[entrada]'")->fetchAll();
                foreach($items as $always){                
                    if($clientsAndEntry["moneda"]=="P"){
                        $totalrp+=$always["total"];
                    }else{
                        $totalrd+=$always["total"];
                    }
                }               
                    
            }
        }
        
        $where =" and p.proceso='3'";
        $Allatenciones=$this->atencionService($initialdate,$finaldate,$where);


        /**ENTRADAS POR MES */
        $entrysByMonth=$this->entrada($initialdate,$finaldate);

        $tanquelavados = $this->tanqueLavados($initialdate,$finaldate);
        $tiempoEnAtenderICalidad=0;
        $tiempoParaPrueba=0;
        $tiempoEnPrueba=0;
        $i=0;
        foreach($tanquelavados as $tanques){
            $tiempoEnAtenderICalidad+=$tanques["duracion"];
            $tiempoParaPrueba+=$tanques["duracionH2"];
            $tiempoEnPrueba+=$tanques["duracionH3"];
            $i++;
        }
        if($i==0){
            $i=1;
        }
        $this->data["initYear"]=$initYear;
        $this->data["initialdate"]=$initialdate;
        $this->data["finaldate"]=$finaldate;
        $relavados=$this->relavados($initialdate,$finaldate);
        
        $this->data["totalrp"]= $totalrp;
        $this->data["totalFacturado"]= $totald;
        $this->data["countEntrysByMonth"]= COUNT($entrysByMonth);
        $this->data["counttanquelavados"]= COUNT($Allatenciones);
        $this->data["counttanqueRelavados"]= COUNT($relavados);
        $this->data['tiempoEnAtenderICalidad']=$tiempoEnAtenderICalidad/$i;
        $this->data['tiempoParaPrueba']=$tiempoParaPrueba/$i;
        $this->data['tiempoEnPrueba']=$tiempoEnPrueba/$i;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('indicators/chartsb', $this->data, true);
    }
     public function tanqueLavados($initialdate,$finaldate,$where="",$inner=""){
        return  Doo::db()->query("SELECT  e.fecha as fecha_entrada,t.serial,c.nombre,e.id as in_entrada,s.status_name,proe.cerrado,
		if(proetest.fecha_inicio is null,now(),proetest.fecha_inicio) inicioTest , proetest.fecha_fin finTest,proe.fecha_inicio fecha_inicio_lavado,proe.fecha_fin fecha_fin_lavado,cali.date_init inicio_calidad,
        TIMESTAMPDIFF(hour, proe.fecha_fin , cali.date_init) AS h,      
          
        (if(TIMESTAMPDIFF(day,date(if(proetest.fecha_inicio is null,now(),proetest.fecha_inicio)),date(cali.date_init))>1 ,
        TIMESTAMPDIFF(day,date(if(proetest.fecha_inicio is null,now(),proetest.fecha_inicio)),date_sub(date(cali.date_init), interval 1 day) )*480,0)  +      
        if(date(if(proetest.fecha_inicio is null,now(),proetest.fecha_inicio))=date(cali.date_init),TIMESTAMPDIFF(minute, if(proetest.fecha_inicio is null,now(),proetest.fecha_inicio) , cali.date_init) ,
        TIMESTAMPDIFF(minute, if(proetest.fecha_inicio is null,now(),proetest.fecha_inicio) , concat(date(if(proetest.fecha_inicio is null,now(),proetest.fecha_inicio)),' 18:00:00') )
        + TIMESTAMPDIFF(minute, concat(date(cali.date_init),' 08:00:00')  , cali.date_init)))/60 duracion,        
		TIMESTAMPDIFF(hour, cali.date_init , proetest.fecha_inicio) AS h2,
        
		(if(TIMESTAMPDIFF(day,date(cali.date_init),date(proetest.fecha_inicio))>1 ,TIMESTAMPDIFF(day,date(cali.date_init),date_sub(date(proetest.fecha_inicio), interval 1 day) )*480,0)  +      
		if(date(cali.date_init)=date(proetest.fecha_inicio),TIMESTAMPDIFF(minute, cali.date_init , proetest.fecha_inicio) ,
		TIMESTAMPDIFF(minute, cali.date_init , concat(date(cali.date_init),' 18:00:00') )
		+ TIMESTAMPDIFF(minute, concat(date(proetest.fecha_inicio),' 08:00:00')  , proetest.fecha_inicio)))/60 duracionH2,
        TIMESTAMPDIFF(hour, proetest.fecha_inicio , proetest.fecha_fin) AS h3,   

		(if(TIMESTAMPDIFF(day,date(proetest.fecha_inicio ),date(proetest.fecha_fin))>1 ,TIMESTAMPDIFF(day,date(proetest.fecha_inicio ),date_sub(date(proetest.fecha_fin), interval 1 day) )*480,0)  +      
		if(date(proetest.fecha_inicio )=date(proetest.fecha_fin),TIMESTAMPDIFF(minute, proetest.fecha_inicio  , proetest.fecha_fin) ,
		TIMESTAMPDIFF(minute, proetest.fecha_inicio  , concat(date(proetest.fecha_inicio ),' 18:00:00') )
		+ TIMESTAMPDIFF(minute, concat(date(proetest.fecha_fin),' 08:00:00')  , proetest.fecha_fin)))/60 duracionH3
        FROM entrada e
        INNER  JOIN status s ON (s.id=e.status or status=0)
        INNER JOIN autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id)
        INNER JOIN tanques  t on (t.id=ai.tanques_id)
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
        INNER JOIN clientes_productos cp on (cp.productos_id=e.last_cargo and c.id=cp.clientes_id and cp.deleted='1')
        INNER JOIN productos p on p.id=cp.productos_id       
        LEFT  JOIN items_entrada ie  on (ie.id_entrada=e.id  and ie.causes_log='S')
        left JOIN  items it ON (ie.items_id = it.id) 
        inner join programacion pro on(pro.id_entrada=e.id and pro.proceso=3) 
        inner join programacion_empleados proe on(proe.id_programacion=pro.id)
        inner join calidad cali on cali.id_programacion=pro.id
        $inner
        left join programacion test on(test.id_entrada=e.id and test.proceso=9)
        left join programacion_empleados proetest on(proetest.id_programacion=test.id)
        left join salida sa on(sa.id_entrada=e.id)
        where e.estado != 'P' and  e.fecha between '$initialdate' and '$finaldate' $where  group by e.id,pro.proceso order by e.fecha;")->fetchAll();
    }
    public function relavados($initialdate,$finaldate){
        return Doo::db()->query("SELECT * FROM logs_status ls
        INNER  JOIN entrada e  on (e.id=ls.id_entrada)
        INNER JOIN autorizacion_ingreso ai on  (ai.id=e.autorizacion_ingreso_id)
        INNER JOIN tanques  t on (t.id=ai.tanques_id)
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
        where ls.status=20 and e.fecha between '$initialdate' and '$finaldate' or ls.cause='CLEANING UP AGAIN' 
        and e.fecha between '$initialdate' and '$finaldate';")->fetchAll();
    }

 public function tanquesRelavadosEmpleado(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/RelavadoTanquesPorEmpleadoPDF");
        $empleados=Doo::db()->query("SELECT * FROM empleados")->fetchAll();
        $allempleados=array();
        $inner="";
        foreach($empleados as $empleado){
            $where =" and e.id='$empleado[id]' and p.proceso='10' and en.fecha between '$initialdate' and '$finaldate' or e.id='$empleado[id]' 
            and p.proceso='10'  and en.fecha between '$initialdate' and '$finaldate'";
            $atenciones=$this->atencionService($initialdate,$finaldate,$where,$inner,"");
        
            $where ="and e.id='$empleado[id]' and p.proceso='3'";
            $Allatenciones=$this->atencionService($initialdate,$finaldate,$where);
            if($atenciones){
                $empleado["atenciones"]=$atenciones;
                $empleado["Allatenciones"]=$Allatenciones;
                $allempleados[]=$empleado;
            }
        }
        $pdf = new RelavadoTanquesPorEmpleadoPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($allempleados);
        $pdf->Output();
    }
    
    public function renderIndicadoresEmpleados() {
        $year =  $_POST["year"];
        $month = $_POST["month"];
        $initialdate = $year."-". $month."-01";
        $finaldate = $year."-". $month."-31";
        /**ENTRADAS POR MES */
        $entrysByMonth=$this->entrada($initialdate,$finaldate);

        $tanquelavados = $this->tanqueLavados($initialdate,$finaldate);
        $tiempoEnAtenderICalidad=0;
        $tiempoParaPrueba=0;
        $i=0;
        foreach($tanquelavados as $tanques){
            $tiempoEnAtenderICalidad+=$tanques["h"];
            $tiempoParaPrueba+=$tanques["h2"];
            $i++;
        }
        $this->data["initialdate"]=$initialdate;
        $this->data["finaldate"]=$finaldate;
        $this->data["countEntrysByMonth"]= COUNT($entrysByMonth);
        $this->data["counttanquelavados"]= COUNT($tanquelavados);
        $this->data['tiempoEnAtenderICalidad']=$tiempoEnAtenderICalidad/$i;

        $this->data['tiempoParaPrueba']=$tiempoParaPrueba/$i;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('indicators/chartsEmpleados', $this->data, true);
    }
    
    
     public function TanquesPorEmpleado(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/TanquesPorEmpleadoPDF");
        $empleados=Doo::db()->query("SELECT * FROM empleados")->fetchAll();
        $allempleados=array();
        foreach($empleados as $empleado){
            $where ="and e.id='$empleado[id]' and p.proceso='3'";
            $atenciones=$this->atencionService($initialdate,$finaldate,$where);
            if($atenciones){
                $empleado["atenciones"]=$atenciones;
                $allempleados[]=$empleado;
            }
        }
        
        $pdf = new TanquesPorEmpleadoPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($allempleados);
        $pdf->Output();
    }
    
     public function timetoquiality(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
         Doo::loadClass("reportes/timesToQuality");
        
        $tanquelavados = $this->tanqueLavados($initialdate,$finaldate);
        $pdf = new timesToQuality();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($tanquelavados );
        $pdf->Output();
    }

    
    public function timesInTest(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
         Doo::loadClass("reportes/timesInTest");
        
        $tanquelavados = $this->tanqueLavados($initialdate,$finaldate);
        $pdf = new timesInTest();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($tanquelavados );
        $pdf->Output();
    }
    public function timesToAirTest(){
        $initialdate=$this->params["initialdate"];
        $finaldate=$this->params["finaldate"];
        Doo::loadClass("pdf/fpdf");
         Doo::loadClass("reportes/timesToAirTest");
        
        $tanquelavados = $this->tanqueLavados($initialdate,$finaldate);
        $pdf = new timesToAirTest();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($tanquelavados );
        $pdf->Output();
    }
    
    

 
}