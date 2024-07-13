<?php
include 'connect_db.php';

if (isset($_POST['u_save'])) {
    $username = mysqli_real_escape_string($conn, $_POST['u_username']);
    $email = mysqli_real_escape_string($conn, $_POST['u_email']);
    $password = mysqli_real_escape_string($conn, $_POST['u_pass']);

    $query = "INSERT INTO users (email, password, active, username) VALUES ('$email', '$password', 'yes', '$username')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>window.location.href="user.php"</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// $brand_query = "SELECT * FROM users";
// $brand_result = mysqli_query($conn, $brand_query);
// $brands = [];
// if (mysqli_num_rows($brand_result) > 0) {
//     while ($brand_row = mysqli_fetch_assoc($brand_result)) {
//         $brands[] = $brand_row;
//     }
// }

// $category_query = "SELECT * FROM tb_category";
// $category_result = mysqli_query($conn, $category_query);
// $categorys = [];
// if (mysqli_num_rows($category_result) > 0) {
//     while ($category_row = mysqli_fetch_assoc($category_result)) {
//         $categorys[] = $category_row;
//     }
// }
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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
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
                        <h4 class="text-center mb-4">Add New User</h4>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="u_username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="u_username" name="u_username" required>
                            </div>
                            <div class="mb-3">
                                <label for="u_email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="u_email" name="u_email" required>
                            </div>
                            <div class="mb-3">
                                <label for="u_pass" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="myPassword" name="u_pass" required>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary form-control" name="u_save">Save</button>
                                </div>
                                <div class="col">
                                    <a href="user.php" class="btn btn-danger form-control">Cancel</a>
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

<script>
  function showPassword() {
    var x = document.getElementById('myPassword');
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>
