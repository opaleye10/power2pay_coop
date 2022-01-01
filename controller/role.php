<?php
class Role extends Controller
{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('role/js/default.js');
        //before login, this code will search if there are already login Member and redirect to dashboard
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
        $this->view->GetRolelist =$this->model->GetRolelist();
        $this->view->render('role/index');

    }

    public function SaveRole()
    {
        $data=array();
        $data['parentid']=$_POST['parentid'];
        $data['subid']=$_POST['subid'];
        $data['rolename']=$_POST['rolename'];
        $data['roledesc']=$_POST['roledesc'];
        $data['currentuser']=$_POST['currentuser'];
        $data['ddate']=$_POST['ddate'];
        $this->model->SaveRole($data);

    }
}
