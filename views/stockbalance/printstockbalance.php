<?php
//print_r($this->printstockbalance);
session::init();
session::set('myrecord',$this->printstockbalance);

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
			$this->SetFont('Times','B',14);
			$this->Cell(150,12,'Stock Balance as at : '.Session::get('sb_date') ,0,0,'C');
			$this->Ln(15);

			
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		
		function headerTables(){
			$this->SetFont('Times','B',11);
			$this->Cell(20,5,'S.No',1,0,'C');
			$this->Cell(18,5,'Stock No',1,0,'C');
			$this->Cell(120,5,'Stock',1,0,'C');
			$this->Cell(18,5,'Balance',1,0,'C');								
			$this->Ln();
		}
		
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			$bal=0;
			foreach ($myrecord as $row) {				
			$this->Cell(20,5,'',1,0,'C');
			$this->Cell(18,5,$row['stockno'],1,0,'L');
			$this->Cell(120,5,$row['stock'],1,0,'L');
			$this->Cell(18,5,number_format($row['qty']),1,0,'R');			
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