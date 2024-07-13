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
        .navbar-custom {
            background-color: #2E4053;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 73px;
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
            color: #dcdcdc;
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
            font-size: 1.25rem;
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
            </ul>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <?php
            // Fetch total counts
            $totalProducts = $conn->query("SELECT COUNT(*) AS total FROM tb_product")->fetch_assoc()['total'];
            $totalBrands = $conn->query("SELECT COUNT(*) AS total FROM brand")->fetch_assoc()['total'];
            $totalCategories = $conn->query("SELECT COUNT(*) AS total FROM tb_category")->fetch_assoc()['total'];
            $totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

            // Fetch recent activities
            $recentActivities = $conn->query("SELECT * FROM (
                SELECT 'Product added' AS activity, 'John Doe' AS user, '2024-07-09' AS date
                UNION
                SELECT 'Brand updated', 'Jane Smith', '2024-07-08'
                UNION
                SELECT 'Category deleted', 'Mike Johnson', '2024-07-07'
                ) AS activities ORDER BY date DESC LIMIT 5");
            ?>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Dashboard</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card bg-primary text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Products</h5>
                                            <p class="display-4"><?php echo $totalProducts; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card bg-success text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Brands</h5>
                                            <p class="display-4"><?php echo $totalBrands; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card bg-warning text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Categories</h5>
                                            <p class="display-4"><?php echo $totalCategories; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card bg-danger text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Users</h5>
                                            <p class="display-4"><?php echo $totalUsers; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Recent Activity</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">User</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while($activity = $recentActivities->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?php echo $activity['activity']; ?></td>
                                                        <td><?php echo $activity['user']; ?></td>
                                                        <td><?php echo $activity['date']; ?></td>
                                                    </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End of card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
