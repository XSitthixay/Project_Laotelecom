<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$database = "inventorysystemphp";

$conn = mysqli_connect($host, $user, $pass, $database);
mysqli_set_charset($conn, "utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    
    // Validate quantity
    if ($quantity <= 0) {
        die("Quantity must be greater than zero.");
    }

    // Fetch product price
    $sql = "SELECT product_name, product_price FROM products WHERE product_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $product_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $product_name, $product_price);
        if (mysqli_stmt_fetch($stmt)) {
            // Calculate total amount
            $total_amount = $quantity * $product_price;

            // Insert order into orders table
            $sql = "INSERT INTO orders (customer_name, total_amount) VALUES (?, ?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                $customer_name = "Guest"; // Modify as needed
                mysqli_stmt_bind_param($stmt, 'sd', $customer_name, $total_amount);
                mysqli_stmt_execute($stmt);
                $order_id = mysqli_insert_id($conn);
                mysqli_stmt_close($stmt);

                // Insert order items into order_items table
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, 'iiid', $order_id, $product_id, $quantity, $product_price);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    echo "Order placed successfully. Your order ID is " . htmlspecialchars($order_id);
                } else {
                    echo "Error preparing statement for order_items: " . mysqli_error($conn);
                }
            } else {
                echo "Error preparing statement for orders: " . mysqli_error($conn);
            }
        } else {
            echo "Product not found.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement for product: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}

mysqli_close($conn);
?>
