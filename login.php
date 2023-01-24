<?php
session_start();
require('server.php');

// if (isset($_SESSION['username'])) {
//     header('location: index.php');
// }

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
  <link href="assets/css/login_style.css" rel="stylesheet">

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>


<body>
  <!-- ======= your code ======= -->
  <div class="title mt-5" data-aos="zoom-in" data-aos-delay="100">
    <h1>JustPark</h1>
    <p>The best web appilcation for book parking lots.</p>
  </div>

  <div class="container center" data-aos="zoom-in" data-aos-delay="100">
    <div id="login">
      <h2>Login to JustPark</h2>

      <form class="form-login" id="form-element" method="post" action="login_db.php">
        <?php if (isset($_SESSION['error'])) : ?>
          <?php
          // Loop all errors
          // forerorach ($_SESSION['error'] as $er) {
          //   if ($error == "Username or password is incorrect." || $error == "You must login first." ||  $error == "You must login as Guest first.") {
          //     echo '<p style="color:red; font-size: 15px; margin-bottom: 3px">' . $error . '</p>';
          //   }
          // }
          ?>
        <?php endif ?>
        <label for="username">Username</label>
        <input type="text" id="username" class="form-control" name="username" placeholder="Username">
        <?php if (isset($_SESSION['error'])) : ?>
          <?php
          // Loop all errors
          // foreach ($_SESSION['error'] as $error) {
          //   if ($error == "The username is required.") {
          //     echo '<p style="color:red; font-size: 15px; margin-top: 3px">' . $error . '</p>';
          //   }
          // }
          ?>
        <?php endif ?>
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <?php if (isset($_SESSION['error'])) : ?>
          <?php
          // Loop all errors
          // foreach ($_SESSION['error'] as $error) {
          //   if ($error == "The password is required.") {
          //     echo '<p style="color:red; font-size: 15px; margin-top: 3px">' . $error . '</p>';
          //   }
          // }
          // unset($_SESSION['error']);
          // ?>
        <?php endif ?>
        <br>

        <!-- Button Login -->
        <button type="submit" id="btn-log" name="login_user">Login <img src="assets/img/right-arrow.png" id="icon_arr"></button>

        <div id="guest" class="mt-4">
          <h2>Login as <span style="color:#EEB543">Guest</span></h2>

          <div id="g-text">
            <label for="info">you can't booking slot anyway.</label>
            <br><br>

            <!-- Button Guest -->
            <button type="submit" id="btn-guest" name="login_guest">Guest Mode <img src="assets/img/right-arrow.png" id="icon_arr"></button>

          </div>

        </div>
      </form>

    </div>

    <hr>

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
</body>

</html>