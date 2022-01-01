<?php

/*

$glsubid  = ($_POST['subid']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');
*/
$glsubid  = ($_POST['subid']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'gtwbunsl_power2pay';
$pass = 'Olabode@001';
mysql_connect($host, $user, $pass);
mysql_select_db('gtwbunsl_power2pay');
$selectdata = "SELECT DISTINCT customerid,customers,SUM(debit-credit) as balance FROM `tbl_debtors` WHERE tbl_debtors.customerid=$glsubid GROUP BY customerid,customers";
$query = mysql_query($selectdata);
$data=array();
while ($row =  mysql_fetch_assoc($query)) {
    $data[]=$row;
}
echo json_encode($data);
?>

