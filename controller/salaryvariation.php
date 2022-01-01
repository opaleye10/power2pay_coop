<?php

class Salaryvariation extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('salaryvariation/js/default.js');

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
        $this->view->render('salaryvariation/index');
    }
    public function inddelete()
    {
        $data=array();        
        $data['vid']=$_POST['vid'];
        $data['staffid']=$_POST['staffid'];        
        $this->model->inddelete($data);
    }
    public function indvarsave()
    {
        $data=array();        
        $data['vid']=$_POST['vid'];
        $data['abbr']=$_POST['abbr'];
        $data['vartype']=$_POST['vartype'];
        $data['staffid']=$_POST['staffid'];
        $data['frqno']=$_POST['frqno'];
        $data['amount']=$_POST['amount'];
        $this->model->indvarsave($data);
    }

    public function displaypays()
    {
        $data=array();                
        $data['staffid']=$_POST['staffid'];        
        $this->model->displaypays($data);
    }

    public function displaydeductions()
    {
        $data=array();                
        $data['staffid']=$_POST['staffid'];        
        $this->model->displaydeductions($data);
    }

}

?>