<?php
session::init();
session::set('myrecord',$this->GetMyProductList);

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
			$this->Cell(276,12,'===== === == = PRODUCT LIST = == === ====',0,0,'C');
			$this->Ln(20);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		function headerTables(){
			$this->SetFont('Times','B',12);
			$this->Cell(40,5,'Product No',1,0,'C');
			$this->Cell(60,5,'Description',1,0,'C');
			
			$this->Ln();
		}
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			foreach ($myrecord as $row) {
			$this->Cell(40,5,$row['pid'],1,0,'C');
			$this->Cell(60,5,$row['pname'],1,0,'L');				
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