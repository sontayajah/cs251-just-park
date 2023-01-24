<?php 
    session_start();
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
  <script src="/lib/bootstrap.min.js"></script>
  <!-- =======================================================
  * Template Name: Regna - v4.7.0
  * Template URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
  * Author: BootstrapMade1.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    #history{
      padding-top: 2%;
      padding-left:  5%;
      padding-right:  5%;
    }
    #tableHistory{
      width: 100%;
      text-align: center;
      color: black;
      font-family: 'kanit', sans-serif;
      background:linear-gradient(0deg, #00CED1, #EEB543);
      border-radius: 10px;
      box-shadow: 10px 10px 5px grey;
    }
    tr:hover{
      background-color: #00CED1;
    }
    #title{
      font-size: 160%;
      color: #000;
      text-shadow: white 0.1em 0.1em 0.1em;
    }
    #title:hover{
      background-color:#EEB543;
      color:#00CED1;
    }
    /* tr:nth-child(even){background-color: #EEB543} */
    tr:nth-child(even):hover{background-color: #00CED1}
    tr:nth-child(odd){color: #1B2631}
    #dowload_H{
      padding: 0.5%;
      text-align: center;
    }
    .btn{
      width: 10%;
      font-size: 120%;
      
    }
    .btn:hover{
      background-color: #00CED1;
      color: black;
    }
    #pic_down{
      position:relative;
      padding-right: 5px;
      padding-bottom: 4px;
      max-width: 20px;
    }
    #his_botton{
      width: 10%;
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
          <li><a class="nav-link scrollto" href="status.php">Status</a></li>
          <li><a class="nav-link scrollto " href="payment.php">Payment</a></li>
          <li><a class="nav-link scrollto active" href="history.php">History</a></li>
          <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
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
  <section id="banner"></section><!-- End Hero Section -->

  <!-- ======= your code ======= -->
    <!-- connect server -->
    <?php
        require('server.php');

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

        $sql = "SELECT HSlot_ID, HArrived_Time, HDue_time
                FROM history
                WHERE HMem_ID LIKE '%" . $memId . "%'
                ";

        $objQuery = mysqli_query($conn, $sql) or die("Error Query [" . $sql . "]");

    ?>

    <div id="history" class="hero-container" data-aos="zoom-in" data-aos-delay="100">
        <center><table id="tableHistory"  class="table table-hover">

            <tr id="title">
                <!-- ตารางHistory -->
                <th>Slot</th>
                <th>Arrival Time</th>
                <th>Leaving Time</th>
            </tr>

            <?php 
                while($data = mysqli_fetch_array($objQuery)) {
            ?>
                <tr>
                    <td><?php echo $data["HSlot_ID"]; ?></td>
                    <td><?php echo $data["HArrived_Time"]; ?></td>
                    <td><?php echo $data["HDue_time"]; ?></td>
                </tr>
            <?php 
                }
            ?>
            

        </table></center>
    <!--</div>

    <div id="dowload_H" class="hero-container" data-aos="zoom-in" data-aos-delay="100">
    <a id="his_botton" class="btn btn-warning" href="#" role="button" ><img src="724933.png" id="pic_down">Bill History</a>
    </div>-->


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