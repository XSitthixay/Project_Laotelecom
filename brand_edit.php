<?php
include 'connect_db.php';

$id = $_GET['edit_id'];

// Fetch existing information with id
$query = "SELECT * FROM brand WHERE brand_id = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['brand_name'];
    $desc = $row['brand_desc'];
    $active = $row['brand_active'];
}

// Update information
if (isset($_POST['update'])){
    $b_name = $_POST['b_name'];
    $b_desc = $_POST['b_desc'];
    $b_active = $_POST['b_active'];

    // Update query with corrected variable names
    $query_update = "UPDATE brand SET brand_name='$b_name', brand_desc='$b_desc', brand_active='$b_active' WHERE brand_id='$id'";
    $result_update = mysqli_query($conn, $query_update);

    if ($result_update) {
        echo '<script>window.location.href="brand.php"</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Edit</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
                        <h4 class="text-center mt-3 mb-5">Brand Edit</h4>

                        <div class="mb-3">
                            <label class="form-label">Brand Name:</label>
                            <input type="text" class="form-control" required name="b_name" value="<?= $name ?>">
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Description:</label>
                            <textarea type="text" class="form-control" rows="2" style="resize: none;" name="b_desc"><?= $desc ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Active:</label>
                            <select class="form-select" name="b_active">
                                <option value="yes" <?= $active == 'yes' ? 'selected' : '' ?>>Yes</option>
                                <option value="no" <?= $active == 'no' ? 'selected' : '' ?>>No</option>
                            </select>
                        </div>

                        <div class="row mb-3 mt-5">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary form-control" name="update">Save</button>
                            </div>

                            <div class="col-6">
                                <a href="brand.php" type="button" class="btn btn-danger form-control">Cancel</a>
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
