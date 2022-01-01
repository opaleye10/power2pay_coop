<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Variationitems extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('variationitems/js/default.js');

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
       $this->view->glaccount =$this->model->glaccount();
        $this->view->render('variationitems/index');
    }
    public function savevariationitems()
    {
        $data=array();
        $data['vid']=$_POST['vid'];
        $data['variation']=$_POST['variation'];
        $data['vartype']=$_POST['vartype'];
        $data['vartypecode']=$_POST['vartypecode'];
        $data['accountid']=$_POST['accountid'];
        $data['abbr']=$_POST['abbr'];
        $data['shows']=$_POST['shows'];
        $this->model->savevariationitems($data);
    }

   
}
