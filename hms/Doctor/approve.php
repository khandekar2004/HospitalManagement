<?php
session_start();
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head>
    <title>HMS | Approve Appointment</title>
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
        $aid = $_GET['id'];
       $q = "SELECT * FROM appointment WHERE id = '$aid';";
       $res = mysqli_query($connect, $q);
       while($row = mysqli_fetch_array($res)){
        $type = $row['type'];
        ?>
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Approve Appointment</h6>

                </div>
                <div class="card-body">
                    <div class="text-center">


                        <?php

                        ?>
                    </div>
                    <form method="post">
                    <div class="form-field">
                    <label>Type :</label>
                          <input type='text' name='type' placeholder='type' value="<?php echo$type;}?>" class='form-control wd-450'  readonly>
                          </div>
                        <label>Time :</label>
                          <input type='time' name='time' placeholder='time' class='form-control wd-450' required='true'>
                          </div>

                     
                        <label>Any messege :</label>
                        
                          <textarea name='messege' placeholder='Messege' rows='6' cols='14' class='form-control wd-450' ></textarea>
                        
                     </br>
                      <input class="btn btn-success" type="submit" name="change" >
                    </form>


                    


                        <?php

                        if (isset($_POST['change'])) {
                            $time = $_POST['time'];
                            $id = $_GET['id'];
                            $messege = $_POST['messege'];
                            $status = 'approved';
                                $query = "UPDATE appointment SET appointmentTime ='$time', messege='$messege',status='$status' WHERE id='$id'";

                                $result = mysqli_query($connect, $query);

                                

                                if ($result) {
                                    
                                    
                                        echo "<script>toastr.success('Appointment Approved Successfully','Success!',);
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