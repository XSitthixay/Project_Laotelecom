<?php
include 'connect_db.php';

$id = $_GET['edit_id'];

// Get product information by id
$query = "SELECT * FROM tb_product WHERE product_id = '$id'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['product_name'];
    $brand = $row['product_brand'];
    $category = $row['product_category'];
    $desc = $row['product_desc'];
    $quan = $row['quantity'];
    $price = $row['unit_price'];
    $total = $row['total_stock'];
} else {
    die("Product not found.");
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
$categories = [];
if (mysqli_num_rows($category_result) > 0) {
    while($category_row = mysqli_fetch_assoc($category_result)) {
        $categories[] = $category_row;
    }
}

// Update information
if (isset($_POST['update'])){
    $name = $_POST['p_name'] ?? null;
    $desc = $_POST['p_desc'] ?? null;
    $brand = $_POST['p_brand'] ?? null;
    $category = $_POST['p_category'] ?? null;
    $quan = $_POST['p_quan'] ?? null;
    $price = $_POST['p_price'] ?? null;
    $total = $_POST['p_total'] ?? null;

    // Debugging: Output the contents of $_POST
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // Check if brand exists in brand table
    $brand_check_query = "SELECT * FROM brand WHERE brand_name = '$brand'";
    $brand_check_result = mysqli_query($conn, $brand_check_query);

    // Check if category exists in category table
    $category_check_query = "SELECT * FROM tb_category WHERE category_name = '$category'";
    $category_check_result = mysqli_query($conn, $category_check_query);

    if (mysqli_num_rows($brand_check_result) > 0 && mysqli_num_rows($category_check_result) > 0) {
        $query_update = "UPDATE tb_product SET product_name='$name', product_desc='$desc', product_brand='$brand', product_category='$category', quantity='$quan', unit_price='$price', total_stock='$total' WHERE product_id='$id'";
        if (mysqli_query($conn, $query_update)) {
            echo '<script>window.location.href="products.php"</script>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Error: The brand or category you entered does not exist.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Edit</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #f8f9fa;
        }

        .card_style {
            margin-top: 50px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card card_style">
                    <h4 class="card-title text-center mb-4">Edit Product</h4>
                    <form method="post" action="product_edit.php?edit_id=<?php echo $id; ?>">
                        <div class="mb-3">
                            <label for="p_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="p_name" name="p_name" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>
                            
                        <div class="mb-3">
                            <label for="p_desc" class="form-label">Product Description</label>
                            <input type="text" class="form-control" id="p_desc" name="p_desc" value="<?php echo htmlspecialchars($desc); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="p_brand" class="form-label">Brand</label>
                            <select class="form-select" id="p_brand" name="p_brand" required>
                                <?php foreach($brands as $b) {
                                    $selected = ($b['brand_name'] == $brand) ? 'selected' : '';
                                    echo "<option value='{$b['brand_name']}' $selected>{$b['brand_name']}</option>";
                                } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="p_category" class="form-label">Category</label>
                            <select class="form-select" id="p_category" name="p_category" required>
                                <?php foreach($categories as $c) {
                                    $selected = ($c['category_name'] == $category) ? 'selected' : '';
                                    echo "<option value='{$c['category_name']}' $selected>{$c['category_name']}</option>";
                                } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="p_quan" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="p_quan" name="p_quan" value="<?php echo htmlspecialchars($quan); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="p_price" class="form-label">Unit Price</label>
                            <input type="text" class="form-control" id="p_price" name="p_price" value="<?php echo htmlspecialchars($price); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="p_total" class="form-label">Total Stock</label>
                            <input type="number" class="form-control" id="p_total" name="p_total" value="<?php echo htmlspecialchars($total); ?>" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
