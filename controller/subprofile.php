<?php

class Subprofile extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('subprofile/js/default.js');

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
        $this->view->GetMainCompany =$this->model->GetMainCompany();
        $this->view->render('subprofile/index');
    }
    public function SaveSubProfile()
    {
        $data=array();
        $data['parentid']=$_POST['parentid'];
        $data['subfirm']=$_POST['subfirm'];
        $data['contact']=$_POST['contact'];
        $this->model->SaveSubProfile($data);

    }
}