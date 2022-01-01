<?php
Class View{
    function __construct()
    {
        
    }
    public function render($name, $noinclude=false)
    {
        if ($noinclude==true)
        {
            require 'views/'. $name . '.php';
        }
        else
        {
            require 'views/header.php';
            require 'views/'. $name . '.php';
            require 'views/footer.php';
        }

    }
}