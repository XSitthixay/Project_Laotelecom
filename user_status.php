<?php 
include "connect_db.php";

// Retrieve parameters from URL
$id = $_GET['id'];
$old_status = $_GET['status'];
$user_type = $_GET['user_type']; // This should be 'saler' or 'accountant'

// Initialize new_status based on old_status
$new_status = ($old_status == 'active') ? 'inactive' : 'active';

if (isset($_POST['cancel'])){
    echo '<script>window.location.href="user.php"</script>';
    exit;
}

if (isset($_POST['change'])){
    // Determine the table and ID column based on user_type
    if ($user_type == 'saler') {
        $table = 'saler';
        $id_column = 'saler_id';
    } elseif ($user_type == 'accountant') {
        $table = 'accountant';
        $id_column = 'accountant_id';
    } else {
        echo "Invalid user type.";
        exit;
    }

    // Prepare and execute the update query using a prepared statement
    $query = "UPDATE $table SET status = ? WHERE $id_column = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $new_status, $id);
    $result = $stmt->execute();

    if ($result) {
        echo '<script>window.location.href="user.php"</script>';
    } else {
        echo "Error updating status.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Status</title>

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
        <div class="modal fade" id="onload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Status Change</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to change the status?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" name="cancel">Close</button>
                        <button type="submit" class="btn btn-primary" name="change">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script>
    window.onload = () => {
        $('#onload').modal('show');
    }
</script>
