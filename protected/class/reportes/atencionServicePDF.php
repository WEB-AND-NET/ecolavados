<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meri�0�9o Iriarte <carlos.merino.iriarte@gmail.com>
 */
class atencionServicePDF extends FPDF {
    

    public function __construct() {
        parent::__construct('L', 'mm', 'A4');
    }

    function Body($data) {

        
        $this->SetFont('Arial', '', 10);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 5;
        //Cabezera
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 9, 7,40,15, 'PNG'), 0, 0, 'C');
        $this->SetTextColor(53,153,110);
        $this->cell(75,5, C_LOGO,"LTR",0,'L');
        $this->cell(50,5, utf8_decode("Atenci��n de servicios.") ,"LTR",1,'L');
        $this->SetFont('Arial', '', 9);
        $this->SetX($x-5+70);
        $this->cell(75,5,"Nit: ". utf8_decode(C_NIT_DIGITO) ,"L",0,'L');
        $this->cell(50,5,utf8_decode("Versi��n: 1 ") ,"LR",1,'L');
        $this->SetX($x-5+70);
        $this->cell(75,5,"Tel: ".C_TEL ." mail: ".C_EMAIL1,"LB",0,'L');
        $this->cell(50,5,"". "","LRB",1,'L');
        $this->SetFillColor("192","192","192");
        $this->SetTextColor(0,0,0);
        $this->ln();
        foreach($data as $empleado){
            $this->SetFillColor("192","192","192");
            $this->cell(280,5,$empleado["nombre"]." ".$empleado["apellido"],"1",1,'C',true);

            $this->cell(30,5,"Cliente","1",0,'C');
            $this->cell(30,5,"Serial","1",0,'C');
            $this->cell(30,5,"Last Cargo","1",0,'C');
            $this->cell(30,5,"Servicio","1",0,'C');
            $this->cell(30,5,"F. Inicio","1",0,'C');
            $this->cell(30,5,"F. Final","1",0,'C');
            $this->cell(30,5,"FI. PRO","1",0,'C');
            $this->cell(30,5,"FF. PRO","1",0,'C');
            $this->cell(20,5,utf8_decode("Duraci��n Min"),"1",0,'C');
            $this->cell(20,5,utf8_decode("Duraci��n Hrs"),"1",1,'C');
            $this->SetWidths(array(30, 30, 30, 30,30,30, 30,30,20,20));
            $this->SetAligns(array('C', 'C','C', 'C','C','C', 'C','C', 'C','C' ));
            foreach($empleado["atenciones"] as $service){
            
                $this->Row(array( 
                    $service["cliente"],
                    $service["serial"],
                    $service["last_catgo"],
                    $service["proceso"],
                    $service["fecha_inicio"],
                    $service["fecha_fin"],
                    $service["fecha_i_p"],
                    $service["fecha_f_p"],
                    $service["duracion"]*60,
                    $service["duracion"]==0 ? $service["duracion"] : $service["duracion"]
                ));
            }
            $this->ln();
        }
    }
}