<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Salaryinfo extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('salaryinfo/js/default.js');
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
        
        $this->view->GetSalaryBank =$this->model->GetSalaryBank();

        $this->view->render('salaryinfo/index');
    }

    public function saverecord()
    {
       $data=array();
       $data['staffid']=$_POST['staffid'];
       $data['firstname']=$_POST['fname'];
       $data['middlename']=$_POST['mname'];
       $data['lastname']=$_POST['lname'];
       $data['sex']=$_POST['sex'];
       $data['phonenumber']=$_POST['phonenumber'];
       $data['contactaddress']=$_POST['contactaddress'];
       $data['email']=$_POST['email'];
       $data['title']=$_POST['title'];
       $data['mstatus']=$_POST['mstatus'];
       $data['religion']=$_POST['religion'];
       $data['employment']=$_POST['employment'];
       $data['deptpost']=$_POST['deptpost'];
       $data['bank']=$_POST['bank'];
       $data['acctno']=$_POST['acctno'];
        $this->model->saverecord($data);
    }




}
