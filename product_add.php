<?php
include 'connect_db.php';

if (isset($_POST['p_save'])) {
    $pid = mysqli_real_escape_string($conn, $_POST['p_pid']);
    $name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['p_desc']);
    $brand = mysqli_real_escape_string($conn, $_POST['p_brand']);
    $category = mysqli_real_escape_string($conn, $_POST['p_category']);
    $quan = mysqli_real_escape_string($conn, $_POST['p_quan']);
    $price = mysqli_real_escape_string($conn, $_POST['p_price']);
    $total = mysqli_real_escape_string($conn, $_POST['p_total']);

    $query = "INSERT INTO tb_product (product_name, product_desc, product_active, product_brand, product_category, quantity, unit_price, total_stock, product_pid) VALUES ('$name', '$desc', 'yes', '$brand', '$category', '$quan', '$price', '$total', '$pid')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>window.location.href="products.php"</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$brand_query = "SELECT * FROM brand";
$brand_result = mysqli_query($conn, $brand_query);
$brands = [];
if (mysqli_num_rows($brand_result) > 0) {
    while ($brand_row = mysqli_fetch_assoc($brand_result)) {
        $brands[] = $brand_row;
    }
}

$category_query = "SELECT * FROM tb_category";
$category_result = mysqli_query($conn, $category_query);
$categorys = [];
if (mysqli_num_rows($category_result) > 0) {
    while ($category_row = mysqli_fetch_assoc($category_result)) {
        $categorys[] = $category_row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .card_style {
            margin-top: 50px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5 card_style">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Add New Product</h4>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="p_pid" class="form-label">Product ID:</label>
                                <input type="text" class="form-control" id="p_pid" name="p_pid" required>
                            </div>
                            <div class="mb-3">
                                <label for="p_name" class="form-label">Product Name:</label>
                                <input type="text" class="form-control" id="p_name" name="p_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="p_brand" class="form-label">Brand:</label>
                                <select class="form-select" id="p_brand" name="p_brand" required>
                                    <option value="">Select Brand</option>
                                    <?php foreach ($brands as $brand): ?>
                                        <option value="<?= htmlspecialchars($brand['brand_name']) ?>"><?= htmlspecialchars($brand['brand_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="p_category" class="form-label">Category:</label>
                                <select class="form-select" id="p_category" name="p_category" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categorys as $category): ?>
                                        <option value="<?= htmlspecialchars($category['category_name']) ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="p_desc" class="form-label">Description:</label>
                                <textarea class="form-control" id="p_desc" rows="2" name="p_desc"></textarea>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="p_quan" class="form-label">Quantity:</label>
                                    <input type="number" class="form-control" id="p_quan" name="p_quan" min="0">
                                </div>
                                <div class="col">
                                    <label for="p_price" class="form-label">Unit Price:</label>
                                    <input type="number" class="form-control" id="p_price" name="p_price" min="0" step="0.01">
                                </div>
                                <div class="col">
                                    <label for="p_total" class="form-label">Total Stock:</label>
                                    <input type="number" class="form-control" id="p_total" name="p_total" min="0">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary form-control" name="p_save">Save</button>
                                </div>
                                <div class="col">
                                    <a href="products.php" class="btn btn-danger form-control">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
