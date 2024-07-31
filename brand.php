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

    
    </style>
</head>
<body>
<?php include "nav-menu.php"; ?>

<!-- Add Brand Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrandModalLabel">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="brand_add.php" method="post">
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand_desc" class="form-label">Description</label>
                        <textarea class="form-control" rows="2" style="resize: none;" name="brand_desc"></textarea>
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
                        <h4 class="card-title text-center">Brand List</h4>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="card-body text-end">
                                <!-- <a href="brand_add.php" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus me-1"></i>Add New Brand</a> -->
                                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                                    <i class="bi bi-file-earmark-plus me-1"></i>Add New Brand
                                </button>
                            </div>
                        <div class="table-responsive table-container">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-start">Brand Name</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM brands ORDER BY brand_id";
                                        $result = mysqli_query($conn, $query);
                                        if ($result) {
                                            $index = 1; // Initialize index counter
                                            while ($rows = mysqli_fetch_assoc($result)) {
                                                $brand_id = $rows['brand_id'];
                                                $brand_name = $rows['brand_name'];
                                                $brand_desc = $rows['brand_desc'];
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $index ?></td>
                                                    <td class="text-start"><?= htmlspecialchars($brand_name) ?></td>
                                                    <td class="text-start"><?= htmlspecialchars($brand_desc) ?></td>
                                                    <td class="text-center">
                                                        <a href="brand_edit.php?edit_bid=<?= $brand_id ?>" class="btn btn-outline-primary btn-sm">
                                                            <i class="bi bi-pencil"></i> 
                                                        </a>
                                                        <a href="brand_delete.php?delete_bid=<?= $brand_id ?>" class="btn btn-outline-danger btn-sm">
                                                            <i class="bi bi-trash"></i> 
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
</div>
</body>
</html>
