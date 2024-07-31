<!-- <?php include 'connect_db.php'; 
if(isset($_POST['b_save'])){
    $name = mysqli_real_escape_string($conn, $_POST['b_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['b_desc']);
    

    // Save information
    $query = "INSERT INTO brands (brand_name, brand_desc) VALUES ('$name', '$desc')";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo '<script>window.location.href="brand.php"</script>';
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
    <title>Add New Product</title>

    //Bootstrap 5
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    //Bootstrap Icons
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #2E4053;
        }

        .card_style {
            background-color: #F4F4F4;
            margin-top: 50px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>

</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card card_style">
                <form action="" method="post">
                    <div class="card-body">
                        <h4 class="text-center mt-3 mb-5">Add New Brand</h4>

                        <div class="mb-3">
                            <label class="form-label">Brand Name</label>
                            <input type="text" class="form-control" required name="b_name">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="2" style="resize: none;" name="b_desc"></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <a href="brand.php" class="btn btn-danger form-control" name="b_save">Cancel</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary form-control">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html> -->

<?php
include 'connect_db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $brand_desc = mysqli_real_escape_string($conn, $_POST['brand_desc']);
    

    $query = "INSERT INTO brands (brand_name, brand_desc) VALUES ('$brand_name', '$brand_desc')";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href='brand.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
