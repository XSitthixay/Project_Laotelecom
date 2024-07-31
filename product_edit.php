<?php
include 'connect_db.php';

// Fetch product data for editing
$id = $_GET['edit_id'];

// Prepare a statement to prevent SQL injection
$query = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die("Product not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['p_name'];
    $serial_number = $_POST['p_serial'];
    $screen_size = $_POST['p_screen'];
    $body_weight = $_POST['p_body'];
    $chips = $_POST['p_chips'];
    $storage = $_POST['p_storage'];
    $color = $_POST['p_color'];
    $price = $_POST['p_price'];
    $description = $_POST['p_desc'];
    $model_number = $_POST['p_model'];
    $warranty_period = $_POST['p_warranty'];
    $supplier_name = $_POST['p_supplier'];
    $brand_name = $_POST['p_brand'];
    $category_name = $_POST['p_category'];
    $date_of_purchase = $_POST['p_date'];
    $stock_quantity = $_POST['p_stock'];
    $location = $_POST['p_location'];
    $status = $_POST['p_status'];
    $reorder_level = $_POST['p_reorder'];
    $barcode = $_POST['p_barcode'];

    // Prepare an update statement
    $update_query = "UPDATE products SET 
    product_name = ?, 
    serial_number = ?, 
    screen_size = ?, 
    body_weight = ?, 
    chips = ?, 
    storage = ?, 
    color = ?, 
    price = ?, 
    description = ?, 
    model_number = ?, 
    warranty_period = ?, 
    supplier_name = ?, 
    brand_name = ?, 
    category_name = ?, 
    date_of_purchase = ?, 
    stock_quantity = ?, 
    location = ?, 
    status = ?, 
    reorder_level = ?, 
    barcode = ? 
    WHERE product_id = ?";

    $stmt = $conn->prepare($update_query);

    // The 'sssssssssssssssssssi' string represents the types for each parameter.
    $stmt->bind_param("sssssssssssssssissisi", 
    $product_name, $serial_number, $screen_size, $body_weight, $chips, 
    $storage, $color, $price, $description, $model_number, $warranty_period, 
    $supplier_name, $brand_name, $category_name, $date_of_purchase, 
    $stock_quantity, $location, $status, $reorder_level, $barcode, $id
    );

    if ($stmt->execute()) {
        echo '<script>window.location.href="products.php"</script>';
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch brands, categories, and suppliers
$brand_query = "SELECT * FROM brands";
$brand_result = $conn->query($brand_query);
$brands = [];
if ($brand_result->num_rows > 0) {
    while ($brand_row = $brand_result->fetch_assoc()) {
        $brands[] = $brand_row;
    }
}

$category_query = "SELECT * FROM categories";
$category_result = $conn->query($category_query);
$categories = [];
if ($category_result->num_rows > 0) {
    while ($category_row = $category_result->fetch_assoc()) {
        $categories[] = $category_row;
    }
}

$supplier_query = "SELECT * FROM suppliers";
$supplier_result = $conn->query($supplier_query);
$suppliers = [];
if ($supplier_result->num_rows > 0) {
    while ($supplier_row = $supplier_result->fetch_assoc()) {
        $suppliers[] = $supplier_row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #2E4053;
            height: 130vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            width: 50%;
            padding: 40px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            background: #ffffff;
        }

        .card-header {
            border-bottom: 2px solid #e0e0e0;
            background: #2E4053;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0.375rem;
        }

        .form-check-label {
            font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Edit Product</h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_name" class="form-label">Product Name:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_name" name="p_name" value="<?= htmlspecialchars($product['product_name'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_serial" class="form-label">Serial Number:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_serial" name="p_serial" value="<?= htmlspecialchars($product['serial_number'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_screen" class="form-label">Screen Size:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_screen" name="p_screen" value="<?= htmlspecialchars($product['screen_size'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_body" class="form-label">Body Weight:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_body" name="p_body" value="<?= htmlspecialchars($product['body_weight'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_chips" class="form-label">Chips:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_chips" name="p_chips" value="<?= htmlspecialchars($product['chips'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_storage" class="form-label">Storage:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_storage" name="p_storage" value="<?= htmlspecialchars($product['storage'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_color" class="form-label">Color:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_color" name="p_color" value="<?= htmlspecialchars($product['color'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_price" class="form-label">Price:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_price" name="p_price" value="<?= htmlspecialchars($product['price'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_desc" class="form-label">Description:</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control form-control-sm" id="p_desc" name="p_desc" rows="3" required><?= htmlspecialchars($product['description'], ENT_QUOTES) ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_model" class="form-label">Model Number:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_model" name="p_model" value="<?= htmlspecialchars($product['model_number'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_warranty" class="form-label">Warranty Period:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_warranty" name="p_warranty" value="<?= htmlspecialchars($product['warranty_period'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_supplier" class="form-label">Supplier Name:</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control form-control-sm" id="p_supplier" name="p_supplier" required>
                                <?php foreach ($suppliers as $supplier): ?>
                                    <option value="<?= htmlspecialchars($supplier['supplier_name'], ENT_QUOTES) ?>" <?= ($supplier['supplier_name'] == $product['supplier_name']) ? 'selected' : '' ?>><?= htmlspecialchars($supplier['supplier_name'], ENT_QUOTES) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_brand" class="form-label">Brand Name:</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control form-control-sm" id="p_brand" name="p_brand" required>
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?= htmlspecialchars($brand['brand_name'], ENT_QUOTES) ?>" <?= ($brand['brand_name'] == $product['brand_name']) ? 'selected' : '' ?>><?= htmlspecialchars($brand['brand_name'], ENT_QUOTES) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_category" class="form-label">Category Name:</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control form-control-sm" id="p_category" name="p_category" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['category_name'], ENT_QUOTES) ?>" <?= ($category['category_name'] == $product['category_name']) ? 'selected' : '' ?>><?= htmlspecialchars($category['category_name'], ENT_QUOTES) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_date" class="form-label">Date of Purchase:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" class="form-control form-control-sm" id="p_date" name="p_date" value="<?= htmlspecialchars($product['date_of_purchase'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_stock" class="form-label">Stock Quantity:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control form-control-sm" id="p_stock" name="p_stock" value="<?= htmlspecialchars($product['stock_quantity'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_location" class="form-label">Location:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_location" name="p_location" value="<?= htmlspecialchars($product['location'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_status" class="form-label">Status:</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-select form-select-sm" id="p_status" name="p_status" required>
                                <option value="yes" <?= $product['status'] == 'yes' ? 'selected' : '' ?>>In Stock</option>
                                <option value="no" <?= $product['status'] == 'no' ? 'selected' : '' ?>>Sold Out</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_reorder" class="form-label">Reorder Level:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control form-control-sm" id="p_reorder" name="p_reorder" value="<?= htmlspecialchars($product['reorder_level'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="p_barcode" class="form-label">Barcode:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm" id="p_barcode" name="p_barcode" value="<?= htmlspecialchars($product['barcode'], ENT_QUOTES) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mt-2 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">Update Product</button>
                            <a href="products.php" class="btn btn-danger btn-sm">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
