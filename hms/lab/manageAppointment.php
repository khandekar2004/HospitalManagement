<?php
session_start();
if (!isset($_SESSION['doc'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>
    <head><title>HMS | Manage Appointment</title></head>
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
    <h1 class="h3 mb-0 text-gray-800">DOCTOR | MANAGE APPOINTMENT</h1>
   
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
                                  $user = $_SESSION['doc'];
                                
                                  $qwr = mysqli_query($connect, "SELECT id FROM doctor where username ='$user'");
                                  $row=mysqli_fetch_array($qwr);
                                  $docId=$row['id'];
        $query = "SELECT * FROM appointment WHERE doctorId = '$docId';";
                                    $res = mysqli_query($connect, $query);
                    $output ="
                    <table class='table ' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                ";
                if(mysqli_num_rows($res) < 1){
                    $output .= "<tr><td colspan=5 class='text-center'>No Appointment</tr></tr>";
                }
                while($row = mysqli_fetch_array($res)){
                    $id = $row['id'];
                    $date = $row['appointmentDate'];
                    $time = $row['appointmentTime'];
                    $special = $row['doctorSpecialization'];
                    $name = $row['name'];
                    $status =$row['status'];
                    $docid = $row['doctorId'];
                    $qu  =mysqli_query($connect,"SELECT name FROM doctor WHERE id = '$docid'; ");
                    $row=mysqli_fetch_array($qu);
            $doc = $row['name'];
                    $output .="
                <tbody>
                    <tr>
                        <td>$name</td>
                        <td>$date</td>
                        <td>$time</td>
                        <td>$status</td>
                        
                        <td>
                        <a href='manageAppointment.php?id=$id&status=approved'><i class='fa fa-pencil'></i><button id='$id' class='btn btn-success'>Approve</button></a>
                        <a href='manageAppointment.php?id=$id&status=canceled'><i class='fa fa-pencil'></i><button id='$id' class='btn btn-danger'>Cancel</button></a>
                        </td>";
                    }
                        $output .="
                    </tr>
                </tbody>
            </table>";
            echo $output;
            
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
        
            ?>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
    </body>
</html>