<?php
include 'connect_db.php';

if (isset($_POST['a_save'])) {
    $accountant_id = mysqli_real_escape_string($conn, $_POST['accountant_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO accountant (name, email, contact, status) VALUES ('$name', '$email', '$contact', '$status')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>window.location.href="user.php"</script>';
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
    <title>Add New User</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #283747;
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
                        <h4 class="text-center mb-4">Add New Accountant</h4>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact:</label>
                                <input type="text" class="form-control" id="contact" name="contact" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <a href="user.php" class="btn btn-danger form-control">Cancel</a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary form-control" name="a_save">Save</button>
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

<!-- <script>
  function showPassword() {
    var x = document.getElementById('u_pass');
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script> -->
