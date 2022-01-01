<?php
session::init();

session::set('myrecord',$this->printstockhistory);
foreach ($this->printstockhistory as $key => $value) {
	# code...
	Session::set('s_stockno',$value['stockno']);
	Session::set('s_stock',$value['stock']);
}

//ini_set("session.auto_start", 0);
//ob_start();

ob_end_clean();
require "libss/fpdf.php";


	class myPDF extends FPDF{

		function header(){
			$this->Image('public/images/'.Session::get('parentcompanyid').'.png',10,6);
			$this->SetFont('Arial','B',14);
			$this->Cell(276,5, Session::get('companyname'),0,0,'C');
			$this->Ln();
			$this->SetFont('Times','',13);
			$this->Cell(276,10,Session::get('subsidiary'),0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',14);
			$this->Cell(150,12,'STOCK CARD : '.Session::get('s_stockno'). ' '. Session::get('s_stock') ,0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(150,12,'Between '.Session::get('sc_startdate'). ' and '. Session::get('sc_enddate') ,0,0,'C');
			$this->Ln(10);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		
		function headerTables(){
			$this->SetFont('Times','B',11);
			$this->Cell(20,5,'Date',1,0,'C');
			$this->Cell(120,5,'Description',1,0,'C');
			$this->Cell(18,5,'Stock-In',1,0,'C');
			$this->Cell(18,5,'Stock-Out',1,0,'C');
			$this->Cell(18,5,'Balance',1,0,'C');						
			$this->Ln();
		}
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			$bal=0;
			foreach ($myrecord as $row) {
				$bal=$row['debit']-$row['credit'] + $bal;
			$this->Cell(20,5,$row['trndate'],1,0,'C');
			$this->Cell(120,5,$row['description'],1,0,'L');
			$this->Cell(18,5,number_format($row['debit']),1,0,'R');
			$this->Cell(18,5,number_format($row['credit']),1,0,'R');
			$this->Cell(18,5,number_format($bal),1,0,'R');
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