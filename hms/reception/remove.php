<!DOCTYPE html>
<html></html>
<link rel="stylesheet" href="./toaster/css/toastr.min.css">
<style>   #toast-container > .toast-error { background-color: #e74a3b !important; } 
 #toast-container > .toast-success { background-color: #1cc88a !important; }</style>

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
                echo "<script>toastr.error('Something Went Wrong','Error!',);</script>";
                
            }}
            if(isset($_REQUEST['adId'])){
                $id = $_REQUEST['adId'];

                $query = "DELETE FROM admin WHERE id = '$id'";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>toastr.success('Admin Removed Successfully','Success!',);
                    setTimeout(function() {
                        window.location.href = 'admin.php';
                      }, 1000);</script>";
            } else {
                echo "<script>toastr.error('Something Went Wrong','Error!',);</script>";
                
            }
            }
            if(isset($_REQUEST['LabId'])){
                $id = $_REQUEST['LabId'];

                $query = "DELETE FROM lab WHERE id = '$id'";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>toastr.success('Lab Removed Successfully','Success!',);
                    setTimeout(function() {
                        window.location.href = 'manageLab.php';
                      }, 1000);</script>";

            } else {
                echo "<script>toastr.error('Something Went Wrong','Error!',);</script>";
                
            }
            }
            if(isset($_REQUEST['userId'])){
                $id = $_REQUEST['userId'];

                $query = "DELETE FROM user WHERE id = '$id'";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>toastr.success('User Removed Successfully','Success!',);
                    setTimeout(function() {
                        window.location.href = 'manageUser.php';
                      }, 1000);</script>";

            } else {
                echo "<script>toastr.error('Something Went Wrong','Error!',);</script>";
                
            }
            }
            if(isset($_REQUEST['docId'])){
                $id = $_REQUEST['docId'];

                $query = "DELETE FROM doctor WHERE id = '$id'";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>toastr.success('Doctor Removed Successfully','Success!',);
                    setTimeout(function() {
                        window.location.href = 'manageDoctor.php';
                      }, 1000);</script>";

            } else {
                echo "<script>toastr.error('Something Went Wrong','Error!',);</script>";
                
            }
            }
            
            if(isset($_REQUEST['spId'])){
                $id = $_REQUEST['spId'];

                $query = "DELETE FROM specialization WHERE id = '$id'";
                $result = mysqli_query($connect, $query); 
                if($result){
                    echo "<script>toastr.success('Specialization Removed Successfully','Success!',);
                    setTimeout(function() {
                        window.location.href = 'doctorspecialization.php';
                      }, 1000);</script>";

            } else {
                echo "<script>toastr.error('Something Went Wrong','Error!',);</script>";
                
            }
            }
            ?>