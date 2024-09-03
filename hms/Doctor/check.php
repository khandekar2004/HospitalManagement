<?php
session_start();
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head>
    <title>HMS | Check</title>
</head>

<body id="page-top">
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
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
  include('./sidenav.php');
  include('../include/header.php');
        $ad = $_SESSION['doc'];

        $query = "SELECT * FROM admin WHERE username ='$ad'";

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
                    <h6 class="m-0 font-weight-bold text-primary">Check Status</h6>

                </div>
                <div class="card-body">
                <form method="post">
                    <div class="form-field">
                        <label>fees :</label>
                          <input type='number' name='fee' placeholder='Rs.' class='form-control wd-450' required='true'>
                          </div>

                        <div class="form-field">
                        <label for="feestat">Fee Status :</label>
                          <select type='text' name='feestat' placeholder='feestat' class='form-control wd-450' required='true'>
                            <option value="">Fee Status</option>
                            <option value="Paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                          </select>
                          </div>
                    
                    
                     
                        
                     </br>
                      <input class="btn btn-success" type="submit" name="change" >
                    </form>
                    </div>

                    


                        <?php

                        if (isset($_POST['change'])) {
                            $id = $_GET['id'];
                            $fee = $_POST['fee'];
                            $feestatus = $_POST['feestat'];
                            $status = 'checked';
                                $query = "UPDATE appointment SET  fee='$fee',feestat='$feestatus',status='$status' WHERE id='$id'";

                                $result = mysqli_query($connect, $query);

                                

                                if ($result) {
                                    
                                    
                                    echo "<script>toastr.success('Appointment Checked','Success!',);
                setTimeout(function() {
                    window.location.href = 'manageAppointment.php';
                  }, 1000);</script>";
                                } else {
                                   echo" <script>toastr.error('Something Went Wrong,Try Again Later!','Error!',);</script>";
                        }}
                        
                        ?>
                    </form>


                </div>
                <h4></h4>
            </div>
        </div>

</body>

</html>