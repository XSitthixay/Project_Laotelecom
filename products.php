<?php include 'connect_db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Data Table -->
    <link rel="stylesheet" href="http://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Noto Sans', sans-serif; /* Changed to Noto Sans */
            background-color: #f8f9fa; /* Added background color for clarity */
        }

        .card_style {
            margin-top: 50px;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background-color: #fff; /* Added white background */
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
            background-color: #212F3C; /* Darker background */
            overflow-x: hidden;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Optional: Adds a subtle shadow */
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
            background-color: #6c757d; /* Darker hover background */
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
            margin-left: 250px; /* Adjusted to match sidebar width */
            padding: 20px;
            width: calc(100% - 250px);
        }
        .table-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow-x: auto; /* Enable horizontal scroll if needed */
        }
        .menu-item {
            font-size: 1.25rem; /* Increase font size */
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
                <li class="list-group-item"><a  href="dashboard.php">Dashboard</a></li>
                <li class="list-group-item"><a  href="products.php">Products</a></li>
                <li class="list-group-item"><a  href="brand.php">Brand</a></li>
                <li class="list-group-item"><a  href="category.php">Category</a></li>
                
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
                            <h4 class="card-title text-center">Product List</h4>
                        </div>
                        <div class="card-body">

                            <!-- <div class="fs-2 text-center mt-2 fw-bold">Product List</div> -->
                            <div class="container-fluid">
                                <div class="card-body text-center">
                                    <a href="product_add.php" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus me-1"></i>Add New Product</a>
                                </div>
                            </div>

                            <div class="container-fluid mt-2">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="fs-6 text-center">No</th>
                                            <th class="fs-6 text-center">Product ID</th>
                                            <th class="fs-6 text-start">Product Name</th>
                                            <th class="fs-6 text-start">Brand</th>
                                            <th class="fs-6 text-center">Category</th>
                                            <th class="fs-6 text-start">Description</th>
                                            <th class="fs-6 text-center">Quantity</th>
                                            <th class="fs-6 text-center">Price</th>
                                            <th class="fs-6 text-center">Total Stock</th>
                                            <th class="fs-6 text-center">Status</th>
                                            <th class="fs-6 text-center">Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM tb_product ORDER BY product_id";
                                            $result = mysqli_query($conn, $query);
                                            $result_num = mysqli_num_rows($result);
                                            if ($result_num > 0){
                                                $index = 1; 
                                                foreach($result as $rows){
                                                    $product_id = $rows['product_id'];
                                                    $product_pid = $rows['product_pid'];
                                                    $product_name = $rows['product_name'];
                                                    $product_desc = $rows['product_desc'];
                                                    $product_active = $rows['product_active'];
                                                    $product_brand = $rows['product_brand'];
                                                    $product_category = $rows['product_category'];
                                                    $product_quantity = $rows['quantity'];
                                                    $product_unit_price = $rows['unit_price'];
                                                    $product_total_stock = $rows['total_stock'];
                                        ?>
                                                    <tr>
                                                        <td class="text-center"><?= $index ?></td>
                                                        <td class="text-start"><?= $product_pid ?></td>
                                                        <td class="text-start"><?= $product_name ?></td>
                                                        <td class="text-start"><?= $product_brand ?></td>
                                                        <td class="text-center"><?= $product_category ?></td>
                                                        <td class="text-start"><?= $product_desc ?></td>
                                                        <td class="text-center"><?= $product_quantity ?></td>
                                                        <td class="text-center"><?= $product_unit_price ?></td>
                                                        <td class="text-center"><?= $product_total_stock ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            if ($product_active == 'yes') {
                                                                ?>
                                                                    <a class="btn btn-success btn-sm" href="product_status.php?status=yes&id=<?= $product_id ?>">Instock</a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                    <a class="btn btn-danger btn-sm" href="product_status.php?status=no&id=<?= $product_id ?>">Sold out</a>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-outline-primary btn-sm" href="product_edit.php?edit_id=<?= $product_id ?>">
                                                                <i class="bi bi-pencil"></i> Edit
                                                            </a>
                                                            <a class="btn btn-outline-danger btn-sm" href="product_delete.php?delete_pid=<?= $product_id ?>">
                                                                <i class="bi bi-trash"></i>Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                        <?php
                                        $index++;
                                                }
                                            } else {
                                                echo '<tr><td colspan="10" class="text-center">No records found</td></tr>';
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
    </div>
</body>
</html>
