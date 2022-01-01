<?php
$glsubid  = ($_POST['subid']); // to avoid  sql injection attack
$parentid  = ($_POST['parentid']); // to avoid  sql injection attack
$subids  = ($_POST['subids']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
    $pass = '';

    mysql_connect($host, $user, $pass);

    mysql_select_db('account_power2pay');
//$user = 'gtwbunsl_power2pay';
//$pass = 'Olabode@001';

//mysql_connect($host, $user, $pass);

//mysql_select_db('gtwbunsl_power2pay');

$selectdata = "SELECT DISTINCT stockno,stock,SUM(debit-credit) as qty FROM `tbl_stock` WHERE tbl_stock.stockno=$glsubid AND tbl_stock.parentid=$parentid AND tbl_stock.subid=$subids GROUP BY stockno,stock";
$query = mysql_query($selectdata);
$data=array();
while ($row =  mysql_fetch_assoc($query)) {
    $data[]=$row;
}
echo json_encode($data);


/*
$glsubid  = ($_POST['subid']); // to avoid  sql injection attack
$parentid  =($_POST['parentid']); // to avoid  sql injection attack
$subids  = ($_POST['subids']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');


$selectdata = "SELECT DISTINCT stockno,stock,SUM(debit-credit) as qty FROM `tbl_stock` WHERE tbl_stock.stockno=$glsubid AND tbl_stock.parentid=$parentid AND tbl_stock.subid=$subids GROUP BY stockno,stock";
$query = mysql_query($selectdata);
$data=array();
while ($row =  mysql_fetch_assoc($query)) {
    $data[]=$row;
}
echo json_encode($data);

*/
?>





