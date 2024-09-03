
<?php
include('../../../include/connection.php');
if (isset($_POST['value'])) {
    $value = $_POST['value'];
    $appid =$_POST['appid'];

    // Insert the value into the database
    $sql = "UPDATE `appointment` set `vid` = '$value' WHERE `id`= '$appid'";
    if ($connect->query($sql) === TRUE) {
        echo 'Value added to the database successfully';
    } else {
        echo 'Error adding value to the database: ' . $connect->error;
    }
}
?>


