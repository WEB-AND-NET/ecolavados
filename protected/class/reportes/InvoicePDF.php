<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class InvoicePDF extends FPDF {

    

    function Body($data,$items,$fecha,$type) {

        $this->SetFont('Arial', '', 10);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 5;
        //Cabezera
        $this->Cell(60, 20,$this->Image("global/img/logo.png", 9, 7,40,15, 'PNG'), 0, 0, 'C');
        $this->SetTextColor(53,153,110);
        $this->cell(75,5, C_LOGO,"LTR",0,'L');
        $this->cell(50,5, utf8_decode("Entry º") ,"LTR",1,'L');
        $this->SetFont('Arial', '', 9);
        $this->SetX($x-5+70);
        $this->cell(75,5,"Nit: ". utf8_decode(C_NIT_DIGITO) ,"L",0,'L');
        $this->cell(50,5,"No: ".$data["id"] ,"LR",1,'L');
        $this->SetX($x-5+70);
        $this->cell(75,5,"Tel: ".C_TEL ." mail: ".C_EMAIL1,"LB",0,'L');
        $this->cell(50,5,"". "","LRB",1,'L');
        //Cabezera--Fin
        $this->SetFillColor("192","192","192");
        $this->SetTextColor(0,0,0);
        $this->ln();

        $this->cell(90,5,"Client",1,0,'C',true);
        $this->cell(45,5,utf8_decode("Entry Date"),1,0,'C',true);
        $this->cell(50,5,$type=='L'? 'Departure date' : "Last day billed",1,1,'C',true);

        $this->cell(90,5,$data["nombre"],"LT",0,'C');
        $this->cell(45,5,"$data[fecha]","LT",0,'C');
        $this->cell(50,5,$fecha,"LTR",1,'C');

        $this->cell(90,5,"Last Cargo: "."$data[last_cargo]","RLB",0,'L');
        $this->cell(95,5,$data["serial"],1,1,'C');
        $this->ln();


        $this->cell(40,5,"Service","1",0,'C');
        $this->cell(50,5,"Description","1",0,'C');
        $this->cell(20,5,"Work Order","1",0,'C');
        $this->cell(20,5,"Quantity","1",0,'C');
        $this->cell(20,5,"Price","1",0,'C');
        $this->cell(20,5,"Total","1",0,'C');
        $this->cell(20,5,"Invoice E.","1",1,'C');
        $this->SetWidths(array(40, 50, 20, 20, 20, 20,20));
        $this->SetAligns(array('L', 'C','C', 'C', 'C', 'C', 'C'));        
       foreach($items as $alway){
            $this->Row(array( utf8_decode($alway["service"]),
            $alway["description"],
            $alway["wo"],
            $alway["quantity"],
            $alway["price"],
            $alway["total"],
            $alway["n_facture"]));
        }     
        $this->SetFillColor("192","192","192");
        $this->cell(40,5,"Total days discounted: " ,"1",0,'L',TRUE);  
        $this->cell(150,5,$_SESSION["tdd"] ,"1",0,'L');  

    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}