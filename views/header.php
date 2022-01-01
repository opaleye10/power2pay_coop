<!DOCTYPE HTML>
<html>
<head>
    <title>Power2pay: Financial Web Application ver. 1.0  | </title>
    <link rel="icon"  type="public/images/logo.png" href="public/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link rel="stylesheet"  href="<?php echo URL; ?>public/css/bootstrap.min.css" type="text/css" media="all"/>

    <!-- Custom Theme files -->
    <link rel="stylesheet"  href="<?php echo URL; ?>public/css/style.css" type="text/css" media="all"/>
    <link rel="stylesheet"  href="<?php echo URL; ?>public/css/font-awesome.css" type="text/css" media="all"/>

    <script  type="text/javascript" src="<?php echo URL; ?>public/js/jquery.min.js"></script>
    <script  type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
    <!-- Table -->
    <link rel="stylesheet"  href="<?php echo URL; ?>public/css/table.css" type="text/css" media="all"/>

    <!-- Custom Theme files -->


    <!-- Mainly scripts -->
    <script src="<?php echo URL; ?>public/js/jquery.metisMenu.js"></script>
    <script src="<?php echo URL; ?>public/js/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <link href="<?php echo URL; ?>public/css/custom.css" rel="stylesheet">
    <script src="<?php echo URL; ?>public/js/custom.js"></script>
    <script src="<?php echo URL; ?>public/js/screenfull.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>


    <script>
        $(function () {
            $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

            if (!screenfull.enabled) {
                return false;
            }

            $('#toggle').click(function () {
                screenfull.toggle($('#container')[0]);
            });
        });
    </script>
    <!--skycons-icons-->
    <script src="<?php echo URL; ?>public/js/skycons.js"></script>
    <script src="<?php echo URL; ?>public/js/notify.min.js"></script>



    <?php

    if (isset($this->js))
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
        }
    }
    ?>



</head>

<body style="background-image: url("finance/account/public/images/Power2PaybackgroundNEW.jpg"); background-repeat: no-repeat; ">

<?php Session::init();
//header
//08103627869
?>

<!-- banner -->

    