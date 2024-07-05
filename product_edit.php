<?php include 'connect_db.php';
$id = $_GET['edit_id'];

// get information with id
$query = "SELECT * FROM tb_product WHERE product_id = '$id'";
$result = mysqli_query($conn, $query);
$info_row = mysqli_num_rows($result);
if ($info_row > 0) {
    foreach($result as $row){
        $name = $row['product_name'];
        $brand = $row['product_brand'];
        $category = $row['product_category'];
        $desc = $row['product_desc'];
        $quan = $row['quantity'];
        $price = $row['unit_price'];
        $total = $row['total_stock'];
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

// update information
if (isset($_POST['update'])){
    $name = $_POST['p_name'];
    $desc = $_POST['p_desc'];
    $brand = $_POST['p_brand'];
    $category = $_POST['p_category'];
    $quan = $_POST['p_quan'];
    $price = $_POST['p_price'];
    $total = $_POST['p_total'];

    $query_update = "UPDATE tb_product SET product_name='$name', product_desc='$desc', product_brand='$brand', product_category='$category', quantity='$quan', unit_price='$price', total_stock='$total' WHERE product_id='$id'";
    $result = mysqli_query($conn, $query_update);
    if ($result) {
        echo '<script>window.location.href="products.php"</script>';
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
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="container card_style">
                <form action="" method="post">
                    <div class="card-body text-start">
                        <h4 class="text-center mt-3 mb-5">Product Edit</h4>

                        <div class="mb-3">
                            <label class="form-label">Product Name:</label>
                            <input type="text" class="form-control" required name="p_name" value="<?= $name ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Brand:</label>
                            <select class="form-select" name="p_brand">
                                <?php foreach($brands as $brand_option): ?>
                                    <option value="<?= htmlspecialchars($brand_option['brand_id']) ?>" <?= ($brand == $brand_option['brand_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($brand_option['brand_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category:</label>
                            <select class="form-select" name="p_category">
                                <?php foreach($categorys as $category_option): ?>
                                    <option value="<?= htmlspecialchars($category_option['category_id']) ?>" <?= ($category == $category_option['category_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category_option['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description:</label>
                            <textarea type="text" class="form-control" rows="2" style="resize: none;" name="p_desc"><?= $desc ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity:</label>
                            <input type="text" class="form-control" name="p_quan" value="<?= $quan ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Unit Price:</label>
                            <input type="text" class="form-control" name="p_price" value="<?= $price ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Stock:</label>
                            <input type="text" class="form-control" name="p_total" value="<?= $total ?>">
                        </div>

                        <div class="row mb-3 mt-5">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary form-control" name="update">Save</button>
                            </div>

                            <div class="col-6">
                                <a href="products.php" type="button" class="btn btn-danger form-control">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</body>

</html>
