<?php
session_start();
include('server.php');

$error = array();

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($error, "The username is required.");
    }

    if (empty($password)) {
        array_push($error, "The password is required.");
    }

    if (count($error) == 0) {
        $query = "SELECT * FROM Member WHERE Username='$username' AND Password='$password'";
        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($results);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['Mem_ID'] = $row['Mem_ID'];
            $_SESSION['success'] = "You are now logged in";
            $_SESSION['login_success'] = "You are now logged in";
            unset($_SESSION['Guest']);
            header('location: index.php');
        } else {
            array_push($error, "Username or password is incorrect.");
            $_SESSION['error'] = $error;
            header('location: login.php');
        }
    } else {
        $_SESSION['error'] = $error;
        header('location: login.php');
    }
} else if (isset($_POST['login_guest'])) {
    $_SESSION['Guest'] = "Guest";
    $_SESSION['Mem_ID'] = "0";
    $_SESSION['success'] = "You are now logged in as Guest";
    header('location: index2.php');
}
