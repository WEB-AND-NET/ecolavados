<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class Quality extends FPDF {
    public $entrada;

    public function __construct($entrada) {
        $this->entrada=$entrada;
        parent::__construct('L', 'mm', 'a4');
        $this->SetTitle("QUALITY INSPECTION FORMAT - ISOTANK");
    }


    function Body($calidad,$evidence) {
        $x = 5;
        $y = 5;

        $this->SetXY($x, $y);
        
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 15, 5, 50, 20, 'PNG'), 1, 0, 'C');
        $this->Cell(175, 5, C_LOGO, "TR", 0, 'C');
        $this->Cell(52, 5,utf8_decode("Nº: ".$this->entrada["id"]) , "TR", 1, 'C');
        $this->SetX($x + 60);
        $this->Cell(175, 5, "QUALITY INSPECTION FORMAT - ISOTANK", "RB", 0, 'C');
        $this->SetFont('Arial', '', 8);

        $this->Cell(52, 5, "", "RB", 1, 'C');
        $this->SetX($x + 60);
        $this->Cell(175, 5, C_NIT_DIGITO, "T", 0, 'C');
        $this->SetFont('Arial', '', 8);

        $this->Cell(52, 5, utf8_decode("VERSIÓN: 1") , "LR", 1, 'C');
        $this->SetFont('Arial', '', 8);

        $this->SetX($x + 60);
        $this->Cell(175, 5, C_DIR_C, "RB", 0, 'C');
        $this->Cell(52, 5, $this->entrada["serial"], "R", 1, 'C');
        $this->SetX($x);

        $this->SetFont('Arial', '', 8);
        $this->Cell(90, 5, "FECHA Y HORA INGRESO: ".$this->entrada["fecha"], "LRB", 0, 'L');
        $this->Cell(197, 5,utf8_decode("ULTIMA CARGA (Last cargo): ".$this->entrada["last_cargo"]) , "RTB", 1, 'L');
        $this->SetFont('Arial', 'B', 10);

        $this->ln();
        $this->SetX($x);

        $this->Cell(143, 5,"  EXTERIOR - Frame, Tank Walkway, Markings clean of contaminations Clean ", "1", 0, 'C');
        $this->Cell(143, 5," INTERIOR  Clean of contamination & Odour", "1", 1, 'C');
        $this->SetX($x);
        $exterior='';
        if($calidad["exterior"]=="S"){
            $exterior='YES';
        }else if($calidad["exterior"]=="N"){
            $exterior='NO';
        }else{
            $exterior='N/A';
        }
        $interior='';
        if($calidad["interior"]=="S"){
            $interior='YES';
        }else if($calidad["interior"]=="N"){
            $interior='NO';
        }else{
            $interior='N/A';
        }
        $this->Cell(143, 10, $exterior, "1", 0, 'C');
        $this->Cell(143, 10,$interior, "1", 1, 'C');
        $valves='';
        if($calidad["valves"]=="S"){
            $valves='YES';
        }else if($calidad["valves"]=="N"){
            $valves='NO';
        }else{
            $valves='N/A';
        }
        $stains='';
        if($calidad["stains"]=="S"){
            $stains='YES';
        }else if($calidad["stains"]=="N"){
            $stains='NO';
        }else{
            $stains='N/A';
        }
        $this->SetX($x);
        $this->Cell(143, 5,"Valves, Man-Way, Fittings Clean of contamination & Odour", "1", 0, 'C');
        $this->Cell(143, 5,"TRANSFERABLE STAINS", "1", 1, 'C');
        $this->SetX($x);
        $this->Cell(143, 10,$valves, "1", 0, 'C');
        $this->Cell(143, 10,$stains, "1", 1, 'C');
        $surfaces='';
        if($calidad["surfaces"]=="NA"){
            $surfaces='N/A';
        }else if($calidad["surfaces"]=="S"){
            $surfaces='OK';
        }else if($calidad["surfaces"]=="STAINING"){
            $surfaces='staining.png';
        } else if($calidad["surfaces"]=="RUST"){
            $surfaces='rust.png';
        }else if($calidad["surfaces"]=="SCORING"){
            $surfaces='scoring.png';
        }else if($calidad["surfaces"]=="PITTING"){
            $surfaces='pitting.png';
        }else{
             $surfaces='N/A';
        }
        
        $this->SetX($x);
        $this->Cell(143, 5,"SURFACE CONDITION", "1", 0, 'C');
        $this->Cell(143, 5,"PITTING DESCRIPTION", "1", 1, 'C');
        $this->SetX($x);
        if(file_exists("global/surface/$surfaces") ){
            $this->Cell(72, 10,$calidad["surfaces"], "LB", 0, 'R');
            $this->Cell(71, 10,$this->Image("global/surface/$surfaces",80, 70, 15, 10, 'PNG'), "B", 0, 'C');
        }else{
            $this->Cell(143, 10,$surfaces, "1", 0, 'C');
        }
        
        $pitting='';
        if($calidad["pitting"]=="NA"){
            $pitting='N/A';
        }else if($calidad["pitting"]=="A"){
            $pitting='a.png';
        }else if($calidad["pitting"]=="B"){
            $pitting='b.png';
        } else if($calidad["pitting"]=="C"){
            $pitting='c.png';
        }else{
             $pitting='N/A';
        }
        if(file_exists("global/pitting/$pitting")){
            $this->Cell(72, 10,$calidad["pitting"], "LB", 0, 'R');
            $this->Cell(71, 10,$this->Image("global/pitting/$pitting",225, 70, 15, 10, 'PNG'), "BR", 0, 'C');
        }else{
            $this->Cell(143, 10,$pitting, "1", 0, 'C');
        }

        
        $pic =  $calidad["area"];
        //$info = getimagesize($pic);
        $TEMPIMGLOCo = 'area.png';
        $dataPieces = explode(',',$pic);
        if(isset($dataPieces[1])){
            $encodedImg = $dataPieces[1];
            $decodedImg = base64_decode($encodedImg);
            if( file_put_contents($TEMPIMGLOCo,$decodedImg)!==false ) {
                $this->Image($TEMPIMGLOCo,10, 90,  160,100,'png');
            }
        }else{
              $this->Cell(71, 10,$this->Image("global/img/tank.png",20, 90, 75, 50, 'PNG'), "BR", 0, 'C');
        }
        $pic =  $calidad["front"];
        //$info = getimagesize($pic);
        $TEMPIMGLOCo = 'front.png';
        $dataPieces = explode(',',$pic);
        if(isset($dataPieces[1])){
            $encodedImg = $dataPieces[1];
            $decodedImg = base64_decode($encodedImg);
            if( file_put_contents($TEMPIMGLOCo,$decodedImg)!==false ) {
                $this->Image($TEMPIMGLOCo,60, 80,  70,100,'png');
            }
        }else{
            $this->Cell(71, 10,$this->Image("global/img/front.png",90, 90, 75, 50, 'PNG'), "BR", 0, 'C');
        }
        $pic =  $calidad["rear"];
        //$info = getimagesize($pic);
        $TEMPIMGLOCo = 'rear.png';
        $dataPieces = explode(',',$pic);
        if(isset($dataPieces[1])){
            $encodedImg = $dataPieces[1];
            $decodedImg = base64_decode($encodedImg);
            if( file_put_contents($TEMPIMGLOCo,$decodedImg)!==false ) {
                $this->Image($TEMPIMGLOCo,120, 80,  70,100,'png');
            }
        }else{
            $this->Cell(71, 10,$this->Image("global/img/rear.png",170, 90, 75, 50, 'PNG'), "BR", 0, 'C');
        }
        
       
         foreach($evidence as $imagene){
            if($imagene["image"] != ""){
                if(file_exists("img_quality/$imagene[image]")){
                    $this->AddPage();
                    $this->Image("img_quality/$imagene[image]",  $this->GetX() ,$this->GetY()+$y , 200, 120);
                    $this->SetY(120);
                }
            }
            
        }
      
    }



}