<?php
class Stockin extends Controller
{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js = array('stockin/js/default.js');
        $logged = Session::get('loggedIn');
       // $permit=Session::get('access_permit');
        if ($logged == false ) {
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        }
        



    }

    function index()
    {
        $this->view->GetGLMenulist =$this->model->GetGLMenulist();
        $this->view->GetAPMenulist =$this->model->GetAPMenulist();
        $this->view->GetARMenulist =$this->model->GetARMenulist();
        $this->view->GetPRMenulist =$this->model->GetPRMenulist();
        $this->view->GetINMenulist =$this->model->GetINMenulist();
        $this->view->GetSTMenulist =$this->model->GetSTMenulist(); 
        $this->view->GetDeliveryRefno =$this->model->GetDeliveryRefno();
        $this->view->GetDeliveryjref =$this->model->GetDeliveryjref();  
        $this->view->DeleteStockIn_Temp =$this->model->DeleteStockIn_Temp();
        $this->view->GetSupplierList =$this->model->GetSupplierList();              
        $this->view->GetItemList =$this->model->GetItemList();
        $this->view->render('stockin/index');
    }


    public function printdelivery($id)
    {
        //print_r($refno);
      $this->view->mydelivery =$this->model->printdelivery($id);
        $this->view->render('stockin/printdeliveryreport');

    }
    public function SaveDelivery()
    {
        $data=array();
        $data['deldate']=($_POST['deldate']);
        $data['trnno']=($_POST['trnno']);
        $data['supplierid']=($_POST['supplierid']);
        $data['supplier']=($_POST['supplier']);
        $data['deliveryno']=($_POST['deliveryno']);
        $data['posted']=($_POST['posted']);
        $data['period']=($_POST['period']);
        $data['amount']=($_POST['amount']);
        $data['currentuser']=($_POST['currentuser']);
        $data['tme']=($_POST['tme']);
        $this->model->SaveDelivery($data);
    }
    public function SaveDeliveryTemp()
    {
        $data=array();
        $data['qty']=($_POST['qty']);        
        $data['price']=($_POST['price']);
        $data['amount']=($_POST['amount']);
        $data['itemno']=($_POST['itemno']);
        $data['itemdesc']=($_POST['itemdesc']);
        $data['currentuser']=($_POST['currentuser']);
        $data['trnno']=($_POST['trnno']);
        $data['period']=($_POST['period']);
        $data['supplierid']=($_POST['supplierid']);
        $data['supplier']=($_POST['supplier']);
        $data['deliveryno']=($_POST['deliveryno']);
        $data['deldate']=($_POST['deldate']);
        $data['tme']=($_POST['tme']);                
        $this->model->SaveDeliveryTemp($data);
    }
}