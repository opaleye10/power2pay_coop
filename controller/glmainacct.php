<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Glmainacct extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('glmainacct/js/default.js');
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
        $this->view->getglAcct =$this->model->getglAcct();
        $this->view->GetGlsubAcctintable =$this->model->GetGlsubAcctintable();
        $this->view->render('glmainacct/index');
    }
    public function SaveGLSubhead()
    {
        $data=array();
        $data['mainid']=$_POST['mainid'];
        $data['subid']=$_POST['subid'];
        $data['sub_desc']=$_POST['sub_desc'];
        $this->model->SaveGLSubhead($data);
    }
    public function GetGLHeald()
    {
       $data=array();
       $data['mainid']=$_POST['mainid'];
        $this->model->GetGLHeald($data);

    }

}
