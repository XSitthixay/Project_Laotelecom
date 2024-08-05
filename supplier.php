<?php include "connect_db.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style>
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php include "nav-menu.php"; ?>

<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="supplier_add.php" method="post">
                    <div class="mb-3">
                        <label for="supplier_name" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="supplier_contact" name="supplier_contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplier_address" class="form-label">Address</label>
                        <textarea class="form-control" rows="2" style="resize: none;" name="supplier_address"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card card-style">
                    <div class="card-header">
                        <h4 class="card-title text-center">Supplier List</h4>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="card-body text-end">
                                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                                    <i class="bi bi-file-earmark-plus me-1"></i>Add New Supplier
                                </button>
                            </div>
                            <div class="table-responsive table-container">
                                <table id="supplierTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-start">Supplier Name</th>
                                            <th class="text-center">Contact</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM suppliers ORDER BY supplier_id";
                                            $result = mysqli_query($conn, $query);
                                            if ($result) {
                                                $index = 1; // Initialize index counter
                                                while ($rows = mysqli_fetch_assoc($result)) {
                                                    $supplier_id = $rows['supplier_id'];
                                                    $supplier_name = $rows['supplier_name'];
                                                    $supplier_contact = $rows['supplier_contact'];
                                                    $supplier_address = $rows['supplier_address'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?= $index ?></td>
                                                        <td class="text-start"><?= htmlspecialchars($supplier_name) ?></td>
                                                        <td class="text-start"><?= htmlspecialchars($supplier_contact) ?></td>
                                                        <td class="text-start"><?= htmlspecialchars($supplier_address) ?></td>
                                                        <td class="text-center">
                                                            <a href="supplier_edit.php?edit_sid=<?= $supplier_id ?>" class="btn btn-outline-primary btn-sm">
                                                                <i class="bi bi-pencil"></i> 
                                                            </a>
                                                            <a href="supplier_delete.php?delete_sid=<?= $supplier_id ?>" class="btn btn-outline-danger btn-sm">
                                                                <i class="bi bi-trash"></i> 
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $index++; // Increment index counter
                                                }
                                            } else {
                                                echo '<tr>
                                                <td colspan="5" class="text-center">No records found</td>
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
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#supplierTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true
    });
});
</script>
</body>
</html>
