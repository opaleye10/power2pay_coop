<?php
class Bootstrap{
    function __construct()
    {
        /**
         * get the url and assign it to url variable
         */
        $url= isset($_GET['url'])? $_GET['url']:null;
        $url= rtrim($url,'/');
        $url= explode('/', $url);
        //print_r($url);

        if(empty($url[0])){
            require 'controller/index.php';
            $controllers=new Index();
            $controllers->index();
            return false;
        }

        $file= 'controller/'. $url[0] . '.php';
        if (file_exists($file)){
            require $file;
        } else
        {
            require 'controller/error.php';
            $controllers = new Error();
            return false;
        }
        $controllers = new $url[0];
        $controllers->loadModel($url[0]);
        //calling method area;

        if(isset($url[2])){
            if(method_exists($controllers,$url[1])){
                $controllers->{$url[1]}($url[2]);
            }
            else
            {
                $this->error();
            }

        }
        else
        {
            if(isset($url[1])){
                if(method_exists($controllers,$url[1])){
                    $controllers->{$url[1]}();
                }
                else
                {
                    $this->error();
                }

            }
            else
            {
                $controllers->index();
            }
        }

    }
    function  error(){
        require 'controller/error.php';
        $controller =new Error();
        $controller->index();
        return false;
    }
}

?>