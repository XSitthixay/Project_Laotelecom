<?php
include 'connect_db.php'; // Include your database connection

$query = $_GET['query'] ?? '';

if ($query) {
    $stmt = $conn->prepare("SELECT product_id, product_name, barcode FROM products WHERE product_name LIKE ?");
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'barcode' => $row['barcode']
        ];
    }
    echo json_encode($products);
} else {
    echo json_encode([]);
}
?>
