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
        $ad = $_SESSION['admin'];

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
                    <h6 class="m-0 font-weight-bold text-success">Approve Appointment</h6>

                </div>
                <div class="card-body">
                    <div class="text-center">


                        <?php
                        ?>
                    </div>
                    <form method="post">
                        <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Time :</label></div><div class="col-sm-3">
                            <select name="hour" class="form-control" required="true">
                                <?php
                                for ($hour = 1; $hour <= 12; $hour++) {
                                    echo "<option value=\"$hour\">$hour</option>";
                                }
                                ?>
                            </select></div><div class="col-sm-3">
                            <select name="minute" class="form-control" required="true">
                                <?php
                                for ($minute = 0; $minute <= 59; $minute++) {
                                    $paddedMinute = str_pad($minute, 2, '0', STR_PAD_LEFT);
                                    echo "<option value=\"$paddedMinute\">$paddedMinute</option>";
                                }
                                ?>
                            </select></div><div class="col-sm-3">
                            <select name="ampm" class="form-control" required="true">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select></div>
                        </div>
                        


                        <label>Any messege :</label>

                        <textarea name='messege' placeholder='Messege' rows='6' cols='14' class='form-control wd-450'></textarea>

                        </br>
                        <input class="btn btn-success" type="submit" name="change">
                    </form>





                    <?php

                    if (isset($_POST['change'])) {
                        
                        $hour = $_POST['hour']; 
                        $minute = $_POST['minute'];
                        $ampm = $_POST['ampm'];
                        $time = $hour . ':' . $minute . ' ' . $ampm;
                        $id = $_GET['id'];
                        $messege = $_POST['messege'];
                        $status = 'approved';
                        $query = "UPDATE appointment SET appointmentTime ='$time', messege='$messege',status='$status' WHERE id='$id'";

                        $result = mysqli_query($connect, $query);



                        if ($result) {

                            echo "<script>window.location.href='./manageAppointment.php';</script>";
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