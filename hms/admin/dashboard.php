<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <?php

if (isset($_SESSION['admin'])) {
    $user = $_SESSION['admin'];
        include('index.php');

}else{
        include('../include/404.php');
}
?>
    </body>
</html>