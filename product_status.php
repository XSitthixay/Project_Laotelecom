<?php include "connect_db.php";
$id = $_GET['id'];
$old_status = $_GET['status'];

if (isset($_POST['cancel'])){
    echo '<script>window.location.href="products.php"</script>';
}

if (isset($_POST['change'])){
    if ($old_status == 'yes') {
        $new_status = 'no';
    } else {
        $new_status = 'yes';
    }

    $query = "UPDATE products SET status = '$new_status' WHERE product_id = '$id'";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo '<script>window.location.href="products.php"</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change status</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Bootstrap Icons
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->

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

<!-- ************************************* Modal  -->
<!-- Modal -->
<form action="" method="post">
    <div class="modal fade" id="onload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Status change</h5>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" name="cancel">Close</button>
                    <button type="submit" class="btn btn-primary" name="change">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</form>

<body>

</body>

</html>

<!-- JQuery V.3 -->
<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script>
    window.onload = () => {
        $('#onload').modal('show');
    }
</script>