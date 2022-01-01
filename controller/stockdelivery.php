<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Stockdelivery extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('stockdelivery/js/default.js');

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
        $this->view->GetStockhead =$this->model->GetStockhead();
        $this->view->render('stockdelivery/index');
    }
    public function details($id)
    {
        $this->view->GetStockDelivered_Total =$this->model->GetDeliveredStock_total($id);
        $this->view->GetStockDelivered =$this->model->GetDeliveredStock($id);
        $this->view->render('stockdelivery/approvestock');
    }


    public function delete($id)
    {

        $this->model->deletehead($id);
       header('location: ' . URL . 'stockdelivery');
    }
    public function approveddelivery()
    {
        $data=array();
        $data['tme']=($_POST['deliverytrackno']);
        $this->model->approvedelivery($data);
        //$this->view->render('stockdelivery');
        header('location: ' . URL . 'stockdelivery');
    }







}
