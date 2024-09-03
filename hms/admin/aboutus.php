<!DOCTYPE html>
<head><title>HMS | About Us</title></head>
<style>
    #toast-container > .toast-error { background-color: #e74a3b !important; } 
 #toast-container > .toast-success { background-color: #1cc88a !important; }
</style>

<link rel="stylesheet" href="./toastr.min.css">
<script src="./toaster/js/jquery.js"></script>
    <script src="./toaster/js/toastr.min.js"></script>
    <script src="toastr.css"></script>
    <body id="page-top">
 
<script src="./nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php');
if(isset($_POST['submit']))
  {
   
     $pagetitle=$_POST['pagetitle'];
$pagedes=$connect->real_escape_string($_POST['pagedes']);
     $query=mysqli_query($connect,"update tblpage set PageTitle='$pagetitle',PageDescription='$pagedes' where  PageType='aboutus'");
    if ($query) {
 
        echo "<script>toastr.success('About Us Updated   Successfully','Success!',)</script>";
        
  }
  else
    {
      echo '<script>toastr.error("Something Went Wrong. Please try again.","Error!",)</script>';
    }
  
}


?>



<!-- Page Wrapper -->
<div id="wrapper">
        
        <?php
        include('./sidenav.php');
        include('../include/header.php');
        ?>
        <div class="container-fluid">
            

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">About Us</h1>
    
    
</div>

<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Admin  | Update the About us Content</h6>
    </div>
    <div class="container-fluid container-fullw bg-white">


<div class="row">
    <div class="col-md-12">


        <form class="forms-sample" method="post">
            <?php

            $ret = mysqli_query($connect, "select * from  tblpage where PageType='aboutus'");
            $cnt = 1;
            while ($row = mysqli_fetch_array($ret)) {

            ?>
                <div class="form-group">
                    <label for="exampleInputUsername1">Page Title</label>
                    <input id="pagetitle" name="pagetitle" type="text" class="form-control" required="true" value="<?php echo $row['PageTitle']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Page Description</label>
                    <textarea class="form-control" name="pagedes" id="pagedes" rows="12"><?php echo $row['PageDescription']; ?></textarea>
                </div>

            <?php } ?>
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