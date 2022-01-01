<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 27/01/2017
 * Time: 02:22
 */
class Info extends Controller
{
    function __construct()
    {
        parent::__construct();

    }

    function index()
    {


        $this->view->render('jvs/index');
    }
}