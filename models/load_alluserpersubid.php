<?php



$subid = ($_POST['subid']); // to avoid  sql injection attack
$parentid = ($_POST['parentid']); // to avoid  sql injection attack
$host = 'localhost'; //
$user = 'gtwbunsl_power2pay'; //gtwbunsl_power2pay
$pass = 'Olabode@001';

mysql_connect($host, $user, $pass);
mysql_select_db('gtwbunsl_power2pay'); //gtwbunsl_power2pay
$selectdata="SELECT * FROM `users` WHERE users.parentid LIKE '%$parentid%' AND users.subid LIKE '%$subid%'";
$query = mysql_query($selectdata);
$data=array();
while ($row=mysql_fetch_assoc($query)) {
    $data[]=$row;
}

echo json_encode($data);

?>

