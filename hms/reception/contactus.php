<!DOCTYPE html>

<head>
    <title>HMS | Contact Us</title>
</head>
<body id="page-top">
<script src="./nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(nicEditors.allTextAreas);
</script>
<style>
    #toast-container>.toast-error {
        background-color: #e74a3b !important;
    }

    #toast-container>.toast-success {
        background-color: #1cc88a !important;
    }
</style>

<link rel="stylesheet" href="./toastr.min.css">

<script src="./toaster/js/jquery.js"></script>
<script src="./toaster/js/toastr.min.js"></script>
<script src="./toaster/toastr.js"></script>
<?php
session_start();
if (!isset($_SESSION['rec'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php');
if (isset($_POST['submit'])) {

    $pagetitle = $_POST['pagetitle'];
    $pagedes = $_POST['pagedes'];
    $email = $_POST['email'];
    $mobnum = $_POST['mobnum'];
    $query = mysqli_query($connect, "update tblpage set PageTitle='$pagetitle',PageDescription='$pagedes',Email='$email',MobileNumber='$mobnum' where  PageType='contactus'");
    if ($query) {
        echo "<script>toastr.success('ContactUs Page Updated Successfully','Success!',);</script>";
    } else {
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
                <h1 class="h3 mb-0 text-gray-800">Contact Us</h1>


            </div>

            <p class="mb-4"> <a target="_blank"></a></p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Admin | Update the Contact Us Content</h6>
                </div>
                <div class="container-fluid container-fullw bg-white">


                    <div class="row">
                        <div class="col-md-12">


                            <form class="forms-sample" method="post">
                                <?php

                                $ret = mysqli_query($connect, "select * from  tblpage where PageType='contactus'");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {

                                ?>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Page Title</label>
                                        <input id="pagetitle" name="pagetitle" type="text" class="form-control" required="true" value="<?php echo $row['PageTitle']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Page Description</label>
                                        <textarea class="form-control" name="pagedes" id="pagedes" rows="5"><?php echo $row['PageDescription']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Email Addresss</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $row['Email']; ?>" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Mobile Number</label>
                                        <input type="text" class="form-control" name="mobnum" value="<?php echo $row['MobileNumber']; ?>" required='true' maxlength="10" pattern='[0-9]+'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Time</label>
                                        <input type="text" class="form-control" name="optime" value="<?php echo $row['OpenningTime']; ?>" >
                                    </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-success mr-2" name="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>

</body>

</html>