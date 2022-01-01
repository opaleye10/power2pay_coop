<?php

class Login extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        //before login, this code will search if there are already login Member and redirect to dashboard

    }
    function index(){
        //echo  Hash::create('SHA256','oros12345',HASH_KEY);

            $this->view->render('login/index');

    }
    function permit(){
        $data=array();
       // $data['login']= mysql_real_escape_string($_POST['_login_name']);
        //$data['password']= mysql_real_escape_string($_POST['_login_password']);

        $data['login']= e($_POST['_login_name']);
        $data['password']= e($_POST['_login_password']);
        //print_r($data);
        $this->model->permit($data);
    }




    function logout()
    {
        Session::destroy();
        header('location: ../login');
    }


}