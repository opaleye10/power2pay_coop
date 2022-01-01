<?php


class Receipt extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('receipt/js/default.js');

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
        $this->view->GetDebtorslist =$this->model->GetDebtorslist();
        $this->view->GetDebtorspaysRefno =$this->model->GetDebtorspaysRefno();   
        $this->view->GetBanks =$this->model->GetBanks();             
        $this->view->render('receipt/index');
    }
    public function SaveCashPayment()
    {
        $data=array();
        $data['customerid']=$_POST['customerid'];
        $data['customers']=$_POST['customers'];
        $data['trndate']=$_POST['trndate'];
        $data['trnno']=$_POST['trnno'];        
        $data['description']=$_POST['description'];         
        $data['period']=$_POST['period'];
        $data['currentuser']=$_POST['currentuser'];
        $data['credit']=$_POST['credit'];
        $data['tme']=$_POST['tme'];
        $this->model->SaveCashPayment($data);
    }

    public function SaveBankPayment()
    {
        $data=array();
        $data['customerid']=$_POST['customerid'];
        $data['customers']=$_POST['customers'];
        $data['trndate']=$_POST['trndate'];
        $data['trnno']=$_POST['trnno'];        
        $data['description']=$_POST['description'];         
        $data['period']=$_POST['period'];
        $data['currentuser']=$_POST['currentuser'];
        $data['credit']=$_POST['credit'];
        $data['bankref']=$_POST['bankref'];
        $data['accountid']=$_POST['accountid'];
        $data['tme']=$_POST['tme'];
        $this->model->SaveBankPayment($data);
    }
    
    public function printdebtorbalances()
    {
       
       
       
                 
                 $this->view->printdebtorsbalances =$this->model->printdebtorsbalances();
                $this->view->render('receipt/printdebtorsbalances');
                
          
      

    }
    public function printdebtorbalance()
    {
       
       //print_r($data);



       if(isset($_POST["debtorid"])) 
            {
                 $data=array();
                 $data['id']=$_POST['debtorid'];
                 $this->view->printdebtorshistory =$this->model->printdebtorshistory($data);
                $this->view->render('receipt/printdebtorhistory');
                
            }
        else
        {
                  echo "<script type='text/javascript'>

            alert('Please select a customer for details transaction listing');

            window.location.replace('https://app.power2pay.com.ng/receipt');

            </script>";

        }     

      //  $this->view->printstockhistory =$this->model->printstockhistory($data);
     //   $this->view->render('stockcard/printstockcard');

    }
}