<?php
session::init();
session::set('myrecord',$this->mydelivery);
foreach ($this->mydelivery as $key => $value) {
	# code...
	Session::set('invoiceno',$value['deliveryno']);
	Session::set('supplierid',$value['supplierid']);
	Session::set('deliverydate',$value['deldate']);

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
			$this->Cell(59,5, 'DELIVERY INVOICE',0,1);
			$this->SetFont('Arial','',12);

			$this->Cell(135,5,'[city, country, zip]',0,0);
			$this->Cell(25,5,'Date',0,0);
			$this->Cell(34,5,Session::get('deliverydate'),0,1);

			$this->Cell(130,5,'[phone no 12345678]',0,0);
			$this->Cell(25,5,'Invoice no',0,0);
			$this->Cell(34,5,Session::get('invoiceno'),0,1);

			$this->Cell(130,5,'[fax no 12345678]',0,0);
			$this->Cell(25,5,'customer id',0,0);
			$this->Cell(34,5,Session::get('supplierid'),0,1);

			$this->Cell(189,10,'',0,1);
			

			$this->Cell(100,5,'Bill to:',0,1);

			//billing address
			$this->Cell(10,5,'',0,0);
			$this->Cell(90,5,'[name]',0,1);
			$this->Cell(10,5,'',0,0);

			$this->Cell(90,5,'[company Name]',0,1);
			$this->Cell(10,5,'',0,0);
			$this->Cell(90,5,'[Address]',0,1);

			$this->Cell(10,5,'',0,0);
			$this->Cell(90,5,'[phoneno]',0,1);
			$this->Cell(189,10,'',0,1);
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
			$this->Cell(20,5,$row['itemno'],1,0,'C');
			$this->Cell(90,5,$row['itemdesc'],1,0,'L');
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