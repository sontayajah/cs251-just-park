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
//1 = รอชำระเงิน 2 = ชำระแล้ว 3 = ยกเลิก
require('server.php');
$username = $_SESSION['username'];
$sql = "SELECT m.*,p.Bill_ID,p.Balance,p.Pay_Status,h.HArrived_Time,h.HDue_time
FROM member as m
INNER JOIN payment as p ON m.Mem_ID=p.PMem_ID
INNER JOIN history as h ON m.Mem_ID=h.HMem_ID
WHERE `Username`='$username' AND Bill_ID=HBill_ID
ORDER BY Bill_ID"; 
$result=$conn->query($sql) or die($conn->error);

function TimeDiff($strTime1,$strTime2)
{
return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
}

function TotalBalance($timediff){
  // return number_format($timediff*10, 3);
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
          <li><a class="nav-link scrollto " href="profile.php">Profile</a></li>
          <!-- <li><a class="nav-link scrollto" href="login.php">Logout</a></li> -->

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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <!-- ======= your code ======= -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <div class="p-3 text-center text-white">
</div>
<div class="container">
            <div class="row">
                 <div class="col-lg-10 mx-auto mb-4">
                    <div class="section-title text-center text-white">
                        <h3 class="top-c-sep">Payment list</h3>
                        <p class="text-white">Let's pay to booking parking slot.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">

                        <div class="filter-result">
                            <p class="mb-30 ff-montserrat text-white">Total waiting list :</p>

                            <table id='payment_list' class="display table table-bordered table-hover table-striped">
                                <thead>
                                  <tr class="danger">
                                    <th class="text-center text-white" width="10%">Bill ID</th>
                                    <th class="text-center text-white" width="15%">Date Time</th>
                                    <th class="text-center text-white" width="10%">Total Time</th>
                                    <th class="text-center text-white" width="5%">Balance</th>
                                    <th class="text-center text-white" width="10%">Status</th>
                                  </tr>

                                </thead>
                                <tbody>
                                  <?php while($row2=mysqli_fetch_assoc($result)) { ?>
                                  <tr>
                                    <td class="text-center text-white"><?php echo $row2['Bill_ID'];?></td>
                                    <td class="text-center text-white"><?php echo $row2['HArrived_Time'];?></td>
                                    <td class="text-center text-white"><?php echo number_format(TimeDiff($row2['HArrived_Time'],$row2['HDue_time']),2);?>&nbsp;<?php echo "hrs"; ?></td>
                                    <td class="text-white" text-align="right"><?php echo number_format(TotalBalance(TimeDiff($row2['HArrived_Time'],$row2['HDue_time'])),2);?>&nbsp;<?php echo "Baht"; ?></td>
                                    <td class="text-center text-white">
                                      <?php
                                      $status = $row2['Pay_Status'];
                                      if($status==0){
                                        echo "<a href='payment2.php'btn btn-primary btn-xs' style= 'color:red;'>Waiting for payment</a>";
                                      }elseif ($status==1) {
                                        echo "<a href='#' btn btn-success btn-xs'>Success</a>";
                                      }else{
                                        echo "<a href='#' btn btn-danger btn-xs'>Cancel</a>";
                                        }
                                      ?>
                                    </td>
                                  </tr>
                                <?php } ?>
                                </tbody>


                              </table>
                            

                        </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
<script type="text/javascript" charset="utf-88">
  $(document).ready(function(){
    $('#payment_list').dataTable({
      "aaSorting" : [[0,'desc']],
      "oLanguage" : {
      "sLengthMenu" : "แสดง_MENU_ เร็คคอร์ด ต่อหน้า",
      "sZeroRecords" : "ไม่เจอข้อมูลที่ค้นหา",
      "sInfo" : "แสดง_START_ถึง_END_ของ_TOTAL_เร็คคอร์ด",
      "sInfoEmpty" : "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
      "sInfoFiltered" : "(จากเร็คคอร์ดทั้งหมด_MAX_เร็คคอร์ด)",
      "sSearch":"ค้นห่ :",
      "aaSorting" : [[0,'desc']],
      "oPaginate" : {
        "sFirst": "หน้าแรก",
        "sPrevious" : "ก่อนหน้า",
        "sNext": "ถัดไป",
        "sLast": "หน้าสุดท้าย"
      },
      }
    });
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

</body>

</html>