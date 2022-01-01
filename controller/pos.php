<?php
class Pos extends Controller{

    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('pos/js/default.js');  

        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        }     
    }

    function index(){                
        $this->view->GetGLMenulist =$this->model->GetGLMenulist();
        $this->view->GetAPMenulist =$this->model->GetAPMenulist();
        $this->view->GetARMenulist =$this->model->GetARMenulist();
        $this->view->GetPRMenulist =$this->model->GetPRMenulist();
        $this->view->GetINMenulist =$this->model->GetINMenulist();
        $this->view->GetSTMenulist =$this->model->GetSTMenulist();
        $this->view->GetBanks =$this->model->GetBanks();
        $this->view->GetPOS =$this->model->GetPOS();
        $this->view->GetDailySalesReports_Cash =$this->model->GetDailySalesReports_Cash();
        $this->view->GetDailySalesReports_transfer =$this->model->GetDailySalesReports_transfer();
        $this->view->GetDailySalesReports_pos =$this->model->GetDailySalesReports_pos();
        $this->view->GetDailySalesReports_Credit =$this->model->GetDailySalesReports_Credit();
        $this->view->GetDailySalesReports =$this->model->GetDailySalesReports();
    	$this->view->GetCustomer =$this->model->GetCustomer();
    	$this->view->GetPosRefno =$this->model->GetPosRefno();
        $this->view->GetPOSjref =$this->model->GetPOSjref();        
    	$this->view->DeleteTempoSale =$this->model->DeleteTempoSale();
        $this->view->render('pos/index');
    }
    public function load_mcl_para()
    {
        $data=array();
        $data['cid']=($_POST['cid']);        
        $this->model->load_mcl_para($data);   
    }
    public function printreceipt()
    {
        $data=array();
        $data['tmej']=($_POST['tmej']);        
        $this->view->printreceipt =$this->model->printreceipt($data);
        $this->view->render('pos/printReceipt');
    }
    public function SaveTempoSale()
    {
    	$data=array();
    	$data['qty']=($_POST['qty']);
    	$data['price']=($_POST['price']);
    	$data['amount']=($_POST['amount']);
    	$data['pid']=($_POST['pid']);
    	$data['product']=($_POST['product']);
    	$data['currentuser']=($_POST['currentuser']);
    	$this->model->SaveTempoSale($data);
    }
    public function SavePosTransferSales()
    {
    	$data=array();
    	$data['trndate']=($_POST['trndate']);
    	$data['trnno']=($_POST['trnno']);
    	$data['customerid']=($_POST['customerid']);
    	$data['customers']=($_POST['customers']);
    	$data['purchasestype']=($_POST['purchasestype']);
    	$data['paymenttype']=($_POST['paymenttype']);
    	$data['payreference']=($_POST['payreference']);
    	$data['period']=($_POST['period']);
    	$data['currentuser']=($_POST['currentuser']);
        $data['accountid']=($_POST['accountid']);
    	$data['tme']=($_POST['tme']);
    	$this->model->SavePosTransferSales($data);
    }

    public function SavePosSales()
    {
        $data=array();
        $data['trndate']=($_POST['trndate']);
        $data['trnno']=($_POST['trnno']);
        $data['customerid']=($_POST['customerid']);
        $data['customers']=($_POST['customers']);
        $data['purchasestype']=($_POST['purchasestype']);
        $data['paymenttype']=($_POST['paymenttype']);
        $data['payreference']=($_POST['payreference']);
        $data['period']=($_POST['period']);
        $data['currentuser']=($_POST['currentuser']);
        $data['accountid']=($_POST['accountid']);
        $data['tme']=($_POST['tme']);
        $this->model->SavePosSales($data);
    }
    public function SaveCashSales()
    {
    	$data=array();
    	$data['trndate']=($_POST['trndate']);
    	$data['trnno']=($_POST['trnno']);
    	$data['customerid']=($_POST['customerid']);
    	$data['customers']=($_POST['customers']);
    	$data['purchasestype']=($_POST['purchasestype']);
    	$data['paymenttype']=($_POST['paymenttype']);    	
    	$data['period']=($_POST['period']);
    	$data['currentuser']=($_POST['currentuser']);
    	$data['tme']=($_POST['tme']);
    	$this->model->SaveCashSales($data);
    }

    public function SaveCreditSales()
    {
    	$data=array();
    	$data['trndate']=($_POST['trndate']);
    	$data['trnno']=($_POST['trnno']);
    	$data['customerid']=($_POST['customerid']);
    	$data['customers']=($_POST['customers']);
    	$data['purchasestype']=($_POST['purchasestype']);
    	$data['paymenttype']=($_POST['paymenttype']);    	
    	$data['period']=($_POST['period']);
    	$data['currentuser']=($_POST['currentuser']);
    	$data['duedate']=($_POST['duedate']);
    	$data['tme']=($_POST['tme']);
    	$this->model->SaveCreditSales($data);
    }

    
}