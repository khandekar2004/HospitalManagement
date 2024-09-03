<?php
session_start();
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>
    <head><title>PROFILE</title></head>
    <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php
        include('sidenav.php');
        include('../include/header.php');
        $user = $_SESSION['user'];

                    $query = "SELECT * FROM user WHERE username ='$user'";

                    $res = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($res)) {
        $username = $row['username'];
        $profiles = $row['profile'];
        $id = $row['id'];
        $password = $row['password'];
    }
        ?>
    <div class="col-lg-12 mb-4">

<!-- Illustrations -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Change Profile Picture</h6>
                                  
    </div>
    <div class="card-body">
        <div class="text-center">
        

<?php
            echo"<img class='img-fluid px-4 px-sm-4 mt-3 mb-4' style='width: 10rem; border-radius:50%;'
                src='./img/$profiles' alt='...'>"; ?>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div style="border:solid 2px gray; padding:20px; border-radius:10px 0">
            <label>Picture:</label><br>
            <div >
            <input type="file" name="profile" id="profile" ><br><br>
            <input class="btn btn-primary" type="submit" name="change">
            </div>
            </div>
           

   
                <?php

                if (isset($_POST['change'])) {
                    $profile = $_FILES['profile']['name'];
                
                    if (empty($profile)) {
                    } else {
                        $query = "UPDATE user SET profile ='$profile' WHERE id='$id'";
                
                        $result = mysqli_query($connect, $query);
                
                        $pic = $profile;
                
                        if ($result) {
                            move_uploaded_file($_FILES['profile']['tmp_name'], "./img/$profile");
                            echo "<script>window.alert('Updated Successfully')
                            window.location.href='./profile.php';</script>";

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
