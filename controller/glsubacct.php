<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Glsubacct extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('glsubacct/js/default.js');
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

        $this->view->GetGlAcct =$this->model->GetGlAcct();
        $this->view->GetGlAcctsubdetails =$this->model->GetGlAcctsubdetails();
        $this->view->render('glsubacct/index');
    }
    public function SaveSubClass()
    {
        $data=array();
        $data['mainid']=$_POST['mainid'];
        $data['subid']=$_POST['subid'];
        $data['subclassid']=$_POST['subclassid'];
        $data['descristion']=$_POST['descristion'];
        $this->model->SaveSubClass($data);
    }


    

}
