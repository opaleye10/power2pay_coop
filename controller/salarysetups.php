<?php

/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Salarysetups extends Controller
{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js = array('salarysetups/js/default.js');

        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        }
    }

    function index()
    {
        $this->view->GetGLMenulist =$this->model->GetGLMenulist();
        $this->view->GetAPMenulist =$this->model->GetAPMenulist();
        $this->view->GetARMenulist =$this->model->GetARMenulist();
        $this->view->GetPRMenulist =$this->model->GetPRMenulist();
        $this->view->GetINMenulist =$this->model->GetINMenulist();
        $this->view->GetSTMenulist =$this->model->GetSTMenulist(); 
        $this->view->GetSalaryCagetory =$this->model->GetSalaryCagetory();
        $this->view->GetSalaryDept =$this->model->GetSalaryDept();
        $this->view->GetSalaryBank = $this->model->GetSalaryBank();
        $this->view->GetSalaryGL = $this->model->GetSalaryGL();
        $this->view->GetSalaryGN = $this->model->GetSalaryGN();
        $this->view->GetSalaryUnion = $this->model->GetSalaryUnion();
        $this->view->GetSalaryAllws = $this->model->GetSalaryAllws();
        $this->view->render('salarysetups/index');
    }

    public function editgn($id)
    {
     $data=array();
        $data['id']=$id;
        $this->model->editgn($data);
         header('location: ' . URL . 'salarysetups');   
    }
    public function editthisrecord($id)
    {
        $data=array();
        $data['id']=$id;
        $this->model->editthisrecord($data);
         header('location: ' . URL . 'salarysetups');
    }    
public function editdept($id)
    {
        $data=array();
        $data['id']=$id;
        $this->model->editdept($data);
         header('location: ' . URL . 'salarysetups');
    }  

    public function deleteallwbyid($id)
    {
        $data=array();
        $data['id']=$id;
        $this->model->deleteallwbyid($data);
         header('location: ' . URL . 'salarysetups');
    }
    public function deletegn($id)
    {
        $data=array();
        $data['id']=$id;
        $this->model->deletegn($data);
         header('location: ' . URL . 'salarysetups');
    }
    public function deletedept($id)
    {
        $data=array();
        $data['id']=$id;
        $this->model->deletedept($data);
         header('location: ' . URL . 'salarysetups');


    }
    public function deleteunion($id)
    {
        $data=array();
        $data['id']=$id;
        $this->model->deleteunion($data);
         header('location: ' . URL . 'salarysetups');
    }
    public function deletethisrecord($id)
    {
        $data=array();
        $data['id']=$id;
        $this->model->deletethisrecord($data);
         header('location: ' . URL . 'salarysetups');


    }
    public function deletebank($id)
    {
        $data=array();
        $data['id']=$id;
        $this->model->deletebank($data);
         header('location: ' . URL . 'salarysetups');
    }


    public function SaveCategory()
    {
        $data=array();
        $data['category']=$_POST['category'];
        $data['astatus']=$_POST['astatus'];
        $this->model->SaveCategory($data);
    }

    public function SaveDepartment()
    {
        $data=array();
        $data['dept']=$_POST['dept'];
        $data['astatus']=$_POST['astatus'];
        $this->model->SaveDepartment($data);
    }

public function saveallw()
    {
        $data=array();
        $data['allwdesc']=$_POST['allwdesc'];               
        $this->model->saveallw($data);
    }



public function saveunionlist()
    {
        $data=array();
        $data['salunion']=$_POST['salunion'];       
        $data['bankunion']=$_POST['bankunion']; 
        $data['acctno']=$_POST['acctno']; 
        $this->model->saveunionlist($data);
    }

 public function SaveBank()
    {
        $data=array();
        $data['bank']=$_POST['bank'];       
        $this->model->SaveBank($data);
    }

public function SaveGradeName()
    {
        $data=array();
        $data['gradename']=$_POST['gradename'];       
        $data['abbr']=$_POST['abbr'];       
        $data['astatus']=$_POST['astatus'];       
        $this->model->SaveGradeName($data);
    }
}
