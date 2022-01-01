<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 25/01/2017
 * Time: 08:42
 */
class Pinvoice extends Controller
{
    function __construct()
    {
        parent::__construct();
        Session::init();
         $this->view->js=array('pinvoice/js/default.js');
         $logged = Session::get('loggedIn');
        if ($logged == false) {
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
    	$this->view->GetSuppliers =$this->model->GetSuppliers();
    	$this->view->GetInvRefno =$this->model->GetInvRefno();    	
        $this->view->GetTempInvTedeleted =$this->model->GetTempInvTedeleted();
    	$this->view->GetGLAccount2Debit =$this->model->GetGLAccount2Debit();
        $this->view->render('pinvoice/index');
    }

    public function SaveInvoiceTemp()
    {
        $data=array();
        $data['amount']=($_POST['amount']);
        $data['accountid']=($_POST['accountid']);
        $data['gldescription']=($_POST['gldescription']);
        $data['currentuser']=($_POST['currentuser']);
         $this->model->SaveInvoiceTemp($data);
    }
    public function SaveInvoice()
    {
        $data=array();
        $data['trndate']=($_POST['trndate']);
        $data['trnno']=($_POST['trnno']);
        $data['accountid']=($_POST['accountid']);        
        $data['description']=($_POST['description']);
        $data['invno']=($_POST['invno']);
        $data['tme']=($_POST['tme']);
        $data['supplierid']=($_POST['supplierid']);
        $data['supplier']=($_POST['supplier']);        
        $data['amount']=($_POST['amount']);
        $data['currentuser']=($_POST['currentuser']);
        $data['period']=($_POST['period']);
       // $data['tamount']=$_POST['tamount'];
         $this->model->SaveInvoice($data);   
    }
}