<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Glprofitandloss extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('glprofitandloss/js/default.js');

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
        $this->view->GetAccountperiodlist =$this->model->GetAccountperiodlist();
        $this->view->render('glprofitandloss/index');
    }

    public function printfile()
    {
        $data=array();
        $data['period']=$_POST['speriod'];
         $this->view->mypandl =$this->model->printfile($data);        
        $this->view->render('glprofitandloss/profitandlossacct');
    }

    







}
