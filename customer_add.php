<?php
include 'connect_db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

    $query = "INSERT INTO customers (customer_name, customer_contact, customer_address) VALUES ('$customer_name', '$customer_contact', '$customer_address')";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='orders.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
