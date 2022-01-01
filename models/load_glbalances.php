<?php



$accountid  = ($_POST['accountid']); // to avoid  sql injection attack
$subid  = ($_POST['subid']); // to avoid  sql injection attack
$parentid  = ($_POST['parentid']); // to avoid  sql injection attack
$period  = ($_POST['period']); // to avoid  sql injection attack
/*
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);
mysql_select_db('account_power2pay');

*/

$host = 'localhost';
$user = 'gtwbunsl_power2pay';
$pass = 'Olabode@001';

mysql_connect($host, $user, $pass);

mysql_select_db('gtwbunsl_power2pay');


$selectdata = "SELECT DISTINCT SUM(debit-credit) as balance FROM `tbl_banktransaction` WHERE tbl_banktransaction.accountid=$accountid AND tbl_banktransaction.period=$period AND tbl_banktransaction.parentid=$parentid AND tbl_banktransaction.subid=$subid";
$query = mysql_query($selectdata);
$data=array();
while ($row =  mysql_fetch_assoc($query)) {
    $data[]=$row;
}
echo json_encode($data);

?>

