<?php
include 'connect_db.php'; // Include your database connection

// Check if 'order_id' is provided
if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);

    // Start a transaction
    mysqli_begin_transaction($conn);
    try {
        // Retrieve the order status
        $select_order_status = "SELECT order_status FROM orders WHERE order_id = ?";
        $stmt = mysqli_prepare($conn, $select_order_status);
        mysqli_stmt_bind_param($stmt, "i", $order_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $order = mysqli_fetch_assoc($result);

        if ($order) {
            $order_status = $order['order_status'];

            // Retrieve product quantities from order_details
            $select_order_details = "SELECT product_id, quantity FROM order_details WHERE order_id = ?";
            $stmt = mysqli_prepare($conn, $select_order_details);
            mysqli_stmt_bind_param($stmt, "i", $order_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($order_status !== 'pending') {
                // Update product quantities if the order status is not pending
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $quantity = $row['quantity'];

                    $update_product = "UPDATE products SET stock_quantity = stock_quantity + ? WHERE product_id = ?";
                    $update_stmt = mysqli_prepare($conn, $update_product);
                    mysqli_stmt_bind_param($update_stmt, "ii", $quantity, $product_id);
                    mysqli_stmt_execute($update_stmt);
                }
            }

            // Update the order status to 'canceled'
            $update_order_status = "UPDATE orders SET order_status = '' WHERE order_id = ?";
            $stmt = mysqli_prepare($conn, $update_order_status);
            mysqli_stmt_bind_param($stmt, "i", $order_id);
            mysqli_stmt_execute($stmt);

            // Delete from order_details
            $delete_order_details = "DELETE FROM order_details WHERE order_id = ?";
            $stmt = mysqli_prepare($conn, $delete_order_details);
            mysqli_stmt_bind_param($stmt, "i", $order_id);
            mysqli_stmt_execute($stmt);

            // Delete the order itself
            $delete_order = "DELETE FROM orders WHERE order_id = ?";
            $stmt = mysqli_prepare($conn, $delete_order);
            mysqli_stmt_bind_param($stmt, "i", $order_id);
            mysqli_stmt_execute($stmt);

            // Commit transaction
            mysqli_commit($conn);
            echo "Order canceled and deleted successfully.";
            
            // Redirect to order list page after successful cancellation
            header("Location: orders.php");
            exit();
        } else {
            echo '<script>alert("Order not found."); window.location.href="orders.php";</script>';
        }

    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No order ID provided.";
}
?>
