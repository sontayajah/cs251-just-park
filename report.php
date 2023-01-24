<?php
    session_start();
    require('server.php');
    $report_msg = $_REQUEST['msg'];
    $name = $_SESSION['username'];

    $check_id = "SELECT Mem_ID
                FROM member
                WHERE Username LIKE '%" . $name . "%'
                ";
    
    $objid = mysqli_query($conn, $check_id) or die("Error Query [" . $check_id . "]");
    $memId = "";

    while ($id = $objid->fetch_assoc()) {
        $memId = "".$id['Mem_ID'];
    }

    $int_id = intval( $memId );

    $index = "SELECT Report_ID
            FROM report";

    $objindex = mysqli_query($conn, $index) or die("Error Query [" . $index . "]");

    $reportId = 1;
    while($Rid = mysqli_fetch_array($objindex)) {
        $reportId++;
    }

    $sql = "
            INSERT INTO report
            VALUES ('$reportId','$int_id','$report_msg', now());
            ";
    $objQuery = mysqli_query($conn, $sql);

    if ($objQuery) {
        echo "New record Inserted successfully";
        header('location: index.php');
    } else {
        echo "Error : Input";
    }
?>