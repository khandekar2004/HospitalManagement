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
<script>
	function getdoctor(val) {
		$.ajax({
			type: "POST",
			url: "get_doctor.php",
			data: 'specilizationid=' + val,
			success: function(data) {
				$("#doctor").html(data);
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
                                $user = $_SESSION['rec'];
                                
                                
                                
                                if (isset($_POST['submit'])) {
                                    
                                    
                                

                                    $patname = $_POST['patname'];
                                    $patcontact = $_POST['patcontact'];
                                    $patemail = $_POST['patemail'];
                                    $gender = $_POST['gender'];
                                    $pataddress = $_POST['pataddress'];
                                    $patage = $_POST['patage'];
                                    $medhis = $_POST['medhis'];
                                    $doctorid = $_POST['doctor'];                               
                                    
                                    $error = array();
                                    $sql = mysqli_query($connect, "insert into tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) values('$doctorid','$patname','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis')");
                                    if ($sql) {
                                        echo "<script>alert('Patient info added Successfully');</script>";
                                        header('location:add-patient.php');
                                    }else {
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
                                
                                
                                
                                
                                
                               
                                <form role="form" name="" method="post">

                                
									<div class="form-group">
										<label for="DoctorSpecialization">
											Doctor Specialization
										</label>
										<select name="DoctorSpecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
											<option value="">Select Specialization</option>
											<?php $ret = mysqli_query($connect, "select * from specialization");
											while ($row = mysqli_fetch_array($ret)) {
											?>
												<option value="<?php echo htmlentities($row['specialization']); ?>">
													<?php echo htmlentities($row['specialization']); ?>
												</option>
											<?php } ?>

										</select>
									</div>
                                    
                                <div class="form-group">
										<label for="doctor">
											Doctors
										</label>
										<select name="doctor" class="form-control" id="doctor" required="true">
											<option value="">Select Doctor</option>
										</select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="doctorname">
                                            Patient Name
                                        </label>
                                        <input type="text" name="patname" class="form-control" placeholder="Enter Patient Name" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="fess">
                                            Patient Contact no
                                        </label>
                                        <input type="text" name="patcontact" class="form-control" placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]+">
                                    </div>
                                    <div class="form-group">
                                        <label for="fess">
                                            Patient Email
                                        </label>
                                        <input type="email" id="patemail" name="patemail" class="form-control" placeholder="Enter Patient Email id" required="true" onBlur="userAvailability()">
                                        <span id="user-availability-status1" style="font-size:12px;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="block">
                                            Gender
                                        </label>
                                        <div class="clip-radio radio-success">
                                            <input type="radio" id="rg-female" name="gender" value="female">
                                            <label for="rg-female">
                                                Female
                                            </label>
                                            <input type="radio" id="rg-male" name="gender" value="male">
                                            <label for="rg-male">
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">
                                            Patient Address
                                        </label>
                                        <textarea name="pataddress" class="form-control" placeholder="Enter Patient Address" required="true"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fess">
                                            Patient Age
                                        </label>
                                        <input type="text" name="patage" class="form-control" placeholder="Enter Patient Age" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="fess">
                                            Medical History
                                        </label>
                                        <textarea type="text" name="medhis" class="form-control" placeholder="Enter Patient Medical History(if any)" required="true"></textarea>
                                    </div>

                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-success">
                                        Add
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