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
$sql = "SELECT * FROM `member` WHERE `Username`='$username'"; 
$result=$conn->query($sql) or die($conn->error);
$row=mysqli_fetch_assoc($result);
$username = $_SESSION['username'];
$sql = "SELECT m.*,p.Bill_ID,p.Balance,p.Time_Pay,p.Pay_Status,p.Bill_Pic,h.HArrived_Time,h.HDue_time,h.HSlot_ID
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

<?php 
                if (!empty($_POST['submit']) && isset($_POST['submit'])){
                $Balance = TotalBalance(TimeDiff($row['HArrived_Time'],$row['HDue_time']));
                $Time_Pay = date("Y-m-d H:i:s", strtotime($_POST["Time_Pay"]));

                 #file name with a random number so that similar dont get replaced
                $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
 
                  #temporary file name to store file
                 $file_loc = $_FILES["file"]["tmp_name"];
                 #upload directory path
                 $folder="fileupload/";
                 #TO move the uploaded file to specific location
                move_uploaded_file($file_loc,$folder.$pname);
                $sqlsubmit = "UPDATE payment
                INNER JOIN history ON HBill_ID=Bill_ID
                SET Balance='$Balance',Time_Pay= '$Time_Pay',Bill_Pic='$pname',Pay_Status=1
                ";
                $resultsubmit = mysqli_query($conn,$sqlsubmit) or die ("Error in query: $sqlsubmit" . mysqli_error());
                if($resultsubmit){
                  echo "<script type='text/javascript'>";
                  echo "alert('Update Succesfuly');";
                  echo "</script>";
                }else{
                  echo "<script type='text/javascript'>";
                  echo "alert('Error back to Payment Status again');";
                  echo "window.location = 'payment.php'; ";
                  echo "</script>";
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
        <h1><a href="index.html">JustPark</a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="search.php">Search</a></li>
          <li><a class="nav-link scrollto" href="status.php">Status</a></li>
          <li><a class="nav-link scrollto active" href="payment.php">Payment</a></li>
          <li><a class="nav-link scrollto" href="history.php">History</a></li>
          <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
        
          <!-- <li><a class="nav-link scrollto" href="login.php" name="logout">Logout</a></li> -->
          <li>
            <div class="dropdown">
              <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Hi, <?php echo $_SESSION['username'] ?>
              </a>
              <ul class="dropdown-menu" style="margin-left:-20px; padding:0;" aria-labelledby="dropdownMenuLink">
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- ======= your code ======= -->
<style>
  
h1 {
  position: relative;
  text-align: center;
  color:  #FFFFFF;
  font-size: 50px;
  font-family: "Poppins", sans-serif;
}

p {
  font-family: 'Lato', sans-serif;
  font-weight: 300;
  text-align: center;
  font-size: 18px;
  color:  #FFFFFF;
}
.frame {
  width: 90%;
  margin: 100px auto;
  text-align: center;
}
button {
  margin: 20px;
  outline: none;
}
.custom-btn {
  width: 130px;
  height: 40px;
  padding: 10px 25px;
  border: 2px solid #000;
  "Poppins", sans-serif;
  font-weight: 500;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
  color: #36B0D4;
}
  .btn-3 {
  line-height: 39px;
  padding: 0;
}
.btn-3:hover{
  background: transparent;
  color:  #FFFFFF;
}
.btn-3 span {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
}
.btn-3:before,
.btn-3:after {
  position: absolute;
  content: "";
  left: 0;
  top: 0;
  background: #000;
  transition: all 0.3s ease;
}
.btn-3:before {
  height: 0%;
  width: 2px;
}
.btn-3:after {
  width: 0%;
  height: 2px;
  color:#FFFFFF ;
}
.btn-3:hover:before {
  height: 100%;
}
.btn-3:hover:after {
  width: 100%;
  color:  #FFFFFF;
}
.btn-3 span:before,
.btn-3 span:after {
  position: absolute;
  content: "";
  right: 0;
  bottom: 0;
  background: #000;
  transition: all 0.3s ease;
}
.btn-3 span:before {
  width: 2px;
  height: 0%;
}
.btn-3 span:after {
  width: 0%;
  height: 2px;
}
.btn-3 span:hover:before {
  height: 100%;
}
.btn-3 span:hover:after {
  width: 100%;
}
</style>
<section id="hero">
  <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
  <h1>Thank you for Payment!</h1>
  <br />
  <?php echo "<h1>" . $row['Username'] . "</h1>"; ?>
  <br />
  <div class="frame">
    <a href="payment.php">
<button class="custom-btn btn-3"><span>Back to Page</span></button></a>
</div>

</div>
  </section><!-- End Hero Section -->
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
</body>

</html>
