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
                    <h6 class="m-0 font-weight-bold text-primary">Change Username</h6>

                </div>
                <div class="card-body">
                    <div class="text-center">


                        <?php
                        echo "<h3 class='text-center text-gray-800'>$username</h3>"; ?>
                    </div>
                    <form method="post">
                        <div style="border:solid 2px gray; padding:20px; border-radius:10px 0">
                            <label for="name">Username:</label><br>
                            <div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="name" class="form-control form-control-user" name="uname" id="uname" placeholder="eg. Ben_admin" required>
                                </div><br>
                                <input class="btn btn-primary" type="submit" name="change">
                            </div>
                        </div>



                        <?php

                        if (isset($_POST['change'])) {
                            $uname = $_POST['uname'];

                            if (empty($uname)) {
                            } else {
                                $query = "UPDATE doctor SET username ='$uname' WHERE id='$id'";

                                $result = mysqli_query($connect, $query);

                                

                                if ($result) {
                            
                                    echo "<script>window.location.href='';</script>";
                                }
                            }
                        }
                        ?>
                    </form>


                </div>
                <h4></h4>
            </div>
        </div>

</body>

</html>