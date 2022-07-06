<?php
    $user = "root";
    $password = "";
    $database = "infinibank";
    $link = new mysqli('localhost', $user, $password, $database) or die("nie można było połączyć się z serwerem");

    if(!$link){
        die(mysqli_error($link));
    }
?>