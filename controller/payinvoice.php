<?php
class Payinvoice extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('payinvoice/js/default.js');

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
        $this->view->GetAccount2pay =$this->model->GetAccount2pay();


        $this->view->render('payinvoice/index');
    }

    public function effectbankpayment()
    {
        if(isset($_POST["pos"])) 
            {
                $data=array();
                $data['trndate']=$_POST['ccdate'];
                $data['trnno']=$_POST['invp'];
                $data['accountid']=$_POST['banktocredit'];
                $data['invno']=$_POST['trnno'];
                $data['tme']=$_POST['tme'];
                $data['amount']=$_POST['myamount'];
                $data['bankref']=$_POST['postransfer'];
                // print_r($data); 
                $this->model->effectbankpayment($data);
                
            }
        else
        {
                $data=array();
                $data['trndate']=$_POST['ccdate'];
                $data['trnno']=$_POST['invp'];               
                $data['invno']=$_POST['trnno'];
                $data['tme']=$_POST['tme'];
                $data['amount']=$_POST['myamount'];
                //print_r($data); 
               $this->model->effectcashpayment($data);

        }     



          
  
  
    }


    public function bringcashcode()
    {
        $this->model->bringcashcode();
    }
    public function details($id)
    {
        $this->view->GetInvoice2pay =$this->model->GetInvoice2pay($id);
        $this->view->GetPaymentRefno =$this->model->GetPaymentRefno();
        $this->view->GetBanks =$this->model->GetBanks();
        $this->view->render('payinvoice/detailpage');
    }


}