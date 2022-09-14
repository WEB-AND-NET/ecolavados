<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class heightPdf extends FPDF {

    function Body($data,$ats) {
        $x = 5;
        $y = 5;

        $this->SetXY($x, $y);
      
       
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 15,$this->Image("global/img/logo.png", 15, 5, 40, 15, 'PNG'), 1, 0, 'C');
        $this->Cell(110, 5, utf8_decode("PERMISO DE TRABAJO SEGURO EN ALTURA"), "TR", 0, 'C');
        $this->SetFont('Arial', '', 7);
        $this->Cell(30, 5,utf8_decode("Versión 2") , "TR", 1, 'C');
        $this->SetX($x + 60);

        $this->Cell(110, 5,utf8_decode("") , "RB", 0, 'C');
        $this->Cell(30, 5,utf8_decode("Fecha: 12/06/2019") , "TRB", 1, 'C');
        
        $this->SetX($x + 60);
       
        $this->Cell(110, 5,utf8_decode("PROCESO DE DIRECCIÓN Y MEJORA CONTINUA") , "RB", 0, 'C');
        $this->Cell(30, 5, utf8_decode("Página 1 de 1") , "RB", 1, 'C');
        $this->Ln(5);
         $this->SetFillColor("0","128","128");
        $this->SetX($x );
        $this->Cell(200, 5,utf8_decode("VALIDO PARA EL PERIODO, LUGAR, EQUIPO Y TRABAJO INDICADO") , "1", 1, 'C',true);

        $this->SetX($x );
       
       
        $this->SetFillColor("214","227","188");

        $this->Cell(30, 5,utf8_decode("Fecha:") , "1", 0, 'C',true);
        $this->Cell(30, 5,utf8_decode($data["fecha"]) , "1", 0, 'C');

        $this->Cell(30, 5, utf8_decode("Hora de inicio:") , "1", 0, 'C',true);
        $this->Cell(40, 5, utf8_decode($data["inicio"]) , "1", 0, 'C');

        $this->Cell(30, 5, utf8_decode("Hora final:") , "1", 0, 'C',true);
        $this->Cell(40, 5, utf8_decode($data["final"]) , "1", 1, 'C');
        
        $this->SetX($x);
         $this->Cell(50, 5,utf8_decode("Area de trabajo") , "1", 0, 'C',true);
        $this->Cell(50, 5,utf8_decode("Trabajo a realizar") , "1", 0, 'C',true);
        $this->Cell(50, 5,utf8_decode("Altura") , "1", 0, 'C',true);
        $this->Cell(50, 5, utf8_decode("Solicitud de servicio") , "1", 1, 'C',true);

        $this->SetX($x);
        $this->Cell(50, 5,utf8_decode("Pista de lavado") , "1", 0, 'C');
        $this->Cell(50, 5,utf8_decode($data["trabajo"]) , "1", 0, 'C');
        $this->Cell(50, 5,utf8_decode($data["altura"]) , "1", 0, 'C');
        $this->Cell(50, 5, utf8_decode($data["consecutivo"]) , "1", 1, 'C');
        $this->SetX($x);

        $this->SetX($x);
        $pic =  $data["firma_empleado_autorizado"];
        //$info = getimagesize($pic);
        $TEMPIMGLOC = 'tempimg.png';
        $dataPieces = explode(',',$pic);
        if(isset($dataPieces[1])){
        $encodedImg = $dataPieces[1];
        
        $decodedImg = base64_decode($encodedImg);
        if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false ) {
            $this->Image($TEMPIMGLOC,50, 45,  20,20,'png');
        }
    }
        $pic =  $data["firma_empleado_autoriza"];
        //$info = getimagesize($pic);
     //   
        $TEMPIMGLOCo = 'tempimg2.png';
        $dataPieces = explode(',',$pic);
        if(isset($dataPieces[1])){
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);
        if( file_put_contents($TEMPIMGLOCo,$decodedImg)!==false ) {
            $this->Image($TEMPIMGLOCo,150, 45,  20,20,'png');
        }
    }
        $this->Cell(100, 5, "Firma operario autorizado", "1", 0, 'C',true);
        $this->Cell(100, 5,"Firma  quien autoriza", "1", 1, 'C',true);
        $this->SetX($x);
        $this->Cell(100, 12,$data["operador"], "1", 0, 'L');
        $this->Cell(100, 12, $data["autoriza"], "1", 1, 'L');
        $this->Ln(5);
        $this->SetFillColor("0","128","128");
        //var_dump($ats);
        foreach($ats as $a){
            $this->SetX($x);
            $this->SetTextColor("255","255","255");
            if($a["numero"]=="0"){
                $this->SetX($x);
                $this->SetFont('Arial', '', 10);
                $this->Cell(163, 5, utf8_decode($a["numero"].".".$a["nombre"]), "1",0, 'C',true);
                
                $this->Cell(12, 5, utf8_decode("SI"), "1",0, 'C',true);
                $this->Cell(12, 5, utf8_decode("NO"), "1",0, 'C',true);
                $this->Cell(13, 5, utf8_decode("N/A"), "1",1, 'C',true);
                $this->SetTextColor("0","0","0");
                $this->SetFont('Arial', '', 6);
                foreach($a["tareas"] as $items ){
                    $this->SetX($x);
                    $this->Cell(3, 5, utf8_decode($items["numero"]), "1", 0, 'L');
                    $this->Cell(160, 5, utf8_decode($items["nombre"]), "1", 0, 'L');
                    $this->Cell(12, 5, utf8_decode($items["defaul"]=="S" ?  "X" : "" ), "1",0, 'C');
                    $this->Cell(12, 5, utf8_decode($items["defaul"]=="N" ?  "X" : ""), "1",0, 'C');
                    $this->Cell(13, 5, utf8_decode($items["defaul"]=="NA" ?  "X" : ""), "1",1, 'C');
                }
                
            }else{
                $this->SetFont('Arial', '', 10);
                $this->Cell(200, 5, utf8_decode($a["numero"].".".$a["nombre"]), "1",1, 'C',true);
                $this->SetTextColor("0","0","0");
                $t=1;
                $this->SetFont('Arial', '', 6);
                $text="";
                foreach($a["tareas"] as $items ){
                   $text .="              ".utf8_decode($items["nombre"]);
                }
                $this->SetX($x);
                $this->SetTextColor("0","0","0");
                $this->SetFillColor(255,255,255,.9);
                $this->MultiCell(200, 5, utf8_decode($text), "1", 1, 'L');
                
            }
        }
    }
}