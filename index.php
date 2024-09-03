<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HMS</title>
    <link href="logo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
    <link rel="manifest" href="manifest.json">
    <style>

    </style>

</head>

<?php include("./hms/include/connection.php") ?>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#"><img height="30px" src="logo.png"> HMS</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Aboutus">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://samjam.pythonanywhere.com">Predictometer</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle btn btn-outline-success" aria-expanded="false" data-bs-toggle="dropdown">Login</a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="./hms/adminlogin.php">Admin</a><a class="dropdown-item" href="./hms/patientlogin.php">Patient/User<br /></a><a class="dropdown-item" href="./hms/doctorlogin.php">Doctor</a><a class="dropdown-item" href="./hms/labLogin.php">Lab</a><a class="dropdown-item" href="./hms/recLogin.php">Reception</a></div>
                    </li>
                    <li class="nav-item dropdown"><a class="btn btn-outline-success" href="./hms/user/registerUser.php">Signup</a></li>


                    <li class="nav-item"><a class="btn btn-success" href="./hms/patientlogin.php">Book Appointment</a></li>

                </ul>

            </div>

        </div>
    </nav>

    <main class="page landing-page">
        <section class="clean-block clean-hero" style="background-image: url(&quot;assets/img/scenery/slider_2.jpg&quot;);color: rgba(28, 200, 138, 0.85);">
            <div class="text">
                <h2>Hospital Management System</h2>
                <p>Get Better Life With Better Care!</p><a href="./hms/patientlogin.php"><button class="btn btn-light btn-outline-success btn-lg" href="./hms/patientlogin.php" type="button">BOOK APPOINTMENT</button></a>
            </div>
        </section>


        <section id="Aboutus" class="clean-block clean-info dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-success">Info</h2>
                    <p></p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6"><img class="img-thumbnail" src="assets/img/new/why.jpg"></div>
                    <div class="col-md-6">
                        <?php
                        $ret = mysqli_query($connect, "select * from tblpage where PageType='aboutus' ");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <h3>About Our Hospital</h3>
                            <div class="getting-started-info">
                                <p><?php echo $row['PageDescription']; ?>.</p><?php } ?>
                            </div>
                    </div>
                    
<!--
                    <p>We are a leading healthcare provider dedicated to delivering high-quality medical care to our patients. Our hospital is staffed with a team of experienced and compassionate healthcare professionals who are committed to ensuring that our patients receive the best possible care.

                        At our hospital, we offer a comprehensive range of medical services, including diagnosis, treatment, and prevention of illnesses and injuries. Our state-of-the-art facilities and advanced medical technologies enable us to provide accurate diagnoses and effective treatments to our patients</p> -->
                </div>
            </div>
        </section>

        <?php

        ?>

        <section id="Services" class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-success">Our Key Features</h2>
                    <p>Take a look at some of our key features</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5 feature-box"><i class="icon-grid icon" style="color:green;"></i>
                        <h4>Comprehensive and specialized medical services</h4>
                        <p>A hospital offers  wide range of medical services, including emergency care, surgical procedures, diagnostic tests, specialized treatments, rehabilitation services, and preventive care</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-graph icon" style="color:green;"></i>
                        <h4>Highly skilled healthcare professionals</h4>
                        <p>Team of experienced and qualified healthcare professionals is critical for a hospital.</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-size-actual icon" style="color:green;"></i>
                        <h4>Patient-centered care</h4>
                        <p>Our Hospital  prioritize patient-centered care, focusing on meeting patients' individual needs and preferences.</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-trophy icon" style="color:green;"></i>
                        <h4>Quality and safety measures</h4>
                        <p>Robust quality assurance programs and safety protocols to maintain high standards of care</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="Gallery" class="clean-block slider dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-success">Gallery</h2>
                    <p>Glimpse of Hospital</p>
                </div>
                <div class="carousel slide" data-bs-ride="carousel" id="carousel-1">
                    <div class="carousel-inner">
                        <div class="carousel-item active"><img class="w-100 d-block" src="assets/img/scenery/slider_1.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="assets/img/scenery/slider_2.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="assets/img/scenery/slider_3.jpg" alt="Slide Image"></div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-success">Our Doctor</h2>
                    <p>Our Expert Doctor</p>
                </div>
               
                <div class="row justify-content-center">
                <?php
$ret=mysqli_query($connect,"SELECT * from doctor ");
while ($rs=mysqli_fetch_array($ret)) {
    
?>
                    <div class="col-sm-6 col-lg-4">
                        <?php if($rs['profile']==""){ ?>
                        <div class="card text-center clean-card"><img class="card-img-top w-20 d-block" src="doc_blank.png">
                        <?php }else{$profile=$rs['profile'];
                        echo"
                        <div class='card text-center clean-card'><img class='card-img-top w-20 d-block' src='./hms/Doctor/img/$profile?>'>";?>

                            <?php } ?>
                            <div class="card-body info">
                                <h4 class="card-title"><?php  echo $rs['name'];?></h4>
                                <p class="card-text"><?php  echo $rs['qualification'];?></p>
                                <p class="card-text"><?php  echo $rs['specialization'];?></p>
                            </div>
                        </div>
                    </div><?php } ?>
                    
                    
                </div>
            </div>
        </section>
        <section class="clean-block slider dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-success">Contact</h2>
                    <p>Contact Details</p>
                </div>
                <div class="row justify-content-center">
                    <?php
$ret=mysqli_query($connect,"select * from tblpage where PageType='contactus' ");
while ($row=mysqli_fetch_array($ret)) {
?>
                  <div class="col-sm-6">
                        <h3>HMS</h3>
                        <p>
                        <?php  echo $row['PageDescription'];?> <br><br>
                            <strong>Phone:</strong>  <?php  echo $row['MobileNumber'];?> <br>
                            <strong>Email:</strong> <a href="mailto:<?php  echo $row['Email'];?>" class=""> <?php  echo $row['Email'];?></a><br>
                            <strong>Opening Time:</strong> <?php  echo $row['OpenningTime'];?><br>
                        </p>
                    </div><?php } ?>
        </section>
    </main>

    <footer class="page-footer dark">

        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="./user/registerUser.php">Sign up</a></li>
                       
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>About us</h5>
                    <ul>
                        <li><a href="#">Company Information</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help desk</a></li>
                        <li><a href="#">Forums</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                  
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>HMS © 2023 Copyright Text</p>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/baguetteBox.min.js"></script>
    <script src="assets/js/vanilla-zoom.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>