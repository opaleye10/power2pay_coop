<?php
session::init();
session::set('myrecord',$this->GetMySuppliers);

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
			$this->Cell(276,12,'LIST OF SUPPLIERS',0,0,'C');
			$this->Ln(20);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo(). '/(nb)',0,0,'C');
		}
		function headerTables(){
			$this->SetFont('Times','B',12);
			$this->Cell(20,13,'S.No',1,0,'C');
			$this->Cell(40,13,'Suppliers',1,0,'C');
			$this->Cell(40,13,'Contact Person',1,0,'C');
			$this->Cell(60,13,'Email',1,0,'C');
			$this->Cell(36,13,'Phone no',1,0,'C');
			$this->Cell(80,13,'Address',1,0,'C');
			$this->Ln();
		}
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			foreach ($myrecord as $row) {
			$this->Cell(20,13,$row['id'],1,0,'C');
			$this->Cell(40,13,$row['supplier'],1,0,'L');
			$this->Cell(40,13,$row['contact_person'],1,0,'L');
			$this->Cell(60,13,$row['email'],1,0,'L');
			$this->Cell(36,13,$row['phone_number'],1,0,'L');
			$this->Cell(80,13,$row['address'],1,0,'L');
			$this->Ln();
			
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