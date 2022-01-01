<?php

class Index extends Controller{
  public  function __construct()
    {
       parent::__construct();       
        $this->view->js=array('index/js/default.js');        
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        }
       // $logged = Session::get('loggedIn');
       // if ($logged == false) {
         //   Session::destroy();
          //  header('location: ' . URL . 'login');
           // exit;
       // }

        
    }

 public   function index(){
     $this->view->GetGLMenulist =$this->model->GetGLMenulist();
        $this->view->GetAPMenulist =$this->model->GetAPMenulist();
        $this->view->GetARMenulist =$this->model->GetARMenulist();
        $this->view->GetPRMenulist =$this->model->GetPRMenulist();
        $this->view->GetINMenulist =$this->model->GetINMenulist();
        $this->view->GetSTMenulist =$this->model->GetSTMenulist(); 
     $this->view->render('index/index');
     //exit;
       //$this->view->msg1='Ok ooooo, This is an example';
   }
   


}