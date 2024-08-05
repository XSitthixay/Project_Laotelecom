<?php
include 'connect_db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $supplier_contact = mysqli_real_escape_string($conn, $_POST['supplier_contact']);
    $supplier_address = mysqli_real_escape_string($conn, $_POST['supplier_address']);
    

    $query = "INSERT INTO suppliers (supplier_name, supplier_contact, supplier_address) VALUES ('$supplier_name', '$supplier_contact', '$supplier_address')";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='supplier.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>