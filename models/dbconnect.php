<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "account_power2pay";
/*
$servername = "localhost";
$username = "gtwbunsl_power2pay";
$password = "Olabode@001";
$dbname = "gtwbunsl_power2pay";
*/

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

