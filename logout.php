<?php
include('./hms/include/connection.php');
session_start();


if (isset($_SESSION['doc'])){
    date_default_timezone_set('Asia/Kolkata');
    $ldate=date( 'd-m-Y h:i:s A', time () );
    mysqli_query($connect,"UPDATE doclog  SET logout = '$ldate' WHERE uid = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
    unset($_SESSION['doc']);
    echo "<script>alert('LOGOUT SUCCESSFULLY!');
    window.location.href='./feedback/index.php';</script>"; 
    
}elseif (isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
    echo "<script>alert('LOGOUT SUCCESSFULLY!');
    window.location.href='index.php';</script>";    
}elseif (isset($_SESSION['user'])){
    date_default_timezone_set('Asia/Kolkata');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($connect,"UPDATE userlog  SET logout = '$ldate' WHERE uid = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
    unset($_SESSION['user']);
    echo "<script>alert('LOGOUT SUCCESSFULLY!');
    window.location.href='./feedback/index.php';</script>"; 
}elseif (isset($_SESSION['lab'])){
    unset($_SESSION['lab']);
    echo "<script>alert('LOGOUT SUCCESSFULLY!');
    window.location.href='./feedback/index.php';</script>"; 
}elseif (isset($_SESSION['rec'])){
    unset($_SESSION['rec']);
    echo "<script>alert('LOGOUT SUCCESSFULLY!');
    window.location.href='./feedback/index.php';</script>"; 
}
?>