<?php


class Variation extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('variation/js/default.js');

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
        $this->view->GetSalaryAllw =$this->model->GetSalaryAllw(); 
        $this->view->GetGLaccountlike020101 =$this->model->GetGLaccountlike020101();              
        $this->view->render('variation/index');
    }
}


?>