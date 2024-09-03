<!DOCTYPE html>

<head>
    <title>HMS | ADD PATIENT</title>
    <link rel="stylesheet" href="./toaster/css/toastr.min.css">
    <style>
        #toast-container > .toast-error { background-color: #e74a3b !important; } 
 #toast-container > .toast-success { background-color: #1cc88a !important; }
    </style>
</head>
<?php
session_start();
if (!isset($_SESSION['lab'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>



<script>
    function validateEmail(val) {
        $.ajax({
            type: "POST",
            url: "validate_email.php",
            data: 'email=' + val,
            success: function(data) {
                $("#doctor").html(data);
            }
        });
    }

    function validatePass(val) {
        $.ajax({
            type: "POST",
            url: "validate_email.php",
            data: 'password=' + val,
            success: function(data) {
                $("#showpass").html(data);
            }
        });
    }
</script>
<script src="toaster/js/jquery.js"></script>
<script src="toaster/js/toastr.min.js"></script>
<script src="toaster/toastr.js"></script>

<body id="page-top">

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
                                $lab = $_SESSION['lab'];

                                $qwr = mysqli_query($connect, "SELECT id FROM lab where labno ='$lab'");
                                $row = mysqli_fetch_array($qwr);
                                $labId = $row['id'];

                                if (isset($_POST['submit'])) {

                                    
                                    
                                    $patname = $_POST['patname'];
                                    $patcontact = $_POST['patcontact'];
                                    $patemail = $_POST['email'];
                                    $gender = $_POST['gender'];
                                    $pataddress = $_POST['pataddress'];
                                    $patage = $_POST['patage'];
                                    $medhis = $_POST['medhis'];
                                    $error = array();
                                    if (filter_var($patemail,FILTER_VALIDATE_EMAIL)===false){
                                        $error['u'] = "Please Enter Valid Email Address";

                                    }
                                    
                                                  // Initialize cURL.
                                                  $ch = curl_init();
                                    
                                                  // Set the URL that you want to GET by using the CURLOPT_URL option.
                                                  curl_setopt($ch, CURLOPT_URL, "https://emailvalidation.abstractapi.com/v1/?api_key=a63f55916a33471db5cd7a4bd3436378&email=$patemail");
                                    
                                                  // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
                                                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    
                                                  // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
                                                  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                                    
                                                  // Execute the request.
                                    
                                                  $response = curl_exec($ch);
                                    
                                                  // Close the cURL handle.
                                                  curl_close($ch);
                                                  $data = json_decode($response, true);
                                                 
                                                  if($data['deliverability']==="UNDELIVERABLE"){
                                                    $error['u'] = "Please Enter Valid Email Address";

                                                  }
                                    
                                                  else if($data["is_disposable_email"]["value"]===true){
                                                    $error['u'] = "Please Enter Valid Email Address";
                                                    
                                                  }else{
                                    $sql = mysqli_query($connect, "insert into labpatient(Labid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) values('$labId','$patname','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis')");
                                    if ($sql) {
                                    echo "<script>toastr.success('Patient Added Successfully!','Success',)  </script>";
                                    
                                    }else {
                                        echo "<script>toastr.error('Something Went Wrong!','Error!',)</script>";

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
                            
                                }

                                ?>






                                <form role="form" name="" method="post">

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
                                        <input type="text" name="patcontact" class="form-control" placeholder="Enter Patient Contact no" required="true" maxlength="10" pattern="[0-9]{10,11}">
                                    </div>
                                    <div class="form-group">
                                        <label for="fess">
                                            Patient Email <span style="color:red;" id="doctor"></span>
                                        </label>
                                        <input type="email" id="email" name="email" class="form-control" onChange="validateEmail(this.value);" placeholder="Enter Patient Email id" required="true" onBlur="userAvailability()">
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
                                            <input type="radio" id="rg-male" name="gender" value="male">
                                            <label for="rg-male">
                                                Transgender
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