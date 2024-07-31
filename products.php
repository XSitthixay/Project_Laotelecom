<?php include 'connect_db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>
<body>

<?php include "nav-menu.php"; ?>

<div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card card-style">
                    <div class="card-header">
                        <h4 class="card-title text-center">Product List</h4>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="container-fluid">
                                <div class="card-body text-end">
                                    <a href="product_add.php" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus me-1"></i>Add New Product</a>
                                </div>
                            </div>
                            <div class="container-fluid table-container">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Order Status</th>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">Serial Number</th>
                                            <th class="text-center">Screen Size</th>
                                            <th class="text-center">Body Weight</th>
                                            <th class="text-center">Chips</th>
                                            <th class="text-center">Storage</th>
                                            <th class="text-center">Color</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Model Number</th>
                                            <th class="text-center">Warranty Period</th>
                                            <th class="text-center">Supplier</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Brand</th>
                                            <th class="text-center">Date of Purchase</th>
                                            <th class="text-center">Stock Quantity</th>
                                            <th class="text-center">Location</th>
                                            <th class="text-center">Reorder Level</th>
                                            <th class="text-center">Barcode</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT products.*, orders.order_id, orders.order_status FROM products 
                                                  LEFT JOIN order_details ON products.product_id = order_details.product_id 
                                                  LEFT JOIN orders ON order_details.order_id = orders.order_id 
                                                  ORDER BY products.product_id";
                                        $result = mysqli_query($conn, $query);
                                        $result_num = mysqli_num_rows($result);
                                        if ($result_num > 0){
                                            $index = 1; 
                                            foreach($result as $rows){
                                                $order_id = $rows['order_id'];
                                                $order_status = $rows['order_status'];
                                                $product_id = $rows['product_id']; // Add this line to get the product_id
                                                $product_name = $rows['product_name'];
                                                $serial_number  = $rows['serial_number'];
                                                $screen_size = $rows['screen_size'];
                                                $body_weight = $rows['body_weight'];
                                                $chips = $rows['chips'];
                                                $storage = $rows['storage'];
                                                $color = $rows['color'];
                                                $price = $rows['price'];
                                                $description = $rows['description'];
                                                $model_number = $rows['model_number'];
                                                $warranty_period = $rows['warranty_period'];
                                                $supplier_name  = $rows['supplier_name'];
                                                $category_name  = $rows['category_name'];
                                                $brand_name  = $rows['brand_name'];
                                                $date_of_purchase = $rows['date_of_purchase'];
                                                $stock_quantity = $rows['stock_quantity'];
                                                $location = $rows['location'];
                                                $status = $rows['status'];
                                                $reorder_level = $rows['reorder_level'];
                                                $barcode = $rows['barcode'];
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $index ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm <?= $order_status == 'Completed' ? 'btn-success' : ($order_status == 'Pending' ? 'btn-warning' : 'btn-secondary') ?>" href="order_status.php?id=<?= $order_id ?>&status=<?= $order_status ?>">
                                                        <?= $order_status ?>
                                                    </a>
                                                </td>

                                                <td class="text-start"><?= $product_name ?></td>
                                                <td class="text-start"><?= $serial_number ?></td>
                                                <td class="text-center"><?= $screen_size ?></td>
                                                <td class="text-start"><?= $body_weight ?></td>
                                                <td class="text-center"><?= $chips ?></td>
                                                <td class="text-center"><?= $storage ?></td>
                                                <td class="text-center"><?= $color ?></td>
                                                <td class="text-start"><?= $price ?></td>
                                                <td class="text-start"><?= $description ?></td>
                                                <td class="text-start"><?= $model_number ?></td>
                                                <td class="text-center"><?= $warranty_period ?></td>
                                                <td class="text-start"><?= $supplier_name ?></td>
                                                <td class="text-center"><?= $category_name ?></td>
                                                <td class="text-center"><?= $brand_name ?></td>
                                                <td class="text-center"><?= $date_of_purchase ?></td>
                                                <td class="text-center"><?= $stock_quantity ?></td>
                                                <td class="text-center"><?= $location ?></td>
                                                <td class="text-center"><?= $reorder_level ?></td>
                                                <td class="text-center"><?= $barcode ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($status == 'yes') {
                                                        ?>
                                                            <a class="btn btn-success btn-sm" href="product_status.php?status=yes&id=<?= $product_id ?>">Instock</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <a class="btn btn-danger btn-sm" href="product_status.php?status=no&id=<?= $product_id ?>">Soldout</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-outline-primary btn-sm" href="product_edit.php?edit_id=<?= $product_id ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm" href="product_delete.php?delete_pid=<?= $product_id ?>">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                    <!-- Add a button to trigger deletion of products based on order_id -->
                                                    <a class="btn btn-outline-warning btn-sm" href="delete_products.php?order_id=<?= $order_id ?>" onclick="return confirm('Are you sure you want to delete products for this order?')">
                                                        <i class="bi bi-x-circle"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        $index++;
                                            }
                                        } else {
                                            echo '<tr><td colspan="22" class="text-center">No records found</td></tr>'; 
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
</div>

<!-- jQuery and DataTables Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "responsive": true
        });
    });
</script>
</body>
</html>
