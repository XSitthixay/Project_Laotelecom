<?php
include 'connect_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $order_status = $_POST['order_status'];
    $product_ids = $_POST['product_id'];
    $quantities = $_POST['quantity'];
    $unit_prices = $_POST['unit_price'];
    
    $total_amount = 0;
    foreach ($quantities as $key => $quantity) {
        $total_amount += $quantity * $unit_prices[$key];
    }
    
    $insert_order_query = "INSERT INTO orders (customer_id, order_date, total_amount, order_status) VALUES ('$customer_id', '$order_date', '$total_amount', '$order_status')";
    if (mysqli_query($conn, $insert_order_query)) {
        $order_id = mysqli_insert_id($conn);
        foreach ($product_ids as $key => $product_id) {
            $quantity = $quantities[$key];
            $unit_price = $unit_prices[$key];
            
            $insert_order_detail_query = "INSERT INTO order_details (order_id, product_id, quantity, unit_price) VALUES ('$order_id', '$product_id', '$quantity', '$unit_price')";
            mysqli_query($conn, $insert_order_detail_query);
            
            $update_product_query = "UPDATE products SET stock_quantity = stock_quantity - '$quantity' WHERE product_id = '$product_id'";
            mysqli_query($conn, $update_product_query);
        }
        
        header('Location: orders.php?order_success=1');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
