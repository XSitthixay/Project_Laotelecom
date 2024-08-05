<?php
include 'connect_db.php'; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>


    <style>
        .btn-outline-primary {
            margin-bottom: 10px;
            border-radius: 8px;
            border-color: #007bff;
            color: #007bff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
</head>
<body>
<?php include 'nav-menu.php'; ?>

<div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card card-style">
                    <div class="card-header">
                        <h4 class="card-title text-center">Order List</h4>
                    </div>
                    <div class="card-body text-end mt-2">
                        <!-- Add New Order Button -->
                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                            <i class="bi bi-file-earmark-plus me-1"></i>Add New Order
                        </button>
                        <!-- Add New Customer Button -->
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                            <i class="bi bi-person-plus me-1"></i>Add New Customer
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-container">
                            <table id="ordersTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#Order</th>
                                        <th>Customer Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Product Name</th>
                                        <th>Barcode</th>
                                        <th>Color</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Amount</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Database query
                                    $query = "SELECT orders.order_id, customers.customer_name, customers.customer_contact, customers.customer_address,
                                                order_details.quantity, order_details.unit_price, products.product_name, 
                                                products.barcode, products.color, orders.total_amount, orders.order_date, orders.order_status
                                              FROM orders
                                              JOIN order_details ON orders.order_id = order_details.order_id
                                              JOIN products ON order_details.product_id = products.product_id
                                              JOIN customers ON orders.customer_id = customers.customer_id";
                                    $result = mysqli_query($conn, $query);
                                    $index = 1; // Initialize the index variable

                                    // Fetch and display data
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>
                                            <td>{$index}</td>
                                            <td>{$row['customer_name']}</td>
                                            <td>{$row['customer_contact']}</td>
                                            <td>{$row['customer_address']}</td>
                                            <td>{$row['product_name']}</td>
                                            <td>{$row['barcode']}</td>
                                            <td>{$row['color']}</td>
                                            <td>{$row['quantity']}</td>
                                            <td>{$row['unit_price']}</td>
                                            <td>{$row['total_amount']}</td>
                                            <td>{$row['order_date']}</td>
                                            <td>";
                                        // Display order status
                                        if ($row['order_status'] == 'Completed') {
                                            echo "<span class='btn btn-success btn-sm'>Completed</span>";
                                        } else {
                                            echo "<span class='btn btn-danger btn-sm'>Pending</span>";
                                        }
                                        // echo "</td>
                                        //     <td>
                                        //         <a class='btn btn-outline-danger btn-sm' href='order_delete.php?delete_order_id={$row['order_id']}' onclick=\"return confirm('Are you sure you want to cancel this order?');\">
                                        //             <i class='bi bi-trash'></i> Cancel
                                        //         </a>
                                        //     </td>
                                        // </tr>";
                                        $index++; // Increment the index
                                    }
                                    ?>
                                </tbody>
                                <!-- Optional: Add a tfoot section for summary -->
                                <tfoot>
                                    <tr>
                                        <td colspan="10" class="text-end">
                                            <!-- Optionally, add summary information here -->
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="order_save.php" method="post">
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select class="form-select" id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                            <?php
                                include 'connect_db.php';
                                $customer_query = "SELECT customer_id, customer_name, customer_contact FROM customers";
                                $customer_result = mysqli_query($conn, $customer_query);
                                while ($customer_row = mysqli_fetch_assoc($customer_result)) {
                                    echo "<option value='{$customer_row['customer_id']}' data-contact='{$customer_row['customer_contact']}'>{$customer_row['customer_name']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="customer_contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="customer_contact" name="customer_contact" readonly>
                    </div>
                    <div id="products-container">
                        <div class="product-entry mb-3">
                            <label class="form-label">Product</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control product-search" placeholder="Search Product">
                            </div>
                            <select class="form-select product-select mb-2" name="product_id[]" required>
                                <option value="">Select Product</option>
                            </select>
                            <input type="text" class="form-control mb-2 barcode-input" name="barcode[]" placeholder="Barcode" readonly>
                            <input type="number" class="form-control mb-2" name="quantity[]" placeholder="Quantity" required>
                            <input type="number" class="form-control mb-2" name="unit_price[]" placeholder="Unit Price" required>
                            <button type="button" class="btn btn-danger remove-product">Remove Product</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="add-product">Add Another Product</button>

                    <div class="mb-3">
                        <label for="order_date" class="form-label">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="order_status" class="form-label">Status</label>
                        <select class="form-select" id="order_status" name="order_status" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="customer_add.php" method="post">
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="customer_contact" name="customer_contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer_address" class="form-label">Address</label>
                        <textarea class="form-control" id="customer_address" name="customer_address" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-product').addEventListener('click', function() {
        var productsContainer = document.getElementById('products-container');
        var newProductEntry = document.createElement('div');
        newProductEntry.className = 'product-entry mb-3';
        newProductEntry.innerHTML = `
            <label class="form-label">Product</label>
            <div class="input-group mb-2">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control product-search" placeholder="Search Product">
            </div>
            <select class="form-select product-select mb-2" name="product_id[]" required>
                <option value="">Select Product</option>
            </select>
            <input type="text" class="form-control mb-2 barcode-input" name="barcode[]" placeholder="Barcode" readonly>
            <input type="number" class="form-control mb-2" name="quantity[]" placeholder="Quantity" required>
            <input type="number" class="form-control mb-2" name="unit_price[]" placeholder="Unit Price" required>
            <button type="button" class="btn btn-danger remove-product">Remove Product</button>
        `;
        productsContainer.appendChild(newProductEntry);
    });

    document.getElementById('products-container').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-product')) {
            event.target.closest('.product-entry').remove();
        }
    });

    document.getElementById('products-container').addEventListener('change', function(event) {
        if (event.target.classList.contains('product-select')) {
            var selectedOption = event.target.options[event.target.selectedIndex];
            var barcode = selectedOption.getAttribute('data-barcode');
            var barcodeInput = event.target.closest('.product-entry').querySelector('.barcode-input');
            barcodeInput.value = barcode || '';
        }
    });

    document.getElementById('products-container').addEventListener('input', function(event) {
        if (event.target.classList.contains('product-search')) {
            var searchValue = event.target.value.toLowerCase();
            var productSelect = event.target.closest('.product-entry').querySelector('.product-select');
            var barcodeInput = event.target.closest('.product-entry').querySelector('.barcode-input');

            if (searchValue.length >= 2) {
                fetch('search_products.php?query=' + encodeURIComponent(searchValue))
                    .then(response => response.json())
                    .then(data => {
                        productSelect.innerHTML = '<option value="">Select Product</option>';
                        data.forEach(product => {
                            var option = document.createElement('option');
                            option.value = product.product_id;
                            option.textContent = product.product_name;
                            option.setAttribute('data-barcode', product.barcode);
                            productSelect.appendChild(option);
                        });
                    })
            } else {
                productSelect.innerHTML = '<option value="">Select Product</option>';
                barcodeInput.value = '';
            }
        }
    });

    // Remove product entry
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-product')) {
            event.target.closest('.product-entry').remove();
        }
    });

    document.getElementById('customer_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var contactNumber = selectedOption.getAttribute('data-contact');
        document.getElementById('customer_contact').value = contactNumber || '';
    });
});
</script>

<script>
        $(document).ready(function() {
            $('#ordersTable').DataTable();
        });
    </script>
</body>
</html>
