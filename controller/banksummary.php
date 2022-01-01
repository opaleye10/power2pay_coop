<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Banksummary extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('banksummary/js/default.js');

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
        $this->view->GetPeriodList =$this->model->GetPeriodList();
        $this->view->render('banksummary/index');
    }
    public function displaybanksummary()
    {
        $data=array();
        $data['period']=($_POST['period']);
       // print_r($data);        
        $this->view->displaysummary =$this->model->displaysummary($data);
      $this->view->render('banksummary/displaysummary');
    }
   




}
