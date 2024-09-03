<?php
session_start();
include('../../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head>
    <title>PROFILE</title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        include('../sidenav.php');
        include('./header.php');
        $ad = $_SESSION['admin'];

        $query = "SELECT * FROM admin WHERE username ='$ad'";

        $res = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_array($res)) {
            $username = $row['username'];
            $profiles = $row['profile'];
            $id = $row['id'];
            $password = $row['password'];
            $name = $row['name'];
            $email = $row['email'];
        }
        ?>
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change Email</h6>

                </div>
                <div class="card-body">
                    <div class="text-center">


                        <?php
                        echo "<h3 class='text-center text-gray-800'>$email</h3>"; ?>
                    </div>
                    <form method="post">
                        <?php

                        if (isset($_POST['change'])) {
                            $emails = $_POST['email'];

                            $error = array();
                            

                            if (empty($emails)) {
                            } else {
                                $sql = "select * from admin where email='$emails';";

                                $resi = mysqli_query($connect, $sql);

                                if (mysqli_num_rows($resi) > 0) {

                                    $row = mysqli_fetch_assoc($res);
                                    if ($emails == isset($row['email'])) {
                                        echo "<script>alert('email already exists');</script>";
                                    } 
                                }else {
                                    $query = "UPDATE admin SET email ='$emails' WHERE id='$id'";

                                    $result = mysqli_query($connect, $query);
                                    if ($result) {
                                        echo "<script>window.location.href='../profile.php';</script>";
                                    }
                                }
                            }
                        }
                        ?>
                        <div style="border:solid 2px gray; padding:20px; border-radius:10px 0">
                        <?php
                        if (isset($error['u'])) {
                                    $sh = $error['u'];
                                    $show = "<h5 class='text-center alert alert-danger'>$sh</h5>";
                                } else {
                                    $show = "";
                                }
                                echo $show;
                                ?>
                            <label for="name">Email:</label><br>
                            <div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="name" class="form-control form-control-user" name="email" id="email" placeholder="eg. Ben001@gmail.com..." required>
                                </div><br>
                                <input class="btn btn-primary" type="submit" name="change">
                            </div>
                        </div>




                    </form>


                </div>
                <h4></h4>
            </div>
        </div>

</body>

</html>