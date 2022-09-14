<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class Seals extends FPDF {
    public $entrada;

    public function __construct($entrada) {
        $this->entrada=$entrada;
        parent::__construct('L', 'mm', 'a4');
        $this->SetTitle("SEALS");
    }


    function Body($imagenes) {
        $x = 5;
        $y = 5;

        $this->SetXY($x, $y);
        
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 15, 5, 50, 20, 'PNG'), 1, 0, 'C');
        $this->Cell(175, 5, C_LOGO, "TR", 0, 'C');
        $this->Cell(52, 5,utf8_decode("Nº: ".$this->entrada["id"]) , "TR", 1, 'C');
        $this->SetX($x + 60);
        $this->Cell(175, 5, "SEALS", "RB", 0, 'C');
        $this->SetFont('Arial', '', 8);

        $this->Cell(52, 5, "", "RB", 1, 'C');
        $this->SetX($x + 60);
        $this->Cell(175, 5, C_NIT_DIGITO, "T", 0, 'C');
        $this->SetFont('Arial', '', 8);

        $this->Cell(52, 5, utf8_decode("VERSIÓN: 1") , "LR", 1, 'C');
        $this->SetFont('Arial', '', 8);

        $this->SetX($x + 60);
        $this->Cell(175, 5, C_DIR_C, "RB", 0, 'C');
        $this->Cell(52, 5, $this->entrada["serial"], "RB", 1, 'C');
        $this->SetX($x);
        $this->ln();
$x=40;
        if($imagenes){
            
            foreach($imagenes as $imagen){
                if($imagen["image"]!=""){
                    if(file_exists("img_seals/$imagen[image]")){
                        $this->Cell(60, 20,$this->Image("img_seals/$imagen[image]",5,  $x, 287, 150), 0, 0, 'C');
                        $this->AddPage();
                    }
                    
                }
               
            }
         
            
        }else{
            $this->SetFont('Arial', '', 15);
            $this->Cell(175, 10, "No evidence of the seals has been uploaded", "0", 1, 'C');
        }
   

    }
}