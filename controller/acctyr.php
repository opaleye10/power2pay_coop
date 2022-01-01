<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Acctyr extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('acctyr/js/default.js');

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
        $this->view->render('acctyr/index');
    }

    public function SaveAccountingPeriod()
    {
        $data=array();
        $data['startdate']=$_POST['startdate'];
        $data['enddate']=$_POST['enddate'];
        $data['yr']=$_POST['yr'];
        $data['astatus']=$_POST['astatus'];
        $this->model->SaveAccountingPeriod($data);
    }
    public function editacctyr($id)
    {
        $this->view->GetAcctYr =$this->model->GetAcctYr($id);
        $this->view->render('acctyr/editacctyr');
    }
    public function edit()
    {
        $data=array();
        $data['astatus']=$_POST['astatus'];
        $data['id']=$_POST['myid'];
        $this->model->EditAcctPeriod($data);
        header('location:'.URL .'acctyr');

    }







}
