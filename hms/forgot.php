<?php
session_start();
include('./include/connection.php');

//Checking Details for reset password
if(isset($_POST['submit'])){
$name=$_POST['fullname'];
$email=$_POST['email'];
$query=mysqli_query($connect,"SELECT * FROM  user WHERE `name`='$name' and `email`='$email'");
$row=mysqli_num_rows($query);
if($row>0){

$_SESSION['name']=$name;
$_SESSION['email']=$email;
header('location:reset-pass.php');
} else {
echo "<script>alert('Invalid details. Please try with valid details');</script>";
echo "<script>window.location.href ='forgot.php'</script>";


}

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>HMS | Register User</title>
    <style>
        #toast-container>.toast-error {
            background-color: #e74a3b !important;
        }

        #toast-container>.toast-success {
            background-color: #1cc88a !important;
        }
    </style>

    <link rel="stylesheet" href="../toaster/css/toastr.min.css">

    <script src="../toaster/js/jquery.js"></script>
    <script src="../toaster/js/toastr.min.js"></script>
    <script src="toastr.css"></script>

</head>

<body style="background-image: url(img/staff2.jpg); background-size: cover;">


    <?php include('./include/mainheader.php') ?>

    <div style="margin-top:60px;"></div>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="background-color:gainsboro; padding: 25px; border-radius: 10px;">

                   <center><div class="logo margin-top-30">
				<h2 class="text-success"> HMS | Patient Password Recovery</h2><br>
				</div></center>
                    <form action="" method="post" class="my-2">
                        
                        <div>
                            <?php
                            if (isset($error['user'])) {
                                $sh = $error['user'];
                                $show = "<h5 class='alert alert-danger'>$sh</h5>";
                            } else {
                                $show = "";
                            }
                            echo $show;
                            ?>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label>
								Please enter your Email and password to recover your password.<br />
					
							</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Registred Full Name">
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            
                        <input type="email" class="form-control" name="email" placeholder="Registred Email">
                        </div>
                        <button type="submit" class="btn btn-success pull-right" name="submit">
									Reset <i class="fa fa-arrow-circle-right"></i>
								</button>
                    </form>
                    <br>
                    <div class="new-account">
								Already have an account? 
								<a href="patientLogin.php">
									Log-in
								</a>
							</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>