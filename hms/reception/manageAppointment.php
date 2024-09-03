<?php
session_start();
if (!isset($_SESSION['rec'])) {
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
                                    $rec = $_SESSION['rec'];
        $query = "SELECT * FROM appointment WHERE `status`='approved' OR   `status` = 'pending' OR   `status` = 'checked';";
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
                        <th>Action</th>

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
                    $row=mysqli_fetch_assoc($qu);
                    $doc = $row['name'];
                    
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
                        if ($status == 'approved') {
                          $output .= "<td><a href='manageAppointment.php?id=$id&status=canceled'><i class='fa fa-pencil'></i><button id='$id' class='btn btn-danger'>Cancel</button></a>
                        </td>";
                        }
                        elseif($status == "canceled"){
                          $output .="<td><a href='approve.php?id=$id'><i class='fa fa-pencil'></i><button id='$id' class='btn btn-success'>Approve</button></a>
                          </td>";
                        }
                        elseif($status == "checked"){
                            $output .="<td><a href='viewpay.php?aid=$id'><i class='fa fa-pencil'></i><button id='$id' class='btn btn-success'>Pay</button></a>
                            </td>";
                          }
                        else{
                        $output.= "<td>
                        <a href='approve.php?id=$id'><button id='$id' class='btn btn-success waves-effect waves-light w-lg' data-toggle='modal' data-target='#myModal'>Approve</button></a>
                        <a href='cancel.php?id=$id'><i class='fa fa-pencil'></i><button id='$id' class='btn btn-danger'>Cancel</button></a>
                        </td></tr>
                        
                        <!--
                        <td>
                        <a href='#' class='btn btn-info' data-toggle='modal' data-target='#exampleModal'>
                        <i class='fa fa-eye'></i></a>
                        <a href='#' class='btn btn-success' data-toggle='modal' data-target='#exampleModal2'>
                        <i class='fa fa-pencil'></i></a>
                        <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal3'>
                        <i class='fa fa-trash'></i></a>
                        </td>-->";}
                        
                    
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