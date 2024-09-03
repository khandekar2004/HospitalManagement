<!DOCTYPE html>
<html></html>
<link rel="stylesheet" href="./toaster/css/toastr.min.css">
<style> #toast-container > .toast-error { background-color: #e74a3b; } 
 #toast-container > .toast-success { background-color: #1cc88a }</style>

<script src="./toaster/js/jquery.js"></script>
    <script src="./toaster/js/toastr.min.js"></script>
    <script src="toaster/toastr.js"></script>
<?php
session_start();
include('../include/connection.php');
if(isset($_REQUEST['patId'])){
                $patId = $_REQUEST['patId'];

            $query = "DELETE FROM labpatient WHERE id = '$patId'";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>
                    
                    toastr.success('Patient Removed Successfully!','Success',)
                    window.location.href = 'managePat.php';
                    
                         </script>";    

            } else {
                echo "<script>alert('Something Went Wrong!')";
                
            }}
            ?>