<?php

/**
 * Description of ClientesController
 *
 * @author Carlos Meri単o Iriarte <carlos.merino.iriarte@gmail.com>
 */
class MailController extends DooController {
    
    public function execute(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'send_mail_daily.php'; 
        $this->view()->renderc('index', $this->data);
    }
    
    public function sendmail(){
        Doo::loadClass("mail/PHPMailer");
        $mail = new PHPMailer();
        $mail->isSMTP(); 
        $mail->SMTPAuth = true;
        $mail->Host = 'mail4.correopremium.com';
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->Username = "operaciones@ecolavados.com.co";
        $mail->Password = "Martin2011*";
        

        $mail->SetFrom('operaciones@ecolavados.com.co', 'Operaciones ecolavados');
        $mail->AddReplyTo("operaciones@ecolavados.com.co","Operaciones ecolavados");
        $mail->Subject = "Informe de llegada de los tanques";
        $mail->MsgHTML("Hola que tal, le informo como llegaron los tanques");
        //indico destinatario
        $address = "miguelmazafernandez@gmail.com";
       
        
        $mail->AddAddress($address, "Miguel Maza");
        $mail->AddAddress("el.vega@arcoi.com.co", "E L");
        $mail->AddAddress("certificadosecol@gmail.com", "Certificados");
        $mail->AddAddress("mmf19972010@hotmail.com", "Miguel Maza");
        if(!$mail->Send()) {
        echo "Error al enviar: " . $mail->ErrorInfo;
        } else {
        echo "Mensaje enviado!";
        }
    }
    
    public function downloadExcel(){
        $id_cliente=1018;
        Doo::loadClass("excel/Classes/PHPExcel");
        $objPHPExcel = new PHPExcel();       
        $propiedades=$objPHPExcel->getProperties();
        $propiedades->setCreator("Cattivo");
        $propiedades->setLastModifiedBy("Cattivo");
        $propiedades->setTitle("Documento Excel");
        $propiedades->setSubject("Documento Excel");
        $propiedades->setDescription("descripcion del documento");
        $propiedades->setKeywords("Excel Office 2007 openxml php");
        $propiedades->setCategory("Documento Excel");
         // Agregar Informacion
        $page_body=$objPHPExcel->setActiveSheetIndex(0);

        
        $fila=1;
        $page_body->setCellValue('A'.$fila,"#");
       
        $page_body->setCellValue('B'.$fila,"Tank Number");
        $page_body->setCellValue('C'.$fila,"Date In");
        $page_body->setCellValue('D'.$fila,"Status");
        $page_body->setCellValue('E'.$fila,"Clean On");
    
        $sqlJoin = "INNER  JOIN status s ON (s.id=e.status)
        INNER JOIN autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id)
    	INNER JOIN tanques  t on (t.id=ai.tanques_id)
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
        INNER JOIN clientes_productos cp on (cp.productos_id=e.last_cargo and c.id=cp.clientes_id and cp.deleted='1')
        INNER JOIN productos p on p.id=cp.productos_id
    	LEFT  JOIN items_entrada ie  on (ie.id_entrada=e.id  and ie.causes_log='S')
        left JOIN  items it ON (ie.items_id = it.id) 
        left join programacion pro on(pro.id_entrada=e.id and pro.proceso=3)   
        left join programacion_empleados proe on(proe.id_programacion=pro.id)";
        
        
        $sql="SELECT date(proe.fecha_inicio) as fecha_inicio, ai.assing, ai.observation , concat(ai.placa_salida,'-',ai.nombre_conductor_salida) as salida,fecha_salida, ai.id as id_autorizacion,ai.type,ai.color_client_send,ai.numer_client_sed,ai.name_client_send,s.color,e.fecha ,t.serial,c.nombre,e.id,s.status_name ,
        group_concat(concat(it.descripcion,'-',ie.valor)) as damage ,   test30,test60,p.nombre as last_cargo
        FROM entrada e ". $sqlJoin ." where
    	c.id='$id_cliente' AND  e.estado='A' group by e.id order by e.fecha;";
        $entrys= Doo::db()->query($sql)->fetchAll();
        $i=0;
        foreach($entrys as $e){
            $i++;
            $fila++;
            $page_body->setCellValue('A' . $fila, $i);
            $page_body->setCellValue('B' . $fila, $e['serial']);
            $page_body->setCellValue('C' . $fila, $e['fecha']);
            $page_body->setCellValue('D' . $fila, $e['status_name']);
            $page_body->setCellValue('E' . $fila, $e['fecha_inicio']);

        
        }
        //Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('Estado Entradas');

