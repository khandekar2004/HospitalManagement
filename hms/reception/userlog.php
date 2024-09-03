<?php
session_start();
if (!isset($_SESSION['admin'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head>
    <title>HMS | Manage Appointment</title>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include('./sidenav.php');
        include('../include/header.php');
        ?>
        

            <!-- DataTales Example -->
            <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Logs</h1>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">View User Logs</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                        
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="hidden-xs">User id</th>
                                    <th>Username</th>
                                    <th>User IP</th>
                                    <th>Login time</th>
                                    <th>Logout Time </th>
                                    <th> Status </th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = mysqli_query($connect, "select * from userlog ");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>

                                    <tr>
                                        <td class="center"><?php echo $cnt; ?>.</td>
                                        <td class="hidden-xs"><?php echo $row['uid']; ?></td>
                                        <td class="hidden-xs"><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['userip']; ?></td>
                                        <td><?php echo $row['loginTime']; ?></td>
                                        <td><?php echo $row['logout']; ?>
                                        </td>

                                        <td>
                                            <?php if ($row['status'] == 1) {
                                                echo "Success";
                                            } else {
                                                echo "Failed";
                                            } ?>

                                        </td>

                                    </tr>

                                <?php
                                    $cnt = $cnt + 1;
                                } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
                $state = $_REQUEST['status'];

                $query = "UPDATE appointment SET `status` = '$state' WHERE id = '$id' ";
                $result = mysqli_query($connect, $query);
                if ($result) {
                    echo "<script>alert('Appointment has been $state');
                    window.location.href='manageAppointment.php';</script>";
                } else {
                    echo "<script>alert('Something Went Wrong!')";
                }
            }
            if (isset($_REQUEST['approve'])) {
                $id = $_REQUEST['id'];
                $state = $_REQUEST['status'];

                $query = "UPDATE appointment SET `status` = '$state' WHERE id = '$id' ";
                $result = mysqli_query($connect, $query);
                if ($result) {
                    echo "<script>alert('Appointment has been $state');
                    window.location.href='manageAppointment.php';</script>";
                } else {
                    echo "<script>alert('Something Went Wrong!')";
                }
            }
            ?>

        </div>
    </div>
    </div>
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
    <!-- /.container-fluid -->

    </div>
</body>

</html>