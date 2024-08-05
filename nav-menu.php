<!-- Custom CSS -->
<style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #ffffff;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: #283747;
            overflow-y: auto;
            padding-top: 25px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            color: #ffffff;
            font-family: 'Noto Sans', sans-serif;
        }
        .sidebar .list-group-item {
            background-color: transparent;
            border: none;
        }
        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 16px;
            color: #e9ecef;
            display: block;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #ffffff;
        }
        .card-style {
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            background-color: #ffffff;
        }
        .card-header {
            background: #283747;
            color: #ffffff;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
            padding: 15px;
        }
        .btn-outline-success {
            margin-bottom: 10px;
            border-radius: 8px;
            border-color: #28a745;
            color: #28a745;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-outline-success:hover {
            background-color: #28a745;
            color: #ffffff;
        }
        .table thead {
            background: #283747;
            color: #ffffff;
        }
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }
        .content {
            margin-top: 70px;
            position: fixed;
            top: 0;
            left: 250px; /* Aligns with the sidebar width */
            width: calc(100% - 250px); /* Adjusted to account for the sidebar width */
            height: calc(100vh - 56px); /* Assuming the navbar height is 56px */
            /* padding: 100px; */
            overflow-y: auto; /* Allows scrolling within the content area if needed */
            
            
            
        }
        .table-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        .menu-item {
            font-size: 1.25rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                width: 100%;
                top: 0;
                box-shadow: none;
            }
            .content {
                margin-left: 0;
                width: 100%;
                height: auto;
                padding: 20px;
            }
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem;
            margin: 0.1rem;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #ffffff;
            color: #fff;
        }
        .dataTables_wrapper .dataTables_filter input {
            margin: 1rem;
            border-radius: 7px;
            border: 1px solid #ddd;
        }
        .modal-header{
            background: #283747;
            color: #ffffff;
            font-weight: bold;
            
        }
        /* Dropdown menu styles */
        .sidebar .dropdown-menu {
            background-color: #495057; /* Background color for the dropdown menu */
            border: none; /* Remove default border */
            box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Optional: add a shadow for better visibility */
        }

        .sidebar .dropdown-item {
            color: #ecf0f1; /* Text color for dropdown items */
            padding: 10px 20px; /* Adjust padding if needed */
        }

        .sidebar .dropdown-item:hover {
            background-color: #34495e; /* Background color on hover */
            color: #ffffff; /* Text color on hover */
        }


        .navbar {
            background-color: #34495E !important;
            height: 7vh;
            width: 1670px;
            margin-left: 250px;
            position: fixed;
            overflow-x: auto;
            font-family: 'Noto Sans', sans-serif;
        }
        

    </style>


<div class="sidebar">
    <h4 class="card-title text-center">Inventory System</h4>
    <ul class="list-group">
        <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="list-group-item dropdown">
            <a class="dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Products
            </a>
            <ul class="dropdown-menu" aria-labelledby="productDropdown">
                <li><a class="dropdown-item" href="products.php">All Products</a></li>
                <li><a class="dropdown-item" href="product_add.php">Add Products</a></li>
            </ul>
        </li>
        <li class="list-group-item"><a href="brand.php">Brand</a></li>
        <li class="list-group-item"><a href="supplier.php">Supplier</a></li>
        <li class="list-group-item"><a href="category.php">Category</a></li>
        <li class="list-group-item"><a href="orders.php">Order</a></li>
    </ul>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid"> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto"> <!-- Added ms-auto class for right alignment -->
                <li class="nav-item">
                    <a class="nav-link" href="user.php">
                        <i class="bi bi-person-fill me-2"></i>Username
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <i class="bi bi-box-arrow-right me-2"></i> Log out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>