        //Ajustar ancho de las columna
        foreach(range('A','E') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        // Crea nueva hoja dentro del documento excel
        $page_body=$objPHPExcel->createSheet(1);

        // Agregar Informacion
        $page_body=$objPHPExcel->setActiveSheetIndex(1);

        $fila=1;
        $page_body->setCellValue('A'.$fila,"#");
       
        $page_body->setCellValue('B'.$fila,"Tank Number");
        $page_body->setCellValue('C'.$fila,"Date In");
        $page_body->setCellValue('D'.$fila,"Status");
        $page_body->setCellValue('E'.$fila,"Clean On");
        $page_body->setCellValue('F'.$fila,"Date Out");

        $sql="SELECT date(proe.fecha_inicio) as fecha_inicio, sd.fecha_salida, ai.assing, ai.observation , concat(ai.placa_salida,'-',ai.nombre_conductor_salida) as salida, ai.id as id_autorizacion,ai.type,ai.color_client_send,ai.numer_client_sed,ai.name_client_send,s.color,e.fecha ,t.serial,c.nombre,e.id,s.status_name ,
        group_concat(concat(it.descripcion,'-',ie.valor)) as damage ,   test30,test60,p.nombre as last_cargo
        FROM salida sd 
        INNER JOIN entrada e ON e.id = sd.id_entrada
        " . $sqlJoin . " where
    	c.id='$id_cliente' AND e.fecha >= date_add(NOW(), INTERVAL -7 DAY) group by e.id order by e.fecha;";
        
        $entrys= Doo::db()->query($sql)->fetchAll();
        $i=0;
        foreach($entrys as $e){
            $i++;
            $fila++;
            $page_body->setCellValue('A' . $fila, $i);
            $page_body->setCellValue('B' . $fila, $e['serial']);
            $page_body->setCellValue('C' . $fila, $e['fecha']);
            $page_body->setCellValue('D' . $fila, $e['status_name']);
            $page_body->setCellValue('E' . $fila, $e['fecha_inicio']);
            $page_body->setCellValue('F' . $fila, $e['fecha_salida']);
 
        
        }

        //Renombrar Hoja 2
        $objPHPExcel->getActiveSheet()->setTitle('Historial Tanques');

        //Ajustar ancho de las columna
        foreach(range('A','F') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        //Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
        $objPHPExcel->setActiveSheetIndex(0);
        // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="CURRENT INVENTORY.xlsx"');//Para descargar en local
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $hoy = date("Y-m-d");  
        $documentName="CURRENT INVENTORY_$hoy.xlsx";
        //$objWriter->save(str_replace(__FILE__,"docs/$documentName",__FILE__));//Para guardar en el servidor 
        $objWriter->save('php://output');//Para guardar en el servidor 
        //return $documentName;

   
    }
    public function sendMailToAll(){
       
         Doo::loadHelper('DooMailer');
        
        $sql = "SELECT id,identificacion,nombre,celular,email,tipo FROM clientes WHERE deleted=1  ORDER BY nombre ASC";
        $clientes = Doo::db()->query($sql)->fetchAll();
        foreach($clientes as $cliente){
            $mail = new DooMailer();
            $emails=Doo::db()->query("SELECT email FROM action_email_clients WHERE id_client='$cliente[id]' AND id_action_email='4'")->fetch();
            $emails = explode(",", $emails["email"]);
            foreach($emails as $emal){
                if($emal!=""){
                    $mail->addTo($emal);
                }
                
            }
            $url=Doo::conf()->APP_URL."downloadExcel/$cliente[id]";

            $sqlTabla= "SELECT ai.type,
                            COUNT(IF(s.id = 6, 1,NULL)) AS AVL, 
                            COUNT(IF(s.id = 2 OR s.id = 15 , 1,NULL)) AS CLN, 
                            COUNT(IF(s.id = 8, 1,NULL)) AS MR,
                            COUNT(IF(s.id = 1 OR s.id = 5 OR s.id = 19  ,1,NULL)) AS NOAVL,  
                            COUNT(*) AS TOTAL
                        FROM entrada e 
                        INNER JOIN `status` s ON (s.id=e.status) 
                        INNER JOIN autorizacion_ingreso ai ON(ai.id=e.autorizacion_ingreso_id)
                        INNER JOIN clientes  c ON (c.id=ai.clientes_id)
                        WHERE	c.id=1018 AND  e.estado='A' AND (ai.type='Chemical' || ai.type='Food Grade') 
                        GROUP BY ai.type
                        ORDER BY ai.type";
            $counts= Doo::db()->query($sqlTabla)->fetchAll();
            
            if (array_search('Chemical', array_column($counts, 'type')) !== false){
                
                $chem= $counts[0];
            }else{
                $chem=  array("AVL"=>0,"CLN"=>0,"MR"=>0,"NOAVL"=>0,"AVL"=>0, "TOTAL"=>0);
            }
            
            if (array_search('Food Grade', array_column($counts, 'type')) !== false){
                $food= $counts[0]['type']=="Chemical"? $counts[1]: $counts[0];
            }else{
                $food= array("AVL"=>0,"CLN"=>0,"MR"=>0,"NOAVL"=>0,"AVL"=>0, "TOTAL"=>0);
            }

            $s1= $chem["AVL"]+$food["AVL"];
            $s2= $chem["CLN"]+$food["CLN"];
            $s3= $chem["MR"]+$food["MR"];
            $s4= $chem["NOAVL"]+$food["NOAVL"];

            $template = <<<EOT
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
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Ecolavados – Grupo Carmona</p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>Current Inventory </p>
                    <p style='font-family:arial; font-size:20px; margin-top:20px'>
                    Hi $cliente[nombre], We have sent an attachment in excel format with the current status of your tanks
                    </p>

                    <br>
                    <table class="tg" style="undefined;table-layout: fixed; width: 394px">
                        <colgroup>
                            <col style="width: 61px">
                            <col style="width: 112px">
                            <col style="width: 127px">
                            <col style="width: 94px">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="tg-0lax"></th>
                                <th class="tg-0lax">CHEMICAL</th>
                                <th class="tg-0lax">FOOD GRADE</th>
                                <th class="tg-0lax">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="tg-0lax">AVL</td>
                                <td class="tg-0lax">$chem[AVL]</td>
                                <td class="tg-0lax">$food[AVL]</td>
                                <td class="tg-0lax">$s1</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">CLN</td>
                                <td class="tg-0lax">$chem[CLN]</td>
                                <td class="tg-0lax">$food[CLN]</td>
                                <td class="tg-0lax">$s2</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">M&amp;R</td>
                                <td class="tg-0lax">$chem[MR]</td>
                                <td class="tg-0lax">$food[MR]</td>
                                <td class="tg-0lax">$s3</td>
                            </tr>
                            <tr>
                                <td class="tg-0lax">NO AVL</td>
                                <td class="tg-0lax">$chem[NOAVL]</td>
                                <td class="tg-0lax">$food[NOAVL]</td>
                                <td class="tg-0lax">$s4</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <center>
                
                

            </body>
        </html>
        <style type="text/css">
            .tg {
                border-collapse: collapse;
                border-color: #ccc;
                border-spacing: 0;
            }

            .tg td {
                background-color: #fff;
                border-color: #ccc;
                border-style: solid;
                border-width: 1px;
                color: #333;
                font-family: Arial, sans-serif;
                font-size: 14px;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg th {
                background-color: #f0f0f0;
                border-color: #ccc;
                border-style: solid;
                border-width: 1px;
                color: #333;
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-weight: normal;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg .tg-0lax {
                text-align: left;
                vertical-align: top
            }
        </style>
EOT;

            
            $hoy = date("Y-m-d"); 
            $mail->setSubject("Currrent Inventory $hoy");
            $mail->setBodyHtml($template);
            $mail->setFrom('operaciones@ecolavados.com.co', "Current Inventory");
        //  $to = sprintf("%010d", $id);
            $mail->addAttachment('docs/'.$this->downloadExcel($cliente["id"]));
            $mail->send();
        } 
       
    }
    
    
     public function newsing(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'items/newSing.php';
        $this->renderc('newSing/newSing', $this->data, true);
     }
}

?>