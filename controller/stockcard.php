<?php

class Stockcard extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('stockcard/js/default.js');

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
        $this->view->GetProductList =$this->model->GetProductList();
        $this->view->render('stockcard/index');
    }


    public function printstockhistory()
    {

        if(isset($_POST['dfrom']) && isset($_POST['dto'])) 

  //Do my PHP code
 
        {
                   $data=array();
                $data['from']=($_POST['dfrom']);
                $data['to']=($_POST['dto']);
                $data['id']=($_POST['mainid']);
              // print_r($data);

                $this->view->printstockhistory =$this->model->printstockhistory($data);
              $this->view->render('stockcard/printstockcard');
        
        }
        else
        {
            echo "<script type='text/javascript'>

            alert('Please select a stock detail with date range');

            window.location.replace('https://app.power2pay.com.ng/stockcard');

            </script>";
            
        }







        
       
    }
   
}

?>