<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meri帽o Iriarte <carlos.merino.iriarte@gmail.com>
 */
class detailsTimePDF extends FPDF {
    function Body($data) {
        $this->SetFont('Arial', '', 10);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 5;
        //Cabezera
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 9, 7,40,15, 'PNG'), 0, 0, 'C');
        $this->SetTextColor(53,153,110);
        $this->cell(75,5, C_LOGO,"LTR",0,'L');
        $this->cell(50,5, utf8_decode("Tiempo de descarga") ,"LTR",1,'L');
        $this->SetFont('Arial', '', 9);
        $this->SetX($x-5+70);
        $this->cell(75,5,"Nit: ". utf8_decode(C_NIT_DIGITO) ,"L",0,'L');
        $this->cell(50,5,utf8_decode("Versión: 1 ") ,"LR",1,'L');
        $this->SetX($x-5+70);
        $this->cell(75,5,"Tel: ".C_TEL ." mail: ".C_EMAIL1,"LB",0,'L');
        $this->cell(50,5,"". "","LRB",1,'L');
        $this->SetFillColor("192","192","192");
        $this->SetTextColor(0,0,0);
        $this->ln();
        
       
        $this->cell(68,5,"Cliente","1",0,'C');
        $this->cell(38,5,"Serial T","1",0,'C');
        $this->cell(38,5,"F. llegada ","1",0,'C');
        $this->cell(38,5,"F. descargo","1",0,'C');
        $this->cell(10,5,"Tiempo","1",1,'C');
        $this->SetWidths(array(68, 38, 38, 38,10));
        $this->SetAligns(array('C', 'C','C', 'C' ));
        foreach($data as $r){
            $this->Row(array( 
                $r['nombre'],
                $r['serial'],
                $r['arrival'],
                $r['update_at'],
                $r['tiempo']
            ));
        }
    }
    
}