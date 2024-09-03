<!DOCTYPE html>
<html>
    <head><title>HMS | Doctor</title></head>
</html>
<?php
session_start();
include('./include/connection.php');

if(isset($_POST['login'])){

    $labno = $_POST['labno'];
    $password = $_POST['pass'];

    $error = array();

    if(empty($labno)){
        $error['lab'] = "Enter Username";
    }else if(empty($password)){
        $error['lab'] = "Enter Password";
    }

    if(count($error)==0){

        $query = "SELECT * FROM lab where labno='$labno' AND password='$password'";

        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count == 1){
            echo "<script>alert('You have login as doctor')</script>";
            $_SESSION['lab'] = $labno;

            header("Location:lab/index.php");
            exit();
        }else{
            echo "<script>alert('Invalid  Username or Password')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab Login</title>
    </head>
    <body style="background-image: url(img/staff2.jpg); background-size: cover;">
        <?php include('./include/mainheader.php')?>

        <div style="margin-top:60px;" ></div>

        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6" style="background-color:gainsboro; padding: 25px; border-radius: 10px;">
                    
                   <center> <img src="img/saim.png" class="col-md-12" style="width: 50%; height:200px; border-radius:50%" alt="admin"></center>
                        <form action="" method="post" class="my-2">
                            <div >
                                <?php
                                if(isset($error['lab'])){
                                    $sh = $error['lab'];
                                    $show = "<h5 class='alert alert-danger'>$sh</h5>";
                                }else{
                                    $show = "";
                                }
                                echo $show;
                                ?>
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label>Lab</label>
                                <input type="text" name="labno" class="form-control"
                                autocomplete="off" placeholder="Enter Email">
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label>Password</label>
                                <input type="password" name="pass" placeholder="Enter Password" class="form-control" >
                            </div>
                            <input type="submit" name="login"  class="btn btn-success btn-user btn-block" style="margin-top: 10px;" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>