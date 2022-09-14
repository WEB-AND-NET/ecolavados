<?php
class ProductsPrinterPDF extends FPDF {
    public function __construct() {
        parent::__construct('L', 'mm', 'A4');
    }

    function Body($data) {
        $this->SetFont('Arial', '', 10);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 10;

        //Cabezera
        $this->Cell(60, 15,$this->Image("global/img/logo.png", 15, 10,45,15, 'PNG'), 1, 0, 'C');
        $this->SetTextColor(53,153,110);
        $this->cell(75,5, C_LOGO,"LTR",0,'L');
        $this->cell(145,5, utf8_decode("Reporte de productos") ,"LTR",1,'L');
        $this->SetFont('Arial', '', 9);
        $this->SetX($x-5+70);
        $this->cell(75,5,"Nit: ". utf8_decode(C_NIT_DIGITO) ,"L",0,'L');
        $this->cell(145,5,utf8_decode("Versión: 1 ") ,"LR",1,'L');
        $this->SetX($x-5+70);
        $this->cell(75,5,"Tel: ".C_TEL ." mail: ".C_EMAIL1,"LB",0,'L');
        $this->cell(145,5,"". "","LRB",1,'L');
        $this->SetFillColor("192","192","192");
        $this->SetTextColor(0,0,0);
        $this->ln();
        $this->SetFillColor("192","192","192");               
        $this->cell(141,5,"Nombre","1",0,'C');     
        $this->cell(47,5,"Cantidad","1",0,'C');
        $this->cell(47,5,utf8_decode("Tipo") ,"1",0,'C');
        $this->cell(46,5,utf8_decode("Unidad de Medida"),"1",1,'C');
        $this->SetWidths(array(141, 47,47,46));
        $this->SetAligns(array('C','C','C','C'));
        foreach($data as $always){
            $this->Row(array( 
                $always["nombre"],
                $always["cantidad"] ,
                $always["tipo"],
                $always["unidad_medida"] 
               
            )); 
        }
    }
}