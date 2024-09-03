<?php
session_start();
if (!isset($_SESSION['admin'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>
    <head><title>HMS | Manage Appointment</title></head>
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
        
        <?php
        include('./sidenav.php');
        include('../include/header.php');
        ?>
        <div class="container-fluid">
            

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Appointment</h1>
   
</div>
<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Appointment</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
                                    $ad = $_SESSION['admin'];
        $query = "SELECT * FROM appointment;";
                                    $res = mysqli_query($connect, $query);
                    $output ="
                    <table class='table table-bordered ' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        
                        <th>Name</th>
                        <th>Doctor</th>
                        <th>Specialization</th>
                        <th>Date</th>
                        <th>Session</th>
                        <th>Time</th>
                        <th>Status</th>
                        

                    </tr>
                </thead>
                <tbody>
                ";
                if(mysqli_num_rows($res) < 1){
                    $output .= "<tr><td colspan=5 class='text-center'>No Appointment</tr></tr>";
                }
                while($row = mysqli_fetch_array($res)){
                    $id = $row['id'];
                    $date = $row['appointmentDate'];
                    $time = $row['appointmentTime'];
                    $special = $row['doctorSpecialization'];
                    $session = $row['session'];
                    $name = $row['name'];
                    $status =$row['status'];
                    $docid = $row['doctorId'];
                    $qu  =mysqli_query($connect,"SELECT * FROM doctor WHERE id = '$docid' ");
                    $rs=mysqli_fetch_assoc($qu);
                    $doc = $rs['name'];
                    
                    $output .="
                    <tr>
                        <td>$name</td>
                        <td>$doc</td>
                        <td>$special</td>
                        <td>$date</td>
                        <td>$session</td>
                        <td>$time</td>
                        <td>$status</td>
                        ";?>
                        <?php
                        
                        
                    
                }
                        $output .="
                    
                </tbody>
            </table>
            ";
            
            echo $output;?>
          

                </div>
            <?php
            if(isset($_REQUEST['id'])){
                $id = $_REQUEST['id'];
                $state = $_REQUEST['status'];
                
                $query = "UPDATE appointment SET `status` = '$state' WHERE id = '$id' ";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>alert('Appointment has been $state');
                    window.location.href='manageAppointment.php';</script>";

            } else {
                echo "<script>alert('Something Went Wrong!')";
                
            }
            }
            if(isset($_REQUEST['approve'])){
                $id = $_REQUEST['id'];
                $state = $_REQUEST['status'];
                
                $query = "UPDATE appointment SET `status` = '$state' WHERE id = '$id' ";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>alert('Appointment has been $state');
                    window.location.href='manageAppointment.php';</script>";

            } else {
                echo "<script>alert('Something Went Wrong!')";
                
            }
            }
            ?>
           
        </div>
    </div>
</div>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>
</div>
<!-- /.container-fluid -->

</div>
    </body>
</html>