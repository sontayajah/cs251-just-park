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
    $query = $conn->query("SELECT * FROM member WHERE username='$username'");
    $row = mysqli_fetch_array($query);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/profile_style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex justify-content-between align-items-center">

            <div id="logo">
                <h1><a href="../index.php">JustPark</a></h1>
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
                            <ul class="dropdown-menu" style="margin-left:-20px; padding:0; " aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="index_member.php?logout='1'">Logout</a></li>
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
    <div class="container"data-aos="zoom-in" data-aos-delay="100">
        <div class="row">
            <div class="col-12">
                <!-- Page title -->
                <div class="my-5">
                    <h3>Profile Settings</h3>
                    <hr>
                </div>
                <!-- Form START -->
                <form action="profile_edit_db.php" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Do you want to save changes?');">
                    <div class="row mb-5 gx-5">
                        <!-- Contact detail -->
                        <div class="col-xxl-12 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-3 rounded">
                                <div class="row g-3">
                                    <!-- <h4 class="mb-4 mt-0">Contact detail</h4> -->
                                    <div class="col-md-12 mb-4" style="text-align: center">
                                        <div class="image-upload">
                                            <label for="ImgInput">
                                                <img src="<?= "profile_image/" . $row['Profile'] ?>" style="height:15rem; width:15rem; border-radius:50%; cursor:pointer; object-fit: cover; object-position: 100% 0;" id="previewImg" alt="Avatar" class="avatar">
                                                <h6 style="text-align: center; font-weight:bold; margin-top:1rem; color:blue;">You can change your profile image here.</h6>
                                            </label>
                                            <input type="file" style="display:none" id="ImgInput" class="form-control" name="Profile" value="<?= $row['Profile'] ?>">
                                        </div>
                                    </div>
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="First name" name="Fname" value="<?php echo $row['Fname'] ?>" required>
                                    </div>
                                    <!-- Last name -->
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Last name" name="Lname" value="<?php echo $row['Lname'] ?>" required>
                                    </div>
                                    <!-- Phone number -->
                                    <div class="col-md-6">
                                        <label for="Tel_no" class="form-label">Phone number *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Phone number" name="Tel_no" value="<?php echo $row['Tel_no'] ?>" required>
                                    </div>
                                    <!-- Address -->
                                    <div class="col-md-6">
                                        <label for="Address" class="form-label">Address *</label>
                                        <input type="text" class="form-control" name="Address" value="<?php echo $row['Address'] ?>" required>
                                    </div>
                                    <!-- <div class="col-md-8">
                                        <label for="profile" class="form-label">Image</label>
                                        <input type="file" id="ImgInput" class="form-control" name="Profile" value="<?= $row['Profile'] ?>">
                                        <img id="previewImg" alt="" style="width:15rem; height:15rem">
                                    </div> -->
                                </div> <!-- Row END -->
                            </div>
                        </div>
                    </div>

                    <!-- button -->
                    <div class="gap-3 d-md-flex justify-content-md-end text-center mb-5">
                        <a class="btn btn-secondary btn-lg" href="profile.php" name="cancel" onclick="return confirm('Do you want to cancel?');">Cancel</a>
                        <button type="submit" class="btn btn-success btn-lg" name="user_edit">Save Change</button>
                    </div>
            </div>
            </form> <!-- Form END -->
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

    <script>
        let imgInput = document.getElementById('ImgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
    </script>

</body>

</html>