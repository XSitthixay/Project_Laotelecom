<?php 
include 'connect_db.php';

// Initialize variables to avoid errors
$name = $desc = $brand = $category = $quan = $price = $total = '';

if(isset($_POST['p_save'])){
    $name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['p_desc']);
    $brand = mysqli_real_escape_string($conn, $_POST['p_brand']);
    $category = mysqli_real_escape_string($conn, $_POST['p_category']);
    $quan = mysqli_real_escape_string($conn, $_POST['p_quan']); // assuming you have p_quan in your form
    $price = mysqli_real_escape_string($conn, $_POST['p_price']); // assuming you have p_price in your form
    $total = mysqli_real_escape_string($conn, $_POST['p_total']); // assuming you have p_total in your form

    // Save information
    $query = "INSERT INTO tb_product (product_name, product_desc, product_active, product_brand, product_category, quantity, unit_price, total_stock) 
              VALUES ('$name', '$desc', 'yes', '$brand', '$category','$quan', '$price', '$total')";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo '<script>window.location.href="products.php"</script>';
        exit; // Optional: exit after redirect
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch brand data
$brand_query = "SELECT * FROM brand";
$brand_result = mysqli_query($conn, $brand_query);
$brands = [];
if (mysqli_num_rows($brand_result) > 0) {
    while($brand_row = mysqli_fetch_assoc($brand_result)) {
        $brands[] = $brand_row;
    }
}

// Fetch category data
$category_query = "SELECT * FROM tb_category";
$category_result = mysqli_query($conn, $category_query);
$categorys = [];
if (mysqli_num_rows($category_result) > 0) {
    while($category_row = mysqli_fetch_assoc($category_result)) {
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

     <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Noto Sans', sans-serif; /* Changed to Noto Sans */
            background-color: #f8f9fa; /* Added background color for clarity */
        }

        .card_style {
            margin-top: 50px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background-color: #fff; /* Added white background */
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card_style">
                    <div class="card-body">
                        <h4 class="text-center mt-3 mb-5">Add New Product</h4>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">Product Name:</label>
                                <input type="text" class="form-control" required name="p_name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Brand:</label>
                                <select class="form-select" name="p_brand">
                                    <?php foreach($brands as $brand_option): ?>
                                        <option value="<?= htmlspecialchars($brand_option['brand_id']) ?>">
                                            <?= htmlspecialchars($brand_option['brand_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category:</label>
                                <select class="form-select" name="p_category">
                                    <?php foreach($categorys as $category_option): ?>
                                        <option value="<?= htmlspecialchars($category_option['category_id']) ?>">
                                            <?= htmlspecialchars($category_option['category_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description:</label>
                                <textarea class="form-control" rows="2" name="p_desc"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantity:</label>
                                <input type="text" class="form-control" name="p_quan">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Unit Price:</label>
                                <input type="text" class="form-control" name="p_price">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Stock:</label>
                                <input type="text" class="form-control" name="p_total">
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

</html>
