<?php 
session_start();
include('server.php');


    $errors = array();
    
    if(isset($_POST['parking_info'])) {
        $carbrand = mysqli_real_escape_string($conn, $_POST['Car_Brand']);
        $carcolor = mysqli_real_escape_string($conn, $_POST['Car_Color']);
        $numplate = mysqli_real_escape_string($conn, $_POST['Num_Plate']);
        $province = mysqli_real_escape_string($conn, $_POST['Province']);
        $slot_id = $_COOKIE['slot_id'];
        $warden_id = $_COOKIE['warden_id'];
        $username = $_SESSION['username'];
        
        //get "user_id"
        $sql_query = "SELECT Mem_ID FROM Member WHERE Username = '$username' ";
        $result = mysqli_query($conn, $sql_query);

        $row = mysqli_fetch_assoc($result);
        $user_id =  $row['Mem_ID'];

        //check if already has Mem_ID in "Parking_Lot"
        $count = mysqli_query($conn, "SELECT * FROM Parking_Lot WHERE PLMem_ID = '$user_id'");

        if ( mysqli_num_rows($count)==0){
            //insert data to "Car"
            $sql = "INSERT INTO Car (CMem_ID, Brand_Car, Color_Car, Province, Number) 
                    VALUES ('$user_id', '$carbrand', '$carcolor', '$province', '$numplate')";
            mysqli_query($conn,$sql);

            // insert data to "Parking_Lot"
            $sql = "INSERT INTO Parking_Lot (Slot_ID, PLWarden_ID, PLMem_ID, Time_Book, Arrived_Time, Due_Time) 
                VALUES ('$slot_id', '$warden_id', '$user_id', CURRENT_TIMESTAMP  , NULL, NULL)";
            mysqli_query($conn,$sql);

            header('location:status.php');
       }
        // else {
        //     //already have data, go back to "search.php"
        //     echo '<script>alert("You already booked.")
        //     window.location.href="search.php";
        //     </script>';
        // }

    } 

?>
