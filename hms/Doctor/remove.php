<!DOCTYPE html>
<html></html>
<link rel="stylesheet" href="../toaster/css/toastr.min.css">
<style>   #toast-container > .toast-error { background-color: #e74a3b !important; } 
 #toast-container > .toast-success { background-color: #1cc88a !important; }</style>

<script src="../toaster/js/jquery.js"></script>
    <script src="../toaster/js/toastr.min.js"></script>
    <script src="toaster/toastr.js"></script>
<?php
session_start();
include('../include/connection.php');

            
    if(isset($_REQUEST['cid'])){
        $id = $_REQUEST['cid'];
        $status = 'canceled';
        $query = "UPDATE appointment SET status='$status' WHERE id='$id'";
        $result = mysqli_query($connect, $query); 
        if($result){
            echo "<script>toastr.success('Appointment Has Been Canceled','Success!',);
                                        setTimeout(function() {
                                            window.location.href = 'manageAppointment.php';
                                          }, 1000);</script>";
    } else {
        echo "<script>toastr.error('Something Went Wrong','Error!',);</script>";
        
    }}?>