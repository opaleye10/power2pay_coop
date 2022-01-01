<?php

class Changepwd extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('changepwd/js/default.js');

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
        $this->view->render('changepwd/index');
    }

    public function searchpwd()
    {
        $data=array();
        $data['pwd']=$_POST['old_password'];
        $this->model->searchpwd($data);

    }
    public function changeidcode()
    {
        if(isset($_POST['oldpass']) && isset($_POST['newpass']))   //Do my PHP code
 
        {
           $data=array();
            $data['oldpass']=$_POST['oldpass'];        
            $data['newpass']=$_POST['newpass']; 
            $data['cnewpass']=$_POST['cnewpass']; 
           $this->model->changeidcode($data);
           //$this->view->render('apexpenses/printexpensesreport');
        }
        else
        {
            echo "<script type='text/javascript'>

            alert('Please select a delivery detail');

            window.location.replace('https://app.power2pay.com.ng/changepwd');

            </script>";
            
        }
    }
}

?>