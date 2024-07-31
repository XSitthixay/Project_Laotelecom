<?php
include 'connect_db.php';

// Handle form submission
if (isset($_POST['p_save'])) {
    // Sanitize and store form data
    $product_id = mysqli_real_escape_string($conn, $_POST['p_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $serial_number = mysqli_real_escape_string($conn, $_POST['p_serial']);
    $screen_size = mysqli_real_escape_string($conn, $_POST['p_screen']);
    $body_weight = mysqli_real_escape_string($conn, $_POST['p_body']);
    $chips = mysqli_real_escape_string($conn, $_POST['p_chips']);
    $storage = mysqli_real_escape_string($conn, $_POST['p_storage']);
    $color = mysqli_real_escape_string($conn, $_POST['p_color']);
    $price = mysqli_real_escape_string($conn, $_POST['p_price']);
    $description = mysqli_real_escape_string($conn, $_POST['p_desc']);
    $model_number = mysqli_real_escape_string($conn, $_POST['p_model']);
    $warranty_period = mysqli_real_escape_string($conn, $_POST['p_warranty']);
    $supplier = mysqli_real_escape_string($conn, $_POST['p_supplier']);
    $brand = mysqli_real_escape_string($conn, $_POST['p_brand']);
    $category = mysqli_real_escape_string($conn, $_POST['p_category']);
    $date_of_purchase = mysqli_real_escape_string($conn, $_POST['p_date']);
    $stock_quantity = mysqli_real_escape_string($conn, $_POST['p_stock']);
    $location = mysqli_real_escape_string($conn, $_POST['p_location']);
    $status = mysqli_real_escape_string($conn, $_POST['p_status']);
    $reorder_level = mysqli_real_escape_string($conn, $_POST['p_reorder']);
    $barcode = mysqli_real_escape_string($conn, $_POST['p_barcode']);

    $query = "INSERT INTO products (product_id, product_name, serial_number, screen_size, body_weight, chips, storage, color, price, description, model_number, warranty_period, supplier_name, brand_name, category_name, date_of_purchase, stock_quantity, location, status, reorder_level, barcode) 
              VALUES ('$product_id', '$product_name', '$serial_number', '$screen_size', '$body_weight', '$chips', '$storage', '$color', '$price', '$description', '$model_number', '$warranty_period', '$supplier', '$brand', '$category', '$date_of_purchase', '$stock_quantity', '$location', '$status', '$reorder_level', '$barcode')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>window.location.href="products.php"</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch brands, categories, and suppliers
$brand_query = "SELECT * FROM brands";
$brand_result = mysqli_query($conn, $brand_query);
$brands = [];
if (mysqli_num_rows($brand_result) > 0) {
    while ($brand_row = mysqli_fetch_assoc($brand_result)) {
        $brands[] = $brand_row;
    }
}

$category_query = "SELECT * FROM categories";
$category_result = mysqli_query($conn, $category_query);
$categories = [];
if (mysqli_num_rows($category_result) > 0) {
    while ($category_row = mysqli_fetch_assoc($category_result)) {
        $categories[] = $category_row;
    }
}

$supplier_query = "SELECT * FROM suppliers";
$supplier_result = mysqli_query($conn, $supplier_query);
$suppliers = [];
if (mysqli_num_rows($supplier_result) > 0) {
    while ($supplier_row = mysqli_fetch_assoc($supplier_result)) {
        $suppliers[] = $supplier_row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
    /* Button styling for larger buttons */
    .btn-lg {
        font-size: 1.25rem; /* Larger text size */
        padding: 0.5rem 1.25rem; /* Larger padding */
    }
    
    /* Container styling for fluid container with a max width */
    .card.card-style {
        width: 100%; /* Full width */
        max-width: 800px; /* Max width for larger screens */
        margin: 0 auto; /* Center the container */
    }
</style>
</head>
<body>

<?php include "nav-menu.php"; ?>


<div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card card-style">
                    <div class="card-header">
                        <h4 class="card-title text-center">Product Add</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <!-- Uncomment if Product ID is needed -->
                            <!-- <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="p_id" class="form-label">Product ID:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_id" name="p_id" required>
                                </div>
                            </div> -->
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_name" class="form-label">Product Name:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_name" name="p_name" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_serial" class="form-label">Serial Number:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_serial" name="p_serial" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_screen" class="form-label">Screen Size:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_screen" name="p_screen" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_body" class="form-label">Body Weight:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_body" name="p_body" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_chips" class="form-label">Chips:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_chips" name="p_chips" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_storage" class="form-label">Storage:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_storage" name="p_storage" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_color" class="form-label">Color:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_color" name="p_color" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_price" class="form-label">Price:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" step="0.01" class="form-control form-control-sm" id="p_price" name="p_price" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_desc" class="form-label">Description:</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm" id="p_desc" name="p_desc" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_model" class="form-label">Model Number:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_model" name="p_model" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_warranty" class="form-label">Warranty Period:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_warranty" name="p_warranty" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_supplier" class="form-label">Supplier:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-select form-select-sm" id="p_supplier" name="p_supplier" required>
                                        <option value="">Select Supplier</option>
                                        <?php foreach ($suppliers as $supplier): ?>
                                            <option value="<?php echo $supplier['supplier_name']; ?>"><?php echo $supplier['supplier_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_brand" class="form-label">Brand:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-select form-select-sm" id="p_brand" name="p_brand" required>
                                        <option value="">Select Brand</option>
                                        <?php foreach ($brands as $brand): ?>
                                            <option value="<?php echo $brand['brand_name']; ?>"><?php echo $brand['brand_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_category" class="form-label">Category:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-select form-select-sm" id="p_category" name="p_category" required>
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo $category['category_name']; ?>"><?php echo $category['category_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_date" class="form-label">Date of Purchase:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" class="form-control form-control-sm" id="p_date" name="p_date" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_stock" class="form-label">Stock Quantity:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control form-control-sm" id="p_stock" name="p_stock" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_location" class="form-label">Location:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_location" name="p_location" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_status" class="form-label">Status:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control form-control-sm" id="p_status" name="p_status" required>
                                        <option value="">Select Status</option>
                                        <option value="yes">Instock</option>
                                        <option value="no">Soldout</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_reorder" class="form-label">Reorder Level:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control form-control-sm" id="p_reorder" name="p_reorder" required>
                                </div>
                            </div>
                            <div class="row mb-3 text-end">
                                <div class="col-md-4">
                                    <label for="p_barcode" class="form-label">Barcode:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="p_barcode" name="p_barcode" required>
                                </div>
                            </div>
                            <div class="row mb-3 mt-4 justify-content-center">
                                <div class="col-md-6 text-center">
                                    <a href="products.php" class="btn btn-danger btn-lg mx-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-lg mx-2" name="p_save">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        @ Products
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
