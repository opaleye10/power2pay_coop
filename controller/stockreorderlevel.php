<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Stockreorderlevel extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('stockreorderlevel/js/default.js');

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
        $this->view->GetItemlist =$this->model->GetItemlist();
        $this->view->GetReorderlevelitems =$this->model->GetReorderlevelitems();
        $this->view->render('stockreorderlevel/index');
    }
    public function savereorderlevel()
    {
        $data=array();
        $data['pid']=($_POST['pid']);
        $data['product']=($_POST['product']);
       $data['qty']=($_POST['qty']);
       $data['currentuser']=($_POST['currentuser']);
       $data['parentid']=($_POST['parentid']);
       $data['subid']=($_POST['subid']);
       $this->model->savereorderlevel($data);
    }

  





}
