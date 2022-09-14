<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class allEntrysInvoicePDF extends FPDF {
    function Body($data) {
        Doo::loadController("EntrysController");
        $EntrysController = new EntrysController();

        $this->SetFont('Arial', '', 10);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 5;
        //Cabezera
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 9, 7,40,15, 'PNG'), 0, 0, 'C');
        $this->SetTextColor(53,153,110);
        $this->cell(75,5, C_LOGO,"LTR",0,'L');
        $this->cell(50,5, utf8_decode("Facturado al mes") ,"LTR",1,'L');
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
        $total=0;
        foreach($data as $cliente){
            $cli=0;
            $this->SetFillColor("192","192","192");
            $this->cell(192,5,$cliente["nombre"],"1",1,'C',true);
            
            $this->cell(38,5,"Serial","1",0,'C');
            $this->cell(38,5,"F. Entrada ","1",0,'C');
            $this->cell(38,5,"F. Salida","1",0,'C');
            $this->cell(78,5,"Last Cargo","1",1,'C');
            $this->SetWidths(array(38, 38, 38, 78));
            $this->SetAligns(array('C', 'C','C', 'C', 'C', ));

            foreach($cliente["entradas"] as $alway){
                $tan=0;
                $this->Row(array( 
                    $alway["serial"],
                    $alway["fecha"],
                    $alway["fecha_lavado"],
                    $alway["last_cargo"]
                ));

            $invoice_always = $EntrysController->invoice_always($alway["id"]);  
            $productos = $EntrysController->productos($alway["id"]);
            $paquetes = $EntrysController->paquetes($alway["id"]);
            if($invoice_always){
                
                $this->cell(64,5,"Proceso","1",0,'C');
                $this->cell(84,5,"Nombre ","1",0,'C');
                $this->cell(44,5,"Precio","1",1,'C');
                foreach($invoice_always as $invoice){
                     $this->cell(64,5,$invoice["proceso"],"1",0,'C');
                    $this->cell(84,5,$invoice["nombre"],"1",0,'C');
                    $this->cell(44,5,$invoice["precio"],"1",1,'C');
                    $tan+=$invoice["precio"];
                }
            }
            if($productos){
                foreach($productos as $invoice){
                    $this->cell(64,5,$invoice["proceso"],"1",0,'C');
                    $this->cell(84,5,$invoice["nombre"],"1",0,'C');
                    $this->cell(44,5,$invoice["precio"],"1",1,'C');
                    $tan+=$invoice["precio"];
                }
            }

            if($paquetes){
                foreach($paquetes as $invoice){
               
                    $this->cell(64,5,$invoice["nombre"],"1",0,'C');
                    $this->cell(84,5,$invoice["nombre"],"1",0,'C');
                    $this->cell(44,5,$invoice["precio"],"1",1,'C');
                    $tan+=$invoice["precio"];
                }
            }
            
            $cli+=$tan;
            
            $this->cell(192,5,"Total Valor tanque: ".$tan ,"1",1,'R',true);
        }
        $total+=$cli;
        $this->cell(192,5,"Total Valor Cliente: ".$cli ,"1",1,'R',true);
        $this->ln();
        }
        $this->cell(192,5,"Total Facturado Hasta la Fecha Actual no incluyendo almacenamiento: ".$total ,"1",1,'R',true);
    }
}