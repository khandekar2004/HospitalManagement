<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <?php

if (isset($_SESSION['rec'])) {
    $user = $_SESSION['rec'];
        include('index.php');

}else{
        include('../include/404.php');
}
?>
    </body>
</html>