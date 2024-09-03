<?php
session_start();
if (!isset($_SESSION['lab'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>
    <head><title>HMS | MANAGE PATIENT</title></head>
    <link rel="stylesheet" href="toaster/css/toastr.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="./nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

    <style> #toast-container > .toast-error { background-color: #e74a3b; } 
 #toast-container > .toast-success { background-color: #1cc88a }</style>
    <body id="page-top">
    <script>

function confirsm(id){
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
    window.location.href = 'remove.php?patId=' + id;
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
    <h1 class="h3 mb-0 text-gray-800">Manage Patient</h1>
   
</div>
<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Lab</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
        $lab = $_SESSION['lab'];
                                
        $qwr = mysqli_query($connect, "SELECT id FROM lab where labno ='$lab'");
        $row=mysqli_fetch_array($qwr);
        $labid=$row['id'];
                                    $sql=mysqli_query($connect,"select * from labpatient where labid='$labid' ");
                                    $cnt=1;
                                    
                    $output ="
                    <table class='table table-hover' id='sample-table-1'>
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
                    <tbody>

                    
                    <tr>
                    <td class='center'>$cnt</td>
                    <td class='hidden-xs'>$patName</td>
                    <td>$patCont</td>
                    <td>$gender</td>
                    <td>$cdate</td>
                    <td>$udate
                    </td>
                    <td>
                    
                    <a href='edipat.php?editid=$patId'><i class='fa fa-edit'></i></a> || <a href='viewPat.php?viewid=$patId'><i class='fa fa-eye'></i></a> || <i onclick='confirsm($patId)' class='fa fa-times fa fa-white'></i>
                    
                    </td>";
                    $cnt=$cnt+1;}
                    $output .="
                    </tr>
                     
                    
                     </tbody>
                    </table>";
            echo $output;?>
            <script src="toaster/js/jquery.js"></script>
    <script src="toaster/js/toastr.min.js"></script>
    <script src="toaster/toastr.js"></script>
            
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
    </body>
</html>