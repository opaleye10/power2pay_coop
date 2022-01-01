<?php
session::init();
//print_r($this->myreceipt);
//exit();
session::set('myrecord',$this->myreceipt);
foreach ($this->myreceipt as $key => $value) {
	# code...
	Session::set('trnno',$value['trnno']);
	Session::set('paytype',$value['purchasestype']);
	Session::set('trndate',$value['trndate']);
	Session::set('customer',$value['customers']);

}

//ini_set("session.auto_start", 0);
//ob_start();

ob_end_clean();
require "libss/fpdf.php";


	class myPDF extends FPDF{

		function header(){		
			$this->Image('public/images/'.Session::get('parentcompanyid').'.png',10,6);	
			$this->SetFont('Arial','B',14);
			$this->Cell(135,5, 'MADELEKE DISTRIBUTORS NIG. LTD',0,0);
			$this->Cell(59,5, 'PAYMENT RECEIPT',0,1);
			$this->SetFont('Arial','',12);

			$this->Cell(135,5,'Ilorin, Nigeria, 032',0,0);
			$this->Cell(25,5,'Date :',0,0);
			$this->Cell(34,5,Session::get('trndate'),0,1);

			$this->Cell(130,5,'Phone: 07035469349',0,0);
			$this->Cell(25,5,'Invoice No :',0,0);
			$this->Cell(34,5,Session::get('invoiceno'),0,1);

			$this->Cell(130,5,'Fax No : 07035469349',0,0);
			$this->Cell(25,5,'Pay Type : ',0,0);
			$this->Cell(34,5,Session::get('paytype'),0,1);

			$this->Cell(189,10,'',0,1);
			

			$this->Cell(100,5,'To :',0,1);

			//billing address
			$this->Cell(10,5,'',0,0);
			$this->Cell(90,5,'BUYER',0,1);
			$this->Cell(10,5,'',0,0);

			$this->Cell(90,5,Session::get('customer'),0,1);
			$this->Cell(10,5,'',0,0);
			$this->Cell(90,5,'',0,1);

			
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/(nb)',0,0,'C');
		}

		function headerTables(){
			$this->SetFont('Times','B',12);
			$this->Cell(20,5,'Item No.',1,0,'C');
			$this->Cell(90,5,'Description',1,0,'C');
			$this->Cell(20,5,'Qty',1,0,'C');
			$this->Cell(20,5,'Price/Unit',1,0,'C');			
			$this->Cell(40,5,'Total',1,0,'C');	
			$this->Ln();
			
			
		}
		
		function viewTable(){
			$this->SetFont('Times','',10);
			$myrecord=Session::get('myrecord');
			$gt=0;
			foreach ($myrecord as $row) {	
			$gt += $row['amount'];
			$this->Cell(20,5,$row['pid'],1,0,'C');
			$this->Cell(90,5,$row['product'],1,0,'L');
			$this->Cell(20,5,number_format($row['qty']),1,0,'R');
			$this->Cell(20,5,number_format($row['price']),1,0,'R');			
			$this->Cell(40,5,number_format($row['amount']),1,0,'R');
			$this->Ln();			
			}
			Session::set('grandtotal',$gt);


		}

		function footable(){
			$grandtotal=Session::get('grandtotal');
			$this->Cell(130, 5, '' ,0,0);
			$this->Cell(25, 5,'Subtotal',0,0);
			$this->Cell(4, 5,'=N=',1,0);
			$this->Cell(30, 5,number_format($grandtotal),1,1,'R');


			$this->Cell(130, 5,'',0,0);
			$this->Cell(25, 5,'Taxable',0,0);
			$this->Cell(4, 5,'=N=',1,0);
			$this->Cell(30, 5,'0',1,1,'R');

			$this->Cell(130,5,'',0,0);
			$this->Cell(25,5,'Tax Rate',0,0);
			$this->Cell(4,5,'=N=',1,0);
			$this->Cell(30,5,'0',1,1,'R');
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