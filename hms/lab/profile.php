<?php
    session_start();
if (!isset($_SESSION['lab'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php');
$lab = $_SESSION['lab'];
$q = "SELECT * FROM lab WHERE labno = '$lab'";
$res = mysqli_query($connect,$q);
while($row = mysqli_fetch_array($res)){
    $id = $row['id'];}
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
                                            <a class="dropdown-item" href="profilechange.php">Profile Picture</a>
                                            <a class="dropdown-item" href="editDoctor">Details</a>
                                            
                                        </div>
                                    </div>
                                  
    </div>
    <div class="card-body">
        <div class="text-center">

        </div>
        <div class="table-responsive">
        <?php
                                    $ad = $_SESSION['lab'];
                                    $query = "SELECT * FROM lab where labno ='$ad'";
                                    $res = mysqli_query($connect, $query);
                    $output ="
                    
                ";
                if(mysqli_num_rows($res) < 1){
                    $output .= "<tr><td colspan=5 class='text-center'>No new admin</tr></tr>";
                }
                while($row = mysqli_fetch_array($res)){
                    $id = $row['id'];
                    $labno = $row['labno'];
                     $name = $row['name'];
                 $email = $row['email'];
            $profiles = $row['profile'];
            if(empty($profiles)) {
                $profiles = "doctor-1.jpg";
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
                        <td>$labno</td>
                
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
