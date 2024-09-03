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
    <head><title>HMS | MANAGE PATIENT</title></head>
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
    <h1 class="h3 mb-0 text-gray-800">Manage Patient</h1>
   
</div>
<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Doctors</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
       
                                    $sql=mysqli_query($connect,"select * from tblpatient ");
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
                    
                    <a href='edipat.php?editid=$patId'><i class='fa fa-edit'></i></a> || <a href='viewPat.php?viewid=$patId'><i class='fa fa-eye'></i></a>
                    
                    </td>";
                    $cnt=$cnt+1;}
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