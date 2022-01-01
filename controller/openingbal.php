<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Openingbal extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('openingbal/js/default.js');

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
       $this->view->Getbanklist =$this->model->Getbanklist();
       $this->view->GetCustomerlist =$this->model->GetCustomerlist();       
       $this->view->GetGLlist =$this->model->GetGLlist();
        $this->view->render('openingbal/index');
    }
    public function saveopeningdebtors()
    {
        $data=array();
        $data['customerid']=$_POST['customerid'];
        $data['customers']=$_POST['customers'];
        $data['trndate']=$_POST['trndate'];
        $data['trnno']=$_POST['trnno'];
        $data['description']=$_POST['description'];
        $data['period']=$_POST['period'];
        $data['debit']=$_POST['debit'];
        $data['tme']=$_POST['tme'];
        $data['gllist']=$_POST['gllist'];
        $this->model->saveopeningdebtors($data);

        //customers:customers,trndate:trndate,trnno:trnno,description:description
    }
    public function saveopeningmoney()
    {
        $data=array();       
        $data['trndate']=$_POST['trndate'];
        $data['trnno']=$_POST['trnno'];
        $data['description']=$_POST['description'];
        $data['period']=$_POST['period'];
        $data['debit']=$_POST['debit'];
        $data['tme']=$_POST['tme'];
        $data['gllist']=$_POST['gllist'];
        $data['accountid']=$_POST['accountid'];
        $this->model->saveopeningmoney($data);
    }



}
