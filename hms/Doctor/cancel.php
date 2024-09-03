<?php
session_start();
include('../include/connection.php')
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
  include('./sidenav.php');
  include('../include/header.php');
        $ad = $_SESSION['doc'];

        ?>
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Cancel appointment</h6>

                </div>
                <div class="card-body">
                    <div class="text-center">


                        <?php
                        ?>
                    </div>
                    <form method="post">
                     
                        <label>Any messege :</label>
                        
                          <textarea name='messege' placeholder='Messege' rows='6' cols='14' class='form-control wd-450' required ></textarea>
                        
                     </br>
                     <?php
                     $cid = $_GET['id'];
                     echo"
                      <button class='btn btn-danger' onclick='confirsm($cid)'  >Cancel</button>"?>
                    </form>


                    


                        <?php

                       /* if (isset($_POST['change'])) {
                            $id = $_GET['id'];
                            $messege = $_POST['messege'];
                            $status = 'canceled';
                                $query = "UPDATE appointment SET  messege='$messege',status='$status' WHERE id='$id'";

                                $result = mysqli_query($connect, $query);

                                

                                if ($result) {
                                    
                                    echo "<script>window.location.href='./manageAppointment.php';</script>";
                                }
                            }*/
                        
                        ?>
                    </form>


                </div>
                <h4></h4>
            </div>
        </div>

</body>

</html>