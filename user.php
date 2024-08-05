<?php include "connect_db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <style>
        .table-admin {
            background-color: #e7f3ff; /* Light Blue */
        }
        .table-saler {
            background-color: #e8f5e9; /* Light Green */
        }
        .table-accountant {
            background-color: #fff8e1; /* Light Yellow */
        }
    </style>
</head>
<body>
    <?php include "nav-menu.php"; ?>

    <div class="content">
        <div class="container-fluid">
            <!-- Admin Section -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card card-style">
                        <div class="card-header">
                            <h4 class="card-title text-center">Admin</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-container">
                                <table id="adminTable" class="table table-bordered table-hover table-admin">
                                    <thead style="background-color: #154360; color: white;">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-start">Username</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-start">Name</th>
                                            <th class="text-center">Create</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM admins ORDER BY admin_id";
                                            $result = mysqli_query($conn, $query);
                                            $result_num = mysqli_num_rows($result);
                                            if ($result_num > 0) {
                                                $index = 1; // Initialize index counter
                                                foreach ($result as $rows) {
                                                    $admin_username = $rows['admin_username'];
                                                    $admin_email = $rows['admin_email'];
                                                    $admin_name = $rows['admin_name'];
                                                    $created_at = $rows['created_at'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?= $index ?></td>
                                                        <td class="text-start"><?= $admin_username ?></td>
                                                        <td class="text-start"><?= $admin_email ?></td>
                                                        <td class="text-start"><?= $admin_name ?></td>
                                                        <td class="text-start"><?= $created_at ?></td>
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

            <!-- Saler Section -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card card-style">
                        <div class="card-header card-header-saler">
                            <h5 class="card-title text-center">Saler</h5>
                        </div>
                        <div class="card-body text-end">
                            <a href="saler_user_add.php" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus me-1"></i>Add New User</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-container">
                                <table id="salerTable" class="table table-bordered table-hover table-saler">
                                    <thead style="background-color: #145A32; color: white;">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-start">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Contact</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM saler ORDER BY saler_id";
                                            $result = mysqli_query($conn, $query);
                                            $result_num = mysqli_num_rows($result);
                                            if ($result_num > 0) {
                                                $index = 1; // Initialize index counter
                                                foreach ($result as $rows) {
                                                    $saler_id = $rows['saler_id'];
                                                    $name = $rows['name'];
                                                    $email = $rows['email'];
                                                    $contact = $rows['contact'];
                                                    $status = $rows['status'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?= $index ?></td>
                                                        <td class="text-start"><?= $name ?></td>
                                                        <td class="text-start"><?= $email ?></td>
                                                        <td class="text-start"><?= $contact ?></td>
                                                        <td class="text-center">
                                                            <?php if ($status == 'active') { ?>
                                                                <a class="btn btn-success btn-sm" href="user_status.php?status=active&id=<?= $saler_id ?>&user_type=saler">Active</a>
                                                            <?php } else { ?>
                                                                <a class="btn btn-danger btn-sm" href="user_status.php?status=inactive&id=<?= $saler_id ?>&user_type=saler">Inactive</a>
                                                            <?php } ?>

                                                        </td>
                                                        <td class="text-center">
                                                            <a href="user_delete.php?delete_uid=<?= $saler_id ?>&user_type=saler" class="btn btn-outline-danger btn-sm">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $index++; // Increment index counter
                                                }
                                            } else {
                                                echo '<tr>
                                                    <td colspan="6" class="text-center">No records found</td>
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

            <!-- Accountant Section -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card card-style">
                        <div class="card-header">
                            <h5 class="card-title text-center">Accountant</h5>
                        </div>
                        <div class="card-body text-end">
                            <a href="acc_user_add.php" type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus me-1"></i>Add New User</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-container">
                                <table id="accountantTable" class="table table-bordered table-hover table-accountant">
                                    <thead style="background-color: #7D6608; color: white;">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-start">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Contact</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM accountant ORDER BY accountant_id";
                                            $result = mysqli_query($conn, $query);
                                            $result_num = mysqli_num_rows($result);
                                            if ($result_num > 0) {
                                                $index = 1; // Initialize index counter
                                                foreach ($result as $rows) {
                                                    $accountant_id = $rows['accountant_id'];
                                                    $name = $rows['name'];
                                                    $email = $rows['email'];
                                                    $contact = $rows['contact'];
                                                    $status = $rows['status'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?= $index ?></td>
                                                        <td class="text-start"><?= $name ?></td>
                                                        <td class="text-start"><?= $email ?></td>
                                                        <td class="text-start"><?= $contact ?></td>
                                                        <td class="text-center">
                                                            <?php if ($status == 'active') { ?>
                                                                <a class="btn btn-success btn-sm" href="user_status.php?status=active&id=<?= $accountant_id ?>&user_type=accountant">Active</a>
                                                            <?php } else { ?>
                                                                <a class="btn btn-danger btn-sm" href="user_status.php?status=inactive&id=<?= $accountant_id ?>&user_type=accountant">Inactive</a>
                                                            <?php } ?>

                                                        </td>
                                                        <td class="text-center">
                                                            <a href="user_delete.php?delete_uid=<?= $accountant_id ?>&user_type=accountant" class="btn btn-outline-danger btn-sm">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $index++; // Increment index counter
                                                }
                                            } else {
                                                echo '<tr>
                                                    <td colspan="6" class="text-center">No records found</td>
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

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#adminTable').DataTable();
            $('#salerTable').DataTable();
            $('#accountantTable').DataTable();
        });
    </script>
</body>
</html>
