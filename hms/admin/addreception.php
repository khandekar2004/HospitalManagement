<?php
session_start();
include('../include/connection.php')
?>
<!DOCTYPE html>
<html></html>
<head><title>HMS | Add Admin</title></head>
<style>
    #toast-container > .toast-error { background-color: #e74a3b !important; } 
 #toast-container > .toast-success { background-color: #1cc88a !important; }
</style>

<link rel="stylesheet" href="./toastr.min.css">

 <script src="./toaster/js/jquery.js"></script>
    <script src="./toaster/js/toastr.min.js"></script>
    <script src="toastr.css"></script>
 <?php
 if (isset($_POST['add'])) {

                                    $uname = $_POST['uname'];
                                    $cpass = $_POST['cpass'];
                                    $pass = $_POST['pass'];
                                    $image = $_FILES['profile']['name'];
                                    $email = $_POST['email'];
                                    $fname = $_POST['fname'];
                                    $lname = $_POST['lname'];

                                    $name = "" . str_replace(' ', '', $fname) ." ". str_replace(' ', '', $lname) . "";


                                    $error = array();
                                    if (empty($uname)) {
                                        $error['u'] = "Enter Admin Username";
                                    } else if (empty($pass)) {
                                        $error['u'] = "Enter Admin Password";
                                    } else if (empty($cpass)) {
                                        $error['u'] = "Enter Confirm Password";
                                    } else if ($pass == $cpass) {
                                        $sql = "select * from admin where (username='$uname' or email='$email');";

                                        $res = mysqli_query($connect, $sql);

                                        if (mysqli_num_rows($res) > 0) {

                                            $row = mysqli_fetch_assoc($res);
                                            if ($email == isset($row['email'])) {
                                                $error['u'] = "email already exists";
                                            }
                                            else if ($uname == isset($row['username'])) {
                                                $error['u']= "Username  already exists";
                                            }
                                        } else {

                                            if (count($error) == 0) {
                                                $q = " INSERT INTO reception(`username`,`password`,`profile`,`email`,`name`) VALUES ('$uname','$cpass','$image','$email','$name')";

                                                $result = mysqli_query($connect, $q);

                                                if ($result) {
                                                   move_uploaded_file($_FILES['profile']['tmp_name'], "img/$image");
                                                    echo "<script>toastr.success('Admin Added Successfully','Success!',);
                                                    setTimeout(function() {
                                                        window.location.href = 'admin.php';
                                                      }, 1000);</script>";  
                                                    
                                                } else {
                                                    $error['u'] = "Something Went Wrong";
                                                }
                                            } else {
                                                $error['u'] = "Your Password doesn't match confirm password";
                                            }
                                        }


                                       }
                                }?>
</head>

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
                                    <h1 class="h4 text-gray-900 mb-4">Add Admin</h1>
                                </div>

                                <?php

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
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Name: <span class="redc">*</span></label>
                                            <input type="text" class="form-control form-control-user" name="fname" id="exampleFirstName" placeholder="First Name" required>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0"><label style="color:transparent"> .</label>
                                            <input type="text" class="form-control form-control-user" name="lname" id="exampleFirstName" placeholder="Last Name" required>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Profile Picture:</label>
                                        <input type="file" class="form-control form-control-user" name="profile" id="profilepic" placeholder="ProfilePic">  
                                        </fieldset></div>
                                        <div class="col-sm-6"><label>Username:<span class="redc">*</span></label>
                                            <input type="text" class="form-control form-control-user" name="uname" id="exampleLastName" placeholder="">
                                        </div>
                            </div>
                            <div class="form-group row">
                                        <div class="col-sm-12"><label>Email: <span class="redc">*</span></label>
                                            <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="eg. xyz@gmail.com..." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0"><label>Password:<span class="redc">*</span></label>
                                            <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        <div class="col-sm-6"><label style="color:transparent">.</label>
                                            <input type="password" name="cpass" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" required>
                                        </div>
                                    </div>

                                    <input  type="submit" class="btn btn-success btn-user btn-block" value="add" name="add">

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