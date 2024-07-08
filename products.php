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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Data Table -->
    <link rel="stylesheet" href="http://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</head>
<body>
    <?php include 'nav-menu.php'; ?>

    <div class="fs-2 text-center mt-2 fw-bold">All Products</div>

    <div class="container-fluid">
        <div class="card-body text-end">
            <a href="product_add.php" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus me-1"></i>Add New Product</a>
        </div>
    </div>

    <div class="container-fluid mt-2">
        <table id="myTable" class="table table-bordered table-hover">
            <thead style="background-color: #2E2D2D; color: #ffffff;">
                <th class="fs-6 text-center">No</th>
                <th class="fs-6 text-start">Product Name</th>
                <th class="fs-6 text-start">Brand</th>
                <th class="fs-6 text-center">Category</th>
                <th class="fs-6 text-start">Description</th>
                <th class="fs-6 text-center">Quantity</th>
                <th class="fs-6 text-center">Unit Price</th>
                <th class="fs-6 text-center">Total Stock</th>
                <th class="fs-6 text-center">Status</th>
                <th class="fs-6 text-center">Active</th>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM tb_product ORDER BY product_id";
                    $result = mysqli_query($conn, $query);
                    $result_num = mysqli_num_rows($result);
                    if ($result_num > 0){
                        $index = 1; 
                        foreach($result as $rows){
                           
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
                                            <a class="btn btn-primary btn-sm" style="width: 100px; border-radius: 10px;" href="product_status.php?status=yes&id=<?= $product_id ?>">Instock</a>
                                        <?php
                                    } else {
                                        ?>
                                            <a class="btn btn-danger btn-sm" style="width: 100px; border-radius: 10px;" href="product_status.php?status=no&id=<?= $product_id ?>">Sold out</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-outline-primary btn-sm" href="product_edit.php?edit_id=<?= $product_id ?>">
                                        <i class="bi bi-pen"></i> Edit
                                    </a>
                                    <a class="btn btn-outline-primary btn-sm" style="background-color: red; color: #ffffff;" href="product_delete.php?delete_id=<?= $product_id ?>">
                                        Delete
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
</body>
</html>
