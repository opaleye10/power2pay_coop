<?php



$glid  = ($_POST['subid']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');

$selectdata = " SELECT * FROM tbl_gl_subclassacct WHERE tbl_gl_subclassacct.subid = $glid";
$query = mysql_query($selectdata);

$courseOptions = '';
$courseOptions .= '<option value disabled selected>Select GL SUb-Head</option>';

while ($row = mysql_fetch_array($query)) {
    $id=$row['subclassid'];
    $course=$row['descristion'];
    $courseOptions .= "<option value=$id>$course </option>";
}

echo json_encode([
    'courses' => $courseOptions,
]);




?>



