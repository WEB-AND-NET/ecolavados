<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class IER extends FPDF {
    public $entrada;
    public function __construct($entrada) {
        $this->entrada=$entrada;
        parent::__construct('L', 'mm', 'a4');
        $this->SetTitle("I.E.R.");
    }

    function Body($list,$imagenes,$fotos = true) {
       
        $x = 5;
        $y = 5;

        $this->SetXY($x, $y);
        
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 15, 5, 40, 15, 'PNG'), 1, 0, 'C');
        $this->Cell(175, 5, C_LOGO, "TR", 0, 'C');
        $this->Cell(52, 5,utf8_decode("Nº: ".$this->entrada["id"]) , "TR", 1, 'C');
        $this->SetX($x + 60);
        $this->Cell(175, 5, "Equipment Interchange Receipt", "RB", 0, 'C');
        $this->SetFont('Arial', '', 10);

        $this->Cell(52, 5, "", "RB", 1, 'C');
        $this->SetX($x + 60);
        $this->Cell(175, 5, C_NIT_DIGITO, "T", 0, 'C');
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(52, 5, utf8_decode("VERSIÓN: 1") , "1", 1, 'C');
        $this->SetFont('Arial', '', 10);

        $this->SetX($x + 60);
        $this->Cell(175, 5, C_DIR_C, "RB", 0, 'C');
        $this->Cell(52, 5, $this->entrada["serial"], "RB", 1, 'C');
        $this->SetX($x);

        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, "FECHA Y HORA INGRESO: ".$this->entrada["fecha"], "LR", 0, 'L');
        $this->Cell(145, 5, "ULTIMA CARGA (Last cargo): ".$this->entrada["last_cargo"], "R", 0, 'L');
        $this->SetFont('Arial', '', 8);

        $this->Cell(72, 5,"TEST 2.5: ".$this->entrada["test30"], "R", 1, 'L');
        $this->SetX($x);
        $this->Cell(70, 5, "", "LRB", 0, 'L');
        $this->Cell(145, 5, "" , "RB", "T", 'L');
        $this->Cell(72, 5, "TEST 5: ".$this->entrada["test60"], "RB", 1, 'L');
        $i=1;
        $Ycolumn1=$this->GetY();
        $Ycolumn2=$this->GetY();
        $this->SetY($this->GetY());
        
        foreach($list as $item){
            $i++;
            if($i%2==0){
                $this->SetY($Ycolumn1);
                $this->SetX($x);
                $this->SetFont('Arial', 'B', 6);
                $this->Cell(100, 3, utf8_decode($item["descripcion"]), "LRB", 0, 'C');
                $this->Cell(40, 3, "ESTADO (STATE)", "RB", 0, 'L');
                foreach($item["sub_item"] as $sub ){
                    $Ycolumn1+=3;
                    $this->SetY($Ycolumn1);
                    $this->SetX($x);
                    $this->Cell(100, 3, utf8_decode($sub["descripcion"]) , "LRB", 0, 'L');
                    $this->Cell(40, 3, $sub["valor"] , "RB", 0, 'L');
                }
                $Ycolumn1+=3;
               // 
            }else{
                
                $this->SetY($Ycolumn2);
                $this->SetX($x+140);
                $this->Cell(100, 3, $item["descripcion"], "LRB", 0, 'C');
                $this->Cell(47, 3, "ESTADO (STATE)", "LRB", 0, 'C');
                $this->SetFont('Arial', 'B', 6);
                foreach($item["sub_item"] as $sub ){
                    $Ycolumn2+=3;
                    $this->SetY($Ycolumn2);
                    $this->SetX($x+140);
                    $this->Cell(100, 3, $sub["descripcion"], "LRB", 0, 'L');
                    $this->Cell(47, 3, $sub["valor"] , "RB", 0, 'L');
                }
                $Ycolumn2+=3;

           
        
            }
        }
        $this->ln(15);

        $pic =  $this->entrada["singeco"];
        
        $TEMPIMGLOC = 'tempimg.png';
        $dataPieces = explode(',',$pic);
         if(isset($dataPieces[1])){
            $encodedImg = $dataPieces[1];
            
            $decodedImg = base64_decode($encodedImg);
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false ) {
                $this->Image($TEMPIMGLOC,50, 170,  30,30,'png');
            }
         }
         
        
        
        $this->SetY($y+179);
        $this->Cell(120, 5, "Firma Ecolavados" , "T", 0, 'C');

        $this->SetX($x+150);

        $pic =  $this->entrada["singdrive"];
       
        $TEMPIMGLOCe = 'tempimg2.png';
        $dataPieces = explode(',',$pic);
        try {
            if(isset($dataPieces[1])){
                $encodedImg = $dataPieces[1];
                $decodedImg = base64_decode($encodedImg);
                if( file_put_contents($TEMPIMGLOCe,$decodedImg)!==false ) {
                   $this->Image($TEMPIMGLOCe,180, 170,  30,30,'png');
                  
                }
            
            }
        } catch (Exception $e) {
                 //   echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        
        
        $this->Cell(120, 5," Transport company: ".$this->entrada["transportista"].", Driver: ".$this->entrada["conductor"].", Plate: ".$this->entrada["placa"], "T", 1, 'C');
        $this->SetFont('Arial', 'B', 20);
        
        
        
        if($fotos){
            foreach($imagenes as $imagene){
                if($imagene["img"]!= ""){
                    if(file_exists("img_causes_logs/$imagene[img]")){
                        $this->AddPage();
                        $this->Cell(260, 10,utf8_decode($imagene["descripcion"]."-".$imagene["valor"]) , "1", 1, 'C');
                        $this->Image("img_causes_logs/$imagene[img]",  $this->GetX() ,$this->GetY()+$y , 200, 120);
                        $this->SetY(120);
                    }
                }
                
            }
        }else{
            
        }
        
    }

    function Footer() { 
        $this->SetY(-10);
      
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
        
    }
    
    function endsWith( $haystack, $needle ) {
        return $needle === "" || (substr($haystack, -strlen($needle)) === $needle);
    }

}
