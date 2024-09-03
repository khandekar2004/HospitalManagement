<!DOCTYPE html>
<head><title>HMS | About Us</title></head>
<script src="./nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php');
if(isset($_POST['submit']))
  {
   $patid = $_GET['viewid'];
     $ail = $_POST['test'];    
$report=$_POST['report'];
     $query=mysqli_query($connect,"INSERT INTO `labmedicalhistory`( `PatientID`, `MedicalPres`, `labreport`) VALUES ('$patid','$ail','$report')");
    if ($query) {
 
    echo '<script>alert("About Us has been updated.")</script>';
  }
  else
    {
      echo "<script>alert(' Something Went Wrong. Please try again.')</script>";
    }
  
}


?>


    <body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
        
        <?php
        include('./sidenav.php');
        include('../include/header.php');
        ?>
        <div class="container-fluid">
        <div class="container">
            

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Report</h1>
    
    
</div>
    
<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->

                
<?php
$repoid = $_GET['rid'];
$ret=mysqli_query($connect,"select * from labmedicalhistory where ID=$repoid  ");
while ($row=mysqli_fetch_array($ret)) {
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Lab  | <?php  echo $row['labreport'];?></h6>
    </div>
    <div class="container-fluid container-fullw bg-white">
            </div>
            <div style="padding-left: 50px;">
<h3></h3>
    <p><?php  echo $row['MedicalPres'];?>.</p><?php } ?>
   
    </div>
<!-- /.container-fluid -->

</div>

    </body>
</html>