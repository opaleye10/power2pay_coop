<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Inreports extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('inreports/js/default.js');

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
        //$this->view->Getfirms =$this->model->Getfirms();        
        $this->view->GetDelivery =$this->model->GetDelivery();
        $this->view->render('inreports/index');
    }


    public function printdelivery()
    {



        if(isset($_POST['mainid']) && $_POST['mainid'] != "") 

  //Do my PHP code
 
        {
           $data=array();
            $data['id']=$_POST['mainid'];        
           $this->view->mydelivery =$this->model->printdelivery($data);
            $this->view->render('inreports/printdeliveryreport');
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
