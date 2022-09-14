<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class SpacePDF extends FPDF {

    function Body($data,$ats) {
        $x = 5;
        $y = 5;

        $this->SetXY($x, $y);
      
       
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 15,$this->Image("global/img/logo.png", 15, 5, 40, 15, 'PNG'), 1, 0, 'C');
        $this->Cell(110, 5, utf8_decode("PERMISO DE TRABAJO EN ESPACIO CONFINADO"), "TR", 0, 'C');
        $this->SetFont('Arial', '', 7);
        $this->Cell(30, 5,utf8_decode("Versión 2") , "TR", 1, 'C');
        $this->SetX($x + 60);

        $this->Cell(110, 5,utf8_decode("") , "RB", 0, 'C');
        $this->Cell(30, 5,utf8_decode("Fecha: 12/07/2019") , "TRB", 1, 'C');
        
      /*  $this->SetX($x + 60);
       
        $this->Cell(110, 5,utf8_decode("PROCESO DE DIRECCIÓN Y MEJORA CONTINUA") , "RB", 0, 'C');
        $this->Cell(30, 5, utf8_decode("Página 1 de 1") , "RB", 1, 'C');
        $this->Ln(5);
         $this->SetFillColor("0","128","128");
        $this->SetX($x );
      

        $this->SetX($x);
        $pic =  $data["firma_empleado_autoriza"];
        //$info = getimagesize($pic);
        $TEMPIMGLOC = 'tempimg.png';
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);
        if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false ) {
            $this->Image($TEMPIMGLOC,50, 45,  15,15,'png');
        }
        
        $pic =  $data["firma_empleado_autorizado"];
        //$info = getimagesize($pic);
     //   
        $TEMPIMGLOCo = 'tempimg.png';
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);
        if( file_put_contents($TEMPIMGLOCo,$decodedImg)!==false ) {
            $this->Image($TEMPIMGLOCo,150, 45,  15,15,'png');
        }
        $this->Cell(100, 5, "Firma de quien autoriza", "1", 0, 'C',true);
        $this->Cell(100, 5,"Firma  quien autoriza", "1", 1, 'C',true);
        $this->SetX($x);
        $this->Cell(100, 12,$data["operador"], "1", 0, 'L');
        $this->Cell(100, 12, $data["autoriza"], "1", 1, 'L');
        $this->Ln(5);
        $this->SetFillColor("0","128","128");*/
        //var_dump($ats);
        foreach($ats as $a){
       
            if($a["numero"]=="1"){
                
                $this->SetFillColor("0","128","128");
                $this->SetX($x);
                $this->SetFont('Arial', '', 10);
                $this->Cell(200, 5, utf8_decode($a["numero"].".".$a["nombre"]), "1",1, 'C',true);
                
                $this->SetX($x);
                $this->SetFillColor("214","227","188");
                $this->Cell(30, 5,utf8_decode("Fecha:") , "1", 0, 'C',true);
                $this->Cell(30, 5,utf8_decode($data["fecha"]) , "1", 0, 'C');
         
                $this->Cell(30, 5, utf8_decode("Hora de inicio:") , "1", 0, 'C',true);
                $this->Cell(40, 5, utf8_decode($data["inicio"]) , "1", 0, 'C');

                $this->Cell(30, 5, utf8_decode("Hora final:") , "1", 0, 'C',true);
                $this->Cell(40, 5, utf8_decode($data["final"]) , "1", 1, 'C');
                
                $this->SetX($x);
                $this->Cell(75, 5,utf8_decode("Area de trabajo") , "1", 0, 'C',true);
                $this->Cell(75, 5,utf8_decode("Trabajo a realizar") , "1", 0, 'C',true);
                $this->Cell(50, 5, utf8_decode("Solicitud de servicio") , "1", 1, 'C',true);
                
                $this->SetX($x);
                $this->Cell(75, 5,utf8_decode("Pista de lavado") , "1", 0, 'C');
                $this->Cell(75, 5,utf8_decode($data["trabajo"]) , "1", 0, 'C');
                $this->Cell(50, 5, utf8_decode($data["consecutivo"]) , "1", 1, 'C');
                $this->SetX($x);
                
                $text="";
                foreach($a["tareas"] as $items ){
                   $text .="  ".utf8_decode($items["nombre"]);
                }
               
                $this->Cell(60, 5,utf8_decode("Herramientas y/o equipos a utilizar: ") , "1", 0, 'C',true);
                $this->Cell(140, 5, utf8_decode($text) , "1", 1, 'C');
                
                $this->SetX($x);
                $this->SetFont('Arial', '', 7);
                $this->MultiCell(170, 3, utf8_decode("Los ejecutantes han sido informados de la tarea, de las medidas preventivas asociadas, medidas de emergencia, equipos  de medida necesarios para realizar el trabajo (gases tóxicos, explosivos y nivel de oxígeno), equipos de rescate, equipos de respiración y equipos de protección individual requeridos durante la ejecución de la tarea.
                ") , "1", 'J');
                $this->SetY(40);
                $this->SetX(175);
                
                $this->Cell(15, 12,utf8_decode("SI") , "1", 0, 'C',$data["informado"]=='S' ? true:false);
                $this->Cell(15, 12,utf8_decode("NO") , "1", 1, 'C',$data["informado"]=='N' ? true:false);
                
            }else if($a["numero"]=="2"){
                $this->SetFillColor("0","128","128");
                $this->SetX($x);
                $this->SetFont('Arial', '', 10);
                $this->Cell(200, 5, utf8_decode($a["numero"].".".$a["nombre"]), "1",1, 'C',true);
                $this->SetFillColor("0","0","0");
               
                $this->SetY(58);
                $this->SetX($x+2);
                 $this->SetFont('Arial', '', 7);
                $this->Cell(10, 5, "", "1",0, 'C',$data["medidor_calibrado"]=='S' ? true:false);
                $this->Cell(50, 5, "Medidor de gases debidamente calibrado", "0",0, 'L');
                $this->Cell(110, 5,utf8_decode("(Si las condiciones antes de ingresar no son aceptables se debe ventilar y posteriormente registrar la medida con ventilación)") , "0",1, 'L');
                
                $this->SetX($x+2);
                $this->Cell(10, 5, "Otro?", "0",0, 'C');
                $this->Cell(50, 5, $data["otro"], "B","0", 'L');
                $this->Cell(80, 5,utf8_decode("Se monitorea constantemente la atmósfera en el sitio de trabajo") , "0",0, 'L');
                
                $this->Cell(10, 5,utf8_decode("SÍ") , "0",0, 'C');
                $this->Cell(10, 5,$data["informado"]=='S' ? 'X':'' , "B","0", 'C');
                
                $this->Cell(10, 5, "NO", "0","0", 'C');
                $this->Cell(10, 5, $data["informado"]=='N' ? 'X':'', "B","1", 'C');
                
                $this->SetY(70);
                $this->SetFillColor("214","227","188");
                $this->Cell(90, 10,utf8_decode("Nivel de medición antes del ingreso al isotanque") , "1",0, 'C',true);
                $this->Cell(20, 10, "CH4: ".$data["ch4"], "1","0", 'C');
                $this->Cell(20, 10, "H2S: ".$data["h2s"], "1","0", 'C');
                $this->Cell(20, 10, "O2: ".$data["c2"], "1","0", 'C');
                $this->Cell(20, 10, "CO: ".$data["co"], "1","1", 'C');
            }else if($a["numero"]=="3"){
                $this->SetFillColor("0","128","128");
                $this->SetX($x);
                $this->SetFont('Arial', '', 10);
                $this->Cell(200,4, utf8_decode($a["numero"].".".$a["nombre"]), "1",1, 'C',true);
                $this->SetFillColor("0","0","0");
                 $text="";
                 
                foreach($a["tareas"] as $items ){
                   $text .=" *".utf8_decode($items["nombre"]);
                }
                $this->SetX($x);
                $this->MultiCell(200, 5, $text, "1", 'C');
            }else if($a["numero"]=="4" || $a["numero"]=="5" || $a["numero"]=="6"){
                 
                $this->SetFillColor("0","128","128");
                $this->SetX($x);
                $this->SetFont('Arial', '', 7);
                $this->Cell(170, 3, utf8_decode($a["numero"].".".$a["nombre"]), "1",0, 'C',true);
                
                $this->Cell(10, 3, utf8_decode("SI"), "1",0, 'C',true);
                $this->Cell(10, 3, utf8_decode("NO"), "1",0, 'C',true);
                $this->Cell(10, 3, utf8_decode("N/A"), "1",1, 'C',true);
                foreach($a["tareas"] as $items ){
                    $this->SetX($x);
                    $this->Cell(170, 3, utf8_decode($items["nombre"]), "1", 0, 'L');
                    $this->Cell(10, 3, utf8_decode($items["defaul"]=="S" ?  "X" : "" ), "1",0, 'C');
                    $this->Cell(10, 3, utf8_decode($items["defaul"]=="N" ?  "X" : ""), "1",0, 'C');
                    $this->Cell(10, 3, utf8_decode($items["defaul"]=="NA" ?  "X" : ""), "1",1, 'C');
                }
            }else if($a["numero"]=="7"){
                $this->SetFillColor("0","128","128");
                $this->SetX($x);
                $this->SetFont('Arial', '', 7);
                $this->Cell(200, 3, utf8_decode($a["numero"].".".$a["nombre"]), "1",1, 'C',true);
                $this->SetX($x);
                $this->Cell(80, 5,utf8_decode("¿Este trabajo produce riesgos para otros trabajos en áreas adyacentes?") , "0",0, 'L');
                  $this->SetFillColor("214","227","188");
                $this->Cell(5, 5,utf8_decode("SÍ") , "0",0, 'C');
                $this->Cell(5, 5, "", "B","0", 'C',$data["riesgos_otros"]=='S' ?true :false);
                
                $this->Cell(5, 5, "NO", "0","0", 'C');
                $this->Cell(5, 5, "", "B","0", 'C',$data["riesgos_otros"]=='N' ?true :false);
                
             
                $this->Cell(80, 5,utf8_decode("¿Los trabajos en áreas adyacentes producen riesgos sobre este trabajo?") , "0",0, 'L');
                
                $this->Cell(5, 5,utf8_decode("SÍ") , "0",0, 'C');
                $this->Cell(5, 5, '', "B","0", 'C',$data["otros_riesgos"]=='S' ?true:false);
                
                $this->Cell(5, 5, "NO", "0","0", 'C');
                $this->Cell(5, 5, '', "B","1", 'C',$data["otros_riesgos"]=='N' ? true:false );
                
            }else if($a["numero"]=="8"){
                $this->SetFillColor("0","128","128");
                $this->SetX($x);
                $this->SetFont('Arial', '', 7);
                $this->Cell(200, 3, utf8_decode($a["numero"].".".$a["nombre"]), "1",1, 'C',true);
                $this->SetX($x);
                $this->MultiCell(200, 5, utf8_decode("COMO EJECUTOR: $data[operador2] __________________________________ idenficado con el número de documento $data[ide_izado]  He verificado con el emisor la aplicación de permiso y los demás controles para minimizar los riesgos asociados a este trabajo y los comunicaré al grupo ejecutor. He verificado el buen estado de las herramientas y equipos a utilizar."), "LTR",1);
                $this->SetX($x);
                $this->MultiCell(200, 5, utf8_decode("COMO EMISOR: $data[autoriza2]  __________________________________ identificado con el número de documento $data[ide_iza]  He verificado en campo con el ejecutor la aplicación del permiso y los demás controles para minimizar los riesgos asociados a este trabajo y considero seguro proceder con la ejecución del mismo."), "LRB",1);
                
                $this->SetY($this->GetY()+10);
                $this->SetX($this->GetX()+10);
                $this->MultiCell(80, 5, utf8_decode("EJECUTOR: Personalmente declaro que: El trabajo ha sido terminado. El sitio y los equipos quedan en condiciones seguras. Entrego el área limpia y libre de desechos y materiales "), "0",1);
                $this->SetY($this->GetY()-15);
                $this->SetX($this->GetX()+100);
                $this->MultiCell(80, 5, utf8_decode("EMISOR: Personalmente he verificado que:  El área queda limpia y libre de desechos y materiales. Se ha terminado satisfactoriamente el trabajo. El permiso de trabajo ha sido suspendido DEFINITIVAMENTE."), "0",1);
            }
            
          
        }
            $this->SetX($x);
            $pic =  $data["firma_empleado_autorizado"];
            //$info = getimagesize($pic);
            $TEMPIMGLOC = 'tempimg.png';
            $dataPieces = explode(',',$pic);
            if(isset($dataPieces[1])){
            $encodedImg = $dataPieces[1];
            $decodedImg = base64_decode($encodedImg);
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false ) {
                $this->Image($TEMPIMGLOC,80, 200,  15,15,'png');
            }
        }
            $pic =  $data["firma_empleado_autoriza"];
            //$info = getimagesize($pic);
         //   
            $TEMPIMGLOCo = 'tempimg1.png';
            $dataPieces = explode(',',$pic);
            if(isset($dataPieces[1])){
            $encodedImg = $dataPieces[1];
            $decodedImg = base64_decode($encodedImg);
            if( file_put_contents($TEMPIMGLOCo,$decodedImg)!==false ) {
                $this->Image($TEMPIMGLOCo,90, 212,  15,15,'png');
            }
        }
            $this->SetX($x);
            $this->Cell(100, 5,$data["operador"], "0", 0, 'C');
            $this->Cell(100, 5, $data["autoriza"], "0", 1, 'C');
            $this->SetX($x);
            $this->Cell(100, 5, "NOMBRE, FIRMA Y C.C. EJECUTOR", "T", 0, 'C');
            $this->Cell(100, 5,"NOMBRE, FIRMA Y C.C. EMISOR", "T", 1, 'C');
    
            $this->Ln(5);
            $this->SetFillColor("0","128","128");
    }
}