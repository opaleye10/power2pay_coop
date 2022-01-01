<?php
session::init();
session::set('myrecord',$this->mypandl);

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
			$this->Cell(150,12,'PROFIT AND LOSS ACCOUNT FOR THE ACTIVE ACCOUNT PERIOD '. Session::get('period'),0,0,'C');
			$this->Ln(10);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		
		function headerTables(){
			$this->SetFont('Times','B',11);
			$this->Cell(10,5,'S/No.',1,0,'C');
			$this->Cell(100,5,'Account Description',1,0,'C');	
			$this->Cell(30,5,'Amount',1,0,'C');									
			$this->Cell(30,5,'Total Amount',1,0,'C');	
			$this->Ln();
		}
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');		
			$sn=0;	
			foreach ($myrecord as $row) {
				$sn++;
				$this->Cell(10,5,$sn,1,0,'C');
				$this->Cell(100,5,$row['gldescription'],1,0,'L');	
				$this->Cell(30,5,$row['amount'],1,0,'R');									
				$this->Cell(30,5,$row['gtotal'],1,0,'R');			
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