<?php
class Stockbalance extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('stockbalance/js/default.js');

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
        $this->view->render('stockbalance/index');
    }


    public function printstockbalance()
    {
        $data=array();
        $data['ddate']=($_POST['dfrom']);
        $this->view->printstockbalance =$this->model->printstockbalance($data);
        $this->view->render('stockbalance/printstockbalance');
    }
}

?>