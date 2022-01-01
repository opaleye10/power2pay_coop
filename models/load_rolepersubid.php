<?php



$glsubid = ($_POST['subid']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');

$selectdata="SELECT * FROM `tbl_role` WHERE tbl_role.subid LIKE '%$glsubid%'";
$query = mysql_query($selectdata);
$data=array();
while ($row=mysql_fetch_assoc($query)) {
    $data[]=$row;
}

echo json_encode($data);

?>

