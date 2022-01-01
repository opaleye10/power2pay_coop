<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Bankschedule extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('bankschedule/js/default.js');

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
        $this->view->render('bankschedule/index');
    }
    public function displaybankschedule()
    {
         $data=array();
        $data['period']=($_POST['period']);
       // print_r($data);        
        $this->view->displaybankschedule =$this->model->displaybankschedule($data);
      $this->view->render('bankschedule/displaybankschedule');
    }
    






}
