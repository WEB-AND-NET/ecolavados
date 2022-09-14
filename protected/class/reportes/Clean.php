<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class Clean extends FPDF {
    public $entrada;
    public function __construct($entrada) {
        $this->entrada=$entrada;
        parent::__construct('L', 'mm', 'a4');
        $this->SetTitle("CLEANING CERTIFICATE");
    }

    function Body($list,$imagenes,$seals) {
       
        $x = 5;
        $y = 5;

        $this->SetXY($x, $y);
        
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 15, 5, 40, 15, 'PNG'), 1, 0, 'C');
        $this->Cell(175, 5, C_LOGO, "TR", 0, 'C');
        $this->Cell(52, 5,utf8_decode("Nº: ".$this->entrada["id"]) , "TR", 1, 'C');
        $this->SetX($x + 60);
        $this->Cell(175, 5, "CERTIFICADO DE LIMPIEZA/CLEANING CERTIFICATE", "RB", 0, 'C');
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
        $this->Cell(90, 4, "Fecha de ingreso: ".$this->entrada["fecha"], "LRB", 0, 'L');
        $this->Cell(197, 4,utf8_decode("Última carga (Last cargo): ".$this->entrada["last_cargo"]) , "RTB", 1, 'L');
        $this->SetFont('Arial', '', 8);

       
        $this->SetX($x);
        $this->Cell(90, 4, "Fecha de salida: ".$this->entrada["fecha_salida"], "LRB", 0, 'L');
        $this->Cell(100, 4,"Test 2,5: ". $this->entrada["test30"], "LRB", 0, 'L');
        $this->Cell(97, 4,"Test 5: ". $this->entrada["test60"], "1", 1, 'L');
        $this->SetFont('Arial', '', 8);


        $this->SetX($x);
        $this->Cell(287, 5,"Sellos (Secutity Seals): ". $seals["sellos"], "LRB", 1, 'L');
        $this->SetFont('Arial', '', 8);
        $this->SetX($x);
        $this->Cell(95, 5,"Interior: "."Clean", "LRB", 0, 'L');
        $this->Cell(96, 5,"Interior: ". "Odor Free", "LRB", 0, 'L');
        $this->Cell(96, 5,"Exterior: "."Clean", "LRB", 1, 'L');
       /* $this->Cell(145, 5, "" , "RB", "B", 'L');
        $this->Cell(52, 5, "", "RB", 1, 'C');*/
        $i=1;
        $Ycolumn1=$this->GetY();
        $Ycolumn2=$this->GetY();
        $this->SetY($this->GetY());
         $this->ln(20);
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
        $this->ln(9);

        $pic =  $seals["sing"];
        $TEMPIMGLOC = 'tempimg.png';
        $dataPieces = explode(',',$pic);
         if(isset($dataPieces[1])){
            $encodedImg = $dataPieces[1];
            $decodedImg = base64_decode($encodedImg);
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false ) {
                $this->Image($TEMPIMGLOC,65, 170,  30,30,'png');
            }
         }
        
        
        $this->Cell(120, 5, "Firma Ecolavados" , "T", 0, 'C');

      
        
        $this->Cell(120, 5, " Driver: ", "T", 1, 'C');
        
        
        
        
      
    }

    function Footer() { 
        $this->SetY(-10);
      
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
        
    }

}
