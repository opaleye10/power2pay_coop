<?php

function unique_multidim_array($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 
} 

















session::init();
session::set('myrecord',$this->myrecord);
foreach ($this->myrecord as $key => $value) {
	# code...
	Session::set('mydate',$value['trndate']);
}
//ini_set("session.auto_start", 0);
//ob_start();

ob_end_clean();
require "libss/fpdf.php";


	class myPDF extends FPDF{

		function header(){
			$this->Image('public/images/'.Session::get('parentcompanyid').'.png',10,6);
			$this->SetFont('Arial','B',14);
			$this->Cell(276,5, 'MADELEKE DISTRIBUTORS NIG. LTD',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',13);
			$this->Cell(276,10,Session::get('subsidiary'),0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',14);
			$this->Cell(260,12,'=====   DAILY SALES DETAILS RECORDS as at  '. Session::get('mydate') .'   ====',0,0,'C');
			
			$this->Ln(20);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		function headerTables(){
			$this->SetFont('Times','B',12);
			$this->Cell(20,5,'C. No.',1,0,'C');
			$this->Cell(80,5,'Customers',1,0,'C');
			$this->Cell(15,5,'Code',1,0,'C');
			$this->Cell(80,5,'Products',1,0,'C');
			$this->Cell(15,5,'Qty',1,0,'C');
			$this->Cell(30,5,'Price',1,0,'C');
			$this->Cell(40,5,'Amount',1,0,'C');
			
			$this->Ln();
		}
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			$getname=Session::get('myrecord');

			$a=array();
			foreach ($getname AS $key => $line ) { 
			    array_push($a,$line['customers']);
			} 
			//print_r(array_unique($a));
			//exit();
			$b=(array_unique($a));
			
			
			
			foreach ($b as $ke) {
				# code...
				$this->Cell(20,5,'',1,0,'C');
				$this->Cell(80,5,$ke,1,0,'C');
				$this->Ln();

					foreach ($myrecord as $row) {
						$this->Cell(20,5,'',1,0,'C');
						$this->Cell(80,5,'',1,0,'C');
						$this->Cell(15,5,$row['pid'],1,0,'C');
						$this->Cell(80,5,$row['product'],1,0,'C');
						$this->Cell(15,5,number_format($row['qty']),1,0,'C');
						$this->Cell(30,5,number_format($row['price']),1,0,'C');
						$this->Cell(40,5,number_format($row['amount']),1,0,'C');				
						$this->Ln();
						
					}


			}
			


		}
		

	}

	$pdf= new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTables();
	$pdf->viewTable();
	$pdf->Output();
	

?>