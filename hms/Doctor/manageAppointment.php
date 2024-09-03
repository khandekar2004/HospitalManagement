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
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
    #toast-container > .toast-error { background-color: #e74a3b !important; } 
 #toast-container > .toast-success { background-color: #1cc88a !important; }
 .danger{
    color:red;
 }
 .success{
            color:#1cc88a;
        }
</style>

<link rel="stylesheet" href="./toastr.min.css">

 <script src="./toaster/js/jquery.js"></script>
    <script src="./toaster/js/toastr.min.js"></script>
    <script src="toastr.css"></script>
    <body id="page-top">
    <script src="sweet.js"></script>
<script>function confirsm(id){
    Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, remove it!'
}).then((result) => {
if (result.isConfirmed) {
    window.location.href = 'remove.php?cid=' + id;
    }
  });
}
</script>

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
                                    $ad = $_SESSION['doc'];
                                    $id = $_SESSION['id'];
        $query = "SELECT * FROM appointment WHERE `doctorId`=$id AND `status`='approved' OR `doctorId`=$id AND  `status` = 'pending';";
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
                    $output .= "<tr><td colspan=8 class='text-center'>No Appointment</tr></tr>";
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
                    $type = $row['type'];
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
                            if ($type == 'virtual'){
                          $output .= "<td>
                          <a href='check.php?id=$id'><i class='success fas fa-clipboard-check'></i></a> ||
                          <a href='./VIDEO/video/index.php?appid=$id' target='_blank'><i class='success fa fa-video'>+</i></a> ||
                          <i  onclick='confirsm($id)' class='danger fa fa-times'></i>
                          </td>";}
                          else{
                            $output .= "<td>
                          <a href='check.php?id=$id'><i class='success fas fa-clipboard-check'></i></a> ||    
                          
                          <a onclick='confirsm($id)'> <i class='danger fa fa-times'></i></a>
                          </td>";
                          }
                        }
                        elseif($status == "canceled"){
                          $output .="<td><a href='approve.php?id=$id'><i class='fa fa-user-check'></i><button id='$id' class='btn btn-success'>Approve</button></a>
                          </td>";
                        }
                        else{
                        $output.= "<td>
                        <a href='approve.php?id=$id'><i class='success fa fa-user-check'>Approve</i></a> ||
                        <i class=' danger fa fa-times'></i></a>
                        </td>";/*
                        
                        <!--
                        <td>
                        <a href='#' class='btn btn-info' data-toggle='modal' data-target='#exampleModal'>
                        <i class='fa fa-eye'></i></a>
                        <a href='#' class='btn btn-success' data-toggle='modal' data-target='#exampleModal2'>
                        <i class='fa fa-pencil'></i></a>
                        <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal3'>
                        <i class='fa fa-trash'></i></a>
                        </td>-->";*/}
                        
                    
                }
                        $output .="
                    </tr>
                </tbody>
            </table>
            ";
            
            echo $output;?>
          

                </div>
            <?php
           /* if(isset($_REQUEST['id'])){
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
            }*/
            ?>
           
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
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
    </body>
</html>