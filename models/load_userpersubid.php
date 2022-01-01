<?php



$subid = ($_POST['subid']); // to avoid  sql injection attack
$parentid = ($_POST['parentid']); // to avoid  sql injection attack
$username = ($_POST['username']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');

$selectdata="SELECT * FROM `users` WHERE users.parentid LIKE '%$parentid%' AND users.subid LIKE '%$subid%' AND users.username LIKE '%$username%'";
$query = mysql_query($selectdata);
$data=array();
while ($row=mysql_fetch_assoc($query)) {
    $data[]=$row;
}

echo json_encode($data);

?>

