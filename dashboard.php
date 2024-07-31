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

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#recentOrdersTable').DataTable();
        });
    </script>

    <style>
        .custom-bg-primary { background-color: #007bff; }
        .custom-bg-success { background-color: #28a745; }
        .custom-bg-success2 { background-color: lawngreen; }
        .custom-bg-warning { background-color: #ffc107; }
        .custom-bg-warning2 { background-color: orangered; }
        .custom-bg-danger { background-color: #dc3545; }
        .custom-bg-danger2 { background-color: #e83e8c; }
    </style>
</head>
<body>
    <?php include 'nav-menu.php'; ?>

    <div class="content">
        <div class="container-fluid">
            <?php
            // Fetch total counts
            $totalBrands = $conn->query("SELECT COUNT(*) AS total FROM brands")->fetch_assoc()['total'];
            $totalCategories = $conn->query("SELECT COUNT(*) AS total FROM categories")->fetch_assoc()['total'];
            $totalAdmin = $conn->query("SELECT COUNT(*) AS total FROM admins")->fetch_assoc()['total'];
            $totalSaler = $conn->query("SELECT COUNT(*) AS total FROM saler")->fetch_assoc()['total'];
            $totalAcc = $conn->query("SELECT COUNT(*) AS total FROM accountant")->fetch_assoc()['total'];
            $totalOrders = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];

            // Fetch total products and adjust based on orders
            $totalProductsQuery = "
                SELECT 
                    p.product_id, 
                    p.product_name, 
                    p.stock_quantity, 
                    COALESCE(SUM(od.quantity), 0) AS ordered_quantity
                FROM products p
                LEFT JOIN order_details od ON p.product_id = od.product_id
                GROUP BY p.product_id
            ";
            $productsResult = $conn->query($totalProductsQuery);

            $totalProducts = 0;
            while ($product = $productsResult->fetch_assoc()) {
                $available_quantity = $product['stock_quantity'] - $product['ordered_quantity'];
                if ($available_quantity > 0) {
                    $totalProducts += $available_quantity;
                }
            }

            // Fetch recent orders
            $recentOrders = $conn->query("SELECT orders.order_id, orders.order_date, orders.total_amount, orders.order_status, customers.customer_name 
                                          FROM orders 
                                          JOIN customers ON orders.customer_id = customers.customer_id 
                                          ORDER BY orders.order_date DESC LIMIT 5");
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
                                    <div class="card custom-bg-primary text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Products</h5>
                                            <p class="display-4"><?php echo $totalProducts; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card custom-bg-success text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Brands</h5>
                                            <p class="display-4"><?php echo $totalBrands; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card custom-bg-warning text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Categories</h5>
                                            <p class="display-4"><?php echo $totalCategories; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card custom-bg-danger text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Orders</h5>
                                            <p class="display-4"><?php echo $totalOrders; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card custom-bg-danger2 text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Admin</h5>
                                            <p class="display-4"><?php echo $totalAdmin; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card custom-bg-success2 text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Saler</h5>
                                            <p class="display-4"><?php echo $totalSaler; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card custom-bg-warning2 text-white mb-4">
                                        <div class="card-body">
                                            <h5>Total Accountant</h5>
                                            <p class="display-4"><?php echo $totalAcc; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Orders Table -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Recent Orders</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="recentOrdersTable" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Customer Name</th>
                                                            <th>Order Date</th>
                                                            <th>Total Amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($order = $recentOrders->fetch_assoc()): ?>
                                                            <tr>
                                                                <td><?php echo $order['order_id']; ?></td>
                                                                <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                                                                <td><?php echo date('Y-m-d', strtotime($order['order_date'])); ?></td>
                                                                <td><?php echo number_format($order['total_amount'], 2); ?></td>
                                                                <td>
                                                                    <?php if ($order['order_status'] == 'Completed'): ?>
                                                                        <span class="badge bg-success">Completed</span>
                                                                    <?php else: ?>
                                                                        <span class="badge bg-danger">Pending</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
