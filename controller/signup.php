<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 25/01/2017
 * Time: 01:03
 */
class Signup extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->js=array('signup/js/default.js');
        Session::init();
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
    	$this->view->GetStafflist =$this->model->GetStafflist();
        $this->view->GetRolelist =$this->model->GetRolelist();
        $this->view->GetRegisteredUsers =$this->model->GetRegisteredUsers();
            $this->view->render('signup/index');
    }
    public function createuser()
    {
        $data=array();
        $data['parentid']=($_POST['parentid']);
        $data['subid']=($_POST['subid']);
        $data['roleid']=($_POST['roleid']);
        $data['staffid']=($_POST['staffid']);
        $data['username']=($_POST['username']);
        $data['password']=($_POST['password']);
        $data['logintype']=($_POST['logintype']);
        $data['mstatus']=($_POST['mstatus']);
        $this->model->createuser($data);

    }

}