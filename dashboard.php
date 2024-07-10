<?php include 'connect_db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Data Table -->
    <link rel="stylesheet" href="http://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
        });
    </script>

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
            background-color: #212F3C;
            overflow-x: hidden;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 18px;
            color: #dcdcdc; /* Lighter font color */
            display: block;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
        }
        .sidebar .list-group-item {
            background-color: transparent;
            border: none;
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
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Inventory System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Username</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="login.php  ">Log out</a>
                    </li>
                    <!-- Add more nav links as needed -->
                </ul>
            </div>
        </div>
    </nav>

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

    <div class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Dashboard</h5>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
