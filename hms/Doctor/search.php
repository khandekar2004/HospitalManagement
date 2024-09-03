<?php
session_start();
if (!isset($_SESSION['doc'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<style>
    .fa{
        color:#1cc88a;
    }
</style>
<!DOCTYPE html>
<html>
    <head><title>HMS | SEARCH</title></head>
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
    <h1 class="h3 mb-0 text-gray-800">DOCTOR | MANAGE APPOINTMENT</h1>
   
</div>
<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Appointment</h6>
    </div>
    <div class="card-body">
    <div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" method="post" name="search">

										<div class="form-group">
											<label for="doctorname">
												Search by Name/Mobile No.
											</label>
											<input type="text" name="searchdata" id="searchdata" class="form-control" value="" required='true'>
										</div>

										<button type="submit" name="search" id="submit" class="btn btn-o btn-success">
											Search
										</button>
									</form>
									<?php
									if (isset($_POST['search'])) {

										$sdata = $_POST['searchdata'];
									?>
										<h4 align="center">Result against "<?php echo $sdata; ?>" keyword </h4>

										<table class="table table-hover" id="sample-table-1">
											<thead>
												<tr>
													<th class="center">#</th>
													<th>Patient Name</th>
													<th>Patient Contact Number</th>
													<th>Patient Gender </th>
													<th>Creation Date </th>
													<th>Updation Date </th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
                                                $user = $_SESSION['doc'];
                                
                                                $qwr = mysqli_query($connect, "SELECT id FROM doctor where username ='$user'");
                                                $row=mysqli_fetch_array($qwr);
                                                $docId=$row['id'];
												$sql = mysqli_query($connect, "SELECT * from tblpatient where PatientName like '%$sdata%'AND Docid ='$docId'|| PatientContno like '%$sdata%' AND Docid ='$docId' ");
												$num = mysqli_num_rows($sql);
												if ($num > 0) {
													$cnt = 1;
													while ($row = mysqli_fetch_array($sql)) {
												?>
														<tr>
															<td class="center"><?php echo $cnt; ?>.</td>
															<td class="hidden-xs"><?php echo $row['PatientName']; ?></td>
															<td><?php echo $row['PatientContno']; ?></td>
															<td><?php echo $row['PatientGender']; ?></td>
															<td><?php echo $row['CreationDate']; ?></td>
															<td><?php echo $row['UpdationDate']; ?>
															</td>
															<td>

																<a href="ediPat.php?editid=<?php echo $row['ID']; ?>"><i class="fa fa-edit"></i></a> || <a href="view-patient.php?viewid=<?php echo $row['ID']; ?>"><i class="fa fa-eye"></i></a>

															</td>
														</tr>
													<?php
														$cnt = $cnt + 1;
													}
												} else { ?>
													<tr>
														<td colspan="8"> No record found against this search</td>

													</tr>

											<?php }
											} ?>
											</tbody>
										</table>
								</div>
							</div>
						</div>
					
    </div>
        <!-- /.container-fluid -->

    </div>
</body>

</html>