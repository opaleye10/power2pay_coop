<?php



    $moduleId  = ($_POST['parentmenu']); // to avoid  sql injection attack
   $host = 'localhost';
    $user = 'root';
    $pass = '';

    mysql_connect($host, $user, $pass);

    mysql_select_db('account_power2pay');

    $selectdata = "SELECT * FROM tbl_submainmenu WHERE tbl_submainmenu.parentmenu LIKE '%$moduleId%'";
    $query = mysql_query($selectdata);

    $courseOptions = '';
    $courseOptions .= '<option value disabled selected>Select Menu</option>';

    while ($row = mysql_fetch_array($query)) {
        $id=$row['submenu'];
        $course=$row['submenuname']. '-----('. $row['submenudesc'].')';
        $courseOptions .= "<option value=$id>$course </option>";
    }

    echo json_encode([
        'courses' => $courseOptions,
    ]);




?>



