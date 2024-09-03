<?php
session_start();
if (!isset($_SESSION['user'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head>
    <title>HMS | Manage Appointment</title>
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <script src="sweet.js"></script>
    <style>
        #toast-container>.toast-error {
            background-color: #ffc107 !important;
        }

        #toast-container>.toast-success {
            background-color: #1cc88a !important;
        }

        #toast-container>.toast.warning {
            background-color: #ffc107 !important;
        }
    </style>
    <link rel="stylesheet" href="../toaster/css/toastr.min.css">

    <script src="../toaster/js/jquery.js"></script>
    <script src="../toaster/js/toastr.min.js"></script>
    <script src="../toaster/js/toastr.js"></script>
    <script>
        function confirsm(id) {
            Swal.fire({
                title: 'Do You Really Want To Cancel Appointment?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'remove.php?cid=' + id;
                }
            });
        }
    </script>
    <script>
        function toast() {
            toastr.error('Meeting is not ready', );
        }
        function unpaid() {
            toastr.error('Fees is unpaid', );
        }
    </script>
    <style>
        .danger {
            color: red;
        }

        .success {
            color: #1cc88a;
        }

        .un {
            color: gray;
        }
    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include('./sidenav.php');
        include('../include/header.php');
        ?>
        <div class="container-fluid">


            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manage Appointment</h1>

            </div>
            <p class="mb-4"> <a target="_blank"></a></p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Doctors</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $user = $_SESSION['user'];
                        $qry = "SELECT * FROM user WHERE username = '$user';";
                        $result = mysqli_query($connect, $qry);
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                        }
                        $query = "SELECT * FROM appointment WHERE userId = '$id';";
                        $res = mysqli_query($connect, $query);
                        $output = "
                    <table class='table table-bordered ' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        
                        <th>Name</th>
                        <th>Doctor</th>
                        <th>Specialization</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Messege</th>
                        <th>Action</th>
                        

                    </tr>
                </thead>
                <tbody>
            
                ";
                        if (mysqli_num_rows($res) < 1) {
                            $output .= "<tr><td colspan=8 class='text-center'>No Appointment</td></tr>";
                        }
                        while ($row = mysqli_fetch_array($res)) {
                            $id = $row['id'];
                            $date = $row['appointmentDate'];
                            $time = $row['appointmentTime'];
                            $special = $row['doctorSpecialization'];
                            $name = $row['name'];
                            $status = $row['status'];
                            $docid = $row['doctorId'];
                            $messege = $row['messege'];
                            $type = $row['type'];
                            $fee = $row['fee'];
                            $cfees = $row['consultancyFees'];
                            $feestat = $row['feestat'];
                            $qu  = mysqli_query($connect, "SELECT name FROM doctor WHERE id = '$docid'; ");
                            $rw = mysqli_fetch_array($qu);
                            $doc = $rw['name'];

                            if ($type == 'physical') {
                                $output .= "
                
                    <tr>
                        <td>$name</td>
                        <td>$doc</td>
                        <td>$special</td>
                        <td>$date</td>

                        
                        ";

                                if ($status == "canceled") {
                                    $output .= "
                            <td>-</td>
                        <td>$status</td>
                        <td>$messege</td><td><a href='AppointmentHist.php?id=$id&status=removed' ><i class=' danger fa fa-trash'></i></a>
                            </td>";
                                } elseif ($status == "Paid") {
                                    $output .= "
                            <td>$time</td>
                        <td>$status</td>
                        <td>-</td><td><a href='AppointmentHist.php?id=$id&status=removed'><i class='danger fa fa-trash'></i></a>
                            </td>";
                                } else {

                                    $output .= "
                            <td>$time</td>
                        <td>$status</td>
                        <td>$messege</td>
                        <td><a onclick='confirsm($id)' ><i class='danger fa fa-times'></i></a>
                            </td>";
                                }
                            } else {
                                $output .= "
                        <tr>
                        <td>$name</td>
                        <td>$doc</td>
                        <td>$special</td>
                        <td>$date</td>

                        
                        ";

                                if ($status == "canceled") {
                                    $output .= "
                            <td>-</td>
                        <td>$status</td>
                        <td>$messege</td><td><a href='AppointmentHist.php?id=$id&status=removed' ><i class=' danger fa fa-trash'></i></a>
                            </td>";
                                } elseif ($status == "Paid") {
                                    $output .= "
                            <td>$time</td>
                        <td>$status</td>
                        <td>-</td><td><a href='AppointmentHist.php?id=$id&status=removed' ><i class=' danger fa fa-trash'></i></a>
                        </td>";
                                } else {

                                    $output .= "
                            <td>$time</td>
                        <td>$status</td>
                        ";
                                    $vid = $row['vid'];
                                    if ($type == 'virtual') {
                                        if ($status != 'checked') {
                                            if (!empty($vid)) {

                                                $cname = openssl_encrypt($name, "AES-256-CBC", 'a1b2c3d4e5f6g7h8', 0, "1234567890abcdef");

                                                // Encode the ciphertext for safe transmission in a GET request
                                                $ecn = urlencode($cname);;
                                                $output .= "<td>$messege</td>

                                                <td>
                        <a href='./VIDEO/video?vid=$vid&nme=$ecn' ><i class='success fa fa-video'></i></a> || 
                        <i style='{text-color:red;}' onclick='confirsm($id)' class='danger fa fa-times'></i>
                        ";
                                            } else {
                                                $output .= "<td>$messege</td>

                                                <td>
                            <a onclick='toast()' ><i class='un fa fa-video'></i></a> ||
                            <i style='{text-color:red;}' onclick='confirsm($id)' class='danger fa fa-times'></i>
                            ";
                                            }
                                        }
                                    }
                                    $output .= "</td>";
                                }
                            }
                        }


                        $output .= "
                    </tr>
                </tbody>
            </table>";
                        echo $output;

                        if (isset($_REQUEST['id'])) {
                            $id = $_REQUEST['id'];
                            $state = $_REQUEST['status'];
                            if ($state == 'removed') {
                                # echo '<script> confirm("")</script>';
                                $query = "DELETE FROM appointment WHERE id = '$id' ";
                                $result = mysqli_query($connect, $query);
                            } elseif ($state == 'canceled') {
                                $query = "UPDATE appointment SET status = '$state' WHERE id = '$id' ";
                                $result = mysqli_query($connect, $query);
                            }


                            if ($result) {
                                echo "<script>alert('Appointment has been $state');
                    window.location.href='AppointmentHist.php';</script>";
                            } else {
                                echo "<script>alert('Something Went Wrong!')";
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../assets/js/demo/datatables-demo.js"></script>
    </div>


    <!-- Page level plugins -->


</body>

</html>