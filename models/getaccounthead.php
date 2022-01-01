<?php



$glid  = ($_POST['mainid']); // to avoid  sql injection attack
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

$selectdata = "SELECT * FROM tbl_gl_subaccount WHERE tbl_gl_subaccount.mainid = $glid";
$query = mysql_query($selectdata);
$data=array();
while ($row =  mysql_fetch_assoc($query)) {
    $data[] =$row;

}

echo json_encode($data);
//echo json_encode($data);
?>

