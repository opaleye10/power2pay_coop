<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Sacctcode extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('sacctcode/js/default.js');

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
        $this->view->GetAccountlist =$this->model->GetAccountlist();
        $this->view->loadcode =$this->model->loadcode();
        
        $this->view->render('sacctcode/index');
    }



public function savedeliverycode()
    {
        $data=array();
        $data['delivery']=$_POST['delivery'];
        $this->model->savedeliverycode($data);
    }




    
    public function Saveinventorycode()
    {
        $data=array();
        $data['inventory']=$_POST['inventory'];
        $this->model->Saveinventorycode($data);
    }

public function Savecogscode()
    {
        $data=array();
        $data['cogs']=$_POST['cogs'];
        $this->model->Savecogscode($data);
    }


    public function Savesalescode()
    {
        $data=array();
        $data['sales']=$_POST['sales'];
        $this->model->Savesalescode($data);
    }
    public function Savedebtorcode()
    {
        $data=array();
        $data['debtor']=$_POST['debtor'];
        $this->model->Savedebtorcode($data);
    }
    public function Savecashcode()
    {
         $data=array();
        $data['cash']=$_POST['cash'];
        $this->model->Savecashcode($data);
    }
    public function Savecreditorcode()
    {
         $data=array();
        $data['creditor']=$_POST['creditor'];
        $this->model->Savecreditorcode($data);
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
