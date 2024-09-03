<?php
session_start();
if (!isset($_SESSION['admin'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head><title>HMS | Add Specialization</title></head>
<style>
    #toast-container > .toast-error { background-color: #e74a3b !important; } 
 #toast-container > .toast-success { background-color: #1cc88a !important; }
</style>

<link rel="stylesheet" href="./toastr.min.css">

 <script src="./toaster/js/jquery.js"></script>
    <script src="./toaster/js/toastr.min.js"></script>
    <script src="toastr.css"></script>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include('./sidenav.php');
        include('../include/header.php');
        ?>
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="container">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                        <form method="post" enctype="multipart/form-data">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Add Specialization</h1>
                                </div>
                                <?php

                                if (isset($_POST['add'])) {

                                    $special = $_POST['specialn'];

                                    $error = array();
                                    if (empty($special)) {
                                        $error['u'] = "Enter Specialization!";
                                    }else if (count($error) == 0) {
                                                $q = " INSERT INTO specialization (`specialization`) VALUES ('$special')";

                                                $result = mysqli_query($connect, $q);

                                                if ($result) {
                                                    echo "<script>toastr.success('Specialization Added Successfully','Success!',);
                                                    setTimeout(function() {
                                                        window.location.href = 'doctorspecialization.php';
                                                      }, 1000);</script>";  
                                                    
                                                } else {
                                                    $error['u'] = "Something Went Wrong";
                                                }
                                            } 
                                        }


                                 /*   }
                                }*/
                                if (isset($error['u'])) {
                                    $sh = $error['u'];
                                    $show = "<h5 class='text-center alert alert-danger'>$sh</h5>";
                                } else {
                                    $show = "";
                                }
                                echo $show;
                                ?>

                                <form method="post" enctype="multipart/form-data" class="user">
                                    <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                    <label>Specialization: <span class="redc">*</span></label>
                                            <input type="text" class="form-control form-control-user" name="specialn" id="specialization" placeholder="Add Doctor Specialization" required>
                                        </div>
                                    </div>

                                    <input  type="submit" class="btn btn-success btn-user btn-block" value="Add" name="add">

                                </form>

                                <hr>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
</body>
<style>
    .redc{
        color:red;
    }
</style>
</html>