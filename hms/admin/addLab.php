<!DOCTYPE html>
<head><title>HMS | ADD LAB</title> </head>
<?php
session_start();
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head><title>HMS | Add Lab</title></head>
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
                                    <h1 class="h4 text-gray-900 mb-4">Add Lab</h1>
                                </div>
                                <?php

                                if (isset($_POST['add'])) {

                                    $name = $_POST['name'];
                                    $labown = $_POST['uname'];
                                    $pass = $_POST['pass'];
                                    $cpass = $_POST['cpass'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $addres = $_POST['address'];
                                    
                                    $labno = "HLAB1";


                                    $error = array();
                                    if (empty($labown)) {
                                        $error['u'] = "Enter Admin Username";
                                    } else if (empty($pass)) {
                                        $error['u'] = "Enter Admin Password";
                                    } else if (empty($cpass)) {
                                        $error['u'] = "Enter Confirm Password";
                                    } else if ($pass == $cpass) {
                                        $sql = "select * from lab where (name='$name' or email='$email');";

                                        $res = mysqli_query($connect, $sql);

                                        if (mysqli_num_rows($res) > 0) {

                                            $row = mysqli_fetch_assoc($res);
                                            if ($email == isset($row['email'])) {
                                                $error['u'] = "email already exists";
                                            }
                                            else if ($name == isset($row['name'])) {
                                                $error['u']= "name  already exists";
                                            }   
                                        } else {

                                            if (count($error) == 0) {
                                                $q = "INSERT INTO `lab`(`name`, `labno`, `labassistant`, `address`, `email`, `phone`, `password`) VALUES ('$name','$labno','$labown','$addres','$email','$phone','$pass');";
                                                $result = mysqli_query($connect, $q);

                                                if ($result) {
                                                   
                                                    echo "<script>toastr.success('Lab Added Successfully','Success!',);
                                                    setTimeout(function() {
                                                        window.location.href = 'manageLab.php';
                                                      }, 1000);</script>";                                                  
                                                } else {
                                                    $error['u'] = "Something Went Wrong";
                                                }
                                            } else {
                                                $error['u'] = "Your Password doesn't match confirm password";
                                            }
                                        }
                                    }
                                }
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
                                        
                                      
                                        <div class="col-sm-6 mb-3 mb-sm-0"><label>Lab Name:</label>
                                            <input type="text" class="form-control form-control-user" name="name" id="exampleFirstName" placeholder="eg.MediLab"  required>
                                        </div>
                                        <div class="col-sm-6"><label>Lab Owner/Assistant:</label>
                                            <input type="text" class="form-control form-control-user " name="uname" id="exampleLastName" placeholder="eg.Ajit Singh..." required>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label>Address:</label>
                                            <textarea type="text" class="form-control form-control-user" value="" name="address" id="address" placeholder="Enter Address">
                            </textarea>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        
                                        <div class="col-sm-6"><label>Email: <span class="redc">*</span></label>
                                            <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="eg. xyz@gmail.com..."  required>
                                        </div>
                                        <div class="col-sm-6"><label>Phone: <span class="redc">*</span></label>
                                            <input type="number" class="form-control form-control-user" name="phone" id="exampleInputEmail" placeholder="eg. 9100091000"  required>
                                        </div>
                                        <div class="col-sm-6"><label>Password: <span class="redc">*</span></label>
                                            <input type="password" class="form-control form-control-user" name="pass"  placeholder="Password"  required>
                                        </div>
                                        <div class="col-sm-6"><label> <span class="redc">*</span></label>
                                            <input type="Password" class="form-control form-control-user" name="cpass"   placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                    
                                    <input type="submit" class="btn btn-success btn-user btn-block" value="Add" name="add">
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