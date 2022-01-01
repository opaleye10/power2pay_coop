<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Jvs extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('jvs/js/default.js');

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
        $this->view->GetJournallist =$this->model->GetJournallist();
        $this->view->render('jvs/index');
    }

    public function details($id)
    {
        $this->view->GetBankTransactionRecord =$this->model->GetBankTransactionRecord($id);
        $this->view->render('jvs/detailpage');
    }
}