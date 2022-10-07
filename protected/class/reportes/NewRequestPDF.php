<?php


class NewRequestPDF extends FPDF {

    public function __construct() {
        parent::__construct('L', 'mm', 'A4');
        //parent::__construct('L','mm','Letter');
        $this->SetTitle('Request');
    }

    function Body($data,$productos,$paquetes) {

        $this->SetFont('Arial', 'B', 10);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 5;
        //Cabezera
        $this->Image("global/img/logo.png", 10, 20,40,15, 'PNG');
        
        $this->cell(185,7, 'TANK EQUIPMENT INTERCHANGE TEST / REPAIRESTIMATE',"1",0,'L');

        $this->SetFont('Arial', '', 10);

        $this->cell(37,7, 'Prefix',"1",0,'L');
        $this->cell(37,7, 'Serial No.',"1",0,'C');
        $this->cell(17,7, 'CD',"1",1,'C');

        $this->cell(125,13, '',"0",0,'L');
        $this->cell(15,13, 'Date',"LTB",0,'L');
        $this->SetFont('Arial', 'B', 17);
        $this->cell(45,13, '24.09.2016',"TRB",0,'C');
        $this->SetFont('Arial', '', 10);
        //prefix - serial - cd values
        $this->cell(37,13, '',"1",0,'L');
        $this->cell(37,13, '',"1",0,'L');
        $this->SetFont('Arial', 'B', 17);
        $this->cell(17,13, '0',"1",1,'C');
        $this->SetFont('Arial', '', 10);

        $this->cell(125,10, '',"0",0,'L');
        $this->cell(25,10, 'In Date',"LTB",0,'L');
        $this->SetFont('Arial', 'B', 14);
        $this->cell(35,10, '19.09.2016',"TRB",0,'C');
        $this->SetFont('Arial', '', 10);
        $this->cell(27,10, 'Tank Type',"LTR",0,'L');
        $this->cell(64,10, 'Deport Ref. No.',"LTR",1,'L');

        $this->cell(45,7,'Ref. / Job / Order Nr.:','LTR',0);
        $this->cell(80,7,'Depot:','LTR',0);

        $this->cell(19,7,'Chemical:','1',0);
        $this->SetFont('Arial', 'B', 12);
        $this->cell(5,7,'X','1',0,'C');
        $this->SetFont('Arial', '', 10);

        $this->cell(14,7,'Food:','1',0);
        $this->SetFont('Arial', 'B', 12);
        $this->cell(5,7,'','1',0,'C');
        $this->SetFont('Arial', '', 10);

        $this->cell(12,7,'Gas:','1',0);
        $this->SetFont('Arial', 'B', 12);
        $this->cell(5,7,'','1',0,'C');
        $this->SetFont('Arial', '', 10);

        //tank type - deport ref values
        $this->cell(27,7, '',"LRB",0,'L');
        $this->SetFont('Arial', 'B', 17);
        $this->cell(64,7, '10167 / 09 / 16',"LRB",1,'C');
        $this->SetFont('Arial', '', 10);

        //ref job - depot value
        $this->cell(45,7,'','LRB',0);
        $this->cell(80,7,'','LRB',0);

        $this->cell(20,7,'CSC No.:','LTB',0);
        $this->cell(40,7,'','TRB',0,'C');

        $this->cell(27,7, 'Last Test Date',"LTB",0,'L');
        $this->cell(45,7, '01/16',"TRB",0,'C');
        $this->cell(5,7, '',"1",0,'C');
        $this->cell(14,7, '',"1",1,'C');

        $this->cell(50,7,'Last charge','LTB',0);
        $this->cell(58,7,'Sasol Wax','TRB',0);

        $this->cell(45,7,'Certificate of Cleanliness','LTB',0);
        $this->cell(10,7,'Yes','TRB',0);
        $this->SetFont('Arial', 'B', 12);
        $this->cell(5,7,'X','1',0);
        $this->SetFont('Arial', '', 10);
        $this->cell(12,7,' No','1',0);
        $this->SetFont('Arial', 'B', 12);
        $this->cell(5,7,'','1',0);
        $this->SetFont('Arial', '', 10);

        $this->cell(21,7,'Issued By:','LTB',0);
        $this->cell(25,7,'','TRB',0);

        $this->cell(20,7,'Est. Date','LTB',0);
        $this->cell(25,7,'','TRB',1);

        $yt = $this->getY();
        $xt = $this->getX();
        $this->MultiCell(90,7,'Remark
        Safely value serialnumber 1: 27196
        Safely value serialnumber 1: 28096
        ','1','C');
        $y1= $this->getY();
        $this->SetY($yt);
        $this->setX($xt+90);

        $this->MultiCell(95,7,'Remark
        Safely value serialnumber 1: 27196
        Safely value serialnumber 1: 28096f dfsgsdfgsdfg
        sdfgsdfgsdfgs
        sdfgsdfgsdfgsf','1','L');
        $y2= $this->getY();
        $this->SetY($yt);
        $this->setX($xt+90+95);

        $this->MultiCell(91,7,'Remark
        Safely value serialnumber 1: 27196
        Safely value serialnumber 1: 28096 gfdghdfgsdfgsdfgsdgfsdfgsfd','1','L');
        $y3= $this->getY();

        $this->SetY(max($y1,$y2,$y3));

        $this->SetFont('Arial', 'B', 10);
        $this->cell(170,7,'','LTB',0);
        $this->cell(30,7,'Depot\'s Estimate','TB',0);
        $this->cell(47,7,'','TB',0);
        $this->cell(14,7,'Rep.','TB',0);
        $this->cell(15,7,'Ok','TRB',1);

        $this->SetFont('Arial', '', 10);
        
        $this->ln();
        
        
        
        
        //Cabezera--Fin
        
     
        
            
       

    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}
