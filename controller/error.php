<?php
class Error extends Controller{
    function __construct()
    {
        parent::__construct();

    }
    function index(){

            $this->view->msg='Page not exist';
            $this->view->render('error/index');
    }
}
