<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
    <!-- Bootstrap icon -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Noto Sans Lao', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #2E4053;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 56px; /* Adjust this value to match the height of your navbar */
            left: 0;
            background-color: #515A5A;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 18px;
            color: #17202A;
            display: block;
        }
        .sidebar a:hover {
            background-color: #515A5A;
            color: white;
        }
        .card-header {
            background-color: #2E4053;
            color: #ffffff;
        }
        .btn-outline-success {
            margin-bottom: 10px;
            border-radius: 10px;
        }
        .table thead {
            background-color: #2E4053;
            color: #ffffff;
        }
        
        .table td, .table th {
            vertical-align: middle;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .menu-item {
            font-size: 1.25rem; /* Increase font size */
        }
    </style>
</head>
<body>
    <?php include 'nav-menu.php' ?>
    <div class="sidebar">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a  href="dashboard.php">Dashboard</a></li>
                <li class="list-group-item"><a  href="products.php">Products</a></li>
                <li class="list-group-item"><a  href="brand.php">Brand</a></li>
                <li class="list-group-item"><a  href="Category.php">Category</a></li>
                
                <!-- Add more menu items as needed -->
            </ul>
        </div>
    </div>
</body>
</html>