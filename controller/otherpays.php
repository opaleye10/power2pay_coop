<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Otherpays extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('otherpays/js/default.js');

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
        $this->view->GetAssetExpenses =$this->model->GetAssetExpenses();
        $this->view->GetAccountid =$this->model->GetAccountid();  
        $this->view->GetInvRefno =$this->model->GetInvRefno();                
        $this->view->render('otherpays/index');
    }
    public function savexpenses()
    {
        $data=array();
        $data['trndate']=$_POST['trndate'];
        $data['trnno']=$_POST['trnno'];
        $data['tme']=$_POST['tme'];
        $data['refno']=$_POST['refno'];
        $data['amount']=$_POST['amount'];
        $data['acct2credit']=$_POST['acct2credit'];
        $data['acct2debit']=$_POST['acct2debit'];
        $data['description']=$_POST['description'];
        $this->model->savexpenses($data);
        

         
    }







}
