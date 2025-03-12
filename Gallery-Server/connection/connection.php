<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db_name = "gallery_system";

    $conn = new mysqli($host,$user,$pass,$db_name);

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods:*");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
?>