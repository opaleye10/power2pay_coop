<?php



$glsubid = ($_POST['subid']); // to avoid  sql injection attack
$parentid = ($_POST['parentid']);
$subids = ($_POST['subids']);
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');

$selectdata="SELECT * FROM `tbl_pos_temp` WHERE tbl_pos_temp.currentuser LIKE '%$glsubid%' AND tbl_pos_temp.parentid LIKE '%$parentid%' AND tbl_pos_temp.subid LIKE '%$subids%'";
$query = mysql_query($selectdata);
$data=array();
while ($row=mysql_fetch_assoc($query)) {
    $data[]=$row;
}

echo json_encode($data);

?>

