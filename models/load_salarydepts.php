<?php



$glsubid  = mysql_real_escape_string($_POST['dept']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');

$selectdata = "SELECT * FROM `tbl_salary_dept`";
$query = mysql_query($selectdata);
$data=array();
while ($row =  mysql_fetch_assoc($query)) {
    $data[]=$row;
}
echo json_encode($data);

?>

