<?php
session_start();
include('../include/connection.php')
?>
<!DOCTYPE html>
<html>

<head>
    <title>PROFILE</title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
  include('./sidenav.php');
  include('../include/header.php');
        $ad = $_SESSION['rec'];
        $aid = $_GET['aid'];
        $sql = "SELECT * FROM appointment WHERE id = '$aid'";
        $res = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_array($res)) {
            
            $fee = $row['fee'];
            $feestat = $row['feestat'];
            
        ?>
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change Username</h6>

                </div>
                <div class="card-body">
                    <div class="text-center">


                        
                    </div>
                    <form method="post">
                    <div class="form-field">
                        <label>fee:</label>
                          <input type='number' name='fee' value="<?php echo $fee ?>" placeholder='fee' class='form-control wd-450' readonly required='true'>
                          </div>

                     
                     <div class="form-field">
                        <label for="feesat">Fee Status :</label>
                          <select type='text' name='feesat' placeholder='feestat' class='form-control wd-450' required='true'>
                            <option value="<?php echo $feestat ?>"><?php echo$feestat?> </option>
                            <option value="Paid">Paid</option>
                          </select>
                          </div><?php } ?>
                     </br>
                      <input class="btn btn-success" type="submit" name="change" >
                    </form>


                    


                        <?php

                        if (isset($_POST['change'])) {
                            $fees = $_POST['fee'];
                            $feestats = $_POST['feesat'];
                            $aid = $_GET['aid'];
                            $status = $feestats;
                            if ($feestats == "Paid"){
                                $income ="INSERT INTO income (rs) VALUES ('$fees')";
                                
                                $qu = mysqli_query($connect, $income);
                                
                                if ($qu) {
                                    $paid= "UPDATE appointment SET feestat ='$feestats', status='$status' WHERE id='$aid';";
                                    $res = mysqli_query($connect, $paid);
                                    if ($res) {

                                        echo "<script>window.location.href='./manageAppointment.php';</script>";
                                    }  
                                    else {
                                        echo "<script>alert('Error while updating record !');</script>";
                                    }   
                                }
                            }
                        }
                            
                            
/*                                $qu = mysqli_multi_query($connect, $query);

                            if ($qu) {
                                        
                                        echo "<script>window.location.href='./manageAppointment.php';</script>";
                                    }  
                                    else {
                                        echo "<script>alert('Error while updating record !');</script>";
                                    }   
                                } 
                            }*/
                               
                        
                        ?>
                    </form>


                </div>
                <h4></h4>
            </div>
        </div>

</body>

</html>