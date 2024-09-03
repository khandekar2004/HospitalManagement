<?php
session_start();
if (!isset($_SESSION['doc'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <title>HMS</title>

    <!-- Custom fonts for this template-->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       

        <?php
        include('./sidenav.php');
        include('../include/header.php'); ?>
        <!-- End of Topbar -->
        <div class="container-fluid">

           <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">DOCTOR | DASHBOARD</h1>
    <a href="./profile.php" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-user fa-sm text-white-50"></i> View Profile</a>
</div>
<!-- Content Row -->
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Appointment</div>
                        <?php $pid=1;
                        $user = $_SESSION['doc'];
                                
                        $qwr = mysqli_query($connect, "SELECT id FROM doctor where username ='$user'");
                        $row=mysqli_fetch_array($qwr);
                        $docId=$row['id'];
                        $query = "SELECT * FROM appointment WHERE `doctorId` = '$docId' AND `status`!='Paid' AND `status`!='checked';";
                        $resulta = mysqli_query($connect,$query);
                        $app_num =mysqli_num_rows($resulta);
                                        ?>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $app_num ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Patient</div>
                        <?php 
                                        $doc = mysqli_query($connect,"SELECT * FROM tblPatient WHERE Docid =$docId");

                                        $doc_num =mysqli_num_rows($doc);
                                        ?>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $doc_num ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

    
</body>

</html>