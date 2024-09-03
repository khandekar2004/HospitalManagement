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
                                    }
                                    elseif (filter_var($email,FILTER_VALIDATE_EMAIL)===false){
                                        $error['u'] = "Please Enter Valid Email Address";

                                    }
                                    
                                                  // Initialize cURL.
                                                  $ch = curl_init();
                                    
                                                  // Set the URL that you want to GET by using the CURLOPT_URL option.
                                                  curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=a63f55916a33471db5cd7a4bd3436378&email=$email");
                                    
                                                  // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
                                                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    
                                                  // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
                                                  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                                    
                                                  // Execute the request.
                                    
                                                  $response = curl_exec($ch);
                                    
                                                  // Close the cURL handle.
                                                  curl_close($ch);
                                                  $data = json_decode($response, true);
                                                 
                                                  if($data['deliverability']==="UNDELIVERABLE"){
                                                    $error['u'] = "Please Enter Valid Email Address";

                                                  }
                                    
                                                  else if($data["is_disposable_email"]["value"]===true){
                                                    $error['u'] = "Please Enter Valid Email Address";
                                                    
                                                  } 
                                    else if ($pass == $cpass) {
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
                                                $cpass = md5($cpass);
                                            if (count($error) == 0) {
                                                $q = " INSERT INTO admin(`username`,`password`,`profile`,`email`,`name`) VALUES ('$uname','$cpass','$image','$email','$name')";

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
<script>
        function validateEmail(val) {
            $.ajax({
                type: "POST",
                url: "../validate_email.php",
                data: 'email=' + val,
                success: function(data) {
                    $("#doctor").html(data);
                }
            });
        }

        function validatePass(val) {
            $.ajax({
                type: "POST",
                url: "../validate_email.php",
                data: 'password=' + val,
                success: function(data) {
                    $("#showpass").html(data);
                }
            });
        }
    </script>
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
                                        <div class="col-sm-12"><label>Email: <span class="redc">*<span class="doctor alert " id="doctor"></span></span></label>
                                            <input type="email" onChange="validateEmail(this.value);" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="eg. xyz@gmail.com..." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <div class="col-sm-12">
                                            Password <span class="redc">*<span class="showpass alert " id="showpass"></span></span>
                                        
                                    </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="pass" onChange="validatePass(this.value);" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                        </div> <div class="col-sm-6">
                                        
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