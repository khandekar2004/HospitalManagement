<?php
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $state = 'approve';
    $time = $_REQUEST['time'];
    $query = "UPDATE appointment SET appointmentTime = '$time' WHERE id = '$id' ";
    $result = mysqli_query($connect, $query); 
    if($result){
        echo "<script>alert('Appointment has been');";
} else {
    echo "<script>alert('Something Went Wrong!')";
    
}
}
?>