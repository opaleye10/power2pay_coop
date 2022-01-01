<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Ar_sdr extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('ar_sdr/js/default.js');

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
        $this->view->Getpos =$this->model->Getpos();
        //$this->view->GetAccountperiodlist =$this->model->GetAccountperiodlist();
        $this->view->render('ar_sdr/index');
    }



   

     public function printreceipt()
    {



        if(isset($_POST['mainid']) && $_POST['mainid'] != "") 
        {
           $data=array();
            $data['id']=$_POST['mainid'];        
           $this->view->myreceipt =$this->model->printreceipt($data);
            $this->view->render('ar_sdr/printreceipt');
        }
        else
        {
            echo "<script type='text/javascript'>

            alert('Please select a delivery detail');

            window.location.replace('https://app.power2pay.com.ng/inreports');

            </script>";
            
        }
       

    }

    



}
