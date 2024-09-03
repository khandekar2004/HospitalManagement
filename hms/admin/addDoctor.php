<!DOCTYPE html>

<head>
    <title>HMS | ADD DOCTOR</title>
</head>
<?php
session_start();
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head>
    <title>HMS | Add Doctor</title>
</head>
<style>
    #toast-container>.toast-error {
        background-color: #e74a3b !important;
    }

    #toast-container>.toast-success {
        background-color: #1cc88a !important;
    }
</style>

<link rel="stylesheet" href="./toastr.min.css">

<script src="./toaster/js/jquery.js"></script>
<script src="./toaster/js/toastr.min.js"></script>
<script src="toastr.css"></script>

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
                                    <h1 class="h4 text-gray-900 mb-4">Add Doctor</h1>
                                </div>
                                <?php

                                if (isset($_POST['add'])) {

                                    $uname = $_POST['uname'];
                                    $cpass = $_POST['cpass'];
                                    $pass = $_POST['pass'];
                                    $spec = $_POST['specialization'];
                                    $email = $_POST['email'];
                                    $name = $_POST['name'];
                                    $phone = $_POST['phone'];
                                    $addr = $_POST['address'];
                                    $fee = $_POST['fee'];


                                    $cpass = md5($cpass);
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
                                                    
                                                  }
                                                   else if ($pass == $cpass) {
                                        $sql = "select * from doctor where (username='$uname' or email='$email');";

                                        $res = mysqli_query($connect, $sql);

                                        if (mysqli_num_rows($res) > 0) {

                                            $row = mysqli_fetch_assoc($res);
                                            if ($email == isset($row['email'])) {
                                                $error['u'] = "email already exists";
                                            } else if ($uname == isset($row['username'])) {
                                                $error['u'] = "Username  already exists";
                                            }
                                        }
                                    } else {

                                            if (count($error) == 0) {
                                                $q = "INSERT INTO `doctor`(`specialization`, `name`, `username`, `email`, `phone`, `password`, `fees`, `address`) VALUES ('$spec','$name','$uname','$email','$phone','$cpass','$fee','$addr')";
                                                $result = mysqli_query($connect, $q);

                                                if ($result) {

                                                    echo "<script>toastr.success('Doctor Added Successfully','Success!',);
                                                    setTimeout(function() {
                                                        window.location.href = 'manageDoctor.php';
                                                      }, 1000);</script>";
                                                } else {
                                                    $error['u'] = "Something Went Wrong";
                                                }
                                            } else {
                                                $error['u'] = "Your Password doesn't match confirm password";
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
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label>Doctor Specialization<span class="redc">*</span></label>

                                            <select name="specialization" class="form-control" required="true">
                                                <option value="">Select Specialization</option>
                                                <?php $ret = mysqli_query($connect, "select * from specialization");
                                                while ($row = mysqli_fetch_array($ret)) {
                                                ?>
                                                    <option value="<?php echo htmlentities($row['specialization']); ?>">
                                                        <?php echo htmlentities($row['specialization']); ?>
                                                    </option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                        <div class="col-sm-6 mb-3 mb-sm-0"><label>Doctor Name</label>
                                            <input type="text" class="form-control form-control-user" name="name" id="exampleFirstName" placeholder="eg.Ben Affleck..." required>
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
                                        <div class="col-sm-6"><label>Username:<span class="redc">*</span></label>
                                            <input type="text" class="form-control form-control-user " name="uname" id="exampleLastName" placeholder="eg.kal001" required>
                                        </div>
                                        <div class="col-sm-6"><label>Email: <span class="redc">*<span class="doctor alert " id="doctor"></span></span></label>
                                            <input type="email" class="form-control form-control-user" name="email" onChange="validateEmail(this.value);" id="exampleInputEmail" placeholder="eg. xyz@gmail.com..." required>
                                        </div>
                                        <div class="col-sm-6"><label>Phone: <span class="redc">*</span></label>
                                            <input type="tel" pattern="[0-9]{10,11}" class="form-control form-control-user" name="phone" id="exampleInputEmail" placeholder="eg. 9100091000" required>
                                        </div>
                                        <div class="col-sm-6"><label>Consultancy Fees<span class="redc">*</span></label>
                                            <input type="text" class="form-control form-control-user" name="fee" id="examplefee" placeholder="Rs /-" required>
                                        </div>
                                        
                                            <div class="col-sm-12">
                                            Password <span class="redc">*<span class="showpass alert " id="showpass"></span></span>
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" onChange="validatePass(this.value);" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control form-control-user" name="pass" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="Password" class="form-control form-control-user" name="cpass" placeholder="Confirm Password" required>
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
    .redc {
        color: red;
    }
</style>

</html>