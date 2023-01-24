<?php
session_start();
include('server.php');

if (!isset($_SESSION['username'])) {
  $error = array();
  array_push($error, "You must login first.");
  $_SESSION['error'] = $error;
  header('location: login.php');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header('location: index.php');
}


if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  //get "user_id"
  $sql_query = "SELECT Mem_ID FROM Member WHERE Username = '$username' ";
  $result = mysqli_query($conn, $sql_query);

  $row = mysqli_fetch_assoc($result);
  $Mem_ID =  $row['Mem_ID'];

  // $Mem_ID = $_SESSION['Mem_ID'];
  $query = "SELECT * FROM member WHERE Mem_ID='$Mem_ID'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
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

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/profile_style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div id="logo">
        <h1><a href="index.php">JustPark</a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="search.php">Search</a></li>
          <li><a class="nav-link scrollto" href="status.php">Status</a></li>
          <li><a class="nav-link scrollto " href="payment.php">Payment</a></li>
          <li><a class="nav-link scrollto" href="history.php">History</a></li>
          <li><a class="nav-link scrollto active" href="profile.php">Profile</a></li>
          <li>
            <div class="dropdown">
              <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Hi, <?php echo $username ?>
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

  <div class="container" data-aos="zoom-in" data-aos-delay="100">
    <div class="row">
      <div class="col-12">
        <!-- Page title -->
        <div class="my-5">
          <h3>My Profile</h3>
          <hr>
        </div>
        <!-- Form START -->
        <form class="file-upload">
          <div class="row mb-5 gx-5">
            <!-- Contact detail -->
            <div class="col-xxl-12 mb-5 mb-xxl-0">
              <div class="bg-secondary-soft px-4 py-3 rounded">
                <div class="row g-3">
                  <div class="col-md-12 mb-4" style="text-align: center">
                    <img src="<?= "profile_image/" . $row['Profile'] ?>" style="height:15rem; width:15rem; border-radius:50%; object-fit: cover; object-position: 100% 0;" alt="Avatar" class="avatar">
                  </div>
                  <div>
                    <h2 style="font-weight:bold; text-align:center; color:black; text-transform: uppercase; ">
                      <?php echo $row['Fname'] . " " . $row['Lname'] ?>
                    </h2>
                  </div>
                  <div style="text-align:center" class="mb-5">
                    <table width="100%">
                      <tr>
                        <td>
                          <h5 style="color:green; font-weight:bold;text-align:center;">Membership start date:</h5>
                          <h5 style = "text-align:center;"><?php echo $row['Start_Date'] ?></h5>
                        </td>
                        <td>
                          <h5 style="color:red; font-weight:bold;text-align:center;">Membership end date:</h5>
                          <h5 style="text-align:center;"><?php echo $row['Due_Date'] ?></h5>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- First Name -->
                  <div class="col-md-6">
                    <label class="form-label">First Name *</label>
                    <input type="text" class="form-control" placeholder="" aria-label="First name" value="<?= $row['Fname'] ?>" readonly>
                  </div>
                  <!-- Last name -->
                  <div class="col-md-6">
                    <label class="form-label">Last Name *</label>
                    <input type="text" class="form-control" placeholder="" aria-label="Last name" value="<?= $row['Lname'] ?>" readonly>
                  </div>
                  <!-- Phone number -->
                  <div class="col-md-6">
                    <label for="Tel_no" class="form-label">Phone number *</label>
                    <input type="text" name="Tel_no" class="form-control" placeholder="" aria-label="Phone number" value="<?= $row['Tel_no'] ?>" readonly>
                  </div>
                  <!-- Address -->
                  <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Address *</label>
                    <input name="inputAddress" type="text" class="form-control" value="<?= $row['Address'] ?>" readonly>
                  </div>
                </div> <!-- Row END -->
              </div>
            </div>
          </div>
      </div>
    </div> <!-- Row END -->
    <!-- button -->
    <div class="gap-3 d-md-flex justify-content-md-end text-center">
      <a href="profile_edit.php"><button type="button" class="btn btn-primary btn-lg mb-5">Edit Profile</button></a>
    </div>
    </form> <!-- Form END -->
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

  <script>
    let imgInput = document.getElementById('ImgInput');
    let previeimg = document.getElementById('previewImg');

    imgInput.onchange = evt => {
      const [file] = imgInput.files;
      if (file) {
        previewImg.src = URL.createObjectURL(file);
      }
    }
  </script>

</body>

</html>