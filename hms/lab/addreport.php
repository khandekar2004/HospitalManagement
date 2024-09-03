<!DOCTYPE html>
<head><title>HMS | About Us</title></head>
<script src="./nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<?php
session_start();
if (!isset($_SESSION['lab'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php');
if(isset($_POST['submit']))
  {
   $patid = $_GET['viewid'];
     $ail = $_POST['test'];  
     $charge = $_POST['charge'];  
$report=$_POST['report'];
     $query=mysqli_query($connect,"INSERT INTO `labmedicalhistory`( `PatientID`, `MedicalPres`, `labreport`,`charges`) VALUES ('$patid','$report','$ail','$charge')");
    if ($query) {
 
    echo '<script>alert("About Us has been updated.")</script>';
  }
  else
    {
       $new = mysqli_error($connect);
      echo "<script>alert('$new')</script>";
    }
  
}


?>

<!DOCTYPE html>
<html>
    <head></head>
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
    <h1 class="h3 mb-0 text-gray-800">Report</h1>
    
    
</div>

<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Lab  | Add Patient Report</h6>
    </div>
    <div class="container-fluid container-fullw bg-white">


<div class="row">
    <div class="col-md-12">


        <form class="forms-sample" method="post">
           
                <div class="form-group">
                    <label for="exampleInputUsername1">Test</label>
                    <input id="test" name="test" type="text" class="form-control" required="true"  placeholder="eg.Sugar Test...">
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Charges</label>
                    <input id="charge" name="charge" type="number" class="form-control"   placeholder="Rs/-">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Add Report</label>
                    <textarea class="form-control" name="report" id="report" rows="12"placeholder="Add Details"></textarea>
                </div>

           
            <button type="submit" class="btn btn-success mr-2" name="submit">Submit</button>
        </form>
    </div>
</div>
</div>
    

</div>
<!-- /.container-fluid -->

</div>

    </body>
</html>