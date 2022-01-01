<?php



$glsubid  = ($_POST['subid']); // to avoid  sql injection attack
$glsubid2  = ($_POST['subid2']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');

$selectdata = "SELECT sum(amount) as amount FROM `tbl_pos` WHERE tbl_pos.purchasestype='Cash' and tbl_pos.currentuser=$glsubid and tbl_pos.trndate=$glsubid2";
$query = mysql_query($selectdata);
$data=array();
while ($row =  mysql_fetch_assoc($query)) {
    $data[]=$row;
}
echo json_encode($data);
?>

