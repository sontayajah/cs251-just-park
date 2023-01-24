<?php
session_start();
require('server.php');


$username = $_SESSION['username'];
//get "user_id"
$sql_query = "SELECT Mem_ID FROM Member WHERE Username = '$username' ";
$result = mysqli_query($conn, $sql_query);

$row = mysqli_fetch_assoc($result);
$user_id =  $row['Mem_ID'];

$count = mysqli_query($conn, "SELECT * FROM Parking_Lot WHERE PLMem_ID = '$user_id'");

setcookie("count_book", mysqli_num_rows($count)); 


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

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/search.css" rel="stylesheet">
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
    <div class="container d-flex justify-content-between align-items-center" >

      <div id="logo">
        <!--<a href="index.php"><img src="assets/img/logo.png" alt=""></a>-->
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1><a href="index.php">JustPark</a></h1>
      </div>

      <nav id="navbar" class="navbar">

        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto active" href="search.php">Search</a></li>
          <li><a class="nav-link scrollto" href="status.php">Status</a></li>
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

        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="banner">
    
  </section><!-- End Hero Section -->

  <!-- ======= your code ======= -->

    <div class="navigation">
      <div class="menuToggle"></div>
      <ul>
        <li class="list active" style="--clr:#f44336;">
          <a href="#"">
            <span class="floor">1</span>
            <span class="icon"></span>
            <span class="slot">16/36</span>
          </a>
        </li>
        <li class="list" style="--clr:#ffa117;">
          <a href="#"">
            <span class="floor">2</span>
            <span class="icon"></span>
            <span class="slot">16/36</span>
          </a>
        </li>
        <li class="list" style="--clr:#0fc70f;">
          <a href="#"">
            <span class="floor">3</span>
            <span class="icon"></span>
            <span class="slot">16/36</span>
          </a>
        </li>
        <li class="list" style="--clr:#2196f3;">
          <a href="#"">
            <span class="floor">4</span>
            <span class="icon"></span>
            <span class="slot">16/36</span>
          </a>
        </li>
        <li class="list" style="--clr:#b145e9;">
          <a href="#"">
            <span class="floor">5</span>
            <span class="icon"></span>
            <span class="slot">16/36</span>
          </a>
        </li>
      </ul>

      
    <div class="container">
      <div class="canvas">
        <div class="cardInfo">
          <div class="Info">
          <h2 class="floorInfo inline">1st</h2>
          <span class="textInfo inline">Zone</span>
          <span class="iconInfo inline">
            <ion-icon name="chevron-forward-outline" class="iconZone st"></ion-icon>
            <ion-icon name="chevron-forward-outline" class="iconZone nd"></ion-icon>
            <ion-icon name="chevron-forward-outline" class="iconZone th"></ion-icon>
          </span>
          <span class="zoneInfo">A</span>
          <span class="slotInfo inline"></span>
          </div>
        </div>

        <div class="menuZone">
          <ul>
            <li class="z-list activeZone">
              <a href="#">
                <span class="zone">A</span>
              </a>
            </li>
            <li class="z-list">
              <a href="#">
                <span class="zone">B</span>
              </a>
            </li>
            <li class="z-list">
              <a href="#">
                <span class="zone">C</span>
              </a>
            </li>
          </ul>
        </div>



        <div class="slotImg">
          <div class="func-slot sec1">
            <ul class="sec1">
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">1</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">2</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover"> 
                  <div class="card-slot">
                    <span class="zone-id">3</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#"class="hover">
                  <div class="card-slot">
                    <span class="zone-id">4</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">5</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">6</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <div class="func-slot sec2">
            <ul class="sec2">
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">7</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">8</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">9</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">10</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">11</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
              <li class="slot-num">
                <a href="#" class="hover">
                  <div class="card-slot">
                    <span class="zone-id">12</span>
                    <span class="car">
                      <img src="" alt="">
                    </span>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <img src="Slot.svg" class="img_slot" alt="Slot SVG">
        </div>
        
      </div>  
    </div>

    </div>

    <div class="model-container">
      <div class="model">
        <h1>Confirm</h1>
        <p>
          Would you like to confirm to book this parking slot?        
        </p>
        <button class="confirm" type="submit" >
          Confirm
        </button>
        <button class="cancel">
          Cancel
        </button>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/search.js"></script>
  <!-- Load icon -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    

</body>

</html>

