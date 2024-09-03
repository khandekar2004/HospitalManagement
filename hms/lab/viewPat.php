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

<head>
  <title>HMS | View PAtient</title>
  <script src="./nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    include('./sidenav.php');
    include('../include/header.php');
    if (isset($_POST['submit'])) {

      $vid = $_GET['viewid'];
      $bp = $_POST['bp'];
      $bs = $_POST['bs'];
      $weight = $_POST['weight'];
      $temp = $_POST['temp'];
      $pres = $_POST['pres'];


      $query = mysqli_query($connect, "insert labmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$vid','$bp','$bs','$weight','$temp','$pres')");
      if ($query) {
        echo '<script>alert("Medicle history has been added.")</script>';
        echo "<script>window.location.href ='managePat.php'</script>";
      } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
      }
    }
    ?>
    <div class="container-fluid">


      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">LAB | MANAGE PATIENT</h1>

      </div>
      <p class="mb-4"> <a target="_blank"></a></p>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-success">View Patient</h6>
        </div>

        <?php
        $vid = $_GET['viewid'];
        $ret = mysqli_query($connect, "select * from labpatient where ID='$vid'");
        $cnt = 1;
        while ($row = mysqli_fetch_array($ret)) {
          $name = $row['PatientName'];
          $email = $row['PatientEmail'];
          $contact = $row['PatientContno'];
          $address = $row['PatientAdd'];
          $gen = $row['PatientGender'];
          $age = $row['PatientAge'];
          $medhis = $row['PatientMedhis'];
          $cdate = $row['CreationDate'];

        $output ="
          <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
          <tr align=' center'>
            <td colspan='4' class='text-success' style='font-size:20px;'>
              Patient Details</td>
            </tr>

            <tr>
              <th scope>Patient Name</th>
              <td>$name</td>
              <th scope>Patient Email</th>
              <td> $email</td>
            </tr>
            <tr>
              <th scope>Patient Mobile Number</th>
              <td>$contact</td>
              <th>Patient Address</th>
              <td>$address</td>
            </tr>
            <tr>
              <th>Patient Gender</th>
              <td>$gen</td>
              <th>Patient Age</th>
              <td>$age </td>
            </tr>
            <tr>

              <th>Patient Medical History(if any)</th>
              <td>$medhis</td>
              <th>Patient Reg Date</th>
              <td>$cdate</td>
            </tr></table>
          ";
           }

          
          
          
          $output.="
          <table id='datatable' class='table table-bordered dt-responsive nowrap' style='border-collapse: collapse; border-spacing: 0; width: 100%;'>
            <tr align='center'>
              <th colspan='8'>Medical History</th>
            </tr>
            <tr>
              <th>#</th>
              <th>Test</th>
              <th>Report Date</th>
              <th>Charges</th>
              <th>Action</th>
              
              
            </tr>";
            $ret = mysqli_query($connect, "select * from labmedicalhistory  where PatientID='$vid'");
            while ($row = mysqli_fetch_array($ret)) {
              $rid=$row['ID'];
              $test = $row['labreport'];
              $date =  $row['CreationDate'];
              $charges = $row["charges"];


            $output .="
              <tr>
                <td>$cnt</td>
                <td>$test</td>
                <td>$date</td>
                <td>$charges</td>
                <td>
                <a href='vreport.php?viewid=$vid&rid=$rid'><i class='fa fa-eye'></i></a>
                </td>
                
              
              
              ";
              
             $cnt = $cnt + 1;
             
            } 
            $output.="</tr>
            </table>
            <p align='center'>
            <a href='addreport.php?viewid=$vid'><button class='btn btn-success waves-effect waves-light w-lg' data-toggle='modal' data-target='#fileModl'>Add Medical History</button></a>
          </p>";
            echo $output;
            

          
?>
          <?php  ?> <div class="row">
    <!--
          <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered table-hover ">

                    <form method="post" name="submit">


                      <tr >
                        <td>enter</td>
                        <td colspan='5'>
                       
                      
                    <label for="exampleInputEmail1">Page Description</label>
                    <div class="col-md-12">
                    <textarea class="form-control" name="pagedes" id="pagedes" rows="12" cols="10" style=" height:500px; padding:0; margin:0;"> </textarea>
                </div></td>
                      </tr>

                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="submit" class="btn btn-success">Submit</button>

                  </form>

                </div>
          -->
                <!-- /.container-fluid -->

              </div>
              
</body>

</html>