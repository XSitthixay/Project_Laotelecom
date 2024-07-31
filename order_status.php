<?php 
include "connect_db.php";
$id = $_GET['id'];
$old_status = isset($_GET['status']) ? $_GET['status'] : '';

if (empty($old_status)) {
    echo '<script>alert("You cannot change the status as it is not set."); window.location.href="products.php";</script>';
    exit();
}

if (isset($_POST['cancel'])){
    echo '<script>window.location.href="products.php"</script>';
    exit();
}

if (isset($_POST['change'])){
    if ($old_status == 'Completed') {
        $new_status = 'Pending';
    } else {
        $new_status = 'Completed';
    }

    $query = "UPDATE orders SET order_status = '$new_status' WHERE order_id = '$id'";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo '<script>window.location.href="products.php"</script>';
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Status</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

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

    <!-- JQuery V.3 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.onload = () => {
            $('#onload').modal('show');
        }
    </script>
</body>

</html>
