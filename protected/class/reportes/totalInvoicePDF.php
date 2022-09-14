<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class totalInvoicePDF extends FPDF {
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
        $allvalue=0;
        foreach($data as $cliente){
            if($cliente["id"]!='1022'){
                $this->SetFillColor("192","192","192");
                $this->cell(280,5,$cliente["nombre"],"1",1,'C',true);        
                $total=0; 
                foreach($cliente["salidas"] as $alway){               
                    $this->SetFillColor("192","192","192");
                    $this->cell(280,5,"ID Entry: ".$alway["entrada"].", Serial: ".$alway["serial"]  ,"1",1,'C',true);   
                    $this->cell(49,5,"Services","1",0,'C');
                    $this->cell(47,5,"Description","1",0,'C');
                    $this->cell(47,5,"Quantity","1",0,'C');
                    $this->cell(46,5,"Price","1",0,'C');
                    $this->cell(46,5,"Total","1",0,'C');
                    $this->cell(45,5,"Facture","1",1,'C');
                    $items = Doo::db()->query("SELECT * from items_facturas where id_entrada='$alway[entrada]'")->fetchAll();
                    $this->SetWidths(array(49, 47,47,46,46,45));
                    $this->SetAligns(array('C', 'C','C','C','C','C'));
                    foreach($items as $always){
                        $this->Row(array( 
                            $always["service"],
                            $always["description"] ,
                            $always["quantity"],
                            $always["price"] ,
                            $always["total"] ,
                            $always["n_facture"] 
                        )); 
                        $total+=$always["total"];
                    }
                } 
                $this->SetFillColor("192","192","192");
                $this->cell(280,5,"Total value: ".$total ,"1",1,'C',true);   
                $allvalue+=$total;
                $this->ln();
            }
        } 
          $this->SetFillColor("192","192","192");
                $this->cell(280,5,"Total value: ".$allvalue ,"1",1,'C',true);  
    }
}