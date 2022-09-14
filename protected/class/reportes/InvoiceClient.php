<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class InvoiceClient extends FPDF {

    

    function Body($data,$items) {


        $this->SetFont('Arial', '', 10);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 5;
        //Cabezera
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 9, 7,40,15, 'PNG'), 0, 0, 'C');
        $this->SetTextColor(53,153,110);
        $this->cell(75,5, C_LOGO,"LTR",0,'L');
        $this->cell(50,5, utf8_decode("") ,"LTR",1,'L');
        $this->SetFont('Arial', '', 9);
        $this->SetX($x-5+70);
        $this->cell(75,5,"Nit: ". utf8_decode(C_NIT_DIGITO) ,"L",0,'L');
        $this->cell(50,5,"" ,"LR",1,'L');
        $this->SetX($x-5+70);
        $this->cell(75,5,"Tel: ".C_TEL ." mail: ".C_EMAIL1,"LB",0,'L');
        $this->cell(50,5,"". "","LRB",1,'L');
        //Cabezera--Fin
        $this->SetFillColor("192","192","192");
        $this->SetTextColor(0,0,0);
        $this->ln();

        $this->cell(190,5,"Client",1,1,'C',true);

        $this->cell(190,5,$data["nombre"],"1",0,'C');
        
        $this->ln();


        $this->SetFont('Arial', '', 8);
        foreach($items as $item){
            $this->ln();
            $this->cell(190,5,$item["id"]."-".$item["serial"],"1",1,'C');
            $this->cell(40,5,"Service","1",0,'C');
            $this->cell(40,5,"Description","1",0,'C');
            $this->cell(15,5,"Date F.","1",0,'C');
            $this->cell(15,5,"Work Order","1",0,'C');
            $this->cell(20,5,"Quantity","1",0,'C');
            $this->cell(20,5,"Price","1",0,'C');
            $this->cell(20,5,"Total","1",0,'C');
            $this->cell(20,5,"Facture","1",1,'C');
            $this->SetWidths(array(40, 40,15, 15, 20, 20, 20,20));
            $this->SetAligns(array('L', 'C','C', 'C', 'C', 'C', 'C'));      

           foreach($item["items"] as $alway){
                $this->Row(array( utf8_decode($alway["service"]),
                $alway["description"],
                $alway["minimo"],
                $alway["wo"],
                $alway["quantity"],
                $alway["price"],
                $alway["total"],
                $alway["n_facture"]));
            } 
        }
    }
}
