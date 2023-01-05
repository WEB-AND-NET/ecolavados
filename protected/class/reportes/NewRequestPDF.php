<?php
define('EURO',chr(128));

class NewRequestPDF extends FPDF {

    public function __construct() {

        parent::__construct('P', 'mm', 'legal');
        $this->SetTitle('Request');
    }

    function Body($data,$productos,$paquetes,$damages,$areas,$id) {

        $this->SetFont('Arial', 'B', 8);
        $x = $this->GetX() - 5;
        $y = $this->GetY() - 5;
        //Cabezera
 
        
        $this->cell(125,5, 'TANK EQUIPMENT INTERCHANGE TEST / REPAIRESTIMATE',"1",0,'L');

        $this->SetFont('Arial', '', 8);

        $this->cell(27,5, 'Prefix',"1",0,'L');
        $this->cell(27,5, 'Serial No.',"1",0,'C');
        $this->cell(17,5, 'CD',"1",1,'C');

        $this->cell(88,5, '',"0",0,'L');
        $this->cell(10,5, 'Date',"LTB",0,'L');
        $this->SetFont('Arial', 'B', 13);
        $this->cell(27,5, '24.09.2016',"TRB",0,'C');
        $this->SetFont('Arial', '', 10);
        //prefix - serial - cd values
        $this->cell(37,5, '',"1",0,'L');
        $this->cell(17,5, '',"1",0,'L');
        $this->SetFont('Arial', 'B', 14);
        $this->cell(17,5, '0',"1",1,'C');
        $this->SetFont('Arial', '', 8);

        $this->cell(88,5, '',"0",0,'L');
        $this->cell(10,5, 'In Date',"LTB",0,'L');
        $this->SetFont('Arial', 'B', 13);
        $this->cell(27,5, '19.09.2016',"TRB",0,'C');
        $this->SetFont('Arial', '', 10);
        $this->cell(33,5, 'Tank Type',"LTR",0,'L');
        $this->cell(38,5, 'Deport Ref. No.',"LTR",1,'L');

        $this->cell(40,5,'Ref. / Job / Order Nr.:','LTR',0);
        $this->cell(40,5,'Depot:','LTR',0);

        $this->cell(19,5,'Chemical:','1',0);
        $this->SetFont('Arial', 'B', 12);
        $this->cell(5,5,'X','1',0,'C');
        $this->SetFont('Arial', '', 10);

        $this->cell(14,5,'Food:','1',0);
        $this->SetFont('Arial', 'B', 8);
        $this->cell(5,5,'','1',0,'C');
        $this->SetFont('Arial', '', 10);

        $this->cell(12,5,'Gas:','1',0);
        $this->SetFont('Arial', 'B', 8);
        $this->cell(5,5,'','1',0,'C');
        $this->SetFont('Arial', '', 10);

        //tank type - deport ref values
        $this->cell(18,5, '',"LRB",0,'L');
        $this->SetFont('Arial', 'B', 14);
        $this->cell(38,5, '10167 / 09 / 16',"LRB",1,'C');
        $this->SetFont('Arial', '', 8);

        //ref job - depot value
        $this->cell(40,5,'','LRB',0);
        $this->cell(40,5,'','LRB',0);

        $this->cell(20,5,'CSC No.:','LTB',0);
        $this->cell(40,5,'','TRB',0,'C');

        $this->cell(20,5, 'Last Test Date',"LTB",0,'L');
        $this->cell(36,5, '01/16',"TRB",1,'C');
    

        $this->cell(35,5,'Last charge','LTB',0);
        $this->cell(101,5,'Sasol Wax','TRB',0);

        $this->cell(33,5,'Certificate of Cleanliness','LTBR',0);
        $this->cell(8,5,'Yes','TRB',0);
        $this->SetFont('Arial', 'B', 12);
        $this->cell(5,5,'X','1',0);
        $this->SetFont('Arial', '', 10);
        $this->cell(9,5,' No','1',0);
        $this->SetFont('Arial', 'B', 12);
        $this->cell(5,5,'','1',1);
        $this->SetFont('Arial', '', 8);

        $this->cell(24,5,'Issued By:','LTB',0);
        $this->cell(70,5,'','TRB',0);

        $this->cell(20,5,'Est. Date','LTB',0);
        $this->cell(82,5,'','TRB',1);

     /*   $yt = $this->getY();
        $xt = $this->getX();
        $this->MultiCell(45,7,'Remark
        Safely value serialnumber 1: 27196
        Safely value serialnumber 1: 28096
        ','1','C');
        $y1= $this->getY();
        $this->SetY($yt);
        $this->setX($xt+45);*/


        $this->SetWidths(array(56,70,70));
        $this->SetAligns(array('L','')); 
        $index = 0;
        $text = "";
        foreach ($damages as $damage ) {          
                $text .= "($damage[code]) $damage[damage] ";
        }
        $this->Row(array(
            "", 
            "DAMAGE CODE\n".$text, 
            "REPAIR CODE\n".$text ));
                

        $this->SetFont('Arial', '', 8);
        $this->cell(131,5,'','LTB',0);
        $this->cell(40,5,'Depot\'s Estimate','TB',0);
        $this->cell(10,5,'','TB',0);
        $this->cell(15,5,'Rep.Ok','TRB',1);


        $this->cell(30,5,'ITEM','LTB',0,'C');
        $this->cell(20,5,'Damge Code','B',0,'L');
        $this->cell(15,5,'Rep Cod','B',0,'R');
        $this->cell(71,5,'DAMAGE/REPAIR DIMENSIONS - REMARKS','LTB',0,'C');
        

        $this->cell(15,5,'HRS','TBRL',0,'C');
        $this->cell(15,5,'Material','TBRL',0,'C');
        $this->cell(20,5,'Tot. COST','TRBRL',0,'C');
        $this->cell(10,5,'','TRBRL',1,'C');

        $this->SetFont('Arial', '', 5);
        $expectedArea = 0;
        $totalCost = 0;
        $totalMaterial = 0;
        $totalLabour = 0;
        foreach ($areas as $key => $area) {
            $y = $this->getY();
            $expectedArea = $this->paintAreas($area["descripcion"],$area["items"]);                 
            $this->setY($this->getY()-$expectedArea);     
            $index = 0;
            $this->SetFont('Arial', '', 5);
            foreach ($area["items"] as $key => $value) {  
                $request_item = Doo::db()->query("SELECT mrg.code,mri.mr,ri.hours,ri.material,ri.total,ri.remarks FROM request_items ri
                inner join mr_items mri on (mri.id=ri.id_service) 
                inner join mr_guideline mrg on (mrg.damage = ri.id_damage) 
                where ri.id_request='$id' and ri.id_area='$area[id]' and ri.id_item_area='$value[id]';")->fetch();
                $borders = $index == 0 ? "TR" : "R"; 
                $this->setX($this->getX()+4);
                $this->cell(26,4,$value["item_order"].". ".$value["descripcion"],$borders,0,'L');
                if($request_item){
                    $this->cell(20,4,$request_item["code"],1,0,'C');
                    $this->cell(15,4,$request_item["mr"],1,0,'C');
                    $this->cell(71,4,$request_item["remarks"],1,0,'C');
                    $this->cell(15,4,$request_item["hours"],1,0,'C');
                    $this->cell(15,4,$request_item["material"],1,0,'C');
                    $this->cell(20,4,$request_item["total"],1,0,'C');
                    $this->cell(10,4,"",1,1,'C');
                    $totalCost = $totalCost + $request_item["total"];
                    $totalMaterial = $totalMaterial + $request_item["material"];
                    $totalLabour = $totalLabour + $request_item["hours"];
                }else{
                    $this->cell(20,4,"",1,0,'C');
                    $this->cell(15,4,"",1,0,'C');
                    $this->cell(71,4,"",1,0,'C');
                    $this->cell(15,4,"",1,0,'C');
                    $this->cell(15,4,"",1,0,'C');
                    $this->cell(20,4,"",1,0,'C');
                    $this->cell(10,4,"",1,1,'C');
                }
                $index++;
            }
        }    
        $this->cell(56,4,"This Estimate was created by","TRL",0,'C');
        $this->cell(60,4,"Estimate approved","TRL",0,'C');
        $this->cell(20,4,"Material Total",1,0,'C');
        $this->cell(15,4,"",1,0,'C');   
        $this->cell(15,4,"",1,0,'C');   
        $this->cell(20,4,$totalMaterial,1,1,'C');   

        $this->cell(56,4,"","RL",0,'C');
        $this->cell(60,4,"","RL",0,'C');
        $this->cell(20,4,"Total Labour",1,0,'C');
        $this->cell(15,4,$totalLabour,1,0,'C');   
        $this->cell(15,4,"",1,0,'C');   
        $this->cell(20,4,$totalLabour * $data["labour_rate"],1,1,'C'); 

        $this->cell(56,4,"","RL",0,'C');
        $this->cell(60,4,"","RL",0,'C');
        $this->cell(20,4,"Labour Rate",1,0,'C');
        $this->cell(15,4,$data["labour_rate"],1,0,'C');   
        $this->cell(15,4,"",1,0,'C');   
        $this->cell(20,4,"",1,1,'C'); 

        $this->cell(56,4,"SIGNATURE PRINT NAME","BRL",0,'C');
        $this->cell(60,4,"SIGNATURE PRINT NAME","BRL",0,'C');
        $this->cell(35,4,"Costs Total",1,0,'C');        
        $this->cell(15,4,"",1,0,'C');   
        $this->cell(20,4,(EURO." ".$totalCost),1,1,'C'); 
        $this->ln();    
    }

    
    function paintAreas($text,$items){
        $numberOfItems = count($items);
        $lenTextArea = strlen($text);
        $space = 2;
        $heightVerticalText = $lenTextArea * 2;
        $expectedVerticalValue = $numberOfItems  * 4;
        $extraSpace = 0;
        $areaIsHigher = false;
        if($heightVerticalText != $expectedVerticalValue){
            if($expectedVerticalValue  > $heightVerticalText){
                $extraSpace = ($expectedVerticalValue - $heightVerticalText ) / 2;
            }else{
                $extraSpace = 0;
                $this->SetFont('Arial', '', 4);
                $areaIsHigher = true;
            }
        }
        $this->cell(4,$extraSpace,'','RL',1,'C');
        foreach (str_split($text) as $value) {
            $space = 2;
            if($value == " " or $value == "." ){
                $space = 2;
            }
            if($areaIsHigher){
                $space = $expectedVerticalValue / $lenTextArea;
            }
            $this->cell(4,$space,$value,'RL',1,'C');
        }
        $this->cell(4,$extraSpace,'','BRL',1,'C');
        return $expectedVerticalValue;
    }

    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }

}
