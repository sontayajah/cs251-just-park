<?php
    session_start();
    include('server.php');

    if (isset($_POST['user_edit'])) {

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        echo '<pre>';
        print_r($_FILES);
        echo '</pre>';

        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $Tel_no = $_POST['Tel_no'];
        $Address = $_POST['Address'];
        $Img = $_FILES['Profile'];

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $Img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . '.' . $fileActExt;
        $filePath = 'profile_image/' . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($Img['size'] > 0 && $Img['error'] == 0) {
                if (move_uploaded_file($Img['tmp_name'], $filePath)) {
                    $query = "UPDATE Member SET Fname='$Fname', Lname='$Lname', Tel_no='$Tel_no', Address='$Address', Profile='$fileNew' WHERE Username='$_SESSION[username]'" or die(mysqli_error($conn));
                    $results = mysqli_query($conn, $query);
                    header('location: profile.php');
                }

                if ($sql) {
                    $_SESSION['success'] = "Profile updated successfully.";
                } else {
                    $_SESSION['error'] = "Profile update failed.";
                }
            }
        } else {
            $query = "UPDATE Member SET Fname='$Fname', Lname='$Lname', Tel_no='$Tel_no', Address='$Address' WHERE Username='$_SESSION[username]'" or die(mysqli_error($conn));
            $results = mysqli_query($conn, $query);
            header('location: profile.php');
        }

    }
?>