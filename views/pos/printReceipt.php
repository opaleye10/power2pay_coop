<?php
session::init();
session::set('myrecord',$this->printreceipt);
foreach ($this->printreceipt as $key => $value) {
	# code...
	Session::set('receiptno',$value['trnno']);
	Session::set('cusid',$value['customerid']);
	Session::set('cust_name',$value['customers']);
	Session::set('rec_date',$value['trndate']);

}

//ini_set("session.auto_start", 0);
//ob_start();

ob_end_clean();
require "libss/fpdf.php";


	class myPDF extends FPDF{

		function header(){		
			
			$this->SetFont('Arial','B',9);
			$this->Cell(0,5, 'MADELEKE DISTRIBUTORS',2,1,'C');			
			$this->cell(0,5,  Session::get('subsidiary'),0,1,'C');
			$this->SetFont('Arial','B',6);
			$this->cell(0,5, 'Lajonrin, Ilorin',0,1,'C');
			$this->Ln();
			

			
			$this->SetFont('Arial','',6);
			$this->Cell(0,5, 'RECEIPT',2,1,'C');
			$this->SetFont('Arial','',5);
			$this->cell(0,5,'S/N:'. Session::get('receiptno'),2,1,'C');
			$this->Ln();


			
		}

		function footer(){
			$this->SetY(-10);
			$this->SetFont('Arial','',4);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}

		function headerTables(){
			$this->SetFont('Times','B',6);
			$this->Cell(6,5,'No.',1,0,'C');
			$this->Cell(15,5,'Description',1,0,'C');
			$this->Cell(5,5,'Qty',1,0,'C');
			$this->Cell(7,5,'Price',1,0,'C');			
			$this->Cell(9,5,'Total',1,0,'C');	
			$this->Ln();
			
			
		}
		
		function viewTable(){
			$this->SetFont('Times','',6);
			$myrecord=Session::get('myrecord');
			$gt=0;
			foreach ($myrecord as $row) {	
			$gt += $row['amount'];
			$this->Cell(6,5,$row['pid'],1,0,'C');
			$this->Cell(15,5,$row['product'],1,0,'L');
			$this->Cell(5,5,number_format($row['qty']),1,0,'R');
			$this->Cell(7,5,number_format($row['price']),1,0,'R');			
			$this->Cell(9,5,number_format($row['amount']),1,0,'R');
			$this->Ln();			
			}
			Session::set('grandtotal',$gt);


		}


		function footable(){
			$this->SetFont('Times','B',6);
			$grandtotal=Session::get('grandtotal');
			$this->Cell(20, 5, '' ,0,0);
			$this->Cell(8, 5,'Total',0,0);
			//$this->Cell(0, 5,'=N=',1,0);
			$this->Cell(14, 5,number_format($grandtotal),1,1,'R');


		}

	}

	$pdf= new myPDF('P','mm',array(60,120));
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->headerTables();
	$pdf->viewTable();
	$pdf->footable();
	$pdf->Output();
	

?>