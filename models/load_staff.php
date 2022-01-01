<?php



$subid  = ($_POST['subid']); // to avoid  sql injection attack
$parentid  = ($_POST['parentid']); // to avoid  sql injection attack
$staffid  = ($_POST['staff']); // to avoid  sql injection attack

$host = 'localhost';
$user = 'gtwbunsl_power2pay';
$pass = 'Olabode@001';

mysql_connect($host, $user, $pass);

mysql_select_db('gtwbunsl_power2pay');
/*
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');
*/

$selectdata = "SELECT * FROM `tbl_staffrecord` WHERE tbl_staffrecord.staffid=$staffid AND tbl_staffrecord.parentid=$parentid AND tbl_staffrecord.subid=$subid ";
$query = mysql_query($selectdata);
$data=array();
while ($row =  mysql_fetch_assoc($query)) {
    $data[]=$row;
}
echo json_encode($data);

?>



