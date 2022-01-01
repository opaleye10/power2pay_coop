<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 26/02/2017
 * Time: 10:49
 */
class Glacctdetails extends Controller
{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        }
        $this->view->js=array('glacctdetails/js/default.js');

    }

    function index()
    {
        $this->view->GetGLMenulist =$this->model->GetGLMenulist();
        $this->view->GetAPMenulist =$this->model->GetAPMenulist();
        $this->view->GetARMenulist =$this->model->GetARMenulist();
        $this->view->GetPRMenulist =$this->model->GetPRMenulist();
        $this->view->GetINMenulist =$this->model->GetINMenulist();
        $this->view->GetSTMenulist =$this->model->GetSTMenulist(); 
        $this->view->GetGlAcct =$this->model->GetGlAcct();
        $this->view->render('glacctdetails/index');
    }
    public function SaveAccountid()
    {
        $data=array();
        $data['mainid']=$_POST['mainid'];
        $data['subid']=$_POST['subid'];
        $data['subclassid']=$_POST['subclassid'];
        $data['accountid']=$_POST['accountid'];
        $data['gldescription']=$_POST['gldescription'];
        $this->model->SaveAccountid($data);
    }

}