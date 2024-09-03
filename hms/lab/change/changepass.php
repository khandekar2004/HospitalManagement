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
        $ad = $_SESSION['doc'];

        $query = "SELECT * FROM doctor WHERE username ='$ad'";

        $res = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_array($res)) {
            $username = $row['username'];
            $profiles = $row['profile'];
            $id = $row['id'];
            $password = $row['password'];
            $name = $row['name'];
        }
        ?>
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>

                </div>
                <div class="card-body">
                    <div class="text-center">


                        <?php
                        if (isset($_POST['change'])) {
                            $opass = $_POST['opass'];
                            $pass = $_POST['pass'];
                            $cpass = $_POST['cpass'];

                            $error = array();

                            if (empty($opass && $cpass && $pass )) {
                            } else if($password != $opass){
                                $error['u'] = "Wrong Password";

                                }else if($opass == $pass){
                                $error['u'] = "You Can't Set current Password As New Password";
                                    
                                }
                                else if($pass != $cpass){
                                    $error['u'] ="Confirm Password Doesn't Match To New Password"; 
                                   
                                    }
                                    else{
                                    $query = "UPDATE admin SET password ='$cpass' WHERE id='$id'";
                                $res = mysqli_query($connect, $query);
                                if($res){
                                    echo "<script>window.location.href='../profile.php'</script>";
                                }
                                    }
                                }
                        echo "<h3 class='text-center text-gray-800'>$name</h3>"; ?>
                    </div>
                    <form method="post">
                        <div style="border:solid 2px gray; padding:20px; border-radius:10px 0">
                        <?php if (isset($error['u'])) {
                                    $sh = $error['u'];
                                    $show = "<h5 class='text-center alert alert-danger'>$sh</h5>";
                                } else {
                                    $show = "";
                                }
                                echo $show;
                                ?>
                            <label for="pass">Password:</label><br>
                            <div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="opass" id="opass" placeholder="Old Password" required>
                                    <input type="password" class="form-control form-control-user" name="pass" id="pass" placeholder="New Password" required>
                                    <input type="password" class="form-control form-control-user" name="cpass" id="cpass" placeholder="Confirm Password" required>
                                </div><br>
                                <input class="btn btn-primary" type="submit" name="change">
                            </div>
                        </div>



                        <?php

                        
                                
/*
                                $result = mysqli_query($connect, $query);

                                $pic = $profile;

                                if ($result) {
                            
                                    echo "<script>window.location.href='../profile.php';</script>";*/
                                
                            
                        
                        ?>
                    </form>


                </div>
                <h4></h4>
            </div>
        </div>

</body>

</html>