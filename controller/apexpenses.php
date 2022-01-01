<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Apexpenses extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('apexpenses/js/default.js');

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
      // $this->view->Getbanklist =$this->model->Getbanklist();
       //$this->view->GetCustomerlist =$this->model->GetCustomerlist();       
       $this->view->GetPeriod =$this->model->GetPeriod();
        $this->view->render('apexpenses/index');
    }

    public function expenseallperiod()
    {
         if(isset($_POST['speriod'])) 

  //Do my PHP code
 
        {
           $data=array();
            $data['period']=$_POST['speriod'];
           $this->view->expenseallperiod =$this->model->expenseallperiod($data);
           $this->view->render('apexpenses/printallexpensesreport');
        }
        else
        {
            echo "<script type='text/javascript'>

            alert('Please select a delivery detail');

            window.location.replace('https://app.power2pay.com.ng/apexpenses');

            </script>";
            
        }
    }
    public function expensesdaterange()
    {

        if(isset($_POST['dfrom']) && isset($_POST['dto'])) 

  //Do my PHP code
 
        {
           $data=array();
            $data['from']=$_POST['dfrom'];        
            $data['to']=$_POST['dto']; 
           $this->view->expensesdaterange =$this->model->expensesdaterange($data);
           $this->view->render('apexpenses/printexpensesreport');
        }
        else
        {
            echo "<script type='text/javascript'>

            alert('Please select a delivery detail');

            window.location.replace('https://app.power2pay.com.ng/apexpenses');

            </script>";
            
        }

    }
   



}
