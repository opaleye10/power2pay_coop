<?php
//print_r($this->printstockbalance);
session::init();
foreach ($this->displaybankschedule as $key => $value) {
	# code...
	Session::set('month',$value['nmonth']);
	Session::set('year',$value['nyear']);
}

session::set('myrecord',$this->displaybankschedule);

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
			$this->Cell(150,12,'BANK SCHEDULE REPORT: '.Session::get('month'). ' '.Session::get('year') ,0,0,'C');
			$this->Ln(15);

			 
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}
		
		function headerTables(){
			$this->SetFont('Times','B',11);
			$this->Cell(20,5,'Staff No.',1,0,'C');
			$this->Cell(55,5,'Staff Name',1,0,'C');
			$this->Cell(60,5,'Bank Details',1,0,'C');
			$this->Cell(35,5,'Account No.',1,0,'C');											
			$this->Cell(25,5,'Amount',1,0,'C');
			$this->Ln();
		}
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			$bal=0;
			$gt=0;
			foreach ($myrecord as $row) {	
			$gt += $row['amount'];			
			$this->Cell(20,5,$row['staffid'],1,0,'C');
			$this->Cell(55,5,$row['staffname'],1,0,'L');
			$this->Cell(60,5,$row['bank'],1,0,'L');
			$this->Cell(35,5,$row['acctno'],1,0,'L');
			$this->Cell(25,5,number_format($row['amount']),1,0,'R');			
			$this->Ln();
			
			}

			Session::set('grandtotal',$gt);
		}
		
		
		function footable(){
			$grandtotal=Session::get('grandtotal');
			$this->Cell(122, 5, '' ,0,0);
			$this->Cell(35, 5,'Net Pay',0,0);
			$this->Cell(20, 5,'=N=',1,0);
			$this->Cell(2, 5,number_format($grandtotal),1,1,'R');


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