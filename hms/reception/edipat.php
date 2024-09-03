<!DOCTYPE html>

<head>
    <title>HMS | ADD PATIENT</title>
</head>
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

<head></head>

<body id="page-top">
<style>
        #toast-container>.toast-error {
            background-color: #e74a3b !important;
        }

        #toast-container>.toast-success {
            background-color: #1cc88a !important;
        }
    </style>

    <link rel="stylesheet" href="../toaster/css/toastr.min.css">

    <script src="../toaster/js/jquery.js"></script>
    <script src="../toaster/js/toastr.min.js"></script>
    <script src="toastr.css"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include('./sidenav.php');
        include('../include/header.php');
        ?>

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="container">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                        <form method="post" enctype="multipart/form-data">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Add Patient</h1>
                                </div>
                                <?php
                                

                                    

                                if (isset($_POST['submit'])) {

                                    $editid = $_GET['editid'];

                                    $patname = $_POST['patname'];
                                    $patcontact = $_POST['patcontact'];
                                    $patemail = $_POST['patemail'];
                                    $gender = $_POST['gender'];
                                    $pataddress = $_POST['pataddress'];
                                    $patage = $_POST['patage'];
                                    $medhis = $_POST['medhis'];
                                    $error = array();
                                    $sql = mysqli_query($connect, "UPDATE tblpatient set PatientName='$patname',PatientContno='$patcontact',PatientEmail='$patemail',PatientGender='$gender',PatientAdd='$pataddress',PatientAge='$patage',PatientMedhis='$medhis' where ID='$editid'");
                                    if ($sql) {
                                        echo "<script>toastr.success('Patient Datail Updated Successfully','Success!',);
                                        setTimeout(function() {
                                            window.location.href = 'managePat.php';
                                          }, 1000);</script>";
                                    } else {
                                        echo " <script>toastr.error('Something Went Wrong,Try Again Later!','Error!',);</script>";

                                        $error['u'] = "Something Went Wrong";
                                    }
                                    if (isset($error['u'])) {
                                        $sh = $error['u'];
                                        $show = "<h5 class='text-center alert alert-danger'>$sh</h5>";
                                    } else {
                                        $show = "";
                                    }
                                    echo $show;
                                }

                                ?>





                                <?php
                                $eid = $_GET['editid'];
                                $ret = mysqli_query($connect, "select * from tblpatient where ID='$eid'");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                ?>
                                    <form role="form" name="" method="post">

                                        <div class="form-group">
                                            <label for="doctorname">
                                                Patient Name
                                            </label>
                                            <input type="text" name="patname" class="form-control" value="<?php echo $row['PatientName']; ?>" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="fess">
                                                Patient Contact no
                                            </label>
                                            <input type="text" name="patcontact" class="form-control" value="<?php echo $row['PatientContno']; ?>" required="true" maxlength="10" pattern="[0-9]+">
                                        </div>
                                        <div class="form-group">
                                            <label for="fess">
                                                Patient Email
                                            </label>
                                            <input type="email" id="patemail" name="patemail" class="form-control" value="<?php echo $row['PatientEmail']; ?>" required="true" onBlur="userAvailability()">
                                            <span id="user-availability-status1" style="font-size:12px;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="block">
                                                Gender
                                            </label>

                                            <?php if ($row['PatientGender'] == "female") { ?>
                                                <div class="clip-radio radio-success">
                                                    <input type="radio" id="rg-female" name="gender" value="female" checked>
                                                    <label for="rg-female">
                                                        Female
                                                    </label>
                                                    <input type="radio" id="rg-male" name="gender" value="male">
                                                    <label for="rg-male">
                                                        Male
                                                    </label>
                                                    <input type="radio" id="rg-trans" name="transgender" value="transgender">
                                                    <label for="rg-trans">
                                                        Transgender
                                                    </label>
                                                </div><?php } elseif ($row['PatientGender'] == "male") { ?>
                                                <div class="clip-radio radio-success">
                                                    <input type="radio" id="rg-female" name="gender" value="female" checked>
                                                    <label for="rg-female">
                                                        Female
                                                    </label>
                                                    <input type="radio" id="rg-male" name="gender" value="male" checked>
                                                    <label for="rg-male">
                                                        Male
                                                    </label>
                                                    <input type="radio" id="rg-trans" name="transgender" value="transgender">
                                                    <label for="rg-trans">
                                                        Transgender
                                                    </label>
                                                </div><?php } else { ?>
                                                <div class="clip-radio radio-success">
                                                    <input type="radio" id="rg-female" name="gender" value="female" checked>
                                                    <label for="rg-female">
                                                        Female
                                                    </label>
                                                    <input type="radio" id="rg-male" name="gender" value="male" checked>
                                                    <label for="rg-male">
                                                        Male
                                                    </label>
                                                    <input type="radio" id="rg-trans" name="transgender" value="transgender">
                                                    <label for="rg-trans">
                                                        Transgender
                                                    </label>
                                                </div><?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">
                                                Patient Address
                                            </label>
                                            <textarea name="pataddress" class="form-control" placeholder="Enter Patient Address" required="true"><?php echo $row['PatientAdd']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="fess">
                                                Patient Age
                                            </label>
                                            <input type="text" name="patage" class="form-control" value="<?php echo $row['PatientAge']; ?>" placeholder="Enter Patient Age" required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="fess">
                                                Medical History
                                            </label>
                                            <textarea type="text" name="medhis" class="form-control" placeholder="Enter Patient Medical History(if any)"><?php echo $row['PatientMedhis']; ?></textarea>
                                        </div>
                                    <?php } ?>
                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-success">
                                        Update
                                    </button>
                                    </form>
                                    <hr>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
</body>
<style>
    .redc {
        color: red;
    }
</style>

</html>