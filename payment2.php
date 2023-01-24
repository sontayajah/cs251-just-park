<?php 
 error_reporting(0);
 session_start();
    if(!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if(isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
require('server.php');
$username = $_SESSION['username'];
$sql = "SELECT m.*,p.Bill_ID,p.Balance,p.Pay_Status,h.HArrived_Time,h.HDue_time,h.HSlot_ID
FROM member as m
INNER JOIN payment as p ON m.Mem_ID=p.PMem_ID
INNER JOIN history as h ON m.Mem_ID=h.HMem_ID
WHERE `Username`='$username' AND Bill_ID=HBill_ID
ORDER BY Bill_ID asc"; 
$result=$conn->query($sql) or die($conn->error);
$row=mysqli_fetch_assoc($result);

function TimeDiff($strTime1,$strTime2)
{
return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
}

function TotalBalance($timediff){
  if($timediff>2){
    return (($timediff-2)*100);
  }
  elseif ($timediff<=2) {
    return 0;
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>JustPark</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/iconP1.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Regna - v4.7.0
  * Template URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div id="logo">
        <!--<a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1><a href="index.php">JustPark</a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="search.php">Search</a></li>
          <li><a class="nav-link scrollto" href="status.php">Status</a></li>
          <li><a class="nav-link scrollto active" href="payment.php">Payment</a></li>
          <li><a class="nav-link scrollto" href="history.php">History</a></li>
          <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
          <!-- <li><a class="nav-link scrollto" href="login.php">Logout</a></li> -->

          <li>
            <div class="dropdown">
              <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Hi, <?php echo $_SESSION['username'] ?>
              </a>
              <ul class="dropdown-menu" style="margin-left:-20px; padding:0; " aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="login.php?logout='1'">Logout</a></li>
              </ul>
            </div>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="banner">
    
  </section><!-- End Hero Section -->

  <!-- ======= your code ======= -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    input[type=button], input[type=submit], input[type=reset] {
  background-color: #04AA6D;
  border: none;
  color: white;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
     width: 100%;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 15px;
    background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA 51%, #77A1D3 100%);
    transition: 0.5s;
    background-size: 200% auto

}
    img.center {
    display: block;
    margin: 0 auto;
}

.form {
  width: 400px;
}
@import "bourbon";
@import url(https://fonts.googleapis.com/css?family=Lato:400,700,300);

.file-upload-wrapper {
  $defaultColor: #4daf7c;
  $height: 60px;
  
  position: relative;
  width: 100%;
  height: $height;
  
  &:after {
    content: attr(data-text);
    font-size: 18px;
    position: absolute;
    top: 0;
    left: 0;
    background: #fff;
    padding: 10px 15px;
    display: block;
    width: calc(100% - 40px);
    pointer-events: none;
    z-index: 20;
    height: $height - 20px;
    line-height: $height - 20px;
    color: #999;
    border-radius: 5px 10px 10px 5px;
    font-weight: 300;
  }
  
  &:before {
    content: 'Upload';
    position: absolute;
    top: 0;
    right: 0;
    display: inline-block;
    height: 60px;
    background: $defaultColor;
    color: #fff;
    font-weight: 700;
    z-index: 25;
    font-size: 16px;
    line-height: $height;
    padding: 0 15px;
    text-transform: uppercase;
    pointer-events: none;
    border-radius: 0 5px 5px 0;
  }
  
  &:hover {
    &:before {
      background: darken($defaultColor, 10%);
    }
  }
   input {
    opacity: 0;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 99;
    height: $height - 20px;
    margin: 0;
    padding: 0;
    display: block;
    cursor: pointer;
    width: 100%;
  }
}

::placeholder {
    font-size: 14px;
    font-weight: 600
}

.form-control {
    color: white;
    background-color: #223C60;
    border: 2px solid transparent;
    height: 60px;
    padding-left: 20px;
    vertical-align: middle
}

.form-control:focus {
    color: white;
    background-color: #0C4160;
    border: 2px solid #2d4dda;
    box-shadow: none
}

.text {
    font-size: 14px;
    font-weight: 600
}
.h1{
    font-size: 24px;
    font-weight: 700
}
.h2{
    font-size: 20px;
    font-weight: 700
}
.h3{
    font-size: 16px;
    font-weight: 700
}
.btn.btn-primary {
    width: 100%;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 15px;
    background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA 51%, #77A1D3 100%);
    border: none;
    transition: 0.5s;
    background-size: 200% auto
}

.btn.btn.btn-primary:hover {
    background-position: right center;
    color: #fff;
    text-decoration: none
}

.btn.btn-primary:hover .fas.fa-arrow-right {
    transform: translate(15px);
    transition: transform 0.2s ease-in
}

.card {
    max-width: 600px;
    margin: auto;
    color: black;
    border-radius: 20 px
}

p {
    margin: 0px
}

.container .h8 {
    font-size: 30px;
    font-weight: 800;
    text-align: center
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.base-timer {
  position: relative;
  width: 300px;
  height: 300px;
}

.base-timer__svg {
  transform: scaleX(-1);
}

.base-timer__circle {
  fill: none;
  stroke: none;
}

.base-timer__path-elapsed {
  stroke-width: 7px;
  stroke: grey;
}

.base-timer__path-remaining {
  stroke-width: 7px;
  stroke-linecap: round;
  transform: rotate(90deg);
  transform-origin: center;
  transition: 1s linear all;
  fill-rule: nonzero;
  stroke: currentColor;
}

.base-timer__path-remaining.green {
  color: rgb(65, 184, 131);
}

.base-timer__path-remaining.orange {
  color: orange;
}

.base-timer__path-remaining.red {
  color: red;
}

.base-timer__label {
  position: absolute;
  width: 300px;
  height: 300px;
  top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 48px;
}
  </style>
<form name="myform" action="paymentsuccess.php" method="POST" enctype="multipart/form-data">
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <div class="p-3 text-center text-white">
  <h1>Payment</h1>
  <div id="app"></div>
</div>
<h8>On-time payment</h8><br>
<div class="card px-4">
        <p class="h8 py-3">Payment Details</p>
        <img class="center" src="assets/img/qr-code.png" width="150" height="150">
        <div class="row gx-3">
          <div class="container">
          </div>
            <div class="col-12">
                <div class="d-flex flex-column">
                    <p class="text mb-1"><?php echo $row['Username']; ?></p>
                    <p id="Username" class="h1 mb-1"><?php echo $row['Fname']; ?>&nbsp;<?php echo $row['Lname']; ?></p> <p id="MemID" name='HMem_ID' class="text mb-1"><?php echo $row['HMem_ID']; ?></p>
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Arrived Time</p><br><p id="HSlot_ID" name='HSlot_ID' type="text" class="h2 mb-1"><?php echo $row['HArrived_Time']; ?></p>
                </div>
            </div>
            <div class="col-6">
                <div class="d-flex flex-column">
                    <p class="text mb-1">SlotID</p> <!---<input class="form-control mb-3" type="text" placeholder="A000">--> <br><p id="HSlot_ID" name='HSlot_ID' type="text" class="h2 mb-1"><?php echo $row['HSlot_ID']; ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Total Time</p><br><p id="totaltime" type="time" class="h2 mb-1"><?php echo number_format(TimeDiff($row['HArrived_Time'],$row['HDue_time']),2); ?> &nbsp;<?php echo "hours"; ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Price</p> <br><p id="balance" name='Balance' type="text" class="h2 mb-1"><?php echo  number_format(TotalBalance(TimeDiff($row['HArrived_Time'],$row['HDue_time'])),2);?>&nbsp;<?php echo "Baht"; ?></p>
                </div>
            </div>
            <div class="form-group col-6">
                <div class="form-group d-flex flex-column">
                    <p class="text mb-1">PAYDATE & TIME</p> <form onsubmit="this.reset(); return false">
                        <label for="Time_Pay"><span class="text-danger"></span>
                          <input type="datetime-local" id="Time_Pay" name="Time_Pay" class="form-control mb-3" required>
                        </label>
                </div>
            </div>
            <br/>
            <p class="text mb-1">Add Bill Image</p>
               <div class="form-group file-upload-wrapper" data-text="Select your file!">
                     <input type="file" name="file" required="required"/>
              </div>
            <br/> <br/>
            <a href="paymentsuccess.php">
            <div class="form-group col-12">
                <div class="form-group btn btn-primary mb-3 "><input type="submit" name="submit" value="Let's pay to Park!" /></div></div></a>
        </div>
    </div>
    </div>
  </section>
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

// Credit: Mateusz Rybczonec
const FULL_DASH_ARRAY = 283;
const WARNING_THRESHOLD = 10;
const ALERT_THRESHOLD = 5;

const COLOR_CODES = {
  info: {
    color: "green"
  },
  warning: {
    color: "orange",
    threshold: WARNING_THRESHOLD
  },
  alert: {
    color: "red",
    threshold: ALERT_THRESHOLD
  }
};

const TIME_LIMIT = 900;
let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;

document.getElementById("app").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label" class="base-timer__label">${formatTime(
    timeLeft
  )}</span>
</div>
`;

startTimer();

function onTimesUp() {
  clearInterval(timerInterval);
}

function startTimer() {
  timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label").innerHTML = formatTime(
      timeLeft
    );
    setCircleDasharray();
    setRemainingPathColor(timeLeft);

    if (timeLeft === 0) {
      onTimesUp();
    }
  }, 1000);
}

function formatTime(time) {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${minutes}:${seconds}`;
}
function setRemainingPathColor(timeLeft) {
  const { alert, warning, info } = COLOR_CODES;
  if (timeLeft <= alert.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(warning.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(info.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(warning.color);
  }
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
  const circleDasharray = `${(
    calculateTimeFraction() * FULL_DASH_ARRAY
  ).toFixed(0)} 283`;
  document
    .getElementById("base-timer-path-remaining")
    .setAttribute("stroke-dasharray", circleDasharray);
}
//import module
const express = require('express');
const router = express();
const fs = require('fs');
document.getElementById("myPay").onclick = function () {
        location.href = "paymentsuccess.html";
    };

$(document).ready(function () {
      setTimeout(function () {
        alert('Time Out! Reloading Page');
        history.go(-1);
      }, 900000);
    });

</script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<script src="assets/js/payment.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</body>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>