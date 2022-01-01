<?php



$vcode  = ($_POST['vartypecode']); // to avoid  sql injection attack
$parentid  = ($_POST['parentid']); // to avoid  sql injection attack

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

$selectdata = "SELECT * FROM `tbl_variationitemsetup` WHERE tbl_variationitemsetup.parentid=$parentid AND tbl_variationitemsetup.vartypecode LIKE '%$vcode%'";
$query = mysql_query($selectdata);

$courseOptions = '';
$courseOptions .= '<option value disabled selected>Select Pay Item</option>';
while ($row = mysql_fetch_array($query)) {
    $id=$row['vid'];
    $course=$row['abbr'];
    $courseOptions .= "<option value=$id>$course </option>";
}

echo json_encode([
    'courses' => $courseOptions,
]);




?>



