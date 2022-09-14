<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class departuresPDF extends FPDF {
    function Body($data) {
        $this->SetFont('Arial', '', 10);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 5;
        //Cabezera
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 9, 7,40,15, 'PNG'), 0, 0, 'C');
        $this->SetTextColor(53,153,110);
        $this->cell(75,5, C_LOGO,"LTR",0,'L');
        $this->cell(50,5, utf8_decode("Salida de isotanques") ,"LTR",1,'L');
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
        foreach($data as $cliente){
            $this->SetFillColor("192","192","192");
            $this->cell(192,5,$cliente["nombre"],"1",1,'C',true);
            $this->cell(38,5,"ID Entry","1",0,'C');
            $this->cell(38,5,"Serial","1",0,'C');
            $this->cell(38,5,"F. Entrada ","1",0,'C');
            $this->cell(38,5,"F. Salida","1",0,'C');
            $this->cell(40,5,"Conductor","1",1,'C');
            $this->SetWidths(array(38, 38, 38, 38,40));
            $this->SetAligns(array('C', 'C','C', 'C' ));
                foreach($cliente["salidas"] as $alway){
                   
                    $this->Row(array( 
                    $alway["entrada"],
                    $alway["serial"],
                    $alway["fecha"],
                    $alway["fecha_salida"],
                    $alway["nombre_conductor_salida"]
                ));
                
            }$this->ln();
        }
    }
}