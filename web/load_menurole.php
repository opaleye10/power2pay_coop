<?php



    $moduleId  = ($_POST['roleid']); // to avoid  sql injection attack
   $host = 'localhost';
    $user = 'gtwbunsl_power2pay';
    $pass = 'Olabode@001';

    mysql_connect($host, $user, $pass);

    mysql_select_db('gtwbunsl_power2pay');

    $selectdata = "SELECT * FROM tbl_appmenurole WHERE roleid = $moduleId";
    $query = mysql_query($selectdata);
    $data=array();

    while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
        $data[]=$row;
}



   // while ($row =  mysql_fetch_assoc($query)) {
     //   $data[]=$row;
   // }
    echo json_encode($data);

?>




