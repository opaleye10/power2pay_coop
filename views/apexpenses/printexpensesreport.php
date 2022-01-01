<?php
//print_r($this->printstockbalance);
session::init();
session::set('myrecord',$this->expensesdaterange);

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
			$this->Cell(150,12,'EXPENSES BETWEEN : '.Session::get('dfrom').' AND '.Session::get('dto') ,0,0,'C');
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
			$this->Cell(18,5,'Date',1,0,'C');
			$this->Cell(120,5,'Descriptions',1,0,'C');
			$this->Cell(25,5,'Amount',1,0,'C');								
			$this->Ln();
		}
		
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			$bal=0;
			$sn=0;
			$totalamt=0;
			foreach ($myrecord as $row) {	
			$sn=$sn+1;
			$totalamt=$totalamt + $row['amount'];		
			$this->Cell(20,5, $sn,1,0,'C');
			$this->Cell(18,5,$row['trndate'],1,0,'L');
			$this->Cell(120,5,$row['trnno'].'--'.$row['description'].'--'.$row['supplier'],1,0,'L');
			$this->Cell(25,5,number_format($row['amount']),1,0,'R');			
			$this->Ln();			
			}
			Session::set('totalamt',$totalamt);


		}



		function footable(){
			$this->SetFont('Times','B',11);
			$grandtotal=Session::get('totalamt');
			$this->Cell(20,5, '',1,0,'C');
			$this->Cell(18,5,'Total',1,0,'L');
			$this->Cell(120,5,'',1,0,'L');
			$this->Cell(25,5,number_format($grandtotal),1,0,'R');		
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