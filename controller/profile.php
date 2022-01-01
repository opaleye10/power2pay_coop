<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Profile extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('profile/js/default.js');
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

        $this->view->GetCompanyProfile =$this->model->GetCompanyProfile();
        $this->view->render('profile/index');
    }
    public function SaveProfile()
    {
        $data=array();
        $data['companyname']=e($_POST['companyname']);
        $data['companyadd']=e($_POST['companyaddress']);
        $data['companymobile']=e($_POST['companymobile']);
        $this->model->SaveProfile($data);
    }

}
