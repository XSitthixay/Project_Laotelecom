<?php
include 'connect_db.php';

if (isset($_GET['delete_order_id'])) {
    $order_id = $_GET['delete_order_id'];

    // First, delete the order items related to this order
    $delete_order_items_query = "DELETE FROM order_details WHERE order_detail_id = $order_id";
    $delete_order_items_result = mysqli_query($conn, $delete_order_items_query);

    if ($delete_order_items_result) {
        // If the order items were deleted successfully, delete the order itself
        $delete_order_query = "DELETE FROM orders WHERE order_id = $order_id";
        $delete_order_result = mysqli_query($conn, $delete_order_query);

        if ($delete_order_result) {
            echo "Order deleted successfully.";
            header("Location: orders.php"); // Redirect back to the orders page
            exit();
        } else {
            echo "Error deleting order: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting order items: " . mysqli_error($conn);
    }
} else {
    echo "No order ID provided.";
}

mysqli_close($conn);
?>
