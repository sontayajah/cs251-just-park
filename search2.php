<?php
session_start();
require('server.php');

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
  <link href="https://fonts.googleapis.com/css2?family=Convergence&family=Lato:wght@300;400;700;900&family=Mukta:wght@300;400;600;700;800&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/search.css">
  <link href="assets/css/search2.css" rel="stylesheet">
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


    <div class="container">
      <div class="canvas">
        <div class="cardInfo">
          <div class="Info">
            <h2 class="floorInfo inline">Floor </h2>
            <span class="iconInfo inline">
              <ion-icon name="chevron-forward-outline" class="iconZone st"></ion-icon>
              <ion-icon name="chevron-forward-outline" class="iconZone nd"></ion-icon>
              <ion-icon name="chevron-forward-outline" class="iconZone th"></ion-icon>
            </span>
            <span class="zoneInfo">A</span>
          </div>
            <div class="warden">
              <div class="war-name inline">
                <span class="icon-warden name">
                  <ion-icon name="person"></ion-icon>
                </span>
                <span class="warName"></span>
              </div>
            <div class="line short inline"></div>
              <div class="wa-tel inline">
                <span class="icon-warden tel">
                  <ion-icon name="call"></ion-icon>
                </span>
                <span class="warTel"></span>
              </div>
          </div>
          <div class="systemInfo">
            <div class="emptyStatus inline">
              <span class="head-slot">Slot</span><br>
              <span class="slotNum"></span>
            </div>
            <div class="line long"></div>
            <div class="time inline">
              <span class="head">Opening Time - Mon-Sun</span><br>
              <span class="time-open">06:00-22:00</span>
            </div>  
          </div>
        </div>

        <!-- colloect data -->
      <form method="post" action="search2_db.php">
        <div class="input-area">
          <div class="form">
          
            
            <div class="CB">
              <input type="text" onkeypress="return /[a-z]/i.test(event.key)"  id="Car_Brand" name= "Car_Brand" for="Car Brand" class="form input" autocomplete="off" placeholder=" " required>
              <label for="carBrand" class="form label">Car Brand</label>
            </div>
            <div class="CC">
              <input type="text" onkeypress="return /[a-z]/i.test(event.key)" id="Car_Color" name = "Car_Color" for="Car Color" class="form input" autocomplete="off" placeholder=" " required>
              <label for="carBrand" class="form label">Car Color</label>
            </div>
            <!-- number -->
            <div class="NP">
              <input type="text" onkeypress="return /[0-9ก-ฮ]/i.test(event.key)" id="Num_Plate" name = "Num_Plate" for="Number Plate" class="form input" autocomplete="off" placeholder=" " required>
              <label for="carBrand" class="form label">Plate Number</label>
            </div>
            <!-- province -->
            <div class="PV">
              <input  type="text" id="Province" onkeypress="return /[ก-๙]/i.test(event.key)" name = "Province" for="Province" class="form input" autocomplete="off" placeholder=" " required>
              <label for="carBrand" class="form label">Province</label>
            </div>
          </div>
          <div class="btn">
            <a class="send" type="submit" value ="submit">Submit</a> 
          </div>
        </div>

        <!-- pop up -->

        <div id="popup">
          <div class="content">
            <span class="Infoicon">
              <ion-icon name="information-circle" class="Info-icon"></ion-icon>
            </span>
            <h2>Information</h2>
            <p>If you didn't arrived in 1 hour then System will cancel your booking.</p>
            <div class="acceptBox">
              <input  type="submit" name = "parking_info" value="Accept" onclick="Accept();">
            </div>
          </div>
          <a class="close" onclick="popupToggle();">
            <ion-icon name="close" class="iconClose"></ion-icon>
          </a>
        </div >
    
      </form > 
      
    </div>  

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
  <script src="assets/js/search2.js"></script>
  <script src="assets/js/search.js"></script>
  <!-- Load icon -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script>
   // window.onload = alert(localStorage.getItem('zone'));
   //window.onload = alert(localStorage.getItem('floor'));
  </script>
</body >

</html>