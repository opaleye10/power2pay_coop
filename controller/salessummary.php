<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Salessummary extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('salessummary/js/default.js');

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
        //$this->view->GetAccountperiodlist =$this->model->GetAccountperiodlist();
        $this->view->render('salessummary/index');
    }


    

     public function dailysalessummary()
    {



        if(isset($_POST['mainid']) && $_POST['mainid'] != "") 
        {
           $data=array();
            $data['mydate']=$_POST['mainid'];        
           $this->view->myrecord =$this->model->dailysalessummary($data);
            $this->view->render('salessummary/dailysalessummary');
        }
        else
        {
            echo "<script type='text/javascript'>

            alert('Please select a date for sales summary report');

            window.location.replace('https://app.power2pay.com.ng/salessummary');

            </script>";
            
        }
       

    }

   
}
