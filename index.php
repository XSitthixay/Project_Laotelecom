<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .header-section {
            padding: 60px 0;
            text-align: center;
        }
        .header-section h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }
        .header-section p {
            font-size: 1.2em;
            color: #6c757d;
        }
        .content-section {
            padding: 60px 0;
        }
        .footer {
            background: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .card.card-style {
            width: 100%; /* Full width */
            max-width: 2000px; /* Max width for larger screens */
            height: 820px; /* Set a specific height */
            margin: 0 auto; /* Center the container */
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
                            <header class="header-section">
                                <div class="container">
                                    <h1>Welcome to Our Website</h1>
                                    <p>Your one-stop solution for all your needs</p>
                                </div>
                            </header>
                        </div>
                        <div class="card-body">
                            <section class="content-section">
                                <div class="container">
                                    <!-- Add your content here -->
                                    <p>This is the content section. Add your content here.</p>
                                </div>
                            </section>
                            <section class="content-section">
                                <div class="container">
                                    <!-- Add your content here -->
                                    <p>This is the content section. Add your content here.</p>
                                </div>
                            </section>
                        </div>
                        <footer class="footer">
                            <div class="container">
                                <p>&copy; 2024 Your Company. All Rights Reserved.</p>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
