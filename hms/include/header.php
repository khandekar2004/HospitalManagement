

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fas fa-hospital-alt"></i>
                </button>

                <!-- Topbar Navbar -->

                <?php
                

                if (isset($_SESSION['admin'])) {
                    $user = $_SESSION['admin'];
                    $query = "SELECT profile FROM admin WHERE username ='$user';";
                    $res = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($res)) {
                        $profiles = $row['profile'];
                    }
                    echo "
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                    <a onclick='goBack()' class='btn btn-danger btn-icon-split'>
                    <span class='icon text-red-600's>
                        <i class='fas fa-arrow-left'></i>
                    </span>
                    <span class='text'>Back</span>
                </a>
                    <ul class='navbar-nav ml-auto'>
                    <div class='topbar-divider d-none d-sm-block'></div>
                        <!-- Nav Item - User Information -->
                        <li class='nav-item dropdown no-arrow'>
                            <a class='nav-link dropdown-toggle' href='#' id='userDropdown' role='button'
                                data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <span class='mr-2 d-none d-lg-inline text-gray-600 small'>$user</span>
                                <img class='img-profile rounded-circle'
                                    src='../admin/img/$profiles'>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class='dropdown-menu dropdown-menu-right shadow animated--grow-in'
                                aria-labelledby='userDropdown'>
                                <a class='dropdown-item' href='../admin/profile.php'>
                                    <i class='fas fa-user fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Profile
                                </a><!--
                                <a class='dropdown-item' href='#'>
                                    <i class='fas fa-cogs fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Settings
                                </a>
                                <a class='dropdown-item' href='#'>
                                    <i class='fas fa-list fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Activity Log
                                </a>-->
                                <div class='dropdown-divider'></div>
                                <a class='dropdown-item' href='../../logout.php' >
                                    <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        ";
                } elseif (isset($_SESSION['doc'])) {
                    $doc = $_SESSION['doc'];
                    $query = "SELECT profile FROM doctor WHERE username ='$doc';";
                    $res = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($res)) {
                        $profiles = $row['profile'];
                    }

                    echo "
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                    <a onclick='goBack()' class='btn btn-danger btn-icon-split'>
                    <span class='icon text-red-600'>
                        <i class='fas fa-arrow-left'></i>
                    </span>
                    <span class='text'>Back</span>
                </a>
                        
                    <ul class='navbar-nav ml-auto'>
                    <div class='topbar-divider d-none d-sm-block'></div>
                        <!-- Nav Item - User Information -->
                        <li class='nav-item dropdown no-arrow'>
                            <a class='nav-link dropdown-toggle' href='#' id='userDropdown' role='button'
                                data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <span class='mr-2 d-none d-lg-inline text-gray-600 small'>$doc</span>
                                <img class='img-profile rounded-circle'
                                    src='../doctor/img/$profiles'>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class='dropdown-menu dropdown-menu-right shadow animated--grow-in'
                                aria-labelledby='userDropdown'>
                                <a class='dropdown-item' href='../doctor/profile.php'>
                                    <i class='fas fa-user fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Profile
                                </a><!--
                                <a class='dropdown-item' href='#'>
                                    <i class='fas fa-cogs fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Settings
                                </a>
                                <a class='dropdown-item' href='#'>
                                    <i class='fas fa-list fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Activity Log
                                </a>-->
                                <div class='dropdown-divider'></div>
                                <a class='dropdown-item' href='../../logout.php' >
                                    <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        ";
                } elseif (isset($_SESSION['rec'])) {
                    $rec = $_SESSION['rec'];
                    $query = "SELECT profile FROM reception WHERE username ='$rec';";
                    $res = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($res)) {
                        $profiles = $row['profile'];
                    }
                    echo "
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                    <a onclick='goBack()' class='btn btn-danger btn-icon-split'>
                    <span class='icon text-red-600's>
                        <i class='fas fa-arrow-left'></i>
                    </span>
                    <span class='text'>Back</span>
                </a>
                <ul class='navbar-nav ml-auto'>
                            <div class='topbar-divider d-none d-sm-block'></div>
                                <!-- Nav Item - User Information -->
                                <li class='nav-item dropdown no-arrow'>
                                    <a class='nav-link dropdown-toggle' href='#' id='userDropdown' role='button'
                                        data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <span class='mr-2 d-none d-lg-inline text-gray-600 small'>$rec</span>
                                        <img class='img-profile rounded-circle'
                                            src='../reception/img/$profiles'>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class='dropdown-menu dropdown-menu-right shadow animated--grow-in'
                                        aria-labelledby='userDropdown'>
                                        <a class='dropdown-item' href='../reception/profile.php'>
                                            <i class='fas fa-user fa-sm fa-fw mr-2 text-gray-400'></i>
                                            Profile
                                        </a><!--
                                        <a class='dropdown-item' href='#'>
                                            <i class='fas fa-cogs fa-sm fa-fw mr-2 text-gray-400'></i>
                                            Settings
                                        </a>
                                        <a class='dropdown-item' href='#'>
                                            <i class='fas fa-list fa-sm fa-fw mr-2 text-gray-400'></i>
                                            Activity Log
                                        </a>-->
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' href='../../logout.php' >
                                            <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>
                                ";
                } elseif (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    $query = "SELECT profile FROM user WHERE username ='$user';";
                    $res = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($res)) {
                        $profiles = $row['profile'];
                    }
                    echo "
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
                    <a onclick='goBack()' class='btn btn-danger btn-icon-split'>
                    <span class='icon text-red-600's>
                        <i class='fas fa-arrow-left'></i>
                    </span>
                    <span class='text'>Back</span>
                </a>
                <ul class='navbar-nav ml-auto'>
                            <div class='topbar-divider d-none d-sm-block'></div>
                                <!-- Nav Item - User Information -->
                                <li class='nav-item dropdown no-arrow'>
                                    <a class='nav-link dropdown-toggle' href='#' id='userDropdown' role='button'
                                        data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <span class='mr-2 d-none d-lg-inline text-gray-600 small'>$user</span>
                                        <img class='img-profile rounded-circle'
                                            src='../user/img/$profiles'>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class='dropdown-menu dropdown-menu-right shadow animated--grow-in'
                                        aria-labelledby='userDropdown'>
                                        <a class='dropdown-item' href='../user/profile.php'>
                                            <i class='fas fa-user fa-sm fa-fw mr-2 text-gray-400'></i>
                                            Profile
                                        </a><!--
                                        <a class='dropdown-item' href='#'>
                                            <i class='fas fa-cogs fa-sm fa-fw mr-2 text-gray-400'></i>
                                            Settings
                                        </a>
                                        <a class='dropdown-item' href='#'>
                                            <i class='fas fa-list fa-sm fa-fw mr-2 text-gray-400'></i>
                                            Activity Log
                                        </a>-->
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' href='../../logout.php' >
                                            <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>
                                ";
                } elseif (isset($_SESSION['lab'])) {
                    $lab = $_SESSION['lab'];

                    $res = mysqli_query($connect, "SELECT * FROM lab WHERE labno = '$lab'");
                    while ($row = mysqli_fetch_array($res)) {
                        $name = $row['name'];
                        $profiles = $row['profile'];

                        echo "<ul class='navbar-nav ml-auto'>
                                    <div class='topbar-divider d-none d-sm-block'></div>
                                        <!-- Nav Item - User Information -->
                                        <li class='nav-item dropdown no-arrow'>
                                            <a class='nav-link dropdown-toggle' href='#' id='userDropdown' role='button'
                                                data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                
                                                <span class='mr-2 d-none d-lg-inline text-gray-600 small'>$name</span>
                                                <img class='img-profile rounded-circle'
                                            src='../lab/img/$profiles'>
                                                
                                            </a>
                                            <!-- Dropdown - User Information -->
                                            <div class='dropdown-menu dropdown-menu-right shadow animated--grow-in'
                                                aria-labelledby='userDropdown'>
                                                <a class='dropdown-item' href='../user/profile.php'>
                                                    <i class='fas fa-user fa-sm fa-fw mr-2 text-gray-400'></i>
                                                    Profile
                                                </a><!--
                                                <a class='dropdown-item' href='#'>
                                                    <i class='fas fa-cogs fa-sm fa-fw mr-2 text-gray-400'></i>
                                                    Settings
                                                </a>
                                                <a class='dropdown-item' href='#'>
                                                    <i class='fas fa-list fa-sm fa-fw mr-2 text-gray-400'></i>
                                                    Activity Log
                                                </a>-->
                                                <div class='dropdown-divider'></div>
                                                <a class='dropdown-item' href='../../logout.php' >
                                                    <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>
                                                    Logout
                                                </a>
                                            </div>
                                        </li>
                                        ";
                    }
                } else {
                    echo "<h4 class='text-center'>HMS</h4>";
                }
                ?>
                </ul>

            </nav><?php ?>
            <!-- End of Topbar -->
            <script src="../vendor/jquery/jquery.min.js"></script>
            <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


            <!-- Core plugin JavaScript-->
            <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../js//sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="../vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../js/demo/chart-pie-demo.js"></script>
            <!-- End of Topbar -->

</body>

</html>