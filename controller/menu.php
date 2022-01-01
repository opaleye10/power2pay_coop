<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:01
 */
class Menu extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->js = array('menu/js/default.js');
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        }

    }

    function index()
    {
        $this->view->GetGLMenulist =$this->model->GetGLMenulist();
        $this->view->GetAPMenulist =$this->model->GetAPMenulist();
        $this->view->GetARMenulist =$this->model->GetARMenulist();
        $this->view->GetPRMenulist =$this->model->GetPRMenulist();
        $this->view->GetINMenulist =$this->model->GetINMenulist();
        $this->view->GetSTMenulist =$this->model->GetSTMenulist(); 
        $this->view->GetAppRoleList =$this->model->GetAppRoleList();
        $this->view->GetMenuHead =$this->model->GetMenuHead();        
        $this->view->render('menu/index');
    }

    public function addappmenu()
    {
        $data=array();
        $data['parentid']=e($_POST['parentid']);
        $data['subid']=e($_POST['subid']);
        $data['roleid']=e($_POST['roleid']);
        $data['rolename']=e($_POST['rolename']);
        $data['parentmenu']=e($_POST['parentmenu']);
        $data['parentmenudesc']=e($_POST['parentmenudesc']);
        $data['submenu']=e($_POST['submenu']);
        $data['submenudesc']=e($_POST['submenudesc']);
        $data['currentuser']=e($_POST['currentuser']);
        $this->model->addappmenu($data);

    }


}