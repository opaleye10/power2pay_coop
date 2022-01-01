<?php
//use auto loader later
require "libss/Bootstrap.php";
require "libss/ControllerBase.php";
require "libss/Model.php";
require "libss/View.php";
//Library requre
require 'libss/Session.php';
require 'libss/Hash.php';
require 'libss/database.php';
require 'libss/PostRequest.php';


//require 'libss/Database.php';
//configuration require
require "config/paths.php";
require "config/database.php";
require "config/constants.php";
require "config/voidxssattack.php";
require "config/captcha.php";
$app=new Bootstrap();
?>
