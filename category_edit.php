<?php
include 'connect_db.php';

$id = $_GET['edit_cid'];

// Fetch existing information with id
$query = "SELECT * FROM categories WHERE category_id = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['category_name'];
    $desc = $row['category_desc'];
}

// Update information
if (isset($_POST['update'])) {
    $c_name = $_POST['c_name'];
    $c_desc = $_POST['c_desc'];

    // Update query with corrected variable names
    $query_update = "UPDATE categories SET category_name='$c_name', category_desc='$c_desc' WHERE category_id='$id'";
    $result_update = mysqli_query($conn, $query_update);

    if ($result_update) {
        echo '<script>window.location.href="Category.php"</script>';
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
    <title>Category Edit</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #2E4053;
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
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="container card_style">
                <form action="" method="post">
                    <div class="card-body text-start">
                        <h4 class="text-center mt-3 mb-5">Category Edit</h4>

                        <div class="mb-3">
                            <label class="form-label">Category Name:</label>
                            <input type="text" class="form-control" required name="c_name" value="<?= $name ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description:</label>
                            <textarea class="form-control" rows="2" style="resize: none;" name="c_desc"><?= $desc ?></textarea>
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">Active:</label>
                            <select class="form-select" name="c_active">
                                <option value="yes" <?= $active == 'yes' ? 'selected' : '' ?>>Yes</option>
                                <option value="no" <?= $active == 'no' ? 'selected' : '' ?>>No</option>
                            </select>
                        </div> -->

                        <div class="row mb-3 mt-5">
                            <div class="col-6">
                                <a href="Category.php" type="button" class="btn btn-danger form-control">Cancel</a>
                            </div>

                            <div class="col-6">
                                <button type="submit" class="btn btn-primary form-control" name="update">Save</button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</body>

</html>
