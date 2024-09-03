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
    <head><title>HMS | Doctor Specialization</title></head>
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="sweet.js"></script>

    <style>
    
    .fa{
        color:#1cc88a;
    }
    .fa-trash{
        color:#e74a3b;
    }
</style>
<script>

function confirsm(id){
    Swal.fire({
title: 'Do You Really Want To Remove?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, remove it!'
}).then((result) => {
if (result.isConfirmed) {
    window.location.href = 'remove.php?spId=' + id;
    }
  });
}</script>
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
    <h1 class="h3 mb-0 text-gray-800">Specialization</h1>
    <a href="addspecialization.php" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-plus-circle fa-sm text-white-50"></i> Add Specialization</a>
</div>
<p class="mb-4"> <a target="_blank"
        ></a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">specialization</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
                                    $ad = $_SESSION['admin'];
        $query = "SELECT * FROM specialization;";
                                    $res = mysqli_query($connect, $query);
                    $output ="
                    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Specialization</th>
                        <th>Creation Date</th>
                        <th>Updation Date</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                ";$cnt=0;
                if(mysqli_num_rows($res) < 1){
                    $output .= "<tr><td colspan=5 class='text-center'>No Specialization</tr></tr>";
                }
                while($row = mysqli_fetch_array($res)){
                    $id = $row['id'];
                    $special = $row['specialization'];
            $cdate = $row['creation_date'];
            $udate = $row['updation_date'];
            
            $cnt += 1;
                    $output .="
               
                    <tr>
                    
                        <td>$cnt</td>
                        <td>$special</td>
                        <td>$cdate</td>
                        <td>$udate</td>
                        <td>
                        
                    <a href='editspecial.php?id=$id'><i class='fa fa-edit'></i></a> || <i style='{text-color:red;}' onclick='confirsm($id)' class='fa fa-trash'></i>
                        
                        </td>";
                    
                    }
                        $output .="
                    </tr>
                </tbody>
            </table>";
            echo $output;
            
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