<?php
if (!isset($_SESSION['admin'])) {
    include('../include/404.php');
    die();
}
include('../include/connection.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <title>HMS</title>

    <!-- Custom fonts for this template-->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">



        <?php
        include('./sidenav.php');
        include('../include/header.php'); ?>
        <!-- End of Topbar -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="./profile.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-user fa-sm text-white-50"></i> View Profile</a>
            </div>
            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Admin</div>
                                    <?php
                                    $ad = mysqli_query($connect, "SELECT * FROM admin");

                                    $num = mysqli_num_rows($ad);
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $num ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users-cog fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Doctor</div>
                                    <?php
                                    $ad = mysqli_query($connect, "SELECT * FROM doctor");

                                    $dnum = mysqli_num_rows($ad);
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $dnum ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-md fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Lab</div>
                                    <?php
                                    $ad = mysqli_query($connect, "SELECT * FROM lab");

                                    $num = mysqli_num_rows($ad);
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $num ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-flask fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    EARNINGS (Daily)</div>
                                    <?php
                                    // Assuming you have already established a database connection

                                    // Get the current date
                                    $currentDate = date('Y-m-d');
                                   /* $today = new DateTime();

// Add one day to today's date
$nextDay = $today->modify('+1 day');

// Format the date as desired
$currentDate = $nextDay->format('Y-m-d');*/

                                    // Prepare the SQL query to retrieve the income for the current date
                                    $query = "SELECT SUM(rs) AS daily_income FROM income WHERE DATE(date) = '$currentDate'";

                                    // Execute the query
                                    $result = mysqli_query($connect, $query);

                                    // Check if the query was successful
                                    if ($result) {
                                        // Fetch the result row
                                        $row = mysqli_fetch_assoc($result);

                                        // Get the daily income value
                                        $dailyIncome = $row['daily_income'];
                                        if($dailyIncome == ''){
                                            echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>Rs " . 0 ." /-</div></div>" ;
                                          }else{

                                        // Display the daily income
                                        echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>Rs $dailyIncome /-</div>
                                        </div>";}
                                    } else {
                                        // Display an error message if the query fails
                                        echo "Failed to retrieve daily income: " . mysqli_error($connect);
                                    }

                                    // Close the database connection
                                    mysqli_close($connect);
                                    ?>
                                    
                                    
                                <div class="col-auto">
                                    <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


</body>

</html>