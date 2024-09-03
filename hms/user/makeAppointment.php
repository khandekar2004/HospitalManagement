<!DOCTYPE html>

<head>
	<title>HMS |MAKE APPOINTMENT</title>

</head>

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
<?php
session_start();

include('../include/connection.php');
$user = $_SESSION['user'];
                                    $qry = "SELECT * FROM user WHERE username = '$user';";
                                    $result = mysqli_query($connect, $qry);
                                    while($row = mysqli_fetch_array($result)){
                                        $id = $row['id'];}
        $query = "SELECT * FROM appointment WHERE userId = '$id';";
                                    $res = mysqli_query($connect, $query);
if (isset($_POST['submit'])) {
	$name = $_POST['patientname'];
	$specilization = $_POST['DoctorSpecialization'];
	$doctorid = $_POST['doctor'];
	$userid = $id;
	$fees = $_POST['fees'];
	$appdate = $_POST['date'];
	$session = $_POST['session'];
	$type = $_POST['type'];
	$messege = 'Please Wait!';
	$userstatus = 1;
	$docstatus = 1;
	$conf = mysqli_query($connect,"SELECT * FROM appointment WHERE (name='$name' AND userId='$userid')");

    if (mysqli_num_rows($conf) > 0) {
		echo "<script>toastr.error('Appointment Already Booked With This Name!','Error!',);</script>";
	} else {
	$query = mysqli_query($connect, "insert into appointment(name,doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,session,messege,type) values('$name','$specilization','$doctorid','$userid','$fees','$appdate','$session','$messege','$type')");
	if ($query) {
		echo "<script>toastr.success('Appoitment Booked!','Success!',);
		setTimeout(function() {
			window.location.href = 'AppointmentHist.php';
		  }, 1000);</script>";
	} else {
		echo " <script>toastr.error('Something Went Wrong,Try Again Later!','Error!',);</script>";}
}
}
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
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

	/* var today = new Date().toISOString().split('T')[0];
  document.getElementById("appdate").setAttribute("min", today);
  const nextWeek = new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000);
const formattedDate = nextWeek.toISOString().slice(0, 10);
document.getElementById("appdate").setAttribute("max", formattedDate);9*/
	var currentDate = new Date();
	var maxDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() + 7);

	// Format the max date as yyyy-mm-dd
	var maxDateString = maxDate.toISOString().slice(0, 10);

	// Set the max attribute of the date input field
	document.getElementById("appdate").setAttribute("max", maxDateString);
</script>
<script>
	function getfee(val) {
		$.ajax({
			type: "POST",
			url: "get_doctor.php",
			data: 'doctor=' + val,
			success: function(data) {
				$("#fees").html(data);
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
								<?php 
								$ret=mysqli_query($connect,"select * from tblpage where PageType='contactus' ");
								while ($row=mysqli_fetch_array($ret)) {
								?>
								
						<p class=""></p>Hospital Timing : <?php  echo $row['OpenningTime'];}?></p>

								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Make Appointment</h1>
								</div>
								<form role="form" name="book" method="post">
									<div class="form-group">
										<label for="name">
											Patient Name
										</label>
										<input type="text" class="form-control" name="patientname" id="patientname" required="required">

									</div>



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
										<select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="true">
											<option value="">Select Doctor</option>
										</select>
									</div>
									<div class="form-group">
										<label for="consultancyfees">
											consultancy Fees
										</label>
										<select name="fees" class="form-control" id="fees" readonly>
										</select>
									</div>	

									<div class="form-group">
										<label for="session">
											Time
										</label>
										<select name="session" class="form-control" id="session" required="true">
												<option value="" >Select Timing</option>
												<option value="Morning">Morning</option>
												<option value="Afternoon">Afternoon</option>
												<option value="Evening">Evening</option>
												<option value="Night">Night</option>
										</select>
									</div>

									<div class="form-group">
										<label for="AppointmentDate">
											Date
										</label>
										<input type="date" id="date-input" class="form-control datepicker" name="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 week')); ?>" required="required" data-date-format="yyyy-mm-dd">

									</div>
									<div class="form-group">
										<label for="session">
											Appointment Type
										</label>
										<select name="type" class="form-control" id="type" required="true">
												<option value="" >Select Appointment Type</option>
												<option value="physical">Physical Appoitment</option>
												<option value="virtual">Virtual Appointment</option>
												
										</select>
									</div>
									
									<button type="submit" name="submit" class="btn btn-o btn-success">
										Submit
									</button>
								</form>
							</div>
					</div>
				</div>

			</div>
		</div>

	</div>
	</div>

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
<script src="form-elements.js"></script>
<script>
	jQuery(document).ready(function() {
		Main.init();
		FormElements.init();
	});

	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		startDate: '-3d'
	});
</script>
<script type="text/javascript">
	$('#timepicker1').timepicker();
</script>
<style>
	.redc {
		color: red;
	}
</style>

</html>