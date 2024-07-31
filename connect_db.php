<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "inventory_system";

    $conn = mysqli_connect($host, $user, $pass, $database);
    mysqli_set_charset($conn, "utf8");

    if ($conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }
?>