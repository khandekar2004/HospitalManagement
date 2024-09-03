<?php
session_start();
include('./include/connection.php');

//Checking Details for reset password
if(isset($_POST['change']))
{
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$newpassword=md5($_POST['password']);
$query=mysqli_query($connect,"UPDATE user SET `password`='$newpassword' where `name`='$name' and `email`='$email'");
if ($query) {
echo "<script>alert('Password successfully updated.');</script>";
echo "<script>window.location.href ='patientLogin.php'</script>";
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
    <script type="text/javascript">
function valid()
{
 if(document.passwordreset.password.value!= document.passwordreset.password_again.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.passwordreset.password_again.focus();
return false;
}
return true;
}
</script>

</head>

<body style="background-image: url(img/staff2.jpg); background-size: cover;">


    <?php include('./include/mainheader.php') ?>

    <div style="margin-top:60px;"></div>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="background-color:gainsboro; padding: 25px; border-radius: 10px;">

                    <center>
                        <div class="logo margin-top-30">
                            <h2 class="text-success"> HMS | Patient Password Recovery</h2><br>
                        </div>
                    </center>
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
                                Please set your new password.<br />
                                <span style="color:red;"></span>

                            </label>

                            <div class="form-group">

                                <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" required>

                            </div>
                        </div>

                        <div class="form-group">

                            <input type="password" class="form-control" id="password_again" name="password_again"  placeholder="Password Again" required>

                        </div>
                        <div class="form-actions">
								
								<button type="submit" class="btn btn-success pull-right" name="change">
									Change <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
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