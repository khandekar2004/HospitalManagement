<?php
session_start();
include('./include/connection.php');
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
    <?php
    if (isset($_POST['login'])) {

        $username = $_POST['uname'];
        $password = md5($_POST['pass']);

        $error = array();

        if (empty($username)) {
            $error['user'] = "Enter Username";
        } else if (empty($password)) {
            $error['user'] = "Enter Password";
        }

        if (count($error) == 0) {

            $query = "SELECT * FROM user where username='$username' AND password='$password'";

            $result = mysqli_query($connect, $query);
            $row = mysqli_fetch_array($result);
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                $uip = $_SERVER['REMOTE_ADDR'];
                $pid = $row['id'];
                $status = 1;
                $log = mysqli_query($connect, "insert into userlog(uid,username,userip,status) values('$pid','$username','$uip','$status')");
                $_SESSION['user'] = $username;
                $_SESSION['id'] = $row['id'];

                echo "<script>toastr.success('Login Successfully','Success!',);
                                                    setTimeout(function() {
                                                        window.location.href = './user/index.php';
                                                      }, 600);</script>";
            } else {
                $uip = $_SERVER['REMOTE_ADDR'];
                $status = 0;
                mysqli_query($connect, "insert into userlog(username,userip,status) values('$username','$uip','$status')");
                $_SESSION['errmsg'] = "Invalid username or password";
                echo "<script>toastr.error('Invalid username or password','Failed!',)</script>";
            }
        }
    }
    ?>


    <?php include('./include/mainheader.php') ?>

    <div style="margin-top:60px;"></div>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="background-color:gainsboro; padding: 25px; border-radius: 10px;">

                   <center> <img src="img/saim.png" class="col-md-12" style="width: 50%; height:200px;border-radius:50%" alt="admin"></center>
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
                            <label>Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label>Password</label>
                            <input type="password" name="pass" placeholder="Enter Password" class="form-control">
                        </div>
                        <input type="submit" name="login" class="btn btn-primary btn-user btn-block" style="margin-top: 10px;">
                    </form>
                    <h6><span style="color:blue"><a href="./forgot.php">forget password</a> </span></h6>
                    <p>  </span></p>
                    <h6>Don't have an account yet?<span style="color:blue"><a href="./user/registerUser.php"> Create an account</a> </span></h6>
                </div>
            </div>
        </div>
    </div>
</body>

</html>