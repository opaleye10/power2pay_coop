<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Aheadreport extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('aheadreport/js/default.js');

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
        $this->view->GetAccountperiodlist =$this->model->GetAccountperiodlist();
        $this->view->GetGLAccountHead =$this->model->GetGLAccountHead();
        $this->view->render('aheadreport/index');
    }

    
    public function editacctyr($id)
    {
        $this->view->GetAcctYr =$this->model->GetAcctYr($id);
        $this->view->render('acctyr/editacctyr');
    }
    public function detailsdaterange()
    {
         if(isset($_POST['dfrom']) && isset($_POST['dto']) && isset($_POST['glaccount'])) 
            
        {
           $data=array();
            $data['from']=$_POST['dfrom'];        
            $data['to']=$_POST['dto']; 
            $data['head']=$_POST['glaccount'];
           $this->view->detailsdaterange =$this->model->detailsdaterange($data);
           $this->view->render('aheadreport/printdetailsreport');
        }
        else
        {
            echo "<script type='text/javascript'>

            alert('Please select a appropriate date range and detail');

            window.location.replace('https://app.power2pay.com.ng/aheadreport');

            </script>";
            
        }
    }







}
