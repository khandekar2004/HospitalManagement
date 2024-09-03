<?php
session_start();
include('../include/connection.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>HMS | Register User</title>
    <style>
    #toast-container > .toast-error { background-color: #e74a3b !important; } 
 #toast-container > .toast-success { background-color: #1cc88a !important; }
</style>

<link rel="stylesheet" href="./toaster/css/toastr.min.css">

 <script src="./toaster/js/jquery.js"></script>
    <script src="./toaster/js/toastr.min.js"></script>
    <script src="toastr.css"></script>

</head>
<script>
function validateEmail(val) {
		$.ajax({
			type: "POST",
			url: "validate_email.php",
			data: 'email=' + val,
			success: function(data) {
				$("#doctor").html(data);
			}
		});
	}
    function validatePass(val) {
		$.ajax({
			type: "POST",
			url: "validate_email.php",
			data: 'password=' + val,
			success: function(data) {
				$("#showpass").html(data);
			}
		});
	}
</script>
<body id="page-top">
<script src="toaster/js/jquery.js"></script>
    <script src="toaster/js/toastr.min.js"></script>
    <script src="toaster/toastr.js"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php

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
                                    <h1 class="h4 text-gray-900 mb-4">Signup</h1>
                                </div>
                                <?php

                                if (isset($_POST['add'])) {
                                    $fname = $_POST['fname'];
                                    $lname = $_POST['lname'];
                                    $addr = $_POST['address'];
                                    $uname = $_POST['uname'];
                                    $email = $_POST['email'];
                                    $phone =$_POST['phone'];
                                    $pass = $_POST['pass'];
                                    $cpass = $_POST['cpass'];
                                    $gender = $_POST['gender']; 
                                    
                                    $name = $fname. ' ' .$lname; 
                                    
                                    $error = array();
                                    if (filter_var($email,FILTER_VALIDATE_EMAIL)===false){
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
                                                    
                                                  }else{
                                    
                                                  
                                                  
                                    if (empty($uname)) {
                                        $error['u'] = "Enter Admin Username";
                                    } else if (empty($pass)) {
                                        $error['u'] = "Enter Admin Password";
                                    } else if (empty($cpass)) {
                                        $error['u'] = "Enter Confirm Password";
                                        
                                    } else if ($pass == $cpass) {
                                        $sql = "select * from user where (username='$uname' or email='$email');";
                                        $cpass = md5($cpass);
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
                                                $q = "INSERT INTO  `user`(`name` , `address`, `username`, `email`, `phone`,`gender`, `password`) VALUES ('$name','$addr','$uname','$email','$phone','$gender','$cpass')";
                                                $result = mysqli_query($connect, $q);

                                                if ($result) {
                                                   
                                                    echo "<script>toastr.success('Account Created Successfully!','Success',);
                                                    </script>";
                                              } else {
                                                    echo "<script>toastr.error('Somthing Went Wrong!','Error!',);
                                                    </script>";
                                                }
                                            } else {
                                                $error['u'] = "Your Password doesn't match confirm password";
                                            }
                                        }
                                    }
                                }}
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
                                      
                                        <div class="col-sm-6 mb-3 mb-sm-0"><label>Enter your Name: </label>
                                            <input type="text" class="form-control form-control-user" name="fname" id="exampleFirstName" placeholder="First Name"  required>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0"><label>. </label>
                                            <input type="text" class="form-control form-control-user" name="lname" id="exampleLastName" placeholder="Last Name"  required>
                                        </div>
            

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label>Address:</label>
                                            <textarea type="text" class="form-control form-control-user" value="" name="address" id="address" placeholder="">
                            </textarea>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6"><label>Username:<span class="redc">*</span></label>
                                            <input type="text" class="form-control form-control-user " name="uname" id="exampleLastName" placeholder="eg.kal001" required>
                                        </div>
                                        <div class="col-sm-6"><label>Email: <span class="redc">*<span class="doctor alert " id="doctor"></span></span></label>
                                            <input type="email" class="form-control form-control-user" onChange="validateEmail(this.value);" id="doctor" name="email" id="exampleInputEmail" placeholder="eg. xyz@gmail.com..."  required>
                                        </div>
                                        <div class="col-sm-6"><label>Phone: <span class="redc">*</span></label>
                                            <input type="tel" pattern="[0-9]{10,11}" class="form-control form-control-user" name="phone" id="exampleInputEmail" placeholder="eg. 9100091000"  required>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label>Select Gender<span class="redc">*</span></label>
                                           <select name="gender" class="form-control" required="true">
											<option value="">Gender</option>
											<option value="male">Male</option>
											<option value="female">Female</option>
											<option value="female">Transgender</option>
                                           </select>
                                        </div>
                                        <input type="hidden" class="doctor" id="doctor">
                                        <div class="col-sm-6"><label>Password <span class="redc">*<span class="showpass alert " id="showpass"></span></span></label>
                                            <input type="password" onChange="validatePass(this.value);" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control form-control-user" name="pass"  placeholder="Password"  required>
                                        </div>
                                        <div class="col-sm-6"><label> <span class="redc">*</span></label>
                                            <input type="Password" class="form-control form-control-user" name="cpass"   placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                    
                                    <input type="submit" class="btn btn-success btn-user btn-block" value="SignUp" name="add">
                                </form>
                                
                                <hr>
                        <h6>Already have an account<span style="color:blue"><a href="../patientlogin.php"> Click Here</a> </span></h6>

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