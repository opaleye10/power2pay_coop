<?php
session::init();
session::set('myrecord',$this->printdebtorsbalances);
//print_r(Session::get('myrecord'));
//exit();
foreach ($this->printdebtorsbalances as $key => $value) {
	# code...
	Session::set('customerid',$value['customerid']);
	Session::set('customer',$value['customers']);
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
			$this->SetFont('Times','',13);
			$this->Cell(276,10,Session::get('subsidiary'),0,0,'C');			
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(150,12,'Current Debtors Account for the year '.Session::get('period').' printed on  '.date("d/m/Y"),0,0,'C');
			$this->Ln(10);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		
		function headerTables(){
			$this->SetFont('Times','B',11);
			$this->Cell(20,5,'ID',1,0,'C');
			$this->Cell(120,5,'Customer',1,0,'C');
			$this->Cell(35,5,'Balance',1,0,'C');									
			$this->Ln();
		}
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			$bal=0;
			foreach ($myrecord as $row) {
				$bal=$row['balance'] + $bal;
			$this->Cell(20,5,$row['customerid'],1,0,'C');
			$this->Cell(120,5,$row['customers'],1,0,'L');
			$this->Cell(35,5,number_format($row['balance']),1,0,'R');			
			$this->Ln();
			
			}
			Session::set("grandtotal",$bal);


		}



		function footable(){
			$this->SetFont('Times','B',12);
			$grandtotal=Session::get('grandtotal');
			$this->Cell(20, 5, '' ,0,0);
			$this->Cell(120, 5,'Total',0,0);
			//$this->Cell(0, 5,'=N=',1,0);
			$this->Cell(35, 5,number_format($grandtotal),1,1,'R');


		}
		

	}

	$pdf= new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('','A4',0);
	$pdf->headerTables();
	$pdf->viewTable();
	$pdf->footable();
	$pdf->Output();
	

?>