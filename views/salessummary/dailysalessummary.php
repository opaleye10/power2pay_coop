<?php
session::init();
session::set('myrecord',$this->myrecord);
foreach ($this->myrecord as $key => $value) {
	# code...
	Session::set('trndate',$value['rptdate']);
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
			$this->Cell(276,5, 'MADELEKE DISTRIBUTORS NIG. LTD',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','',13);
			$this->Cell(276,10,Session::get('subsidiary'),0,0,'C');
			$this->Ln();
			$this->SetFont('Times','B',13);
			$this->Cell(150,12,'SALES SUMMARY REPORT AS AT : '.Session::get('trndate'),0,0,'C');			
			$this->Ln(15);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		
		function headerTables(){
			$this->SetFont('Times','B',11);
			$this->Cell(15,5,'P.No',1,0,'C');
			$this->Cell(80,5,'Description',1,0,'C');
			$this->Cell(18,5,'Sales Qty',1,0,'C');
			$this->Cell(30,5,'Sales Cost',1,0,'C');
			$this->Cell(30,5,'Comp. Cost',1,0,'C');
			$this->Cell(25,5,'Profit/Loss',1,0,'C');						
			$this->Ln();
		}
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			$tqty=0;
			$tsales=0;
			$trev=0;
			$tprofit=0;
			foreach ($myrecord as $row) {
				$tqty=$row['qty'] + $tqty;
				$tsales=$row['income'] + $tsales;
				$trev=$row['actualcost'] + $trev;
				$tprofit=$row['profitloss'] + $tprofit;
			$this->Cell(15,5,$row['prid'],1,0,'C');
			$this->Cell(80,5,$row['product'],1,0,'L');
			$this->Cell(18,5,number_format($row['qty']),1,0,'R');
			$this->Cell(30,5,number_format($row['income']),1,0,'R');
			$this->Cell(30,5,number_format($row['actualcost']),1,0,'R');
			$this->Cell(25,5,number_format($row['profitloss']),1,0,'R');
			$this->Ln();
			
			}
			Session::set('tqty',$tqty);
			Session::set('tsales',$tsales);
			Session::set('trev',$trev);
			Session::set('tprofit',$tprofit);
			


		}



		function footable(){
			$this->SetFont('Times','B',12);
			$grandtotal=Session::get('grandtotal');
			$this->Cell(15,5,'',1,0,'C');
			$this->Cell(80,5,'Total Balance',1,0,'R');
			$this->Cell(18,5,number_format(Session::get('tqty')),1,0,'R');
			$this->Cell(30,5,number_format(Session::get('tsales')),1,0,'R');
			$this->Cell(30,5,number_format(Session::get('trev')),1,0,'R');
			$this->Cell(25,5,number_format(Session::get('tprofit')),1,0,'R');
			$this->Ln();


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