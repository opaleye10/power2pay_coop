<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Maxcreditlevel extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('maxcreditlevel/js/default.js');

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
        $this->view->GetAccountlist =$this->model->GetAccountlist();
        $this->view->loaddebtorslist =$this->model->loaddebtorslist(); 
        $this->view->loadmaxcreditlist =$this->model->loadmaxcreditlist(); 
        $this->view->render('maxcreditlevel/index');
    }
    public function savemcl()
    {        
        $data=array();
        $data['cid']=$_POST['cid'];
        $data['mcl']=$_POST['mcl'];
        $data['customers']=$_POST['customers'];
        $data['parentid']=$_POST['parentid'];
        $data['subid']=$_POST['subid'];
        $this->model->savemcl($data);
    }
    public function updatelosv()
    {
        $data=array();
        $data['cid']=$_POST['cid'];
        $data['mcl']=$_POST['mcl'];
        $data['customers']=$_POST['customers'];
        $data['parentid']=$_POST['parentid'];
        $data['subid']=$_POST['subid'];
        $this->model->updatelosv($data);
    }








}
