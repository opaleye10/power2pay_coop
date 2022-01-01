<?php
session::init();
session::set('myrecord',$this->chartofaccount);

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
			$this->Cell(150,12,'FINANCIAL CHART OF ACCOUNT ',0,0,'C');
			$this->Ln(10);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		
		function headerTables(){
			$this->SetFont('Times','B',11);
			$this->Cell(30,5,'Accound Code',1,0,'C');
			$this->Cell(160,5,'Account Description',1,0,'C');									
			$this->Ln();
		}
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');			
			foreach ($myrecord as $row) {				
			$this->Cell(30,5,$row['accountid'],1,0,'C');
			$this->Cell(160,5,$row['description'],1,0,'L');			
			$this->Ln();
			
			}


		}
		

	}

	$pdf= new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('','A4',0);
	$pdf->headerTables();
	$pdf->viewTable();
	$pdf->Output();
	

?>