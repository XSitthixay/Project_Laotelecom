<?php
include "connect_db.php";

if (isset($_GET['delete_uid']) && isset($_GET['user_type'])) {
    $delete_uid = $_GET['delete_uid'];
    $user_type = $_GET['user_type'];

    // Determine the table based on user type
    $table = "";
    switch ($user_type) {
        case 'saler':
            $table = "saler";
            break;
        case 'accountant':
            $table = "accountant";
            break;
        case 'admin':
            $table = "admins";
            break;
        default:
            die("Invalid user type specified.");
    }

    // Delete the user
    $query = "DELETE FROM $table WHERE {$user_type}_id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $delete_uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Redirect to the user management page
    header("Location: user.php");
} else {
    echo "Invalid request.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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

<!-- Modal -->
<form action="" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" name="cancel">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- JQuery V.3 -->
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#deleteModal').modal('show');
    });
</script>

</body>

</html>
