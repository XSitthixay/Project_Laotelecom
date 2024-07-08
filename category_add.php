<?php include 'connect_db.php'; 
if(isset($_POST['c_save'])){
    $name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['c_desc']);
    

    // Save information
    $query = "INSERT INTO tb_category (category_name, category_desc, category_active) VALUES ('$name', '$desc', 'yes')";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo '<script>window.location.href="category.php"</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New category</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Noto Sans Lao';
        }

        .card_style {
            background-color: #F4F4F4;
            margin-top: 50px;
            border-radius: 10px;
            padding: 20px;
        }
    </style>

</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card card_style">
                <form action="" method="post">
                    <div class="card-body">
                        <h4 class="text-center mt-3 mb-5">Add New Category</h4>

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" required name="c_name">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="2" style="resize: none;" name="c_desc"></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary form-control" name="c_save">Save</button>
                            </div>
                            <div class="col">
                                <a href="Category.php" class="btn btn-danger form-control">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
