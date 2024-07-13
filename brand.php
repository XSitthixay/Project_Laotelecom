<?php include "connect_db.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Noto Sans Lao', sans-serif;
        }
        .navbar-custom {
            background-color: #2E4053;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 73px; /* Adjust this value to match the height of your navbar */
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
        .content {
            margin-left: 250px; /* Adjusted to match sidebar width */
            width: calc(100% - 250px);
            padding: 20px;
        }
        .card-header {
            background-color: #2E4053;
            color: #ffffff;
        }
        .btn-outline-success, .btn-outline-primary, .btn-outline-danger {
            border-radius: 10px;
        }
        .table-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow-x: auto; /* Enable horizontal scroll if needed */
            padding: 2rem;
        }
        .table thead {
            background-color: #2E4053;
            color: white;
        }
        .table thead th {
            vertical-align: middle;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .page-title {
            margin-top: 1rem;
            font-weight: bold;
        }
        /* Optional: Adjust table responsiveness */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
            .content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <?php include 'nav-menu.php'; ?>

    <div class="sidebar">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="list-group-item"><a href="products.php">Products</a></li>
                <li class="list-group-item"><a href="brand.php">Brand</a></li>
                <li class="list-group-item"><a href="Category.php">Category</a></li>
                <!-- Add more menu items as needed -->
            </ul>
        </div>
    </div>  

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Brand List</h5>
                    </div>
                    <div class="container-fluid">
                        <div class="card-body text-end">
                            <a href="brand_add.php" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus me-1"></i>Add New Brand</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-container">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-start">Brand Name</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM brand ORDER BY brand_id";
                                        $result = mysqli_query($conn, $query);
                                        $result_num = mysqli_num_rows($result);
                                        if ($result_num > 0){
                                            $index = 1; // Initialize index counter
                                            foreach($result as $rows){
                                                $brand_id = $rows['brand_id'];
                                                $brand_name = $rows['brand_name'];
                                                $brand_active = $rows['brand_active'];
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $index ?></td>
                                                    <td class="text-start"><?= $brand_name ?></td>
                                                    <td class="text-center">
                                                        <?php if ($brand_active == 'yes') { ?>
                                                            <span class="btn btn-success btn-sm">Active</span>
                                                        <?php } else { ?>
                                                            <span class="btn btn-danger btn-sm">Inactive</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="brand_edit.php?edit_bid=<?= $brand_id ?>" class="btn btn-outline-primary btn-sm">
                                                            <i class="bi bi-pencil"></i> Edit
                                                        </a>
                                                        <a href="brand_delete.php?delete_bid=<?= $brand_id ?>" class="btn btn-outline-danger btn-sm">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $index++; // Increment index counter
                                            }
                                        } else {
                                            echo '<tr>
                                            <td colspan="4" class="text-center">No records found</td>
                                            </tr>'; 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
