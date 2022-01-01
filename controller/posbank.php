<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Posbank extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('posbank/js/default.js');

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
        $this->view->GetBanklist =$this->model->GetBanklist();     
        $this->view->GetAccountid =$this->model->GetAccountid();  
        $this->view->Getposbanklist =$this->model->Getposbanklist();            
        $this->view->render('posbank/index');
    }

     public function SaveBankpos()
    {
       $data=array();       
       $data['bank']=e($_POST['bank']);
       $data['posname']=e($_POST['posname']);       
       $data['acctno']=e($_POST['acctno']);
       $data['accountid']=e($_POST['accountid']);
       $this->model->SaveBankpos($data);
    }
}

?>