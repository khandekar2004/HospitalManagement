<?php
session_start();


if (isset($_SESSION['doc'])){
    unset($_SESSION['doc']);

    header("Location:../index.php");    
}elseif (isset($_SESSION['admin'])){
    unset($_SESSION['admin']);

    header("Location:../index.php");    
}elseif (isset($_SESSION['user'])){
    unset($_SESSION['user']);

    header("Location:../index.php");    
}
?>