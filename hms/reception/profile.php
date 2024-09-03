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
        include('./sidenav.php');
        include('../include/header.php');
        ?>
    <div class="col-lg-12 mb-4">

<!-- Illustrations -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Profile</h6>
        <div class="dropdown mb-4">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Change
                                        </button>
                                        <div class="dropdown-menu animated--fade-in"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="change/profilechange.php">Profile Picture</a>
                                            <a class="dropdown-item" href="change/namechange.php">Name</a>
                                            <a class="dropdown-item" href="change/unamechange.php">Username</a>
                                            <a class="dropdown-item" href="change/emailchange.php">Email</a>
                                            <a class="dropdown-item" href="change/changepass.php">Password</a>
                                        </div>
                                    </div>
                                  
    </div>
    <div class="card-body">
        <div class="text-center">

        </div>
        <div class="table-responsive">
        <?php
                                    $rec = $_SESSION['rec'];
                                    $query = "SELECT * FROM reception where username ='$rec'";
                                    $res = mysqli_query($connect, $query);
                    $output ="
                    
                ";
                if(mysqli_num_rows($res) < 1){
                    $output .= "<tr><td colspan=5 class='text-center'>No new admin</tr></tr>";
                }
                while($row = mysqli_fetch_array($res)){
                    $id = $row['id'];
                    $username = $row['username'];
                     $name = $row['name'];
                 $email = $row['email'];
            $profiles = $row['profile'];
            if(empty($profiles)) {
                $profiles = "saim.png";
            }
            $output .= "
            <div class='text-center'><img class='img-fluid px-4 px-sm-4 mt-3 mb-4 ' style='width: 10rem; border-radius:50%;'
            src='./img/$profiles' alt='...'></div>
                    <table class='table ' id='dataTable' width='' cellspacing='0' >
                
                <tbody>
                    <tr>
                        <td>Id</td>
                        <td>$id</td>
                        
                     </tr>
                     <tr>   
                        <td>Name</td>
                        <td>$name</td>
                        </tr>
                        <tr>
                        <td>Username</td>
                        <td>$username</td>
                
                        </tr>

                        <tr>
                        <td>Email</td>
                        <td>$email</td>
                        
                        </tr>
                        <tr><td></td><td></td></tr>";
                        
                        
                    }
                        $output .="
                    </tr>
                </tbody>
            </table>";
            echo $output;
            
            if(isset($_REQUEST['id'])){
                $id = $_REQUEST['id'];

                $query = "DELETE FROM admin WHERE id = '$id'";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>alert('Removed Successfully');
                    window.location.href='admin.php';</script>";

            } else {
                echo "<script>alert('Something Went Wrong!')";
                
            }
            }
            ?>
            <div class="col-lg-6">

            
        </div>
        <h4></h4>
    </div>
</div>

    </body>
</html>
