<?php


class Banks extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('banks/js/default.js');

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
        $this->view->render('banks/index');
    }

    public function SaveBanks()
    {
       $data=array();
       $data['bank']=e($_POST['bank']);
       $data['branch']=e($_POST['branch']);
       $data['acctno']=e($_POST['acctno']);
       $data['accountid']=e($_POST['accountid']);
       $this->model->SaveBanks($data);
    }
}