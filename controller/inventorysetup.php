<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:52
 */

class Inventorysetup extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('inventorysetup/js/default.js');
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

       $this->view->GetProductCategory =$this->model->GetProductCategory();
        $this->view->GetGLAccountIDInventory =$this->model->GetGLAccountIDInventory();
        $this->view->GetGLAccountIDSales =$this->model->GetGLAccountIDSales();
        $this->view->GetProductClass =$this->model->GetProductClass();
        $this->view->render('inventorysetup/index');
    }


    public function printproductlist()
    {
        $this->view->GetMyProductList =$this->model->GetMyProductList();
        $this->view->render('inventorysetup/printmyproductlist');
    }
    public function printcustomers()
    {
        $this->view->GetMyCustomers =$this->model->GetMyCustomers();
        $this->view->render('inventorysetup/printcustomerlist');
    }

    public function printsuppliers()
    {
        $this->view->GetMySuppliers =$this->model->GetMySuppliers();
        $this->view->render('inventorysetup/printdeliveryreport');
    }
    public function SaveCustomer()
    {
        $data=array();
        $data['customername']=e($_POST['customername']);
        $data['address']=e($_POST['address']);
        $data['mobileno']=e($_POST['mobileno']);
        $data['parentid']=e($_POST['parentid']);
        $data['subid']=e($_POST['subid']);
        $this->model->SaveCustomer($data);
    }

    public function SaveSupplier()
    {
        $data=array();
        $data['supplier']=e($_POST['supplier']);
        $data['address']=e($_POST['address']);
        $data['contact_person']=e($_POST['contact_person']);
        $data['phone_number']=e($_POST['phone_number']);
        $data['email']=e($_POST['email']);
        $data['parentid']=e($_POST['parentid']);
        $data['subid']=e($_POST['subid']);
        $this->model->SaveSupplier($data);
    }
    public function SaveProductList()
    {
        $data=array();
        $data['pid']=e($_POST['pid']);
        $data['pname']=e($_POST['pname']);
        $data['pclass']=e($_POST['pclass']);
        $data['glsales']=e($_POST['glsales']);
        $data['glinventory']=e($_POST['glinventory']);
        $data['parentid']=e($_POST['parentid']);
        $data['subid']=e($_POST['subid']);
        $this->model->SaveProductList($data);
    }
    public function SaveProductCategory()
    {
        $data=array();
        $data['description']=e($_POST['description']);
        $data['parentid']=e($_POST['parentid']);
        $data['subid']=e($_POST['subid']);
        $this->model->SaveProductCategory($data);

    }
    public function SaveProductClass()
    {
        $data=array();
        $data['category']=e($_POST['category']);
        $data['pclass']=e($_POST['pclass']);
        $this->model->SaveProductClass($data);
    }





}
