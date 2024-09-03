<?php
session_start();
if (!isset($_SESSION['user'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>
    <head><title>HMS | MANAGE PATIENT</title></head>
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
    <h1 class="h3 mb-0 text-gray-800">View Patient</h1>
   
</div>
<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Patient</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
        $user = $_SESSION['user'];
        $qry = "SELECT * FROM user WHERE username = '$user';";
        $result = mysqli_query($connect, $qry);
        while($row = mysqli_fetch_array($result)){
            $pemail = $row['email'];
                                    $sql=mysqli_query($connect,"select * from labpatient where PatientEmail='$pemail' ");
                                    $cnt=1;
        }
                    $output ="
                    <table class='table table-hover table-bordered' id='dataTable'>
                    <thead>
                    <tr>
                    <th class='center'>#</th>
                    <th>Patient Name</th>
                    <th>Patient Contact Number</th>
                    <th>Patient Gender </th>
                    <th>Creation Date </th>
                    <th>Updation Date </th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    ";
                    while($row=mysqli_fetch_array($sql))
                    {   
                    $patName = $row['PatientName'];
                       $patCont = $row['PatientContno'];
                       $gender = $row['PatientGender'];
                       $cdate = $row['CreationDate'];
                       $udate =$row['UpdationDate'];
                       $patId=$row['ID'];
                    $output .="

                    
                    <tr>
                    <td class='center'>$cnt</td>
                    <td class='hidden-xs'>$patName</td>
                    <td>$patCont</td>
                    <td>$gender</td>
                    <td>$cdate</td>
                    <td>$udate
                    </td>
                    <td>
                    
                <a href='labvpat.php?viewid=$patId'><i class='fa fa-eye'></i></a> 
                    
                    </td>";
                    $cnt=$cnt+1;}
                    $output .="
                    </tr>
                     
                    
                     </tbody>
                    </table>";
            echo $output;
            
           

        
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