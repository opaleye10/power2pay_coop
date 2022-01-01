<?php



$glid  = ($_POST['mainid']); // to avoid  sql injection attack
$host = 'localhost';
$user = 'root';
$pass = '';

mysql_connect($host, $user, $pass);

mysql_select_db('account_power2pay');

$selectdata = " SELECT * FROM tbl_gl_subaccount WHERE tbl_gl_subaccount.mainid = $glid";
$query = mysql_query($selectdata);

$courseOptions = '';
$courseOptions .= '<option value disabled selected>Select GL SUb-Head</option>';

while ($row = mysql_fetch_array($query)) {
    $id=$row['subid'];
    $course=$row['sub_desc'];
    $courseOptions .= "<option value=$id>$course </option>";
}

echo json_encode([
    'courses' => $courseOptions,
]);




?>



