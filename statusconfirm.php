<?php 
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
$sql = "SELECT member.*,parking_lot. *,car.*
FROM member
INNER JOIN parking_lot ON member.Mem_ID=parking_lot.PLMem_ID
INNER JOIN car ON member.Mem_ID=car.CMem_ID
WHERE Username='$username' "; 

$result=$conn->query($sql) or die($conn->error);
$row=mysqli_fetch_assoc($result);

$slot=$row['Slot_ID'];
date_default_timezone_set('Asia/Bangkok');
//hide warning

// error_reporting(0);
if(empty($slot)){
  echo "<script>
alert('You must booking first');
window.location.href='index.php';
</script>";
}
$Cmem=$row['CMem_ID'];
if(isset($_POST['setDuetime'])){
  $time2 = date('Y-m-d H:i:s',time()); //for duetime time

  //insert in parking lot
  $query2 = mysqli_query($conn,"UPDATE `parking_lot` SET `Due_Time` = '$time2' WHERE`Slot_ID` ='$slot'");

  //insert to history
  $HSlot_ID=$row['Slot_ID'];
  $HMem_ID=$row['Mem_ID'];
  $HArrived_Time=$row['Arrived_Time'];
  // $HDue_time=$row['Due_Time'];
  $HBill_ID=rand();
  $Bill_ID = $HBill_ID;

  $insert=mysqli_query($conn,"INSERT INTO `history` (`HSlot_ID`, `HMem_ID`, `HArrived_Time`, `HDue_time`, `HBill_ID`) 
  VALUES ('$HSlot_ID', '$HMem_ID', ' $HArrived_Time', CURRENT_TIMESTAMP, '$HBill_ID');"); 
 //insert to payment
  $insert=mysqli_query($conn,"INSERT INTO `payment` (`Bill_ID`, `PMem_ID`, `Balance`, `Time_Pay`, `Pay_Status`,  `Bill_Pic`) 
  VALUES ('$Bill_ID', '$HMem_ID', Null , Null, Null,Null);"); 
  //delete parking lot
  $deleteP = mysqli_query($conn,"DELETE FROM `parking_lot` WHERE `parking_lot`.`Slot_ID` = '$slot' ");
  $deleteC = mysqli_query($conn,"DELETE FROM `car` WHERE `car`.`cmem_ID` = '$Cmem' ");
  header('Location: history.php');
 }

?>

<!DOCTYPE html>
<html lang="en">

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
  <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    #bg {
				background-color: white;
				padding: 40px;
        padding-bottom: 20px;
				margin-top: 25px;
        width: 900px;
        height: auto;
				border-radius:3px;
			}

    h3{
      font-family: "Poppins", sans-serif;
      color: black;
      font-weight: bold;
      /*font-size: 27px;*/
    }

    p {
      font-family: 'kanit', sans-serif;
      color: black;
      font-size: 22px;
    }

    #myfloor, #myslot {
      text-align: center;
      margin-bottom: 10px;
    }

    #mylocation, #mytel {
      font-size: 15px;
      margin-bottom: 10px;
    }

    #pic_placeholder {
      position: relative;
      max-width: 20px;
    }

    #pic_telephone {
      position: relative;
      max-width: 20px;
    }

    #bookingtime {
      margin-top: 30px;
      margin-bottom: 10px;
      text-align: center;
      font-size: 22px;
      font-weight: bold;
    }

    #time {
      text-align: center;
      font-size: 27px;
      font-weight: bold;
    }

    #icon1 {
      position: relative;
      max-width: 40px;
    }

    table.center {
      margin-left: auto; 
      margin-right: auto;
      border-radius: 10px;
      -webkit-backdrop-filter: blur(10px);
      backdrop-filter: blur(10px);
      background-color: rgba(130, 108, 153, 0.311);
    }

    th {
      border-collapse: collapse;
      padding: 15px;
      text-align: center;
      font-family: 'kanit', sans-serif;
      color: black;
      font-size: 20px;
    }

    #btn-cf {
      background-color: #FFC600;
      border: none;
      cursor: pointer;
      padding: 12px 90px;
      border-radius: 25px;
      font-family: "Poppins", sans-serif;
      font-weight: bold;
    }

    #btn-cf:hover {
      background-color: #dcaf0c;
    }

    .btn {
      margin-left: 255px;
    }

    #btn-cc {
      background-color: white;
      border: none;
      cursor: pointer;
      margin-top: 13px;
      margin-bottom: 0;
      color: #258687;
      font-family: "Poppins", sans-serif;
      font-weight: bold;
      font-size: 17px;
    }

    #btn-cc:hover {
      color: red;   
    }
    #cct{
      color: white;
      text-align: center;
      font-weight: bold;
    }

    #btn-out {
      background-color: #FFC600;
      border: none;
      cursor: pointer;
      padding: 12px 20px;
      border-radius: 25px;
      font-family: "Poppins", sans-serif;
      font-weight: bold;
      margin-left: 680px;
      margin-top: 20px;
    }

    #btn-out:hover {
      background-color: #dcaf0c;
    }

    #setConfirm{
      color: black;
      background-color: #04fbff;
    }
    #setConfirm:hover{
      background-color: #2cff00;
    }
    #setCancle{
      color: black;
      background-color: #EEB543;
    }
    #setCancle:hover{
      background-color: #ea1a1a;
    }

  </style>

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
          <li><a class="nav-link scrollto active" href="status.php">Status</a></li>
          <li><a class="nav-link scrollto " href="payment.php">Payment</a></li>
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
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="banner"></section><!-- End Hero Section -->

  <!-- ======= your code ======= -->

  <div class="container center" id="bg">
    
    <h3>Status for Booking</h3>

    <!-- countdowntime -->


    <br>
    <div class="booking" id="mybooking">
      <p id="mylocation"><span style="font-weight: bold;"><img src="assets/img/placeholder.png" id="pic_placeholder"> location : </span><?php echo $row['Address'];?></p>
      <p id="mytel"><span style="font-weight: bold;"><img src="assets/img/telephone.png" id="pic_telephone"> Tel. : <?php echo $row['Tel_no'];?> </span></p>
    </div>
    <hr id="hr">

    <!-- split date time of time_book -->
   <?php
    $splits=explode(" ",$row['Time_Book']);
    $date=$splits[0];
    $time=$splits[1];
   ?>
    <div class="booking" id="mybooking">
      <p id="bookingtime">Booking Time <?php echo $date; ?></p>
      <p id="time"><?php echo $time; ?></p>
    </div>
   <!-- split varchar of slotid -->
   <?php
    $splitsL=explode("-",$row['Slot_ID']);
    $Floor=$splitsL[0];
    $coneID=$splitsL[1];
    $r=array();
    if(strlen($coneID)==3){
      for($i=0;$i<strlen($coneID);$i++){
        $r[$i]=$coneID[$i];
      $cone=$r[2];
      $id=$r[0].$r[1];
    }
   }
    elseif (strlen($coneID)==2){
    for($i=0;$i<strlen($coneID);$i++){
      $r[$i]=$coneID[$i];
    }
    $cone=$r[1];
    $id=$r[0];
   }
   ?>
   
    <div class="booking" id="mybooking">
      <p id="myfloor"><span style="font-weight: bold;">Floor : </span> <?php echo $_COOKIE['floors'];?><img src="assets/img/icon1.png" id="icon1"><?php echo $cone;?>-<?php echo $id;?></p> 
      <!--<p id="myslot" style="text-indent: 2.5em"><span style="font-weight: bold;">Slot : </span>C-11</p>-->
    </div>

    <div id="mybooking">
      <table class="center">
        <tr>
          <th id="mybrand"><?php echo $row['Brand_Car'];?> - <?php echo $row['Color_Car'];?></th>
          <th id="myprov"><?php echo $row['Province'];?> <?php echo $row['Number'];?> </th>
        </tr>
      </table>

    </div>

    <hr id="hr1">
    
    <div class="btn" id="mybtn">
    <form method ="POSt">
      <button type="submit" id="btn-cf" name="setDuetime" type="submit" ><span style="color: red;">Leave Parking</span></button>
      <br>
    </form >  
    </div>
 
  </div>

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

   <!-- load pop up page -->
   <script src="assets/js/status-popup.js"></script>
   
  
</body>

</html>

