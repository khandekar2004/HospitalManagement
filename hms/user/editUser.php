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

<head></head>

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
                                    <h1 class="h4 text-gray-900 mb-4">Edit Doctor Info</h1>
                                </div>
                                <?php
                                $id = intval($_GET['id']);
                                $query = "SELECT * FROM user WHERE id = '$id';";
                                $res = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_array($res)) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    $address = $row['address'];
                                    $uname = $row['username'];
                                    $phone = $row['phone'];
                                

                                if (isset($_POST['change'])) {

                                    $unames = $_POST['uname'];

                                    $emails = $_POST['email'];
                                    $names = $_POST['name'];
                                    $addresss = $_POST['address'];
                                    $phones = $_POST['phone'];
                                    $gender = $_POST['gender'];
                                    $error = array();
                                    $query = "UPDATE user SET name='$names',email='$emails',address='$addresss',phone='$phones',Gender = '$gender' WHERE username='$uname';";
                                    $update = mysqli_query($connect,$query);
                                    if($update){
                                        $error['u'] = "<h5 class='text-center alert alert-success'>Detailed Updated Successfully</h5>";
                                        echo "<script>alert('User Detail Updated Successfully');
                                        window.location.href='profile.php';</script>";
                                    }else{
                                        $er = mysqli_error($connect);
                                        $error['u'] = "<h5 class='text-center alert alert-danger'>Something Went Wrong :$er</h5>
                                        ";
                                    }
                                }
                                if (isset($error['u'])) {
                                    $sh = $error['u'];
                                    $show = $sh;
                                } else {
                                    $show = "";
                                }
                                echo $show;


/*  

                                    $error = array();
                                    if (empty($uname)) {
                                        $error['u'] = "Enter Admin Username";
                                    } else if (empty($pass)) {
                                        $error['u'] = "Enter Admin Password";
                                    } else if (empty($cpass)) {
                                        $error['u'] = "Enter Confirm Password";
                                    } else if ($pass == $cpass) {
                                        $sql = "select * from admin where (username='$uname' or email='$email');";

                                        $res = mysqli_query($connect, $sql);

                                        if (mysqli_num_rows($res) > 0) {

                                            $row = mysqli_fetch_assoc($res);
                                            if ($email == isset($row['email'])) {
                                                $error['u'] = "email already exists";
                                            } else if ($uname == isset($row['username'])) {
                                                $error['u'] = "Username  already exists";
                                            }
                                        } else {

                                            if (count($error) == 0) {
                                                $q = " INSERT INTO doctor(`username`,`password`,`specialization`,`email`,`name`,`phone`,`fees`,`address`) VALUES ('$uname','$cpass','$specialization','$email','$name','$phone','$fees','$address')";

                                                $result = mysqli_query($connect, $q);

                                                if ($result) {
                                                    echo "<script>alert('Admin Added Successfully');
                                                    window.location.href='admin.php';</script>";
                                                } else {
                                                    $error['u'] = "Something Went Wrong";
                                                }
                                            } else {
                                                $error['u'] = "Your Password doesn't match confirm password";
                                            }
                                        }
                                    }
                                }
                                if (isset($error['u'])) {
                                    $sh = $error['u'];
                                    $show = "<h5 class='text-center alert alert-danger'>$sh</h5>";
                                } else {
                                    $show = "";
                                }
                                echo $show;*/
                                ?>

                                <form method="post" enctype="multipart/form-data" class="user">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label>Username<span class="redc">*</span></label>
                                            <input type="text" class="form-control form-control-user" name="uname" id="exampleFirstName" placeholder="Enter Username" value="<?php echo $uname; ?>" readonly>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0"><label>Doctor Name</label>
                                            <input type="text" class="form-control form-control-user" name="name" id="exampleFirstName" placeholder="eg.Ben Affleck..." value="<?php echo $name ?>" required>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label>Address:</label>
                                            <textarea type="text" class="form-control form-control-user" value="" name="address" id="address" placeholder="Enter Address"><?php echo $address; ?>
                            </textarea>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6"><label>Username:<span class="redc">*</span></label>
                                            <input type="text" class="form-control form-control-user " name="uname" id="exampleLastName" placeholder="" value="<?php echo $uname; ?> " readonly>
                                        </div>
                                        <div class="col-sm-6"><label>Email: <span class="redc">*</span></label>
                                            <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="eg. xyz@gmail.com..." value="<?php echo $email; ?>" required>
                                        </div>
                                        <div class="col-sm-6"><label>Phone: <span class="redc">*</span></label>
                                            <input type="number" class="form-control form-control-user" name="phone" id="exampleInputEmail" placeholder="mobile no" value="<?php echo $phone; ?>" required>
                                        </div>

                                        <div class="col-sm-6"><label>Gender: <span class="redc">*</span></label>

                                            <?php if ($row['Gender'] == "female") { ?>
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
                                                </div><?php } elseif ($row['Gender'] == "male") { ?>
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
                                                </div><?php } }?>
                                        </div>
                                    </div>
                                    
                                    <input type="submit" class="btn btn-success btn-user btn-block" value="Update" name="change">
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