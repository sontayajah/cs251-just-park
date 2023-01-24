<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "justparkdb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);


    $array = [];

    $array['parking_lot'] = [];
    $result = mysqli_query($conn, "SELECT DISTINCT Slot_ID FROM parking_lot");
        if(mysqli_num_rows($result) > 0){
                while($obj = mysqli_fetch_row($result)){
                        $array['parking_lot'][] = $obj;
                }
        }
    $array['warden'] = [];
    $flr = $_COOKIE['floor'];
    $result = mysqli_query($conn, "SELECT WarName, WarTel FROM warden WHERE Floor = '$flr' ");
        if(mysqli_num_rows($result) > 0){
                while($obj = mysqli_fetch_row($result)){
                        $array['warden'] = $obj;
                }
        }
    echo json_encode($array);


?>